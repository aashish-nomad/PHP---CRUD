<?php

use Core\Response;

function dd($value)
{
  echo '<pre>';
  var_dump($value);
  echo '</pre>';

  die();
}

function urlIs($value)
{
  return $_SERVER['REQUEST_URI'] === $value;
}

function abort($statuscode = Response::NOT_FOUND)
{
  http_response_code($statuscode);
  require base_path("views/{$statuscode}.php");
  die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
  if ($condition) {
    abort($status);
  }
}

function base_path($path)
{
  return BASE_DIR . $path;
}

function view($view, $attributes = [])
{
  extract($attributes);

  require base_path('views/' . $view);
}

function redirect($url)
{
  header("location: {$url}");
  exit();
}
