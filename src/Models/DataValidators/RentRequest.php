<?php


namespace Models\DataValidators;


class RentRequest extends RequestValidator {
    protected static $rules = [
        'licensePlate' => 'string',
        'client' => 'array',
        'rentedTheCarAt' => 'string',
        'paymentModality' => 'string'
    ];
}