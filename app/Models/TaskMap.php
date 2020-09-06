<?php

namespace App\Models;

/**
 * Class TaskMap
 * @package App\Models
 */
final class TaskMap extends ModelMap
{
    public static string $table = 'tasks';
    public static string $modelClass = Task::class;
}
