<?php

namespace web;
use app\src\Autoloader;

require_once __DIR__ . '/../app/src/Autoloader.php';
Autoloader::register();

$app =require_once __DIR__. '/../app/bootstrap.php';
$app->run();