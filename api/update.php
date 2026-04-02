<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Methods: PUT");

include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

// Set ID of product to be edited
$product->id = $data->id;
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;

if ($product->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Product updated successfully."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update product."));
}

?>