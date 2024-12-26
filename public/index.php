<?php

use Core\Router;

const BASE_DIR = __DIR__ . '/../';

require BASE_DIR . "Core/functions.php";

spl_autoload_register(function ($class) {

  // $class value after using name space: Core\Database.
  // Directory separator is a forward slash.
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

  require base_path("{$class}.php");
});

require BASE_DIR . "bootstrap.php";

$router = new Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
