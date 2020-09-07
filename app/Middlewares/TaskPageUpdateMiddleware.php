<?php

namespace App\Middlewares;

use App\PageNotifier;
use App\Services\TaskService;

/**
 * Class TaskPageUpdateMiddleware
 * @package App\Middlewares
 */
final class TaskPageUpdateMiddleware extends Middleware
{
    /**
     * @param array $parameters
     */
    public function run(array $parameters)
    {
        try {
            $taskService = new TaskService();
            $taskService->getById($parameters['id'] ?? 0);

            $middleware = new IsAdminMiddleware();
            $middleware->run($parameters);
        } catch (\Exception $e) {
            PageNotifier::getInstance()->addError('Task with this id not found');
            redirect('/');
        }
    }
}
