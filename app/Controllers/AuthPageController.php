<?php

namespace App\Controllers;

use App\Exceptions\ViewerException;

/**
 * Class AuthPageController
 * @package App\Controllers
 */
class AuthPageController
{
    /**
     * @return string
     * @throws ViewerException
     */
    public function login(): string
    {
        return view('login');
    }
}
