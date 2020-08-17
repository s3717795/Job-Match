<?php

session_start();

require './db_connection.php';
require './account_class.php';

$account = new Account();

try
{
    $newId = $account->addAccount('myNewName', 'Full Name', 'newname@name.com', 'myPassword');
}
catch (Exception $e)
{
    echo $e->getMessage();
    die;
}

echo 'The new account ID is '.$newId;
?>