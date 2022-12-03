<?php

use app\support\RequesType;
use app\core\Router;

require '../vendor/autoload.php';

session_start();

// dd(RequesType::get());

Router::run();
