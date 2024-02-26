<?php

namespace Monir\AmsRouter;

class Route
{
  public $path;
  public $method;
  public $handler;
  public $params = [];
  public $middleware = [];

  public function __construct($path, $method, $handler, $middleware = [])
  {
    $this->path       = $path;
    $this->method     = $method;
    $handler          = is_callable($handler) ? $handler : [$this, $handler];
    $this->handler    = $handler;
    $this->middleware = $middleware;
  }

  public function match($requestPath, $requestMethod)
  {
    if ($this->method !== $requestMethod) {
      return false;
    }

    $pattern = '~^.*/index\.php~';
    $result  = preg_replace($pattern, '', $requestPath);
    $path    = rtrim($this->path, '/');
    $result  = rtrim($result, '/');

    if ($path === $result) {
      return true;
    }

    return false;
  }

  // public function match($requestPath, $requestMethod)
  // {
  //   if ($this->method !== $requestMethod) {
  //     return false;
  //   }
  //   dump($requestPath, $this->path);

  //   $pattern = '~' . $this->path . '~';

  //   return preg_match($pattern, $requestPath, $this->params);
  // }
}
