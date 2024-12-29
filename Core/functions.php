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

function login($user)
{
  $_SESSION['user'] = $user;

  session_regenerate_id(true);
}

function logout()
{
  // Empty global session object.
  $_SESSION = [];

  // Delete the content of file in which session was stored.
  session_destroy();

  // Delete the cookie stored in the client browser.
  $params = session_get_cookie_params();
  setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
