<?php


namespace Controllers;

use Doctrine\DBAL\Exception\ConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Interfaces\ControllerDeleteInterface;
use Interfaces\ControllerGetInterface;
use Interfaces\ControllerPatchInterface;
use Interfaces\ControllerPostInterface;
use Models\DataValidators\CarRequest;
use Models\Entity\Car;

class CarController implements ControllerDeleteInterface, ControllerPatchInterface, ControllerGetInterface, ControllerPostInterface {
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function delete($request, $response, array $args)
    {
        // TODO: Implement delete() method.
    }

    public function get($request, $response, array $args)
    {
        // TODO: Implement get() method.
    }

    public function patch($request, $response, array $args)
    {
        // TODO: Implement patch() method.
    }

    public function post($request, $response, array $args)
    {
        $data = $request->getParsedBody();

        try {
            CarRequest::validate($data);
            $car = new Car($data);

            $this->em->persist($car);
            $this->em->flush();
        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(RESPONSE_STATUS_UNPROCESSABLE_ENTITY);
        } catch (ConstraintViolationException $e) {
            $response->getBody()->write("The license plate is already registered for another car!");
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return $response->withStatus(RESPONSE_STATUS_INTERNAL_SERVER_ERROR);
        }

        return $response->withStatus(RESPONSE_STATUS_CREATED);
    }
}