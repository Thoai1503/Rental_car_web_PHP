<?php

require_once 'repositories/BaseRepositoryInterface.php';

class CarRepository implements BaseRepositoryInterface
{

    private $pdo;
    private $table = 'cars';
    public $cars = [];
    private $carTypeRepository;
    private $carBrandRepository;
                  
    public function __construct($pdo)
    {
      
        require_once 'models/Car.php';
        require_once 'helpers/function.php';
        require_once 'repositories/CarTypeRepository.php';
        require_once 'repositories/CarBrandRepository.php';
        $this->pdo = $pdo;
        $this->carTypeRepository = new CarTypeRepository($this->pdo);
        $this->carBrandRepository = new CarBrandRepository($this->pdo);
      
    }

    public function getAllAvailableCar(): array
    {
      //  var_dump($this->pdo);die();
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE status = 'available'");
        $stmt->execute();
       $cars=  $stmt->fetchAll(PDO::FETCH_ASSOC);
         $results =[];
         foreach ($cars as $carData) {
            $item= new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
            $item->setTypeName($this->carTypeRepository->getById($carData['type_id']));
            $item->setBrandName($this->carBrandRepository->getById($carData['brand_id']));

            $results[] = $item;
        }
        return $results;
    }
    public function getCarByBrandId($brandId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE brand_id = ?" . " AND status = 'available'");
        $stmt->execute([$brandId]);
        $cars=  $stmt->fetchAll(PDO::FETCH_ASSOC);
         $results =[];
         foreach ($cars as $carData) {
            $item= new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
            $item->setTypeName($this->carTypeRepository->getById($carData['type_id']));
            $item->setBrandName($this->carBrandRepository->getById($carData['brand_id']));

            $results[] = $item;
        }
        return $results;
    }

    public function getAll(): array
    {
      //  var_dump($this->pdo);die();
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} ");
        $stmt->execute();
       $cars=  $stmt->fetchAll(PDO::FETCH_ASSOC);
         $results =[];
         foreach ($cars as $carData) {
            $item= new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
            $item->setTypeName($this->carTypeRepository->getById($carData['type_id']));
            $item->setBrandName($this->carBrandRepository->getById($carData['brand_id']));

            $results[] = $item;
        }
        return $results;
    }



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
        
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (name,brand_id,type_id,fuel_type,seats,transmission, price_per_day, image) VALUES (?, ?, ?,?, ?, ?, ?, ?)");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), 'automatic', $car->getPricePerDay(), $car->getImage()]);
    }

    public function update($data)
    { 
      //  var_dump($_REQUEST);die();
        
        if($data['image']!=""){
        $car= new Car( $data['id'],$data['name'],$data['brand'],$data['type'],$data['fuel_type'],$data['seats'],$data['transmission'], $data['price_per_day'], $data['image'],$status="available");
       // var_dump($car);die();
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand_id =?,type_id=?,fuel_type=?,seats=?,transmission =?, price_per_day = ?, image = ? WHERE id = ?");
        return $stmt->execute([$car->getName(), $car->getBrand(), $car->getType(), $car->getFuelType(), $car->getSeats(), $car->getTransmission(), $car->getPricePerDay(), $car->getImage(),$car->getId()]);
        }
        else{
            $car= new Car( $data['id'],$data['name'],$data['brand'],$data['type'],$data['fuel_type'],$data['seats'],$data['transmission'], $data['price_per_day'], $image="",$status="available");
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?,brand_id =?,type_id=?,fuel_type=?,seats=?,transmission =?, price_per_day = ? WHERE id = ?");
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
        try{
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            $carData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($carData) {
                $car= new Car($carData['id'], $carData['name'], $carData['brand_id'], $carData['type_id'], $carData['fuel_type'], $carData['seats'], $carData['transmission'], $carData['price_per_day'], $carData['image'],$carData['status']);
                $car->setTypeName($this->carTypeRepository->getById($carData['type_id']));
                $car->setBrandName($this->carBrandRepository->getById($carData['brand_id']));
                return $car;
            }
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        
        // $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        // $stmt->execute([$id]);
        // $result= $stmt->fetch(PDO::FETCH_ASSOC);
        // $car = new Car($result['id'], $result['name'], $result['brand_id'], $result['type_id'], $result['fuel_type'], $result['seats'], $result['transmission'], $result['price_per_day'], $result['image'], $result['status']);
        // return $car;
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
    public function getByBrandId(int $brandId): array
{
    $sql = "SELECT * FROM {$this->table} WHERE brand_id = ? AND status = 'available' LIMIT 2";
    $params = [$brandId];
    

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $results = [];
    foreach ($cars as $carData) {
        $item = new Car(
            $carData['id'], 
            $carData['name'],   
            $carData['brand_id'], 
            $carData['type_id'], 
            $carData['fuel_type'], 
            $carData['seats'], 
            $carData['transmission'], 
            $carData['price_per_day'], 
            $carData['image'],
            $carData['status']
        );
        $item->setTypeName($this->carTypeRepository->getById($carData['type_id']));
        $item->setBrandName($this->carBrandRepository->getById($carData['brand_id']));
        
        $results[] = $item;
    }
    
    return $results;
}

}


?>