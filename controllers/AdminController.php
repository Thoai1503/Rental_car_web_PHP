<?php
require_once 'repositories/CarRepository.php';
require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
class AdminController{

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
        $carTypes = $this->carTypeRepository->getAll();
        require_once 'views/admin/index.php';
    }          
    
    
    public function addView()
    {
        $carTypes = $this->carTypeRepository->getAll();
        $carBrands = $this->carBrandRepository->getAll();   
        require 'views/admin/add-car.php';
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $type = $_POST['type'];
            $fuel_type = $_POST['fuel_type'];
            $seats = $_POST['seats'];
            $transmission = $_POST['transmission'];
            $price_per_day = $_POST['price_per_day'];
            $image = randomString(8) . basename($_FILES["image"]["name"]);
            $target_dir = "uploads/";
            $target_file = $target_dir.$image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $this->carRepository->create($name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image);
            header('Location: /admin');
        } else {
            require 'views/admin/add-car.php';
        }
}
public function carTable()
{
    $cars = $this->carRepository->getAllCarsMapped();
    require 'views/admin/car-list.php';
}

public function carTypeTable()
{
    
    require 'views/admin/car-type-list.php';
}
}
?>

