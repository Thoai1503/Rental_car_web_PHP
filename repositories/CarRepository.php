<?php

require_once 'repositories/BaseRepositoryInterface.php';
class CarRepository implements BaseRepositoryInterface
{

    private $pdo;
    private $table = 'cars';
    public $cars = [];
                    private Car $car;
    public function __construct($pdo)
    {
        
        require_once 'models/Car.php';
        require_once 'helpers/function.php';
        $this->pdo = $pdo;
      
    }

    public function getAll(): array
    {
      //  var_dump($this->pdo);die();
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
       $cars=  $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         foreach ($cars as $carData) {
            $this->cars[] = new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
        }
        return $this->cars;
    }
    // Rewrite the second method to get all cars using mapping through the Car class
    public function getAllCarsMapped()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cars as $carData) {
            $this->cars[] = new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
        }
        return $this->cars;
    }

    public function create($data)
    {
        $car= new Car(0,$data['name'],$data['brand'],$data['type'],$data['fuel_type'],$data['seats'],$data['transmission'], $data['price_per_day'], $data['image'],"available");
        
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (name,brand,type,fuel_type,seats,transmission, price_per_day, image) VALUES (?, ?, ?,?, ?, ?, ?, ?)");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(), $car->getImage()]);
    }

    public function update($data)
    { 
      //  var_dump($_REQUEST);die();
        
        if($data['image']!=""){
        $car= new Car( $data['id'],$data['name'],$data['brand'],$data['type'],$data['fuel_type'],$data['seats'],$data['transmission'], $data['price_per_day'], $image="",$status="available");
       // var_dump($car);die();
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand =?,type=?,fuel_type=?,seats=?,transmission =?, price_per_day = ?, image = ? WHERE id = ?");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(), $car->getImage(),$car->getId()]);
        }
        else{
            $car= new Car( $data['id'],$data['name'],$data['brand'],$data['type'],$data['fuel_type'],$data['seats'],$data['transmission'], $data['price_per_day'], $image="",$status="available");
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand =?,type=?,fuel_type=?,seats=?,transmission =?, price_per_day = ? WHERE id = ?");
            return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(),$car->getId()]);
        }
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        $car = new Car($result['id'], $result['name'], $result['brand_id'], $result['type_id'], $result['fuel_type'], $result['seats'], $result['transmission'], $result['price_per_day'], $result['image'], $result['status']);
        return $car;
    }

    public function search($keyword)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE name LIKE ?");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCarStatus($id, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
    public function getCarByStatus($status)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE status = ?");
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>