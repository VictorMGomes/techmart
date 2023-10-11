<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../utils/Router.php';
require_once __DIR__ . '/../../config/database/DatabaseConnection.php';
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$DatabaseConnection = new DatabaseConnection();
$pdo = $DatabaseConnection->getConnection();

$authController = new AuthController($pdo);
$productController = new ProductController($pdo);

$router = new Router();

$router->add('POST', '/gerar-token', function () use ($authController) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email']) && isset($data['senha'])) {
        $email = $data['email'];
        $senha = $data['senha'];

        $token = $authController->generateToken($email, $senha);

        if ($token) {
            echo json_encode(array("token" => $token));
            return;
        }
    }

    http_response_code(401);
    echo json_encode(array("mensagem" => "Falha na autenticação."));
});

$router->add('POST', '/produtos', function () use ($productController) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $token = getBearerToken();
    if (!$productController->verifyToken($token)) {
        http_response_code(401);
        echo json_encode(array("mensagem" => "Token de autenticação inválido."));
        return;
    }

    $result = $productController->createProduct($data);

    if ($result) {
        echo json_encode(array("mensagem" => "Produto criado com sucesso."));
    } else {
        http_response_code(500);
        echo json_encode(array("mensagem" => "Não foi possível criar o produto."));
    }
});

$router->add('GET', '/produtos/(\d+)', function ($id) use ($productController, $authController) {
    $token = $authController->getBearerToken();
    if (!$authController->verifyToken($token)) {
        http_response_code(401);
        echo json_encode(array("mensagem" => "Token de autenticação inválido."));
        return;
    }

    $product = $productController->getProduct($id);

    if ($product) {
        echo json_encode($product);
    } else {
        http_response_code(404);
        echo json_encode(array("mensagem" => "Produto não encontrado."));
    }
});

$router->add('GET', '/produtos', function () use ($productController) {
    $token = getBearerToken();
    if (!$productController->verifyToken($token)) {
        http_response_code(401);
        echo json_encode(array("mensagem" => "Token de autenticação inválido."));
        return;
    }

    $products = $productController->getProducts();

    echo json_encode($products);
});




$router->add('PUT', '/produtos/(\d+)', function ($id) use ($productController) {
    $data = json_decode(file_get_contents("php://input"), true);

    $token = getBearerToken();
    if (!$productController->verifyToken($token)) {
        http_response_code(401);
        echo json_encode(array("mensagem" => "Token de autenticação inválido."));
        return;
    }

    $result = $productController->updateProduct($id, $data);

    if ($result) {
        echo json_encode(array("mensagem" => "Produto atualizado com sucesso."));
    } else {
        http_response_code(500);
        echo json_encode(array("mensagem" => "Não foi possível atualizar o produto."));
    }
});

$router->add('DELETE', '/produtos/(\d+)', function ($id) use ($productController) {
    $token = getBearerToken();
    if (!$productController->verifyToken($token)) {
        http_response_code(401);
        echo json_encode(array("mensagem" => "Token de autenticação inválido."));
        return;
    }

    $result = $productController->deleteProduct($id);

    if ($result) {
        echo json_encode(array("mensagem" => "Produto excluído com sucesso."));
    } else {
        http_response_code(500);
        echo json_encode(array("mensagem" => "Não foi possível excluir o produto."));
    }
});


function getBearerToken() {
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        return trim(str_replace("Bearer ", "", $headers['Authorization']));
    }
    return null;
}

$router->dispatch();
