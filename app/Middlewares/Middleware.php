<?php

namespace App\Middlewares;

/**
 * Class Middleware
 * @package App\Middlewares
 */
abstract class Middleware
{
    /**
     * @param array $parameters
     */
    abstract public function run(array $parameters);
}
