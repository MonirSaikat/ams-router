<?php

use Monir\AmsRouter\Http\Request;
use Monir\AmsRouter\Http\Response;
use Monir\AmsRouter\RequestHandler;
use Monir\AmsRouter\Router;

require_once './vendor/autoload.php';

$router = new Router();

$router->get('/', function (Request $request, Response $response) {
  $jsonValue = array(
    'name' => 'Monir Saikat',
    'hobby' => 'Coding'
  );

  $response->json($jsonValue)->send();
});

$router->get('/about', function (Request $request, Response $response) {
  $response->content('About Me')->send();
});

RequestHandler::handleRequest($router);
