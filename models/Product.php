<?php
class Product {
    private $conn;
    private $table_name = "products";

    // properties
    public $id;
    public $name;
    public $price;
    public $description;

    // constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // method to fetch products
    public function read() {
        $query = "SELECT id, name, description, price FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // adding products
    public function create() {
        // clean the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // SQL query
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, price=:price, description=:description";

        $stmt = $this->conn->prepare($query);

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Update the product
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, description = :description WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Clean the data and Bind
        $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
        $stmt->bindParam(':price', htmlspecialchars(strip_tags($this->price)));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($this->description)));
        $stmt->bindParam(':id', htmlspecialchars(strip_tags($his->id)));

        return $stmt->execute();
    }
    // DELETE the product
        public function delete() {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            return $stmt->execute();
        }
}

?>