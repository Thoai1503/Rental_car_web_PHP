<?php
require_once 'models/Car.php';
class Booking
{
    private int $id;
    private int $userId;
    private string $userName;
    private string $userEmail;
    private string $userPhone;
    private int $carId;

    private Car $car;
    private $totalPrice;
  
    private string $startDate;
    private string $endDate;
    private string $status;

    public function __construct($id, $userId, $carId,$totalPrice, $startDate, $endDate, $status)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->carId = $carId;
        $this->totalPrice = $totalPrice;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCarId()
    {
        return $this->carId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;
    }

    public function getUserName()
    {
        return $this->userName;
    }
    public function getUserEmail()
    {
        return $this->userEmail;
    }
    public function getUserPhone()
    {
        return $this->userPhone;
    }
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
    public function getCar()
    {
        return $this->car;
    }
    public function setCar($car)
    {
        $this->car = $car;
    }
}
?>