<?php
require_once '../core/Database.php';
require_once '../models/User.php';

class UserController {

    public function show($id) {
        // initialize the DB
        $database = new Database();
        $dbConn = $database->getConnection();

        // call the model
        $userModel = new User($dbConn);
        $userData = $userModel->getUserById($id);

        // load the view
        // make $userData available for the view
        require_once '../views/user_profile.php';
    }
}

?>