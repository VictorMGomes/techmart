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
        $productModel = new ProductModel($this->db);
        $result = $productModel->createProduct($data);
        return $result;
    }

    public function getProducts() {
        $productModel = new ProductModel($this->db);
        $products = $productModel->getProducts();
        return $products;
    }

    public function getProduct($id) {
        $productModel = new ProductModel($this->db);
        $product = $productModel->getProduct($id);
        return $product;
    }

    public function updateProduct($id, $data) {
        $productModel = new ProductModel($this->db);
        $result = $productModel->updateProduct($id, $data);
        return $result;
    }

    public function deleteProduct($id) {
        $productModel = new ProductModel($this->db);
        $result = $productModel->deleteProduct($id);
        return $result;
    }

    public function verifyToken($token) {
        return $this->jwtUtil->verifyToken($token);
    }
}
?>
