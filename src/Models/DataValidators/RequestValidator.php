<?php


namespace Models\DataValidators;


class RequestValidator {
    protected static $rules = [];

    public static function validate($data, $allOptional = false) {
        foreach(static::$rules as $property => $expectedType) {

            if(!isset($data[$property])) {
                if($allOptional)
                    continue;
                else
                    throw new \InvalidArgumentException("The property ${property} is missing!");
            }

            switch($expectedType) {
                    case 'bool':
                        $eval = filter_var($data[$property], FILTER_VALIDATE_BOOLEAN);
                        break;

                    case 'email':
                        $eval = filter_var($data[$property], FILTER_VALIDATE_EMAIL);
                        break;

                    case 'float':
                        $eval = filter_var($data[$property], FILTER_VALIDATE_FLOAT);
                        break;

                    case 'url':
                        $eval = filter_var($data[$property], FILTER_VALIDATE_URL);
                        break;

                    default:
                        $eval = gettype($data[$property]) == $expectedType;
                }
                if(!$eval)
                    throw new \InvalidArgumentException("The property ${property} must be of type ${expectedType}");

        }
    }
}