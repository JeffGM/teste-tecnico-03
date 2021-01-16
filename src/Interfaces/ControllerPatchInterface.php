<?php


namespace Interfaces;


interface ControllerPatchInterface {
    public function patch($request, $response, array $args);
}