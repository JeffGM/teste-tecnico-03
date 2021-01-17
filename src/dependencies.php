<?php

use Controllers\CarController;
use Doctrine\ORM\EntityManager;

$container[CarController::class] = function ($container) {
    return new CarController($container[EntityManager::class]);
};