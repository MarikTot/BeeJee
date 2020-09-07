<?php

namespace App\Controllers;

use App\Exceptions\DbException;
use App\Exceptions\ModelException;
use App\Exceptions\ViewerException;
use App\Paginator;
use App\Services\TaskService;

/**
 * Class TaskPageController
 * @package App\Controllers
 */
final class TaskPageController
{
    private const LIMIT_ON_PAGE = 3;

    /**
     * @param array $parameters
     * @return string
     * @throws DbException|ViewerException
     */
    public function list(array $parameters): string
    {
        $taskService = new TaskService();

        $countPages = $taskService->countPages(self::LIMIT_ON_PAGE);

        // validated in validator
        $page = $parameters['page'];
        $order = $parameters['order'];

        $paginator = new Paginator($page, $countPages, '/:page/' . $order);

        return view('tasks/list', [
            'list' => $taskService->getListByPage($page, $order, self::LIMIT_ON_PAGE),
            'paginator' => $paginator,
            'page' => $page,
            'order' => $order,
        ]);
    }

    /**
     * @return string
     * @throws ViewerException
     */
    public function create(): string
    {
        return view('tasks/create');
    }

    /**
     * @param array $parameters
     * @return string
     * @throws DbException
     * @throws ViewerException|ModelException
     */
    public function update(array $parameters): string
    {
        $taskService = new TaskService();

        // validated in validator
        $task = $taskService->getById($parameters['id']);

        return view('tasks/update', [
            'task' => get_object_vars($task),
        ]);
    }
}
