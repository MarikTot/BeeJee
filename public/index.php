<?php

use App\App;
use App\Middlewares\TaskPageUpdateMiddleware;
use App\Validators\TaskCompleteValidator;
use App\Validators\TaskCreateValidator;
use App\Validators\TaskListValidator;
use App\Validators\TaskUpdateValidator;

require_once '../vendor/autoload.php';
require_once '../functions.php';

$app = App::getInstance();

$app->router()->get('/create', 'TaskPageController@create');
$app->router()->post('/create', 'TaskController@create')->validator(TaskCreateValidator::class);
$app->router()->get('/update/{id}', 'TaskPageController@update')->middleware(TaskPageUpdateMiddleware::class);
$app->router()->post('/update/{id}', 'TaskController@update')->validator(TaskUpdateValidator::class);
$app->router()->get('/complete/{id}', 'TaskController@complete')->validator(TaskCompleteValidator::class);
$app->router()->get('/{page}/{order}', 'TaskPageController@list')->validator(TaskListValidator::class);

$app->run();
