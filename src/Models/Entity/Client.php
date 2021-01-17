<?php


namespace Models\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(type="string")
     */
    protected $cpf;
    /**
     * @ORM\Column(type="string")
     */
    protected $fullName;
    /**
     * @ORM\Column(type="string")
     */
    protected $phone;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    public function __construct($cpf) {
        $this->setCpf($cpf);
    }

    public function setFieldsFromData($data) {
        $this->setFullName($data["fullName"]);
        $this->setEmail($data["email"]);
        $this->setPhone($data["phone"]);
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getFullName(){
        return $this->fullName;
    }

    public function setFullName($fullName){
        $this->fullName = $fullName;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

}