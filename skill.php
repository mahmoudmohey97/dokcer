<?php
include_once 'objects/user.php';
class Skill
{

    private $conn;
    private $table_name = "skills";
    public $SKILL;
    public function __construct($db)
    {
        $this-> conn = $db;
    }

    function delete($id)
    {
        //echo "---------->".$id ;
        $query = "DELETE FROM skills
                         WHERE skills.SKILLID IN (SELECT hasskills.SKILLID
                                                   FROM hasskills
                                                    WHERE hasskills.USERID = '{$id}')";
        $var = $this->conn->query($query);
        //$query2 = "DELETE FROM hasskills WHERE hasskills.USERID = '{$id}'";
        //$var2 = $this->conn->query($query2);
        if($var != null )
            return true;
        else
            return false;
    }

    function update($id)
    {
        if($this->SKILL != null)
            $skillsarr = $str_arr = explode (",", $this->SKILL);
        else
        {
            $skillsarr = array();
            array_push($skillsarr, "null");
        }

        for ($i = 0 ; $i < sizeof($skillsarr) ; $i++)
        {
            $query = "INSERT INTO " . $this->table_name . "
            SET SKILL = '{$skillsarr[$i]}'";
            $varr = $this->conn->query($query);

            $query2 = "SELECT * FROM skills WHERE SKILL = '{$skillsarr[$i]}'";
            $arr = $this->conn->query($query2)->fetchAll();
            $last = $arr[sizeof($arr) -1];

            $query3 = "INSERT INTO hasskills
            SET USERID = '{$id}' , SKILLID= '{$last["SKILLID"]}'";
            $varr = $this->conn->query($query3);

        }
    }

    function create()
    {
        if($this->SKILL != null)
            $skillsarr = $str_arr = explode (",", $this->SKILL);
        else
        {
            $skillsarr = array();
            array_push($skillsarr, "null");
        }
        //print_r($skillsarr);
        $queryUserId = "Select * from applicant";
        $arr = $this->conn->query($queryUserId)->fetchAll();
        $userId = $arr[sizeof($arr)-1]["USERID"];

        for ($i = 0 ; $i < sizeof($skillsarr) ; $i++)
        {
            $query = "INSERT INTO " . $this->table_name . "
            SET SKILL = '{$skillsarr[$i]}'";
            $varr = $this->conn->query($query);

            $query2 = "SELECT * FROM skills WHERE SKILL = '{$skillsarr[$i]}'";
            $arr = $this->conn->query($query2)->fetchAll();
            $last = $arr[sizeof($arr) -1];

            $query3 = "INSERT INTO hasskills
            SET USERID = '{$userId}' , SKILLID= '{$last["SKILLID"]}'";
            $varr = $this->conn->query($query3);

        }
        return true;


    }


}
