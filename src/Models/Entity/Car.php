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
    protected $carName;
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
    /**
     * @ORM\Column(type="float")
     */
    protected $pricePerDay;
    /**
     * @ORM\Column(type="float")
     */
    protected $pricePerMonth;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isAvaliable;

    public function __construct($data) {
        $this->setCarName($data["carName"]);
        $this->setColor($data["color"]);
        $this->setIsAvaliable(true);
        $this->setLicensePlate($data["licensePlate"]);
        $this->setModel($data["carModel"]);
        $this->setYear($data["year"]);
        $this->setPricePerDay($data["pricePerDay"]);
        $this->setPricePerMonth($data["pricePerMonth"]);
    }

    public function getCarId(){
        return $this->carId;
    }

    public function getCarName(){
        return $this->carName;
    }

    public function setCarName($carName){
        $this->carName = $carName;
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

    public function getPricePerDay(){
        return $this->pricePerDay;
    }

    public function setPricePerDay($pricePerDay){
        $this->pricePerDay = $pricePerDay;
    }

    public function getPricePerMonth(){
        return $this->pricePerMonth;
    }

    public function setPricePerMonth($pricePerMonth){
        $this->pricePerMonth = $pricePerMonth;
    }

    public function getIsAvaliable(){
        return $this->pricePerMonth;
    }

    public function setIsAvaliable($isAvaliable){
        $this->isAvaliable = $isAvaliable;
    }
}