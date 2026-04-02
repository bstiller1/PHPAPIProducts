<?php
class User {
    private $db;

    // pass db connection through a constructor (Dependency Injection)
    public function __construct($dbConn) {
        $this->db = $dbConn;
    }

    // fetch user by ID
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>