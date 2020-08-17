<?php

class Account
{
    /* Class properties (variables) */

    /* The ID of the logged in account (or NULL if there is no logged in account) */
    private $id;

    /* The name of the logged in account (or NULL if there is no logged in account) */
    private $username;

    /* The full name of the logged in account */
    private $name;

    /* The email address of the logged in account */
    private $email;

    /* The password of the logged in account */
    private $passwd;

    /* TRUE if the user is authenticated, FALSE otherwise */
    private $authenticated;


    /* Public class methods (functions) */

    /* Constructor */
    public function __construct()
    {
        /* Initialize the $id and $name variables to NULL */
        $this->id = NULL;
        $this->username = NULL;
        $this->authenticated = FALSE;
    }

    /* Destructor */
    public function __destruct()
    {

    }

    /* Add a new account to the system and return its ID (the account_id column of the accounts table) */
    public function addAccount(string $username, string $name, string $email, string $passwd, string $account_type): int
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $username = trim($username);
        $name = trim($name);
        $email = trim($email);
        $passwd = trim($passwd);

        /* Check if the user name is valid. If not, throw an exception */
        if (!$this->isNameValid($username))
        {
            throw new Exception('Invalid user name');
        }

        if (!$this->isEmailValid($email))
        {
            throw new Exception('Invalid email');
        }

        /* Check if the password is valid. If not, throw an exception */
        if (!$this->isPasswdValid($passwd))
        {
            throw new Exception('Invalid password');
        }

        /* Check if an account having the same name already exists. If it does, throw an exception */
        if (!is_null($this->getIdFromName($username)))
        {
            throw new Exception('User name not available');
        }

        /* Finally, add the new account */

        /* Insert query template */
        if (strcmp($account_type, 'applicants') == 0)
        {
            $query = 'INSERT INTO login_system.applicants (username, password, fullname, email_address) VALUES (:username, :passwd, :name, :email)';
        }
        else if (strcmp($account_type, 'employers') == 0)
        {
            $query = 'INSERT INTO login_system.employers (username, password, fullname, email_address) VALUES (:username, :passwd, :name, :email)';
        }
        else
            {
            throw new Exception('Invalid account type');
        }
        /* Password hash */
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        /* Values array for PDO */
        $values = array(':username' => $username, ':passwd' => $hash, ':fullname' => $name, ':email' => $email);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }

        /* Return the new ID */
        return $pdo->lastInsertId();
    }

    /* A sanitization check for the account username */
    public function isNameValid(string $name): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the length must be between 8 and 16 chars */
        $len = mb_strlen($name);

        if (($len < 8) || ($len > 16))
        {
            $valid = FALSE;
        }

        /* More checks to be added if need be */

        return $valid;
    }

    public function isEmailValid(String $email): bool
    {
        $valid = TRUE;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $valid = FALSE;
        }
    }

    /* A sanitization check for the account password */
    public function isPasswdValid(string $passwd): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the length must be between 8 and 16 chars */
        $len = mb_strlen($passwd);

        if (($len < 8) || ($len > 16))
        {
            $valid = FALSE;
        }

        /* More checks to be added if need be */

        return $valid;
    }

    /* A sanitization check for the account ID */
    public function isIdValid(int $id): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the ID must be between 1 and 1000000 */

        if (($id < 1) || ($id > 1000000))
        {
            $valid = FALSE;
        }

        /* More checks to be added if need be */

        return $valid;
    }

    /* Returns the account id having $name as name, or NULL if it's not found */
    public function getIdFromName(string $username, string $account_type): ?int
    {
        /* Global $pdo object */
        global $pdo;

        /* Since this method is public, we check $name again here */
        if (!$this->isNameValid($username))
        {
            throw new Exception('Invalid user name');
        }

        /* Initialize the return value. If no account is found, return NULL */
        $id = NULL;

        /* Search the ID on the database */
        if (strcmp($account_type, 'applicants'))
        {
            $query = 'SELECT account_id FROM login_system.applicants WHERE (username = :username)';
        } else if (strcmp($account_type, 'employers'))
        {
            $query = 'SELECT account_id FROM login_system.employers WHERE (username = :username)';
        } else
        {
            return $id;
        }

        $values = array(':username' => $username);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        /* There is a result: get it's ID */
        if (is_array($row))
        {
            $id = intval($row['account_id'], 10);
        }

        return $id;
    }

    /* Edit an account (selected by its ID). The name, the password and the status (enabled/disabled) can be changed */
    public function editAccount(int $id, string $username, string $name, string $email, string $passwd, bool $enabled, string $account_type)
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $username = trim($username);
        $name = trim($name);
        $email = trim($email);
        $passwd = trim($passwd);

        /* Check if the ID is valid */
        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid account ID');
        }

        /* Check if the user name is valid. */
        if (!$this->isNameValid($name))
        {
            throw new Exception('Invalid user name');
        }

        if (!$this->isEmailValid($email))
        {
            throw new Exception('Invalid email address');
        }

        /* Check if the password is valid. */
        if (!$this->isPasswdValid($passwd))
        {
            throw new Exception('Invalid password');
        }

        /* Check if an account having the same name already exists (except for this one). */
        $idFromName = $this->getIdFromName($username);

        if (!is_null($idFromName) && ($idFromName != $id))
        {
            throw new Exception('User name already used');
        }

        /* Finally, edit the account */

        /* Edit query template */
        if (strcmp($account_type, 'applicants'))
        {
            $query = 'UPDATE login_system.applicants SET username = :username, fullname = :name, email = :email, password = :passwd, account_enabled = :enabled WHERE account_id = :id';
        } else if (strcmp($account_type, 'employers'))
        {
            $query = 'UPDATE login_system.employers SET username = :username, fullname = :name, email = :email, password = :passwd, account_enabled = :enabled WHERE account_id = :id';
        }
        else
        {
            throw new Exception('Invalid account type');
        }

        /* Password hash */
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        /* Int value for the $enabled variable (0 = false, 1 = true) */
        $intEnabled = $enabled ? 1 : 0;

        /* Values array for PDO */
        $values = array(':username' => $username, ':fullname' => $name, ':email' => $email, ':passwd' => $hash, ':enabled' => $intEnabled, ':id' => $id);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }
    }

    /* Delete an account (selected by its ID) */
    public function deleteAccount(int $id, string $account_type)
    {
        /* Global $pdo object */
        global $pdo;

        /* Check if the ID is valid */
        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid account ID');
        }

        /* Query template */
        if (strcmp($account_type, 'applicants'))
        {
            $query = 'DELETE FROM login_system.applicants WHERE account_id = :id';
        }
        else if (strcmp($account_type, 'employers'))
        {
            $query = 'DELETE FROM login_system.employers WHERE account_id = :id';
        }
        /* Values array for PDO */
        $values = array(':id' => $id);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }

        /* Delete the Sessions related to the account */
        $query = 'DELETE FROM login_system.account_sessions WHERE (account_id = :id)';

        /* Values array for PDO */
        $values = array(':id' => $id);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }
    }

    /* Login with username and password */
    public function login(string $username, string $passwd, string $account_type): bool
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $username = trim($username);
        $passwd = trim($passwd);

        /* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isNameValid($username))
        {
            return FALSE;
        }

        /* Check if the password is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isPasswdValid($passwd))
        {
            return FALSE;
        }

        /* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
        if (strcmp($account_type, 'applicants')) {
            $query = 'SELECT * FROM login_system.applicants WHERE (username = :username) AND (account_enabled = 1)';
        } else if (strcmp($account_type, 'employers'))
        {
            $query = 'SELECT * FROM login_system.employers WHERE (username = :username) AND (account_enabled = 1)';
        } else
        {
            throw new Exception('Invalid account type');
        }

        /* Values array for PDO */
        $values = array(':username' => $username);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        /* If there is a result, we must check if the password matches using password_verify() */
        if (is_array($row))
        {
            if (password_verify($passwd, $row['account_passwd']))
            {
                /* Authentication succeeded. Set the class properties (id and name) */
                $this->id = intval($row['account_id'], 10);
                $this->username = $username;
                $this->authenticated = TRUE;

                /* Register the current Sessions on the database */
                $this->registerLoginSession();

                /* Finally, Return TRUE */
                return TRUE;
            }
        }

        /* If we are here, it means the authentication failed: return FALSE */
        return FALSE;
    }

    /* Saves the current Session ID with the account ID */
    private function registerLoginSession()
    {
        /* Global $pdo object */
        global $pdo;

        /* Check that a Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* 	Use a REPLACE statement to:
                - insert a new row with the session id, if it doesn't exist, or...
                - update the row having the session id, if it does exist.
            */
            $query = 'REPLACE INTO login_system.account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
            $values = array(':sid' => session_id(), ':accountId' => $this->id);

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
                throw new Exception('Database query error');
            }
        }
    }

    /* Login using Sessions */
    public function sessionLogin(string $account_type): bool
    {
        /* Global $pdo object */
        global $pdo;

        /* Check that the Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /*
                Query template to look for the current session ID on the account_sessions table.
                The query also make sure the Session is not older than 7 days
            */
            if (strcmp($account_type, 'applicants'))
                $query =

                    'SELECT * FROM login_system.account_sessions, login_system.applicants WHERE (account_sessions.session_id = :sid) ' .
                    'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' .
                    'AND (accounts.account_enabled = 1)';
            else if (strcmp($account_type, 'employers'))
                $query =

                    'SELECT * FROM login_system.account_sessions, login_system.employers WHERE (account_sessions.session_id = :sid) ' .
                    'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' .
                    'AND (accounts.account_enabled = 1)';
            else
                throw new Exception('Invalid account type');

            /* Values array for PDO */
            $values = array(':sid' => session_id());

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
                throw new Exception('Database query error');
            }

            $row = $res->fetch(PDO::FETCH_ASSOC);

            if (is_array($row))
            {
                /* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
                $this->id = intval($row['account_id'], 10);
                $this->name = $row['account_name'];
                $this->authenticated = TRUE;

                return TRUE;
            }
        }

        /* If we are here, the authentication failed */
        return FALSE;
    }

    /* Logout the current user */
    public function logout()
    {
        /* Global $pdo object */
        global $pdo;

        /* If there is no logged in user, do nothing */
        if (is_null($this->id))
        {
            return;
        }

        /* Reset the account-related properties */
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;

        /* If there is an open Session, remove it from the account_sessions table */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* Delete query */
            $query = 'DELETE FROM login_system.account_sessions WHERE (session_id = :sid)';

            /* Values array for PDO */
            $values = array(':sid' => session_id());

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
                throw new Exception('Database query error');
            }
        }
    }

    /* "Getter" function for the $authenticated variable
    Returns TRUE if the remote user is authenticated */
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

    /* Close all account Sessions except for the current one (aka: "logout from other devices") */
    public function closeOtherSessions()
    {
        /* Global $pdo object */
        global $pdo;

        /* If there is no logged in user, do nothing */
        if (is_null($this->id))
        {
            return;
        }

        /* Check that a Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* Delete all account Sessions with session_id different from the current one */
            $query = 'DELETE FROM login_system.account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';

            /* Values array for PDO */
            $values = array(':sid' => session_id(), ':account_id' => $this->id);

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
                throw new Exception('Database query error');
            }
        }
    }

}
?>