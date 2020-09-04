<?php

namespace App\Controllers;

/**
 * Class ErrorController
 * @package App\Controllers
 */
final class ErrorController
{
    /**
     * @return string
     */
    public function notFound(): string
    {
        return '404';
    }
}
