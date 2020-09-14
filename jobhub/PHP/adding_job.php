<?php

require './db_inc.php';
require './account_class.php';
require './job_class.php';

$job = new Job();

if(!isset($_POST))
{
    if(isset($_SESSION['currentpage']))
        header("Location: " . $_SESSION['currentpage']);
    else
        header("Location: ../index.php");
}

$jobname = $_POST["jobname"];
$jobshortdesc = $_POST["shortjobdesc"];
$jobdesc = $_POST["jobdesc"];
$jobskills = $_POST["jobskills"];
$jobeducation = $_POST["jobeducation"];
$jobapplydate = $_POST["jobapplydate"];
$joblocation = $_POST["joblocation"];
$jobnature = $_POST["natures"];
$jobsalary = $_POST["jobsalary"];

echo "Job name: ".$jobname."<br>";
echo "Job short description: ".$jobshortdesc."<br>";
echo "Job description: ".$jobdesc."<br>";
echo "Job skills: ".$jobskills."<br>";
echo "Job education: ".$jobeducation."<br>";
echo "Job apply date: ".$jobapplydate."<br>";
echo "Job location: ".$joblocation."<br>";
echo "Job nature: ".$jobnature."<br>";
echo "Job salary: ".$jobsalary."<br>";

// Add checks for job details, otherwise...

try
{
    $newId = $job->addJob($jobname,
                        $jobshortdesc,
                        $jobdesc,
                        $jobskills,
                        $jobeducation,
                        $jobapplydate,
                        $joblocation,
                        $jobnature,
                        $jobsalary);
}
catch (Exception $e)
{
    echo $e->getMessage();
    die();
}

echo 'Job posting successful.<br>';
$_SESSION["job_posted"] = TRUE;
//header("Location: ../job_posted.php");
?>