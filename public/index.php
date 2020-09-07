<?php

use App\App;
use App\Middlewares\IsAdminMiddleware;
use App\Middlewares\TaskPageUpdateMiddleware;
use App\Validators\AuthLoginValidator;
use App\Validators\TaskCompleteValidator;
use App\Validators\TaskCreateValidator;
use App\Validators\TaskListValidator;
use App\Validators\TaskUpdateValidator;

require_once '../vendor/autoload.php';
require_once '../functions.php';

$app = App::getInstance();

$app->router()->get('/login', 'AuthPageController@login');
$app->router()->post('/login', 'AuthController@login')->validator(AuthLoginValidator::class);
$app->router()->get('/logout', 'AuthController@logout');
$app->router()->get('/create', 'TaskPageController@create');
$app->router()->post('/create', 'TaskController@create')->validator(TaskCreateValidator::class);
$app->router()->get('/update/{id}', 'TaskPageController@update')->middleware(TaskPageUpdateMiddleware::class);
$app->router()->post('/update/{id}', 'TaskController@update')->validator(TaskUpdateValidator::class)->middleware(IsAdminMiddleware::class);
$app->router()->get('/complete/{id}', 'TaskController@complete')->validator(TaskCompleteValidator::class)->middleware(IsAdminMiddleware::class);;
$app->router()->get('/{page}/{order}/{orderType}', 'TaskPageController@list')->validator(TaskListValidator::class);

$app->run();
