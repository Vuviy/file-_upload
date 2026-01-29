<?php

namespace App;

final class Router
{
    private array $routes = [];

    public function __construct(private readonly Container $container) {}

    private function add(string $method, string $uri, array $action): void
    {
        $pattern = preg_replace(
            '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
            '(?P<$1>[^/]+)',
            $uri
        );

        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'action'  => $action,
        ];
    }

    public function get(string $uri, array $action): void
    {
        $this->add('GET', $uri, $action);
    }

    public function post(string $uri, array $action): void
    {
        $this->add('POST', $uri, $action);
    }



    public function dispatch(): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                [$controller, $methodName] = $route['action'];

                $params = array_filter(
                    $matches,
                    fn ($k) => !is_int($k),
                    ARRAY_FILTER_USE_KEY
                );

                $controllerInstance = new $controller($this->container);

                return $controllerInstance->$methodName(
                    new Request($params)
                );
            }
        }

        return new Response('404 Not Found', 404);
    }

}