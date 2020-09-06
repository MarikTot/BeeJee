<?php

namespace App\Controllers;

use App\Exceptions\DbException;
use App\Exceptions\ModelException;
use App\Services\TaskService;

/**
 * Class TaskController
 * @package App\Controllers
 */
class TaskController
{
    /**
     * @param array $parameters
     * @throws DbException
     * @throws ModelException
     */
    public function create(array $parameters): void
    {
        $taskService = new TaskService();
        $taskService->create($parameters);

        redirect('/');
    }
}
