<?php


use Controllers\CarController;

require_once __DIR__ . '/dependencies.php';


$app->post('/car', CarController::class . ':post');
$app->get('/car/{id}', CarController::class . ':get');