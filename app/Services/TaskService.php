<?php

namespace App\Services;

use App\Exceptions\DbException;
use App\Exceptions\ModelException;
use App\Models\Task;
use App\Models\TaskMap;

/**
 * Class TaskService
 * @package App\Services
 */
final class TaskService
{
    /**
     * @return Task[]
     * @throws DbException
     */
    public function getList(): array
    {
        $map = new TaskMap();

        return $map->getList();
    }

    /**
     * @param int $page
     * @param string $orderBy
     * @param string $orderType
     * @param int $limitOnPage
     * @return Task[]
     * @throws DbException
     */
    public function getListByPage(int $page, string $orderBy, string $orderType, int $limitOnPage): array
    {
        $map = new TaskMap();

        $offset = ($limitOnPage * $page) - $limitOnPage;

        return $map->getList($orderBy, $orderType, $limitOnPage, $offset);
    }

    /**
     * @param int $id
     * @return Task
     * @throws DbException|ModelException
     */
    public function getById(int $id): Task
    {
        $map = new TaskMap();

        /** @var Task $task */
        $task = $map->getById($id);

        return $task;
    }

    /**
     * @return int
     * @throws DbException
     */
    public function count(): int
    {
        $map = new TaskMap();

        return $map->count();
    }

    /**
     * @param int $limitOnPage
     * @return int
     * @throws DbException
     */
    public function countPages(int $limitOnPage): int
    {
        $countTasks = $this->count();
        $countPages = $countTasks / $limitOnPage;

        if ($countTasks % $limitOnPage || 0 === $countPages) {
            $countPages++;
        }

        return $countPages;
    }

    /**
     * @param array $parameters
     * @return Task
     * @throws DbException|ModelException
     */
    public function create(array $parameters): Task
    {
        $task = new Task();
        $task->fill($parameters);
        $taskMap = new TaskMap();

        /** @var Task $task */
        $task = $taskMap->create($task);

        return $task;
    }

    /**
     * @param int $id
     * @return Task
     * @throws DbException|ModelException
     */
    public function complete(int $id): Task
    {
        $task = $this->getById($id);
        $task->setAttribute('completed_at', date('Y-m-d H:i:s'));
        $taskMap = new TaskMap();

        /** @var Task $task */
        $task = $taskMap->update($task);

        return $task;
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return Task
     * @throws DbException|ModelException
     */
    public function update(int $id, array $parameters): Task
    {
        $task = $this->getById($id);
        $originTask = clone($task);

        $task->fill($parameters);

        $taskMap = new TaskMap();

        // comparing object properties
        if ($originTask != $task) {
            $task->setAttribute('updated_at', date('Y-m-d H:i:s'));
        }

        /** @var Task $task */
        $task = $taskMap->update($task);

        return $task;
    }
}
