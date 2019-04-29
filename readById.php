<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$idn= $data->USERID;

$stmt = $user->readById($idn);
$num = $stmt->rowCount();
//echo($num);
if ($num > 0) {
    $users_arr = array();
    $users_arr ["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_applicant = array(
            "fname" => $FNAME,
            "lname" => $LNAME,
            "age" => $AGE,
            "email" => $EMAIL,
            "username" => $USERNAME,
            "mobilenum" => $MOBILENUM,
            "geneder" => $GENDER,
            "skills" => $skill_name
        );
        array_push($users_arr["records"], $user_applicant);
        http_response_code(200);
    }
    echo json_encode($users_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No users found."));
}