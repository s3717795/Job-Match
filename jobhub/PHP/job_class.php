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

    public function searchJob($query)
    {
        $servername = "localhost";
        $username = "outsideadmin";
        $password = "bLb$?Se%@6@U*5CK";
        $dbname = "login_system";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql1 = "SELECT * FROM login_system.jobs";
        $res1 = mysqli_query($conn, $sql1);

        if(!$res1)
        {
            echo "error ".mysqli_error($conn);
        }

//        global $pdo;
//
//        $sql1 = "SELECT * FROM login_system.jobs";
//        try {
//            $res = $pdo->prepare($sql1);
//            $res->execute();
//        }
//        catch (PDOException $e)
//        {
//            throw new Exception('Database query error');
//        }
//
//        while($row = $res->fetch(PDO::FETCH_ASSOC))
        while($row = mysqli_fetch_assoc($res1))
        {
            $sound = " ";
            if ($row['job_name']!=null)
            {
                $words = explode(" ", $row['job_name']);
                foreach($words as $word)
                {
                    $sound.=metaphone($word)." ";
                }
            }

            if ($row['job_short_desc']!=null)
            {
                $words = explode(" ", $row['job_short_desc']);
                foreach($words as $word)
                {
                    $sound.=metaphone($word)." ";
                }
            }

            if ($row['job_desc']!=null)
            {
                $words = explode(" ", $row['job_desc']);
                foreach($words as $word)
                {
                    $sound.=metaphone($word)." ";
                }
            }

            // Free to add others

            $id = $row['job_id'];
            $sql2 = "UPDATE login_system.jobs SET indexing = '$sound' WHERE job_id = '$id'";

//            $values = array(':sound' => $sound, ':id' => $id);

//            try
//            {
//                $res = $pdo->prepare($sql2);
//                $res->execute($values);
//            }
//            catch (PDOException $e)
//            {
//                throw new Exception('Database update error');
//            }

            $res2 = mysqli_query($conn, $sql2);

            if(!$res2)
            {
                echo "error ".mysqli_error($conn);
            }


        }

        $words = $this->filterSearchKeys($query);
//        $words = explode(" ", $query);
        $search_string = "";

        foreach($words as $word)
        {
            $search_string.=metaphone($word)." ";
        }

//        echo $search_string."<br>";
        $sql = "SELECT * FROM login_system.jobs WHERE indexing like '%$search_string%'";
//      $values = array(':search_string', $search_string);

//        try
//        {
//            $res = $pdo->prepare($sql);
//            $res->execute($values);
//        }
//        catch (PDOException $e)
//        {
//            throw new Exception('Database query error');
//        }

        $res = mysqli_query($conn, $sql);

        if(!$res)
        {
            echo "error ".mysqli_error($conn);
        }

        return $res;
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

    function filterSearchKeys($query)
    {
        $query = trim(preg_replace("/(\s+)+/", " ", $query));
        $words = array();
        // expand this list with your words.
        $list = array("in","it","a","the","of","or","I","you","he","me","us","they","she","to","but","that","this","those","then");
        $c = 0;
        foreach(explode(" ", $query) as $key){
            if (in_array($key, $list)){
                continue;
            }
            $words[] = $key;
            if ($c >= 15){
                break;
            }
            $c++;
        }
        return $words;
    }

    function limitChars($query, $limit = 200){
        return substr($query, 0,$limit);
    }

    public function getNameFromId($id): ?string
    {
        global $pdo;

        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid job ID');
        }

        $name = null;

        $query = 'SELECT job_name FROM login_system.jobs WHERE (job_id = :id)';
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

        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (is_array($row))
        {
            $desc = $row['job_name'];
        }

        return $desc;
    }

    public function getShortDescFromId($id): ?string
    {
        global $pdo;

        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid job ID');
        }

        $shortdesc = null;

        $query = 'SELECT job_short_desc FROM login_system.jobs WHERE (job_id = :id)';
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

        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (is_array($row))
        {
            $shortdesc = $row['job_short_desc'];
        }

        return $shortdesc;
    }

    public function getDescFromId($id): ?string
    {
        global $pdo;

        if (!$this->isIdValid($id))
        {
            throw new Exception('Invalid job ID');
        }

        $desc = null;

        $query = 'SELECT job_desc FROM login_system.jobs WHERE (job_id = :id)';
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

        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (is_array($row))
        {
            $desc = $row['job_desc'];
        }

        return $desc;
    }
}