<?php

/* Host name of the MySQL server */
$host = getenv('CLOUDSQL_DSN');

/* MySQL account username */
$user = getenv('CLOUDSQL_USER');

/* MySQL account password */
$passwd = getenv('CLOUDSQL_PASSWORD');

/* The schema you want to use */
$schema = getenv('CLOUDSQL_DB');

/* The PDO object */
$pdo = NULL;

$conn = mysqli_connect(null, $user, $passwd, $schema, null, $host);

/* Connection string, or "data source name" */
$dsn = getenv('CLOUDSQL_DSN');

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