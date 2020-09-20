<?php


require_once("../db_inc.php");

$del = $_GET['del'];

$conn = mysqli_connect("localhost", "outsideadmin", "bLb$?Se%@6@U*5CK", "login_system");

$query = mysqli_query($conn, "DELETE from accounts where account_id='$del' ");

if ($query) {
    echo "<script>alert('Record has been deleted')</script>";
    header('location:users.php');
}else{
    echo "<script>alert('Record has not been deleted')</script>";
}
?>