<?php
require_once 'repositories/CarRepository.php';
require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'repositories/BookingRepository.php';
require_once 'repositories/UserRepository.php';
class AdminController{

    private $pdo;
    private $carRepository;
    private $carTypeRepository;
    private $carBrandRepository;
    private $bookingRepository;
    private $userRepository;
    public function __construct($pdo)
    {
     
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
        $this->carTypeRepository = new CarTypeRepository($this->pdo);
        $this->carBrandRepository = new CarBrandRepository($this->pdo);
        $this->bookingRepository = new BookingRepository($this->pdo);
        $this->userRepository = new UserRepository($this->pdo);
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
            
            $data = [
                'name' => $name,
                'brand' => $brand,
                'type' => $type,
                'fuel_type' => $fuel_type,
                'seats' => $seats,
                'transmission' => $transmission,
                'price_per_day' => $price_per_day,
                'image' => $image
            ];

            $target_dir = "uploads/";
            $target_file = $target_dir.$image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $this->carRepository->create($data);
            header('Location: /admin');
        } else {
            require 'views/admin/add-car.php';
        }
}
public function carTable()
{
    $cars = $this->carRepository->getAll();
    require 'views/admin/car-list.php';
}

public function carTypeTable()
{
    require 'views/admin/car-type-list.php';
}
public function show($id)
{
    $carTypes = $this->carTypeRepository->getAll();
    $carBrands = $this->carBrandRepository->getAll();
    $car = $this->carRepository->getById($id);
    require 'views/admin/edit-car.php';
}
public function bookingTable()
{
    $bookings = $this->bookingRepository->getAll();
    require 'views/admin/bookinglist.php';

}
public function bookingDetail($id)
{
    $booking = $this->bookingRepository->getById($id);
    $user = $this->userRepository->getById($booking->getUserId());
    $booking->setCar($this->carRepository->getById($booking->getCarId()));
    require 'views/admin/bookingdetail.php';
}
public function userTable()
{
    $users = $this->userRepository->getAllClient();
    require 'views/admin/user-list.php';
}
}
?>

