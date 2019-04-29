<?php
class Interest
{
    private $conn;
    private $tableName = "interest";
    public $choosenInterests;
    public const interests = array("Machine Learning" , "Web Development" , "Artificial Intelligence" ,
        "Programming" ,"Finance" ,"Game Development" , "Mobile Development");

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    function create()
    {
        $interestsArr = explode("," , $this->choosenInterests);
        //check on size
        if(sizeof($interestsArr) < 1 || sizeof($interestsArr) > 5)
        {
            //choosse if written interests meet written one
            echo "interests num";
            return false;
        }

        else
        {
            $query = "SELECT * FROM company";
            $holdAll = $this->conn->query($query)->fetchAll();
            $userId =  $holdAll[sizeof($holdAll) -1]["USERID"];
            for($i = 0 ; $i < sizeof($interestsArr) ; $i++)
            {
                $query2 = "INSERT INTO ".$this->tableName." 
                           SET INTERESTS = '{$interestsArr[$i]}' ,
                                COM_USERID = '{$userId}' ";
                $result = $this-> conn->query($query2);
                if ($result == null)
                    return false;
            }
            return true;
        }
    }

    function createForApplicant()
    {
        $interestsArr = explode("," , $this->choosenInterests);
        //check on size
        if(sizeof($interestsArr) < 1 || sizeof($interestsArr) > 5)
        {
            //choosse if written interests meet written one
            echo "interests num";
            return false;
        }

        else
        {
            $query = "SELECT * FROM applicant";
            $holdAll = $this->conn->query($query)->fetchAll();
            $userId =  $holdAll[sizeof($holdAll) -1]["USERID"];
            for($i = 0 ; $i < sizeof($interestsArr) ; $i++)
            {
                $query2 = "INSERT INTO ".$this->tableName." 
                           SET INTERESTS = '{$interestsArr[$i]}' ,
                                USERID = '{$userId}' ";
                $result = $this-> conn->query($query2);
                if ($result == null)
                    return false;
            }
            return true;
        }
    }

    function delete($id)
    {
        //echo "---------->".$id ;
        $query = "DELETE FROM interest
                         WHERE interest.COM_USERID ='{$id}'";
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
        $interestsArr = explode("," , $this->choosenInterests);
        //check on size
        if(sizeof($interestsArr) < 1 || sizeof($interestsArr) > 5)
        {
            //choosse if written interests meet written one
            echo "interests num";
            return false;
        }

        else
        {
            for($i = 0 ; $i < sizeof($interestsArr) ; $i++)
            {
                $query2 = "INSERT INTO ".$this->tableName." 
                           SET INTERESTS = '{$interestsArr[$i]}' ,
                                COM_USERID = '{$id}' ";
                $result = $this-> conn->query($query2);
                if ($result == null)
                    return false;
            }
            return true;
        }
    }

    function deleteApplicant($id)
    {
        //echo "---------->".$id ;
        $query = "DELETE FROM interest
                         WHERE interest.USERID ='{$id}'";
        $var = $this->conn->query($query);
        //$query2 = "DELETE FROM hasskills WHERE hasskills.USERID = '{$id}'";
        //$var2 = $this->conn->query($query2);
        if($var != null )
            return true;
        else
            return false;
    }

    function updateApplicant($id)
    {
        $interestsArr = explode("," , $this->choosenInterests);
        //check on size
        if(sizeof($interestsArr) < 1 || sizeof($interestsArr) > 5)
        {
            //choosse if written interests meet written one
            echo "interests num";
            return false;
        }

        else
        {
            for($i = 0 ; $i < sizeof($interestsArr) ; $i++)
            {
                $query2 = "INSERT INTO ".$this->tableName." 
                           SET INTERESTS = '{$interestsArr[$i]}' ,
                                USERID = '{$id}' ";
                $result = $this-> conn->query($query2);
                if ($result == null)
                    return false;
            }
            return true;
        }
    }
}