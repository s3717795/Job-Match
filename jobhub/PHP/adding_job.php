<?php
session_start();
require './db_inc.php';
require './account_class.php';

$conn = mysqli_connect("localhost", "outsideadmin", "bLb$?Se%@6@U*5CK", "login_system");
 
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

$sql = "INSERT INTO jobs (job_name, job_short_desc, job_desc, job_skills, job_education, job_apply_date, job_location, job_nature, job_salary, employer_id) VALUES ('$jobname', '$jobshortdesc', '$jobdesc', '$jobskills', '$jobeducation', '$jobapply', '$joblocation', '$jobnature', '$jobsalary', '$ID')";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
    $_SESSION['job_created'];
    mysqli_close($conn);
    header("Location: ../");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>