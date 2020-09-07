<?php

namespace App\Middlewares;

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
        } catch (\Exception $e) {
            redirect('/');
        }
    }
}
