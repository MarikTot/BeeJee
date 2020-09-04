<?php

namespace App\Controllers;

use App\Exceptions\ViewerException;

/**
 * Class ErrorController
 * @package App\Controllers
 */
final class ErrorController
{
    /**
     * @return string
     * @throws ViewerException
     */
    public function notFound(): string
    {
        return view('error', ['message' => '404: Page not found']);
    }
}
