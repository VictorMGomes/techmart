<?php
class Router {
    private $routes = [];

    public function add($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $routeMethod = $route['method'];
            $routePath = $route['path'];
            $callback = $route['callback'];

            if ($requestMethod === $routeMethod && preg_match("~" . $routePath . "~", $requestPath, $matches)) {
                array_shift($matches);
                call_user_func_array($callback, $matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(array("mensagem" => "Rota não encontrada."));
    }
}
?>
