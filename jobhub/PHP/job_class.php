<?php

class Job
{
    private $id;
    private $name;

    public function __construct()
    {
        $this->id = NULL;
        $this->name = NULL;
    }

    public function __destruct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function addJob(string $jobname,
                           string $jobshortdesc,
                           string $jobdesc,
                           string $jobskills,
                           string $jobeducation,
                           string $jobapplydate,
                           string $joblocation,
                           string $jobnature,
                           string $jobsalary)
    {
        global $pdo;

        $query = 'INSERT INTO login_system.jobs (job_name, 
                                                job_short_desc, 
                                                job_desc,
                                                job_skills, 
                                                job_education, 
                                                job_apply_date, 
                                                job_location, 
                                                job_nature, 
                                                job_salary) 
                                                VALUES (:name, 
                                                :shortdesc, 
                                                :desc, 
                                                :skills, 
                                                :education, 
                                                :applydate, 
                                                :location, 
                                                :nature, 
                                                :salary)';
        $values = array(':name' => $jobname,
            ':shortdesc' => $jobshortdesc,
            ':desc' => $jobdesc,
            ':skills' => $jobskills,
            ':education' => $jobeducation,
            ':applydate' => $jobapplydate,
            ':location' => $joblocation,
            ':nature' => $jobnature,
            ':salary' => $jobsalary);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error');
        }
    }
}