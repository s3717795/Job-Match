<?php
session_start();
require './db_inc.php';
require './account_class.php';

$link = mysqli_connect("localhost", "root", "", "login_system");
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$jobname = mysqli_real_escape_string($link, $_REQUEST['jobname']);
$jobshortdesc = mysqli_real_escape_string($link, $_REQUEST['jobshortdesc']);
$jobdesc = mysqli_real_escape_string($link, $_REQUEST['jobdesc']);
$jobskills = mysqli_real_escape_string($link, $_REQUEST['jobskills']);
$jobeducation = mysqli_real_escape_string($link, $_REQUEST['jobeducation']);
$jobapply = mysqli_real_escape_string($link, $_REQUEST['jobapply']);
$joblocation = mysqli_real_escape_string($link, $_REQUEST['joblocation']);
$jobnature = mysqli_real_escape_string($link, $_REQUEST['jobnature']);
$jobsalary = mysqli_real_escape_string($link, $_REQUEST['jobsalary']);
$ID = mysqli_real_escape_string($link, $_REQUEST['sessionid']);

$sql = "INSERT INTO jobs (jobname, jobshortdesc, jobdesc, jobskills, jobeducation, jobapply, joblocation, jobnature, jobsalary, employerID) VALUES ('$jobname', '$jobshortdesc', '$jobdesc', '$jobskills', '$jobeducation', '$jobapply', '$joblocation', '$jobnature', '$jobsalary', '$ID')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);

header("Location: ../index.php");

?>