<?php

use Pcntl\QosClass;

interface BaseRepositoryInterface 
{
    public function getAll(): array;
    public function getById(int $id);

    public function create(array $car);
    public function update(array $car);
    public function delete(int $id);
}
?>