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
        return $this->addRoute(new Route(Route::METHOD_POST, $route, $handler));
    }

    /**
     * @param string $route
     * @param string $handler
     * @return Route
     */
    public function post(string $route, string $handler): Route
    {
        return $this->addRoute(new Route(Route::METHOD_POST, $route, $handler));
    }

    /**
     * @param string $route
     * @param string $handler
     * @return Route
     */
    public function any(string $route, string $handler): Route
    {
        return $this->addRoute(new Route(Route::METHOD_ANY, $route, $handler));
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
