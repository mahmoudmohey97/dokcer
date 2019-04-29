<?php
class User
{
    private $conn;
    private $table_name = "applicant";

    public $FNAME;
    public $LNAME;
    public $EMAIL;
    public $PASSWORD;
    public $MOBILENUM;
    public $GENDER;
    public $AGE;
    public $USERNAME;



    public function __construct($db)
    {
        $this-> conn = $db;

    }
    public function setfname($name)
    {
        $this->FNAME ="";
        $this->FNAME = $name;
    }

    /**
     * @return mixed
     */
    public function getFNAME()
    {
        return $this->FNAME;
    }

    function getUserId($email)
    {
       $var = $this->conn->query("SELECT * FROM applicant WHERE EMAIL='{$email}'")->fetchAll();
       return $var[0]["USERID"];
    }

    function update($email)
    {
        if($this->FNAME != null and $this->LNAME != null and $this->GENDER != null and $this->MOBILENUM != null and $this->AGE != null and $this->emailExists($this->EMAIL))
        {
            $query = "UPDATE applicant
                  SET
                    FNAME = :FNAME,
                    LNAME = :LNAME,
                    MOBILENUM = :MOBILENUM,
                    GENDER = :GENDER,
                    AGE = :AGE  
                    WHERE applicant.EMAIL = '{$email}'";



            $stmt = $this->conn->prepare($query);


            $this->FNAME = htmlspecialchars(strip_tags($this->FNAME));
            $this->LNAME = htmlspecialchars(strip_tags($this->LNAME));
            $this->GENDER = htmlspecialchars(strip_tags($this->GENDER));
            $this->MOBILENUM = htmlspecialchars(strip_tags($this->MOBILENUM));
            $this->AGE = htmlspecialchars(strip_tags($this->AGE));

            $stmt->bindParam(':FNAME', $this->FNAME,PDO::PARAM_STR);
            $stmt->bindParam(':LNAME', $this->LNAME);
            $stmt->bindparam(':AGE', $this->AGE);
            $stmt->bindParam(':GENDER', $this->GENDER);
            $stmt->bindParam(':MOBILENUM', $this->MOBILENUM);

            if ($stmt->execute())
            {
                //echo($stmt->rowCount());
                return true;
            }
            return false;
        }

        else
        {
            return false;
        }
    }

    function readById($id)
    {
        $query = "select applicant.FNAME , applicant.LNAME, applicant.AGE , applicant.EMAIL ,applicant.USERNAME ,applicant.GENDER,applicant.MOBILENUM, GROUP_CONCAT(SKILL) as skill_name 
                    FROM skills , applicant WHERE SKILLID IN 
                    ( SELECT hasskills.SKILLID FROM hasskills WHERE hasskills.USERID = '{$id}' ) GROUP BY applicant.USERNAME";
        //$query = "select FNAME, LNAME, AGE , EMAIL , USERNAME from applicant";
        $stmt = $this->conn->query($query);
        return $stmt;
    }
    function read()
    {

        $query = "select applicant.FNAME , applicant.LNAME, applicant.AGE , applicant.EMAIL ,applicant.USERNAME ,applicant.GENDER,applicant.MOBILENUM, GROUP_CONCAT(SKILL) as skill_name 
                    FROM skills , applicant WHERE SKILLID IN 
                    ( SELECT hasskills.SKILLID FROM hasskills WHERE hasskills.USERID = applicant.USERID ) GROUP BY applicant.USERNAME";
        //$query = "select FNAME, LNAME, AGE , EMAIL , USERNAME from applicant";
        $querylocations = "select applicant.FNAME , applicant.LNAME, applicant.AGE , applicant.EMAIL ,applicant.USERNAME ,applicant.GENDER,applicant.MOBILENUM, interest.INTERESTS
                    FROM applicant, interest
                    WHERE applicant.USERID = interest.USERID";
        $stmt = $this->conn->query($query);
        return $stmt;
    }
    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                FNAME = :FNAME,
                LNAME = :LNAME,
                MOBILENUM = :MOBILENUM,
                GENDER = :GENDER,
                EMAIL = :EMAIL,
                USERNAME = :USERNAME,
                AGE = :AGE,
                PASSWORD = :PASSWORD";



        $stmt = $this-> conn-> prepare($query);
        $this->FNAME=htmlspecialchars(strip_tags($this->FNAME));
        $this->LNAME=htmlspecialchars(strip_tags($this->LNAME));
        $this->EMAIL=htmlspecialchars(strip_tags($this->EMAIL));
        $this->GENDER=htmlspecialchars(strip_tags($this->GENDER));
        $this->MOBILENUM=htmlspecialchars(strip_tags($this->MOBILENUM));
        $this->AGE=htmlspecialchars(strip_tags($this->AGE));
        $this->USERNAME=htmlspecialchars(strip_tags($this->USERNAME));
        $this->PASSWORD=htmlspecialchars(strip_tags($this->PASSWORD));

        $stmt-> bindParam(':FNAME' , $this-> FNAME);
        $stmt-> bindParam(':LNAME' , $this-> LNAME);
        $stmt-> bindparam(':AGE' ,$this-> AGE);
        $stmt-> bindParam(':USERNAME' , $this-> USERNAME);
        $stmt-> bindParam(':EMAIL' , $this-> EMAIL);
        $stmt->bindParam(':PASSWORD', $this->PASSWORD);
        $stmt->bindParam(':GENDER', $this->GENDER);
        $stmt->bindParam(':MOBILENUM', $this->MOBILENUM);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function emailExists()
    {
        // query to check if email exists
        $query = "SELECT USERID, PASSWORD
            FROM " . $this->table_name . "
            WHERE EMAIL = ?
            LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->EMAIL=htmlspecialchars(strip_tags($this->EMAIL));

        // bind given email value
        $stmt->bindParam(1, $this->EMAIL);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num > 0)
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->USERID = $row['USERID'];
            $this->PASSWORD = $row['PASSWORD'];
            return true;
        }
        return false;
    }
}