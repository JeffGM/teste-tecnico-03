<?php


namespace Models\Entity;

use Doctrine\ORM\Mapping as ORM;
use Models\Traits\DataChangeLogTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="rent")
 * @ORM\HasLifecycleCallbacks
 */
class Rent {
    use DataChangeLogTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $rentId;
    /**
     * @ORM\OneToOne(targetEntity="Models\Entity\Client")
     * @ORM\JoinColumn(name="cpf", referencedColumnName="cpf")
     */
    protected $client;
    /**
     * @ORM\OneToOne(targetEntity="Models\Entity\Car")
     * @ORM\JoinColumn(name="carId", referencedColumnName="carId")
     */
    protected $car;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $rentedTheCarAt;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $returnedTheCarAt;
    /**
     * @ORM\Column(type="integer")
     */
    protected $paymentModality;

    public function getRentId(){
        return $this->rentId;
    }

    public function getClient(){
        return $this->client;
    }

    public function setClient($client){
        $this->client = $client;
    }

    public function getCar(){
        return $this->car;
    }

    public function setCar($car){
        $this->car = $car;
    }

    public function getRentedTheCarAt(){
        return $this->rentedTheCarAt;
    }

    public function setRentedTheCarAt($rentedTheCarAt){
        $this->rentedTheCarAt = $rentedTheCarAt;
    }

    public function getReturnedTheCarAt(){
        return $this->returnedTheCarAt;
    }

    public function setReturnedTheCarAt($returnedTheCarAt){
        $this->returnedTheCarAt = $returnedTheCarAt;
    }

    public function getPaymentModality(){
        return $this->paymentModality;
    }

    public function setPaymentModality($paymentModality){
        $this->paymentModality = $paymentModality;
    }
}