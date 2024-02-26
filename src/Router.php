<?php

namespace Monir\AmsRouter;

class Router
{
  public $prefix = '';
  private $routes     = [];
  private $middleware = [];

  public function add(string $path, string $method, $handler, $middleware = [])
  {
    $route = new Route($this->prefix . $path, $method, $handler, $middleware);
    $this->routes[] = $route;
  }

  public function dispatch(string $requestMethod, string $requestPath)
  {
    foreach ($this->routes as $route) {
      if ($route->match($requestPath, $requestMethod)) {
        $next = function ($params) use ($route) {
          call_user_func_array($route->handler, $params);
        };

        $middleware = array_reverse($route->middleware);

        foreach ($middleware as $m) {
          $next = $m($next);
        }

        $next($route->params);
        return;
      }
    }

    http_response_code(404);
    exit("404 Not Found");
  }

  public function group(string $prefix, callable $callback, $middleware = [])
  {
    $newRouter = new Router();
    $newRouter->prefix = $prefix;

    call_user_func($callback, $newRouter);

    $this->routes = array_merge($newRouter->routes, $this->routes);
  }


  public function addMiddleware(callable $middleware)
  {
    $this->middleware[] = $middleware;
  }

  public function get(string $path, $handler, $middleware = [])
  {
    $this->add($path, "GET", $handler, $middleware);
  }

  public function post(string $path, $handler, $middleware = [])
  {
    $this->add($path, "POST", $handler, $middleware);
  }

  public function put(string $path, $handler, $middleware = [])
  {
    $this->add($path, "PUT", $handler, $middleware);
  }

  public function patch(string $path, $handler, $middleware = [])
  {
    $this->add($path, "PATCH", $handler, $middleware);
  }

  public function prefixRoutes(string $prefix)
  {
    foreach ($this->routes as $route) {
      $route->path = $prefix . ($route->path == '/' ? '' : $route->path);
    }
  }

  public function getPaths()
  {
    return array_map(function ($route) {
      return $route->path;
    }, $this->routes);
  }
}
