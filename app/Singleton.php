<?php

namespace App;

/**
 * Class Singleton
 * @package App
 */
abstract class Singleton
{
    private static self $instance;

    /**
     * Singleton constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (false === isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
