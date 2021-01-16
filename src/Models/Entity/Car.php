<?php


namespace Models\Entity;
use Doctrine\ORM\Mapping as ORM;
use Models\Traits\DataChangeLogTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="car")
 * @ORM\HasLifecycleCallbacks
 */
class Car {
    use DataChangeLogTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $carId;
    /**
     * @ORM\Column(type="string")
     */
    protected $model;
    /**
     * @ORM\Column(type="string")
     */
    protected $color;
    /**
     * @ORM\Column(type="integer")
     */
    protected $year;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $licensePlate;

    public function getCarId(){
        return $this->carId;
    }

    public function getModel(){
        return $this->model;
    }

    public function setModel($model){
        $this->model = $model;
    }

    public function getColor(){
        return $this->color;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function getYear(){
        return $this->year;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function getLicensePlate(){
        return $this->licensePlate;
    }

    public function setLicensePlate($licensePlate){
        $this->licensePlate = $licensePlate;
    }
}