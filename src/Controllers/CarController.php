<?php


namespace Controllers;

use Doctrine\DBAL\Exception\ConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Exceptions\ResourceNotFoundException;
use Interfaces\ControllerDeleteInterface;
use Interfaces\ControllerGetInterface;
use Interfaces\ControllerPatchInterface;
use Interfaces\ControllerPostInterface;
use Models\DataValidators\CarRequest;
use Models\Entity\Car;
use Models\Formatters\CarFormatter;

class CarController implements ControllerDeleteInterface, ControllerPatchInterface, ControllerGetInterface, ControllerPostInterface {
    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function delete($request, $response, array $args){
        $data = $request->getParsedBody();

        try {
            $car =  $this->em->getRepository('\Models\Entity\Car')->find($data["carId"]);

            if($car == null)
                throw new ResourceNotFoundException("Car not found!");

            $this->em->remove($car);
            $this->em->flush();
        } catch(ResourceNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_NOT_FOUND);
        } catch (Exception $e) {
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }
        return $response->withStatus(RESPONSE_STATUS_SUCCESS);
    }

    public function get($request, $response, array $args){

        try {
            $licensePlate = $args["licensePlate"];

            $car = $this->em->getRepository('\Models\Entity\Car')->findOneBy(["licensePlate" => $licensePlate]);

            if($car == null)
                throw new ResourceNotFoundException("Car not found!");

            $response->getBody()->write(CarFormatter::getAsJSON($car));
        } catch(ResourceNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_NOT_FOUND);
        }

        return $response->withStatus(RESPONSE_STATUS_SUCCESS);
    }

    public function patch($request, $response, array $args){
        $data = $request->getParsedBody();

        try {
            CarRequest::validate($data, true);

            $car =  $this->em->getRepository('\Models\Entity\Car')->find($data["carId"]);

            if($car == null)
                throw new ResourceNotFoundException("Car not found!");

            if(isset($data["carName"]))
                $car->setCarName($data["carName"]);

            if(isset($data["carModel"]))
                $car->setCarName($data["carModel"]);

            if(isset($data["color"]))
                $car->setCarName($data["color"]);

            if(isset($data["year"]))
                $car->setCarName($data["year"]);

            if(isset($data["licensePlate"]))
                $car->setCarName($data["licensePlate"]);

            if(isset($data["pricePerDay"]))
                $car->setCarName($data["pricePerDay"]);

            if(isset($data["pricePerMonth"]))
                $car->setCarName($data["pricePerMonth"]);

            if(isset($data["isAvailable"]))
                $car->setCarName($data["isAvailable"]);

            $this->em->persist($car);
            $this->em->flush();

            $response->getBody()->write(CarFormatter::getAsJSON($car));
        } catch(ResourceNotFoundException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_NOT_FOUND);
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }

        return $response->withStatus(RESPONSE_STATUS_SUCCESS);
    }

    public function post($request, $response, array $args){
        $data = $request->getParsedBody();

        try {
            CarRequest::validate($data);
            $car = new Car($data);

            $this->em->persist($car);
            $this->em->flush();

            $response->getBody()->write(CarFormatter::getAsJSON($car));
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (ConstraintViolationException $e) {
            $response->getBody()->write("The license plate is already registered for another car!");
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }

        return $response->withStatus(RESPONSE_STATUS_CREATED);
    }
}