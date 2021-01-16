<?php


namespace Interfaces;


interface ControllerPostInterface {
    public function post($request, $response, array $args);
}