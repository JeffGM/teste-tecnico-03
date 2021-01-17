<?php

use Controllers\CarController;
use Controllers\RentController;
use Doctrine\ORM\EntityManager;

$container[CarController::class] = function ($container) {
    return new CarController($container[EntityManager::class]);
};

$container[RentController::class] = function ($container) {
    return new RentController($container[EntityManager::class]);
};