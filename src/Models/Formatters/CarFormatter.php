<?php


namespace Models\Formatters;


use Models\Entity\Car;

class CarFormatter {

    public static function getAsJSON(Car $car) {
        return json_encode(static::getAsArray($car));
    }

    public static function getAsArray(Car $car) {
        return [
            "carName"=> $car->getCarName(),
            "carModel" => $car->getModel(),
            "color" => $car->getModel(),
            "year" => $car->getYear(),
            "licensePlate" => $car->getLicensePlate(),
            "pricePerDay" => $car->getPricePerDay(),
            "pricePerMonth" => $car->getPricePerMonth(),
            "isAvailable" => $car->getIsAvailable(),
            "updatedAt" => $car->getUpdatedAt(),
            "createdAt" => $car->getCreatedAt()
        ];
    }
}