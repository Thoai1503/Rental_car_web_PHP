<?php
    require_once  'BaseRepositoryInterface.php';
    class CarTypeRepository implements BaseRepositoryInterface{


        private $pdo;
        private $table = 'car_types';
        public $car_types = [];

        public function __construct($pdo)
        {
            require_once 'models/CarType.php';
            require_once 'helpers/function.php';
            $this->pdo = $pdo;  
        }

        public function getAll(): array {
            
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            $car_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $results =[];
            foreach ($car_types as $carTypeData) {
                $car=new CarType($carTypeData['id'], $carTypeData['name']);
               $results[] = $car;
            }
            return $results;
        }

        public function getById(int $id) {
           
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            $carTypeData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($carTypeData) {
               $carType= new CarType($carTypeData['id'], $carTypeData['name']);
               return $carType->getName();
            }
          
            return null;
        }

        public function getByField(string $field, $value): object|null {
            // Implement logic to retrieve a car type by a specific field
            return null;
        }

        public function create(array $car): bool {
            // Implement logic to create a new car type
            return true;
        }

        public function update(array $car): bool {
            // Implement logic to update an existing car type
            return true;
        }

        public function delete(int $id): bool {
            // Implement logic to delete a car type by ID
            return true;
        }
    }
?> 
