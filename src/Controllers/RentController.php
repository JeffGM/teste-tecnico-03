<?php


namespace Controllers;


use DateTime;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Exception;
use Exceptions\ResourceNotFoundException;
use Interfaces\ControllerPostInterface;
use Models\DataValidators\ClientRequest;
use Models\DataValidators\RentRequest;
use Models\Entity\Client;
use Models\Entity\Rent;
use Models\Formatters\RentFormatter;

class RentController implements ControllerPostInterface {

    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function post($request, $response, array $args){
        $data = $request->getParsedBody();

        try {
            RentRequest::validate($data);
            ClientRequest::validate($data["client"]);

            $car = $this->em->getRepository('\Models\Entity\Car')->find($data["carId"]);

            if($car == null)
                throw new ResourceNotFoundException("Car not found!");

            if(!$car->getIsAvailable())
                throw new \InvalidArgumentException("The car is already rented!");

            $client = $this->em->getRepository('\Models\Entity\Client')->find($data["client"]["cpf"]);

            if($client == null)
                $client = new Client($data["client"]["cpf"]);

            $client->setFieldsFromData($data["client"]);

            $car->setIsAvailable(false);

            $rent = new Rent($data, $client, $car);

            $this->em->persist($car);
            $this->em->persist($client);
            $this->em->persist($rent);
            $this->em->flush();

            $response->getBody()->write(RentFormatter::getAsJSON($rent));
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (ResourceNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_NOT_FOUND);
        } catch (Exception $e) {
            $response->getBody()->write($e->getMessage());

            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }

        return $response->withStatus(RESPONSE_STATUS_CREATED);
    }

    public function returnCar($request, $response, array $args){
        $data = $request->getParsedBody();

        try {
            $car = $this->em->getRepository('\Models\Entity\Car')->find($data["carId"]);

            if($car == null)
                throw new \InvalidArgumentException("Car not found!");

            $rent = $this->em->getRepository('\Models\Entity\Rent')
                ->findOneBy(["car" => $car, "returnedTheCarAt" => null]);

            if($rent == null)
                throw new \InvalidArgumentException("The car is not currently rented!");

            $now = new DateTime();

            $rent->setReturnedTheCarAt($now);
            $car->setIsAvailable(true);

            $this->em->persist($rent);
            $this->em->persist($car);
            $this->em->flush();

            $response->getBody()->write(RentFormatter::getAsJSON($rent));
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (ResourceNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_NOT_FOUND);
        } catch (Exception $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }

        return $response->withStatus(RESPONSE_STATUS_SUCCESS);
    }
}