<?php

if (!(isset($_SESSION["no_username"])
    || isset($_SESSION["no_password"])
    || isset($_SESSION["incorrect_username_password"])
    || isset($_SESSION["session_error"])))
{
    session_start();
}

require './db_inc.php';
require './account_class.php';

$account = new Account();
$login = false;

echo "Your username is: ".$_POST["username"]."<br>";
echo "Your password is: ".$_POST["password"]."<br>";

if($_POST["username"] == "" && $_POST["password"] == "")
{
    $_SESSION["no_username"] = true;
    $_SESSION["no_password"] = true;
    header("Location: ../login.php");
} else if($_POST["username"] == "")
{
    $_SESSION["no_username"] = true;
    header("Location: ../login.php");
} else if($_POST["password"] == "")
{
    $_SESSION["no_password"] = true;
    header("Location: ../login.php");
}

$_SESSION["password"] = $_POST["password"];

if (!isset($_POST["username"]) || !isset($_POST["password"]))
{
    if(isset($_SESSION['currentpage']))
        header("Location: " . $_SESSION['currentpage']);
    else
        header("Location: ./index.php");
}

// Login Process
try {
    $login = $account->login($_POST["username"], $_POST["password"]);
}

catch (Exception $e)
{
    echo $e->getMessage();
    die();
}

if ($login)
{
    echo 'Authentication successful (login).' . '<br>';
    echo 'Account ID: ' . $account->getId() . '<br>';
    echo 'Account name: ' . $account->getName() . '<br>';
}

else
{
    $_SESSION["incorrect_username_password"] = true;
    header("Location: ../login.php");
}

// Session Login Process
try
{
    $login = $account->sessionLogin();
}
catch (Exception $e)
{
    echo $e->getMessage();
    die();
}

if ($login)
{
    echo 'Authentication successful (session login).<br>';
    echo 'Account ID: ' . $account->getId() . '<br>';
    echo 'Account name: ' . $account->getName() . '<br>';
    $_SESSION["user_id"] = $account->getId();
    header("Location: ../");
}
else
{
    $_SESSION["session_error"] = true;
    header("Location: ../login.php");
}
?>