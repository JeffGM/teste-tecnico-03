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

                    case 'cpf':
                        $eval = static::validateCPF($data[$property]);
                        break;

                    default:
                        $eval = gettype($data[$property]) == $expectedType;
                }
                if(!$eval)
                    throw new \InvalidArgumentException("The property ${property} must be a valid ${expectedType}");

        }
    }

    private static function validateCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}