<?php
class Router {
    private $routes = array();

    public function get($route, $action, $options = array()) {
        $this->addRoute('GET', $route, $action, $options);
    }

    public function post($route, $action, $options = array()) {
        $this->addRoute('POST', $route, $action, $options);
    }

    private function addRoute($method, $route, $action, $options) {
        $this->routes[] = array(
            'method' => $method,
            'route' => $route,
            'action' => $action,
            'middleware' => isset($options['middleware']) ? $options['middleware'] : null
        );
    }

    public function dispatch($url) {
        $url = trim($url, '/');
        if (empty($url)) {
            $url = '/';
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $routePath = trim($route['route'], '/');
            if (empty($routePath)) {
                $routePath = '/';
            }

            if ($routePath === $url && $route['method'] === $method) {
                // Check middleware
                if ($route['middleware'] === 'admin') {
                    if (session_id() == '') { session_start(); }
                    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                            header('Location: ' . BASE_URL . 'user/index');
                        } else {
                            header('Location: ' . BASE_URL . 'login');
                        }
                        exit;
                    }
                }

                // Call controller action
                list($controllerName, $methodName) = explode('@', $route['action']);
                
                require_once ROOT_DIR . '/controllers/' . $controllerName . '.php';
                
                $controller = new $controllerName();
                $controller->$methodName();
                return;
            }
        }

        // 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "<div style='text-align:center; padding: 50px; font-family: sans-serif;'>";
        echo "<h1>404 Not Found</h1>";
        echo "<p>The page you requested ('" . htmlspecialchars($url) . "') could not be found.</p>";
        echo "<a href='" . BASE_URL . "'>Go Home</a>";
        echo "</div>";
    }
}
?>
