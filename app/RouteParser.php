<?php

namespace App;

use App\Exceptions\PreparerException;

/**
 * Class RouteParser
 * @package App
 */
final class RouteParser
{
    private string $url;
    private Route $route;
    private array $parameters = [];

    /**
     * RouteParser constructor.
     * @param string $url
     * @param Route $route
     * @throws PreparerException
     */
    public function __construct(string $url, Route $route)
    {
        $this->url = $url;
        $this->route = $route;

        $this->parseParameters();
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @throws PreparerException
     */
    private function parseParameters(): void
    {
        $currentUrl = explode('/', $this->url);
        $route = explode('/', $this->route->getRoute());

        for ($i = 0; $i < count($currentUrl); $i++) {
            if ($currentUrl[$i] === $route[$i]) {
                continue;
            }

            $key = preg_replace('/({|})/', '', $route[$i]);
            $this->parameters[$key] = prepare($currentUrl[$i]);
        }
    }
}
