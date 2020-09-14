<?php


require_once("../db_inc.php");

$del = $_GET['del'];


$query = mysqli_query($conn, "DELETE from accounts where account_id='$del' ");

if ($query) {
    echo "<script>alert('Record has been deleted')</script>";
    header('location:employers.php');
}else{
    echo "<script>alert('Record has not been deleted')</script>";
}
?>