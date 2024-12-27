<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
  protected $routes = [];

  public function add($method, $uri, $controller)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => NULL,
    ];

    return $this;
  }

  public function only($key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;
  }

  public function get($uri, $controller)
  {
    return $this->add('GET', $uri, $controller);
  }

  public function post($uri, $controller)
  {
    return $this->add('POST', $uri, $controller);
  }

  public function delete($uri, $controller)
  {
    return $this->add('DELETE', $uri, $controller);
  }

  public function patch($uri, $controller)
  {
    return $this->add('PATCH', $uri, $controller);
  }

  public function put($uri, $controller)
  {
    return $this->add('PUT', $uri, $controller);
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($uri === $route['uri'] && $route['method'] === strtoupper($method)) {
        Middleware::resolve($route['middleware']);

        return require base_path($route['controller']);
      }
    }
    $this->abort();
  }

  public function abort($statuscode = Response::NOT_FOUND)
  {
    http_response_code($statuscode);
    require base_path("views/{$statuscode}.php");
    die();
  }
}
