<?php
class JWTUtil {
    private $key = "sua_chave_secreta";

    public function generateToken($data) {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode($data));
        $signature = hash_hmac('sha256', "$header.$payload", $this->key, true);
        $token = "$header.$payload." . base64_encode($signature);
        return $token;
    }

    public function verifyToken($token) {
        list($header, $payload, $signature) = explode('.', $token);
        $data = json_decode(base64_decode($payload), true);
        $expectedSignature = hash_hmac('sha256', "$header.$payload", $this->key, true);
        
        return hash_equals(base64_decode($signature), $expectedSignature) ? $data : false;
    }
}
?>
