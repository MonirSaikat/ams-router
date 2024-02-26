<?php

namespace Monir\AmsRouter;

class RequestHandler
{
  public static function handleRequest(Router $router)
  {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestPath   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $router->dispatch($requestMethod, $requestPath);
  }
}
