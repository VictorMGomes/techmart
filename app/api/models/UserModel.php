<?php
class UserModel {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
