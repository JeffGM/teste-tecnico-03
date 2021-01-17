<?php


namespace Models\DataValidators;


class CarRequest {
    protected static $rules = [
        'carName' => 'string',
        'carModel' => 'string',
        'color' => 'string',
        'year' => 'string',
        'licensePlate' => 'string',
        'pricePerDay' => 'float',
        'pricePerMonth' => 'float',
        'isAvaliable' => 'bool'
    ];

    public function validateCarAsArray($data) {
        foreach(static::$rules as $property => $expectedType) {
            if(isset($data[$property])) {
                if(gettype($data[$property]) != $expectedType)
                    throw new \InvalidArgumentException("The property ${property} must be of type ${expectedType}");
            else
                throw new \InvalidArgumentException("The property ${property} is missing!");
            }
        }
    }
}