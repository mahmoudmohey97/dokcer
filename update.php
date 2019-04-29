<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once'config/database.php';
include_once 'objects/user.php';
include_once 'objects/skill.php';
include_once 'objects/interest.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$skill = new Skill($db);
$interest = new Interest($db);
$data = json_decode(file_get_contents("php://input"));

$skill->SKILL = $data->SKILL;
$interest->choosenInterests = $data->interests;
$user->EMAIL = $data->EMAIL;
$user->FNAME = $data->FNAME;
$user->AGE = $data->AGE;
$user->MOBILENUM = $data->MOBILENUM;
$user->GENDER = $data->GENDER;
$user->LNAME = $data->LNAME;



if($user->update($user->EMAIL))
{
    $id = $user->getUserId($user->EMAIL);
   if($skill->delete($id))
   {

       $skill->update($id);
       if($interest->deleteApplicant($id))
       {
        $interest->updateApplicant($id);
        http_response_code(200);
        echo json_encode(array("message"=>"update 8aleban succesfull"));
       }
       else
       {
        http_response_code(500);
        echo json_encode(array("meesage"=>"error deleting interests"));
       }
       
   }
   else
   {
       http_response_code(500);
       echo json_encode(array("meesage"=>"error deleting skills"));
   }
}
else
{
    http_response_code(501);
    json_encode(array("message"=>"error updatiing user properties"));
}


