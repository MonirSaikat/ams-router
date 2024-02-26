<?php

use Monir\AmsRouter\RequestHandler;
use Monir\AmsRouter\Router;

require_once './vendor/autoload.php';

$router = new Router();

$router->get('/', function () {
  echo 'Home Page';
});

$router->group('/admin', function ($x) {
  $x->get('/', function () {
    echo 'Admin Page';
  });

  $x->get('/settings', function () {
    echo 'Settings Page';
  });
});

$router->group('/api', function ($router) {
  $router->get('/', function () {
    echo json_encode([
      'name' => 'Moniruzzaman Saikat'
    ], 1);
  });
});

RequestHandler::handleRequest($router);
