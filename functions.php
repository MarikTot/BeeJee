<?php

use App\AuthAdmin;
use App\DB;
use App\Exceptions\PreparerException;
use App\Exceptions\ViewerException;
use App\Preparer;
use App\Viewer;

/**
 * @return DB
 */
function db(): DB
{
    return DB::getInstance();
}

/**
 * @param $data
 * @return array|float|int|string
 * @throws PreparerException
 */
function prepare($data)
{
    return Preparer::getInstance()->prepare($data);
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/**
 * @param string $template
 * @param array $objects
 * @param string $title
 * @return string
 * @throws ViewerException
 */
function view(string $template, array $objects = [], string $title = ''): string
{
    $view = new Viewer($template);
    return $view->render($objects);
}

/**
 * @return bool
 */
function isAdmin(): bool
{
    return AuthAdmin::getInstance()->isAdmin();
}
