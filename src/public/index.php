<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "../../vendor/autoload.php";
require_once '../../bootstrap.php';
require_once '../constants.php';

//$app->config('debug', false);
$app = new \Slim\App($container);

require_once "../../src/routes.php";

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->run();