<?php
namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, string $action): void
    {
        $this->routes['GET'][$uri] = $this->parseAction($action);
    }

    public function post(string $uri, string $action): void
    {
        $this->routes['POST'][$uri] = $this->parseAction($action);
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = $this->resolveUri();

        if (isset($this->routes[$method][$uri])) {
            [$controllerClass, $actionMethod] = $this->routes[$method][$uri];
            $controller = new $controllerClass();
            $controller->$actionMethod();
            return;
        }

        $notFound = new \App\Controllers\ErrorController();
        $notFound->notFound();
    }

    private function resolveUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        $pos = strpos($uri, '?');
        if ($pos !== false) {
            $uri = substr($uri, 0, $pos);
        }

        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
        if ($base !== '' && $base !== '/' && stripos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }

        $uri = '/' . ltrim($uri, '/');
        $uri = rtrim($uri, '/');

        return $uri === '' ? '/' : $uri;
    }

    private function parseAction(string $action): array
    {
        [$controller, $method] = explode('@', $action, 2);
        return ['App\\Controllers\\' . $controller, $method];
    }
}
