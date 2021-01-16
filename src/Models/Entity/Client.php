<?php


namespace Models\Entity;


use Models\Traits\DataChangeLogTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 * @ORM\HasLifecycleCallbacks
 */
class Client {
    use DataChangeLogTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $cpf;
    /**
     * @ORM\Column(type="string")
     */
    protected $firstName;
    /**
     * @ORM\Column(type="string")
     */
    protected $lastName;
    /**
     * @ORM\Column(type="date")
     */
    protected $birthDate;

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function getBirthDate(){
        return $this->birthDate;
    }

    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }
}