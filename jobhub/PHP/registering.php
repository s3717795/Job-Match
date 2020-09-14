<?php
session_start();
require_once("account_class.php");
require_once("db_inc.php");
$account = new Account();
$pass = TRUE;

if(!(isset($_POST)))
{
    if (isset($_SESSION['currentpage']))
        header("Location: " . $_SESSION['currentpage']);
    else
        header("Location: ./index.php");
}

if ($_POST["username"] == "")
{
    $_SESSION["username_error2"] = TRUE;
    $pass = FALSE;
} else if (!$account->isNameValid($_POST["username"]))
{
    $_SESSION["username_error3"] = TRUE;
    $pass = FALSE;
} else if (!is_null($account->getIdFromName($_POST["username"])))
{
    $_SESSION["username_error1"] = TRUE;
    $pass = FALSE;
}

if ($_POST["password"] == "")
{
    $_SESSION["password_error1"] = TRUE;
    $pass = FALSE;
} else if (!$account->isPasswdValid($_POST["password"]))
{
    $_SESSION["password_error2"] = TRUE;
    $pass = FALSE;
}

if ($_POST["password2"] == "")
{
    $_SESSION["password2_error1"] = TRUE;
    $pass = FALSE;
} else if (!($_POST["password"] == $_POST["password2"]))
{
    $_SESSION["password2_error2"] = TRUE;
    $pass = FALSE;
}

if ($_POST["fullname"] == "")
{
    $_SESSION["fullname_error1"] = TRUE;
    $pass = FALSE;
} /* Fullname regex check WIP */

if (!$account->isEmailValid($_POST["email"]) && !($_POST["email"] == ""))
{
    $_SESSION["email_error"] = TRUE;
    $pass = FALSE;
}

if (!$account->isPhoneValid($_POST["phone"]) && !($_POST["phone"] == ""))
{
    $_SESSION["phone_error"] = TRUE;
    $pass = FALSE;
}

if ($pass)
{
    try
    {
        $newId = $account->addAccount($_POST["username"], $_POST["password"], $_POST["type"]);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        die();
    }

    echo 'The new account ID is ' . $newId . '<br>';

    try
    {
        // editAccount(accountID, username, password, full_name, email, phone, enabled_status);

        $account->editAccount($account->getIdFromName($_POST["username"]),
            $_POST["username"],
            $_POST["password"],
            $_POST["fullname"],
            $_POST["email"],
            $_POST["phone"],
            TRUE);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        die();
    }

    echo 'Account edit successful.<br>';
    $_SESSION["account_created"] = TRUE;
    header("Location: ../account_registered.php");
} else
{
    header("Location: ../register.php");
}

?>