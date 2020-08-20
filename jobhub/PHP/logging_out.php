<?php
session_start();
require_once("account_class.php");
require_once("db_inc.php");
$Account = new Account();

if (!isset($_SESSION["user_id"]))
{
    header("Location: ../");
}

$login = $Account->login($Account->getNameFromId($_SESSION["user_id"]), $_SESSION["password"]);
$Account->logout();

session_unset();
session_destroy();

header("Location: ../");
?>