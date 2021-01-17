<?php


namespace Models\DataValidators;

class CarRequest extends RequestValidator {
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
    }