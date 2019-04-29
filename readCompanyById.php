<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once'config/database.php';
include_once 'objects/company.php';

$database = new Database();
$db = $database->getConnection();

$company = new Company($db);
$idn= $data->USERID;
$stmt = $company->readById($idn);
$num = $stmt->rowCount();
//echo($num);
if($num > 0)
{
    $company_arr = array();
    $company_arr ["records"] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $user_company = array(
            "name" => $NAME,
            "email" => $EMAIL,
            "employees number" => $NUMEMPLOYEES,
            "interests" =>$interest_name
        );
        array_push($company_arr["records"], $user_company);
        http_response_code(200);
    }
    echo json_encode($company_arr);
}

else
{
    http_response_code(404);
    echo json_encode(array("message" => "No users found."));
}

