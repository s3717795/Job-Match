<?php

/* Host name of the MySQL server */
$host = 'localhost';

/* MySQL account username */
$user = 'outsideadmin';

/* MySQL account password */
$passwd = 'bLb$?Se%@6@U*5CK';

/* The schema you want to use */
$schema = 'login_system';

/* The PDO object */
$pdo = NULL;

/* Connection string, or "data source name" */
$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

/* Connection inside a try/catch block */
try
{
    /* PDO object creation */
    $pdo = new PDO($dsn, $user,  $passwd);

    /* Enable exceptions on errors */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    /* If there is an error an exception is thrown */
    echo 'Database connection failed.';
    die();
}

?>