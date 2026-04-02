<?php
// simple manual routing 
require_once '../controllers/UserController.php';

// simulate a URL requect like: index.php?id=1
// $id = isset($_GET['id']) ? $_GET['id'] : 1;

// Get the URL from the .htaccess redirect
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

// Split the URL into an array
$urlParts = explode('/', $url);

// Basic Routing Logic
$controllerName = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . 'Controller' : 'UserController';
$methodName = isset($urlParts[1]) ? $urlParts[1] : 'show';
$param = isset($urlParts[2]) ? $urlParts[2] : 1;

// Check if controller class exists
if (class_exists($controllerName)) {
    $controller = new $controllerName();

    // Check if the method (action) exists inside that controller
    if (method_exists($controller, $methodName)) {
        // Call the method and pass the parameter
        $controller->$methodName($param);
    } else {
        echo "404 - Method Not Found";
    }
} else {
    echo "404 - Contoller Not Found.";
}

// instantiate the controller and trigger action
// $controller = new UserController();
// $controller->show($id);
?>