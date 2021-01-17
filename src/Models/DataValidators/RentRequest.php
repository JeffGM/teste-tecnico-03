<?php


namespace Models\DataValidators;


class RentRequest extends RequestValidator {
    protected static $rules = [
        'carId' => 'integer',
        'client' => 'array',
        'rentedTheCarAt' => 'string',
        'paymentModality' => 'string'
    ];
}