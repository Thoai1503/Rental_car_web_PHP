<?php
require_once 'repositories/CarRepository.php';
class CarController

{
    private $pdo;
    private $carRepository;

    public function __construct($pdo)
    {
        require_once 'helpers/function.php';
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
    }
    public function index()
    {
        $cars = $this->carRepository->getAll();
        require_once 'views/_layout/client.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //    dd($_POST);die();
            $str = randomString(8);

            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $type = $_POST['type'];
            $fuel_type = $_POST['fuel_type'];
            $seats = $_POST['seats'];
            $transmission = $_POST['transmission'];

            $price_per_day = $_POST['price_per_day'];
         
            $image = randomString(8) . basename($_FILES['image']['name']);

            $target_dir = 'uploads/';
            $target_file = $target_dir . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            $data = [
                'name' => $name,
                'brand' => $brand,
                'type' => $type,
                'fuel_type' => $fuel_type,
                'seats' => $seats,
                'price_per_day' => $price_per_day,
                'image' => $image,
                'transmission' => $transmission] ;
            $this->carRepository->create($data);
            header('Location: ../index');
        } else {
            require 'views/admin/add-car.php';
        }
    }
    public function edit($id)
    {
        $car = $this->carRepository->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // dd($_FILES);die();
            if ($_FILES['image']['error'] == 0) {
                // Check if the file is uploaded successfully
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo 'Error uploading file: ' . $_FILES['image']['error'];
                    return;
                }
                // Check if the file is an image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    echo 'File is not an image.';
                    return;
                }
                // Check if the file size is within limits (e.g., 2MB)
                if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                    echo 'File size exceeds the limit.';
                    return;
                }
                if ($car->getImage() != '' && strlen($car->getImage()) > 20) {
                    //`   var_dump("uploads/".$car['image']);die();
                    unlink('uploads/' . $car->getImage());

                    $filename = $_FILES['image']['name'];
                    $image = randomString(8) . $filename;
                    $target_dir = 'uploads/';
                    $target_file = $target_dir . $image;
                    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    $data = [
                        'id' => $id,
                        'name' => $_POST['name'],
                        'brand' => $_POST['brand'],
                        'type' => $_POST['type'],
                        'fuel_type' => $_POST['fuel_type'],
                        'seats' => $_POST['seats'],
                        'transmission' => $_POST['transmission'],
                        'price_per_day' => $_POST['price_per_day'],
                        'image' => $image,
                    ];
    
                    $this->carRepository->update($data);
                    header('Location: ../index');
                 //   var_dump('./uploads/' . $car['image']);
                  //  die();
                }
                // echo "Out";die();
                $filename = $_FILES['image']['name'];
                $image = randomString(8) . $filename;
                $target_dir = 'uploads/';
                $target_file = $target_dir . $image;

                $data = [
                    'id' => $id,
                    'name' => $_POST['name'],
                    'brand' => $_POST['brand'],
                    'type' => $_POST['type'],
                    'fuel_type' => $_POST['fuel_type'],
                    'seats' => $_POST['seats'],
                    'transmission' => $_POST['transmission'],
                    'price_per_day' => $_POST['price_per_day'],
                    'image' => $image,
                ];

                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $this->carRepository->update($data);
                header('Location: ../index');
            } else {

                $data = [
                    'id' => $id,
                    'name' => $_POST['name'],
                    'brand' => $_POST['brand'],
                    'type' => $_POST['type'],
                    'fuel_type' => $_POST['fuel_type'],
                    'seats' => $_POST['seats'],
                    'transmission' => $_POST['transmission'],
                    'price_per_day' => $_POST['price_per_day']??'',
                    'image' => '',
                    'status' => 'available',
                ];
                $this->carRepository->update($data);
                header('Location: ../index');
            }
            // header('Location: /cars');
        } else {
            require 'views/admin/edit-car.php';
        }
    }
    public function delete($id)
    {
        $this->carRepository->delete($id);
        header('Location: ../car_rent');
    }
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $cars = $this->carRepository->search($keyword);
        require 'views/admin/car-list.php';
    }
    public function show($id)
    {
        $car = $this->carRepository->getById($id);
        require 'views/admin/edit-car.php';
    }
    public function updateStatusViaAjax()
    {
        // Set content type to JSON
        header('Content-Type: application/json');

        $rawData = file_get_contents('php://input');

        // Decode the JSON into an associative array
        $data = json_decode($rawData, true);
        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'success' => false,
                'message' => 'Method not allowed. Please use POST.',
            ]);
            return;
        }

        // Validate required parameters
        if (!isset($data['carId']) || !isset($data['status'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing required parameters: carId and status',
            ]);
            return;
        }

        // Get and sanitize parameters
        $carId = (int) $data['carId'];
        $status = htmlspecialchars($data['status']);

        // Validate status value
        if (!in_array($status, ['available', 'unavailable'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid status value. Must be "available" or "not available".',
            ]);
            return;
        }

        try {
            // Update car status
            $success = $this->carRepository->updateCarStatus($carId, $status);

            if ($success) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Car status updated successfully',
                    'data' => [
                        'carId' => $carId,
                        'status' => $status,
                    ],
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update car status',
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }
  
}
?>
