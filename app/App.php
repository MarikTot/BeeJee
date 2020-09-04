<?php

namespace App;

use Closure;
use Throwable;

/**
 * Class App
 * @package App
 */
final class App extends Singleton
{
    private Router $router;

    /**
     * App constructor.
     */
    protected function __construct()
    {
        parent::__construct();

        $this->router = Router::getInstance();
    }

    /**
     * @return Router
     */
    public function router(): Router
    {
        return $this->router;
    }

    /**
     *
     */
    public function run(): void
    {
        try {
            $route = $this->router()->findRoute();
            $handler = $this->handler($route->getHandler());

            $parameters = $this->router()->parseParameters($route);

            $middleware = $route->getMiddleware();
            if (null !== $middleware) {
                $middleware->run();
            }

            $validator = $route->getValidator();
            if (null !== $validator) {
                $validator->validate($parameters);
                if (false === $validator->isValid()) {
                    $validator->fail();
                }
                $parameters = $validator->validParameters();
            }

            echo $handler($parameters);
        } catch (Throwable $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $handler
     * @return Closure
     */
    private function handler(string $handler)
    {
        return fn(...$args) => call_user_func_array($this->parseHandler($handler), $args);
    }

    /**
     * @param string $handler
     * @return array
     */
    private function parseHandler(string $handler): array
    {
        list($class, $method) = explode('@', $handler);
        $class = '\\App\\Controllers\\' . $class;

        return [$class, $method];
    }
}
