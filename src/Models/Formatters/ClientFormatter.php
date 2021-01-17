<?php


namespace Models\Formatters;


use Models\Entity\Client;

class ClientFormatter {
    public static function getAsJSON(Client $client) {
        return json_encode(static::getAsArray($client));
    }

    public static function getAsArray(Client $client) {
        return [
            "cpf" => $client->getCpf(),
            "fullName" => $client->getFullName(),
            "phone" => $client->getFullName(),
            "email" => $client->getEmail(),
            "updatedAt" => $client->getUpdatedAt(),
            "createdAt" => $client->getCreatedAt()
        ];
    }
}