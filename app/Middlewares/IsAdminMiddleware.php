<?php

namespace App\Middlewares;

use App\PageNotifier;

/**
 * Class IsAdminMiddleware
 * @package App\Middlewares
 */
final class IsAdminMiddleware extends Middleware
{
    /**
     * @param array $parameters
     */
    public function run(array $parameters)
    {
        if (false === isAdmin()) {
            PageNotifier::getInstance()->addError('Access denied!');
            redirect('/login');
        }
    }
}
