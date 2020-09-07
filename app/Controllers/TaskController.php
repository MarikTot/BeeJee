<?php

namespace App\Controllers;

use App\Exceptions\DbException;
use App\Exceptions\ModelException;
use App\PageNotifier;
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

        PageNotifier::getInstance()->addSuccess('Task was created');

        redirect('/');
    }

    /**
     * @param array $parameters
     * @throws DbException
     * @throws ModelException
     */
    public function update(array $parameters): void
    {
        $taskService = new TaskService();
        $taskService->update($parameters['id'], $parameters);

        PageNotifier::getInstance()->addSuccess('Task was updated');

        redirect('/');
    }

    /**
     * @param array $parameters
     * @throws DbException
     * @throws ModelException
     */
    public function complete(array $parameters): void
    {
        $taskService = new TaskService();

        $taskService->complete((int)$parameters['id']);

        PageNotifier::getInstance()->addSuccess('Task was completed');

        redirect('/');
    }
}
