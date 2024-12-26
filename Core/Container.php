<?php

namespace Core;

class Container
{
  protected $bindings = [];

  // To add something in the container.
  public function bind($key, $resolver)
  {
    $this->bindings[$key] = $resolver;
  }

  // To access something from the container.
  public function resolve($key)
  {
    if (!array_key_exists($key, $this->bindings)) {
      throw new \Exception("No matching bindings found for {$key}");
    }
    $resolver = $this->bindings[$key];
    return call_user_func($resolver);
  }
}
