<?php

class CarRepository
{

    private $pdo;
    private $table = 'cars';

    public function __construct($pdo)
    {
        require_once 'models/Car.php';
        $this->pdo = $pdo;
    }

    public function getAllCars()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCar($name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image)
    {
        $car= new Car($id=0,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image);
 
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (name,brand,type,fuel_type,seats,transmission, price_per_day, image) VALUES (?, ?, ?,?, ?, ?, ?, ?)");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(), $car->getImage()]);
    }

    public function updateCar($id,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image)
    { 
      //  var_dump($_REQUEST);die();
        
        if($image!=""){
        $car= new Car($id,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image);
       // var_dump($car);die();
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand =?,type=?,fuel_type=?,seats=?,transmission =?, price_per_day = ?, image = ? WHERE id = ?");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(), $car->getImage(),$id]);
        }
        else{
            $car= new Car($id,$name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image="");
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand =?,type=?,fuel_type=?,seats=?,transmission =?, price_per_day = ? WHERE id = ?");
            return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(),$id]);
        }
    }

    public function deleteCar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCarById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchCars($keyword)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE name LIKE ?");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>