<?php
session_start();
require './db_inc.php';
require './account_class.php';

$conn = mysqli_connect("localhost", "root", "", "login_system");
 
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$jobname = mysqli_real_escape_string($conn, $_REQUEST['jobname']);
$jobshortdesc = mysqli_real_escape_string($conn, $_REQUEST['jobshortdesc']);
$jobdesc = mysqli_real_escape_string($conn, $_REQUEST['jobdesc']);
$jobskills = mysqli_real_escape_string($conn, $_REQUEST['jobskills']);
$jobeducation = mysqli_real_escape_string($conn, $_REQUEST['jobeducation']);
$jobapply = mysqli_real_escape_string($conn, $_REQUEST['jobapply']);
$joblocation = mysqli_real_escape_string($conn, $_REQUEST['joblocation']);
$jobnature = mysqli_real_escape_string($conn, $_REQUEST['jobnature']);
$jobsalary = mysqli_real_escape_string($conn, $_REQUEST['jobsalary']);
$ID = mysqli_real_escape_string($conn, $_REQUEST['sessionid']);

$sql = "INSERT INTO jobs (jobname, jobshortdesc, jobdesc, jobskills, jobeducation, jobapply, joblocation, jobnature, jobsalary, employerID) VALUES ('$jobname', '$jobshortdesc', '$jobdesc', '$jobskills', '$jobeducation', '$jobapply', '$joblocation', '$jobnature', '$jobsalary', '$ID')";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: ../index.php");

?>