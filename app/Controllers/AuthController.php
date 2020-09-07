<?php

namespace App\Controllers;

use App\AuthAdmin;
use App\PageNotifier;

/**
 * Class AuthController
 * @package App\Controllers
 */
class AuthController
{
    /**
     * @param array $parameters
     */
    public function login(array $parameters): void
    {
        AuthAdmin::getInstance()->login($parameters['login'], $parameters['password']);
        PageNotifier::getInstance()->addSuccess('Login success');

        redirect('/');
    }

    /**
     *
     */
    public function logout(): void
    {
        AuthAdmin::getInstance()->logout();

        redirect('/');
    }
}
