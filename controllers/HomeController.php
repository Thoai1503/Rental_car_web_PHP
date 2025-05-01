<?php
require_once 'repositories/CarRepository.php';

require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';


class HomeController
{
 
    private $pdo;
    private $carRepository;
    private $carTypeRepository;
    private $carBrandRepository;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
        $this->carTypeRepository = new CarTypeRepository($this->pdo);
        $this->carBrandRepository = new CarBrandRepository($this->pdo);
    }

    public function index()
    {
        $cars = $this->carRepository->getAll();
        require_once 'views/client/index.php';
    }
}

?>