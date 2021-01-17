<?php


use Controllers\CarController;
use Controllers\RentController;

require_once __DIR__ . '/dependencies.php';


$app->post('/car', CarController::class . ':post');
$app->patch('/car', CarController::class . ':patch');
$app->delete('/car', CarController::class . ':delete');
$app->get('/car/{carId}', CarController::class . ':get');

$app->post('/rent', RentController::class . ':post');
$app->post('/return-car', RentController::class . ':returnCar');

