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
$user =new User($db);
$skill = new Skill($db);
$interest = new Interest($db);

$data = json_decode(file_get_contents("php://input"));
$user->FNAME = $data->FNAME;
$user->LNAME = $data->LNAME;
$user->AGE = $data->AGE;
$user->MOBILENUM = $data->MOBILENUM;
$user->GENDER = $data->GENDER;
$user-> EMAIL = $data->EMAIL;
$user-> USERNAME = $data-> USERNAME;
$user-> PASSWORD = $data-> PASSWORD;
$skill->SKILL = $data-> SKILL;
$interest->choosenInterests = $data-> interests;

if($user->emailExists())
{
    http_response_code(400);
    echo json_encode(array("message"=>"mail exists"));
}
else
{
    if($user->create())
    {
        http_response_code(200);
        echo json_encode(array("message" => "User was created."));
        if($skill->create())
        {
            http_response_code(200);
            echo json_encode(array("message" => "Skill was created."));
            if ($interest->createForApplicant()) {
                http_response_code(201);
                echo json_encode(array("message" => "interests created"));
            }
            else
            {
                http_response_code(http_response_code(500));
                echo json_encode(array("message" => "failed to create interest"));
            }
        }
        else
        {
            http_response_code(400);
            echo json_encode(array("message" => "error creating skills"));
        }
    }

    else
    {
        http_response_code(400);
        echo json_encode(array("message" => "error creating user "));
    }

}







