<?php


namespace Models\DataValidators;

class CarRequest extends RequestValidator {
    protected static $rules = [
        'carName' => 'string',
        'carModel' => 'string',
        'color' => 'string',
        'year' => 'integer',
        'licensePlate' => 'string',
        'pricePerDay' => 'float',
        'pricePerMonth' => 'float',
        'isAvailable' => 'bool'
    ];
}