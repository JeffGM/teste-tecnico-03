<?php


namespace Models\Entity;

use Doctrine\ORM\Mapping as ORM;
use Models\Traits\DataChangeLogTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 * @ORM\HasLifecycleCallbacks
 */
class Address {
    use DataChangeLogTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $addressId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $cep;
    /**
     * @ORM\Column(type="string")
     */
    protected $streetName;
    /**
     * @ORM\Column(type="integer")
     */
    protected $number;
    /**
     * @ORM\Column(type="string")
     */
    protected $neighborhood;
    /**
     * @ORM\Column(type="string")
     */
    protected $complement;
    /**
     * @ORM\Column(type="string")
     */
    protected $state;
    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    public function getId(){
        return $this->addressId;
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }

    public function getStreetName(){
        return $this->streetName;
    }

    public function setStreetName($streetName){
        $this->streetName = $streetName;
    }

    public function getNumber(){
        return $this->number;
    }

    public function setNumber($number){
        $this->number = $number;
    }

    public function getNeighborhood(){
        return $this->neighborhood;
    }

    public function setNeighborhood($neighborhood){
        $this->neighborhood = $neighborhood;
    }

    public function getComplement(){
        return $this->complement;
    }

    public function setComplement($complement){
        $this->complement = $complement;
    }

    public function getState(){
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
    }

    public function getCountry(){
        return $this->country;
    }

    public function setCountry($country){
        $this->country = $country;
    }
}