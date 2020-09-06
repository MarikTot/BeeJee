<?php

use App\App;
use App\Validators\TaskListValidator;

require_once '../vendor/autoload.php';
require_once '../functions.php';

$app = App::getInstance();

$app->router()->get('/{page}/{order}', 'TaskPageController@list')->validator(TaskListValidator::class);

$app->run();
