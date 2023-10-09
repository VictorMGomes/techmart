<?php

require_once __DIR__."/../models/UserModel.php";
require_once __DIR__."/../utils/JWT.php";


class AuthController {
    private $db;
    private $userModel;
    private $jwtUtil;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($db);
        $this->jwtUtil = new JWTUtil();
    }

    public function generateToken($email, $senha) {
        $user = $this->userModel->getUserByEmail($email);
    
        if ($user && $user['senha'] === md5($senha)) {
            $tokenData = array(
                "id" => $user['id'],
                "nome" => $user['nome'],
                "email" => $user['email']
            );
    
            $token = $this->jwtUtil->generateToken($tokenData);
            return $token;
        } else {
            return false;
        }
    }
    

    public function verifyToken($token) {
        return $this->jwtUtil->verifyToken($token);
    }
}
?>
