<?php

namespace App;

final class Router
{
    /** @var Route[] */
    private array $routes;

    /**
     * @param string $route
     * @param string $handler
     * @return Route
     */
    public function get(string $route, string $handler)
    {
        return $this->addRoute(new Route($route, $handler, Route::METHOD_GET));
    }

    /**
     * @param string $route
     * @param string $handler
     * @return Route
     */
    public function post(string $route, string $handler): Route
    {
        return $this->addRoute(new Route($route, $handler, Route::METHOD_POST));
    }

    /**
     * @param string $route
     * @param string $handler
     * @return Route
     */
    public function any(string $route, string $handler): Route
    {
        return $this->addRoute(new Route($route, $handler, Route::METHOD_ANY));
    }

    /**
     * @return string
     */
    public static function getCurrentURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return string
     */
    public static function getCurrentMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return Route
     */
    public function findRoute(): Route
    {
        foreach ($this->routes as $route) {
            if (false === $this->check($route)) {
                continue;
            }

            return $route;
        }

        // TODO: make route for 404
    }

    /**
     * @param Route $route
     * @return bool
     */
    private function check(Route $route): bool
    {
        return $this->checkRoute($route) && $this->checkMethod($route);
    }

    /**
     * @param Route $route
     * @return bool
     */
    private function checkRoute(Route $route): bool
    {
        return (bool)preg_match($route->getPattern(), self::getCurrentURI());
    }

    /**
     * @param Route $route
     * @return bool
     */
    private function checkMethod(Route $route): bool
    {
        return self::getCurrentMethod() === $route->getMethod() || Route::METHOD_ANY === $route->getMethod();
    }

    /**
     * @param Route $route
     * @return Route
     */
    private function addRoute(Route $route): Route
    {
        $this->routes[] = $route;
        return $route;
    }
}