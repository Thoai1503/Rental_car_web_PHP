<?php
class CarController
{
    private $carRepository;

    public function __construct($carRepository)
    {
        require_once 'helpers/function.php';
        $this->carRepository = $carRepository;
    }
    public function index()
    {
        $cars = $this->carRepository->getAllCars();
      require_once 'views/admin/home.php';
    }
    
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           dd($_POST);die();
           $str= randomString(8);
     
            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $type = $_POST['type'];
            $fuel_type = $_POST['fuel_type'];
            $seats = $_POST['seats'];
            $transmission = $_POST['transmission'];

            $price_per_day = $_POST['price_per_day'];
            $image = randomString(8) . basename($_FILES["image"]["name"]);

            $target_dir = "uploads/";
            $target_file = $target_dir.$$image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $this->carRepository->addCar($name,$brand,$type,$fuel_type,$seats,$transmission, $price_per_day, $image);
            header('Location: /cars');
        } else {
            require 'views/admin/add-car.php';
        }
    }
    public function edit($id)
    {
        $car = $this->carRepository->getCarById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           // dd($_FILES);die();
            if ($_FILES["image"]["error"] == 0) {
        
                // Check if the file is uploaded successfully
                if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
                    echo "Error uploading file: " . $_FILES["image"]["error"];
                    return;
                }
                // Check if the file is an image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    echo "File is not an image.";
                    return;
                }
                // Check if the file size is within limits (e.g., 2MB)
                if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
                    echo "File size exceeds the limit.";
                    return;
                }
               if($car['image']!=""&& strlen($car['image'])>20){
             //`   var_dump("uploads/".$car['image']);die();
                unlink("uploads/".$car['image']);
             


                $filename = $_FILES["image"]["name"];
                $image = randomString(8) . $filename;
                $target_dir = "uploads/";
                $target_file = $target_dir.$image;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $this->carRepository->updateCar($id, $_POST['name'], $_POST['brand'], $_POST['type'], $_POST['fuel_type'], $_POST['seats'], $_POST['transmission'], $_POST['price_per_day'], $image);
                header('Location: ../');
                var_dump("./uploads/".$car['image']);die();
              
               }
              // echo "Out";die();
                $filename = $_FILES["image"]["name"];
                $image = randomString(8) . $filename;
                $target_dir = "uploads/";
                $target_file = $target_dir.$image;
                
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $this->carRepository->updateCar($id, $_POST['name'], $_POST['brand'], $_POST['type'], $_POST['fuel_type'], $_POST['seats'], $_POST['transmission'], $_POST['price_per_day'], $image);
                header('Location: ../');
            } else {
                $this->carRepository->updateCar($id, $_POST['name'], $_POST['brand'], $_POST['type'], $_POST['fuel_type'], $_POST['seats'], $_POST['transmission'], $_POST['price_per_day'], "");
                header('Location: ../');
            }
            // header('Location: /cars');
        } else {
            require 'views/admin/edit-car.php';
        }
    }
    public function delete($id)
    {
        $this->carRepository->deleteCar($id);
        header('Location: ../car_rent');
    }
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $cars = $this->carRepository->searchCars($keyword);
        require 'views/admin/car-list.php';
    }
    public function show($id)
    {
        $car = $this->carRepository->getCarById($id);
        require 'views/admin/edit-car.php';
    }
}
?>