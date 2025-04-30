<?php
require_once 'BaseRepositoryInterface.php';
 class CarBrandRepository implements BaseRepositoryInterface
{

    private $pdo;
    private $table = 'brands';
    public $car_brands = [];

    public function __construct($pdo)
    {
        require_once 'models/CarBrand.php';
        require_once 'helpers/function.php';
        $this->pdo = $pdo;  
    }

    public function getAll(): array {
        
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        $car_brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $results =[];
        foreach ($car_brands as $carBrandData) {
            $car=new CarBrand($carBrandData['id'], $carBrandData['name']);
           $results[] = $car;
        }
        return $results;
    }

    public function getById(int $id) {
       
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $carBrandData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($carBrandData) {
           $carBrand= new CarBrand($carBrandData['id'], $carBrandData['name']);
           return $carBrand->getName();
        }
      
        return null;
    }


    public function create(array $car): bool {
        // Implement logic to create a new car brand
        return true;
    }

    public function update(array $car): bool {
        // Implement logic to update an existing car brand
        return true;
    }

    public function delete(int $id): bool {
        // Implement logic to delete a car brand by ID
        return true;
    }
}
?>