<?php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController {
    private $db;
    private $jwtUtil;

    public function __construct($db) {
        $this->db = $db;
        $this->jwtUtil = new JWTUtil();
    }

    public function createProduct($data) {
        // Lógica para criar um novo produto
        $productModel = new ProductModel($this->db);
        $result = $productModel->createProduct($data);
        return $result;
    }

    public function getProducts() {
        // Lógica para obter a lista de produtos
        $productModel = new ProductModel($this->db);
        $products = $productModel->getProducts();
        return $products;
    }

    public function getProduct($id) {
        // Lógica para obter um produto específico
        $productModel = new ProductModel($this->db);
        $product = $productModel->getProduct($id);
        return $product;
    }

    public function updateProduct($id, $data) {
        // Lógica para atualizar um produto
        $productModel = new ProductModel($this->db);
        $result = $productModel->updateProduct($id, $data);
        return $result;
    }

    public function deleteProduct($id) {
        // Lógica para excluir um produto
        $productModel = new ProductModel($this->db);
        $result = $productModel->deleteProduct($id);
        return $result;
    }

    public function verifyToken($token) {
        // Lógica para verificar o token JWT
        return $this->jwtUtil->verifyToken($token);
    }
}
?>
