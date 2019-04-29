<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once'config/database.php';
include_once 'objects/company.php';
include_once 'objects/interest.php';
include_once 'objects/companyLocation.php';

$database = new Database();
$db = $database->getConnection();
$company = new Company($db);
$interest = new Interest($db);
$companyLocation = new CompanyLocation($db);
$data = json_decode(file_get_contents("php://input"));
$interest->choosenInterests = $data->interests;
$companyLocation->companyLocations = $data->locations;
$company->EMAIL = $data->EMAIL;
$company->NAME = $data->NAME;
$company->NUMEMPLOYEES = $data->NUMEMPLOYEES;
$company->PASSWORD = $data->PASSWORD;



if ($company->create()) {
    http_response_code(200);
    echo json_encode(array("message" => "company created"));
    if ($interest->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "interests created"));
        if($companyLocation->create())
        {
            http_response_code(201);
            echo json_encode(array("message" => "locations created"));
        }
        else
        {
             http_response_code(http_response_code(500));
             echo json_encode(array("message" => "failed to create locations"));
        }
    }
    else
    {
        http_response_code(http_response_code(500));
        echo json_encode(array("message" => "failed to create interest"));
    }

}
else
{
    http_response_code(http_response_code(500));
    echo json_encode(array("message" => "failed to create"));
}

