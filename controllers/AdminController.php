<?php
class AdminController{

    private $carRepository;
    public function __construct($carRepository)
    {
        $this->carRepository = $carRepository;
    }
    public function index()
    {
        $cars = $this->carRepository->getAllCars();
        require_once 'views/admin/index.php';
    }          
    
    
    public function addView()
    {
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
            $this->carRepository->addCar($name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image);
            header('Location: /admin');
        } else {
            require 'views/admin/add-car.php';
        }
}
}
?>

