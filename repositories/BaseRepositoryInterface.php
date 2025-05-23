<?php


interface BaseRepositoryInterface 
{
    public function getAll(): iterable;
    public function getById(int $id);

    public function create(array $car);
    public function update(array $car);
    public function delete(int $id);
}
?>