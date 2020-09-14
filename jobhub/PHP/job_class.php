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

        return $pdo->lastInsertId();
    }

    public function deleteJob(int $id)
    {
        global $pdo;

        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid job ID');
        }

        $query = 'DELETE FROM login_system.accounts WHERE (job_id = :id)';

        $values = array(':id' => $id);

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

    public function editJob(string $jobname,
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

        $query = 'UPDATE login_system.accounts SET job_name = :name,
                                                   job_short_desc = :shortdesc,
                                                   job_desc = :desc,
                                                   job_skills = :skills,
                                                   job_education = :education,
                                                   job_apply_date = :applydate,
                                                   job_location = :location,
                                                   job_nature = :nature,
                                                   job_salary = :salary';

        $values = array(
            ':name' => $jobname,
            ':shortdesc' => $jobshortdesc,
            ':desc' => $jobdesc,
            ':skills' => $jobskills,
            ':education' => $jobeducation,
            ':applydate' => $jobapplydate,
            ':location' => $joblocation,
            ':nature' => $jobnature,
            ':salary' => $jobsalary
        );

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

    public function isIdValid(int $id): bool
    {
        $valid = TRUE;

        if(($id < 1) || ($id > 10))
        {
            $valid = FALSE;
        }

        return $valid;
    }

}