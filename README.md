### AMS Router

The start of another php framework. It in in very early stages of development. Working...

How to run the application is so easy. You just download it and run `composer update` from the root of the project and you start creating route in the index.php as following. And now run `php ams serve` you will see Server is running on http://localhost:8000
```php
<?php

use Monir\AmsRouter\Http\Request;
use Monir\AmsRouter\Http\Response;
use Monir\AmsRouter\RequestHandler;
use Monir\AmsRouter\Router;

require_once './vendor/autoload.php';

$router = new Router();

$router->get('/', function (Request $request, Response $response) {
  $jsonValue = array(
    'name'  => 'Monir Saikat',
    'hobby' => 'Coding'
  );

  $response->json($jsonValue)->send();
});

$router->get('/about', function (Request $request, Response $response) {
  $response->content('About Me')->send();
});

RequestHandler::handleRequest($router);

``` 