<?php

namespace App;

/**
 * Class Singleton
 * @package App
 */
abstract class Singleton
{
    private static array $instances = [];

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
        $cls = static::class;
        if (false === isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
