<?php


namespace Models\DataValidators;


class ClientRequest extends RequestValidator {
    protected static $rules = [
        'cpf' => 'cpf',
        'fullName' => 'string',
        'phone' => 'string',
        'email' => 'email'
    ];
}