<?php


namespace Models\Formatters;


use Models\Entity\Rent;

class RentFormatter {
    public static function getAsJSON(Rent $rent) {
        return json_encode(static::getAsArray($rent));
    }

    public static function getAsArray(Rent $rent) {
        return [
            "rentId" => $rent->getRentId(),
            "client" => CLientFormatter::getAsArray($rent->getClient()),
            "car" => CarFormatter::getAsArray($rent->getCar()),
            "rentedTheCarAt" => $rent->getRentedTheCarAt(),
            "returnedTheCarAt" => $rent->getReturnedTheCarAt(),
            "paymentModality" => $rent->getPaymentModality()
        ];
    }
}