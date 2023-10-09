<?php
class ProductModel {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function createProduct($data) {
        // Lógica para criar um novo produto no banco de dados
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
        // Lógica para obter a lista de produtos do banco de dados
        $query = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id) {
        // Lógica para obter um produto específico do banco de dados
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $data) {
        // Lógica para atualizar um produto no banco de dados
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
        // Lógica para excluir um produto do banco de dados
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
