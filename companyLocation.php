<?php
class CompanyLocation
{
	private $conn;
    private $tableName = "companylocation";
    public $companyLocations;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create()
    {
    	//echo($this->companyLocations);
    	$locationsArr = explode("," , $this->companyLocations);
    	//echo(sizeof($locationsArr));
    	if(sizeof($locationsArr) == 0)
    		return false;
    	$query = "SELECT * FROM company";
        $holdAll = $this->conn->query($query)->fetchAll();
        $userId =  $holdAll[sizeof($holdAll) -1]["USERID"];
        for($i = 0 ; $i < sizeof($locationsArr) ; $i++)
        {
        	echo "heree";
            $query2 = "INSERT INTO ".$this->tableName." 
                       SET LOCACATION = '{$locationsArr[$i]}' ,
        	                USERID = '{$userId}'";
            $result = $this-> conn->query($query2);
            if ($result == null)
                return false;
        }
            return true;
    }

   	 function delete($id)
    {
        //echo "---------->".$id ;
        $query = "DELETE FROM companylocation
                         WHERE CompanyLocation.USERID ='{$id}'";
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
        $locationsArr = explode("," , $this->companyLocations);
        //check on size
        if(sizeof($locationsArr) < 1)
        {
            return false;
        }

        else
        {
            for($i = 0 ; $i < sizeof($locationsArr) ; $i++)
            {
                $query2 = "INSERT INTO ".$this->tableName." 
                           SET LOCACATION = '{$locationsArr[$i]}' ,
                                USERID = '{$id}'";
                $result = $this-> conn->query($query2);
                if ($result == null)
                    return false;
            }
            return true;
        }
    }

}
?>