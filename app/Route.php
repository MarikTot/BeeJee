<?php

namespace App;

use App\Middlewares\Middleware;
use App\Middlewares\Validator;

/**
 * Class Route
 * @package App
 */
final class Route
{
    public const METHOD_GET = 'get';
    public const METHOD_POST = 'post';
    public const METHOD_ANY = 'any';

    private string $method;
    private string $route;
    private string $handler;
    private string $pattern;

    private Middleware $middleware;
    private Validator $validator;

    /**
     * Route constructor.
     * @param string $method
     * @param string $route
     * @param string $handler
     */
    public function __construct(string $route, string $handler, string $method = self::METHOD_ANY)
    {
        $this->route = $route;
        $this->handler = $handler;
        $this->method = $method;

        $this->generatePattern();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return '/' . $this->pattern . '/';
    }

    /**
     * @return null|Middleware
     */
    public function getMiddleware(): ?Middleware
    {
        return $this->middleware;
    }


    /**
     * @return null|Validator
     */
    public function getValidator(): ?Validator
    {
        return $this->validator;
    }

    /**
     * @param string $class
     */
    public function middleware(string $class): void
    {
        $this->middleware = new $class();
    }

    /**
     * @param string $class
     */
    public function validator(string $class): void
    {
        $this->validator = new $class();
    }

    /**
     *
     */
    private function generatePattern(): void
    {
        $pattern = preg_replace('/\{.\+\}/', '.+', $this->getRoute());
        $this->pattern = str_replace('/', '\/', $pattern);
        $this->pattern .= '$';
    }
}
