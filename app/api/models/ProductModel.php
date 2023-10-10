<?php
class ProductModel {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function createProduct($data) {
        $nome = $data['nome'];
        $descricao = $data['descricao'];
        $preco = $data['preco'];

        $query = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProducts() {
        $query = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id) {
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $data) {
        $nome = $data['nome'];
        $descricao = $data['descricao'];
        $preco = $data['preco'];

        $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
