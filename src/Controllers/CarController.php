<?php


namespace Controllers;


use Interfaces\ControllerDeleteInterface;
use Interfaces\ControllerGetInterface;
use Interfaces\ControllerPatchInterface;
use Interfaces\ControllerPostInterface;

class CarController implements ControllerDeleteInterface, ControllerPatchInterface, ControllerGetInterface, ControllerPostInterface {


    public function delete($request, $response, array $args)
    {
        // TODO: Implement delete() method.
    }

    public function get($request, $response, array $args)
    {
        // TODO: Implement get() method.
    }

    public function patch($request, $response, array $args)
    {
        // TODO: Implement patch() method.
    }

    public function post($request, $response, array $args)
    {
        // TODO: Implement post() method.
    }
}