<?php
// required headers

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/user.php';
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->EMAIL = $data->EMAIL;
$email_exists = $user->emailExists();

if($email_exists && ($data->PASSWORD == $user->PASSWORD))
{
    http_response_code(200);
    echo json_encode(array("message" => "login succesful"));
}
else
{
    http_response_code(400);
    echo json_encode(array("message"=>"error occured"));
}
