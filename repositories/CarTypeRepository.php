<?php
    require_once  'BaseRepositoryInterface.php';
    class CarTypeRepository implements BaseRepositoryInterface{

        public function getAll(): array {
            // Implement logic to retrieve all car types
            return [];
        }

        public function getById(int $id): object|null {
            // Implement logic to retrieve a car type by ID
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
