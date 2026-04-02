<?php
error_reporting(0);
// headers
header("Access-Control-Allow-Origin");
header("Content-Type: application/json; charset=UT-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

// GET posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(!empty($data->name) && !empty($data->price)) {
    // set product property values
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;

    // create the product
    if ($product->create()) {
        // 201 created
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    } else {
        // 503 Service Unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
} else {
    // 400 Bad Request
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data. Provide name and price."));
}

?>