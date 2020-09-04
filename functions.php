<?php

use App\DB;
use App\Exceptions\PreparerException;
use App\Preparer;

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
