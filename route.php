<?php
require_once 'controllers/CarController.php';
require_once 'repositories/CarRepository.php';
require_once 'controllers/AdminController.php';

require_once 'helpers/function.php';
$pdo = require_once 'config/database.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/car_rent', '', $requestUri);

//var_dump($requestUri);

if($requestUri === '/index.php' || $requestUri === '/') {
 // var_dump(value: __DIR__);die();
  $carController = new CarController(new CarRepository($pdo));
  $carController->index();


} 
  elseif($requestUri === '/addcar') {
    $title = 'Thêm xe';
    require_once 'views/add-car.php';


  } elseif($requestUri === '/admin/cars-add'){
    $carController = new CarController(new CarRepository($pdo));
    $carController->add();

    

} 
 elseif(str_contains($requestUri,'cars-edit')) {
  $id=(int)explode('/', $requestUri)[2];
    $carController = new CarController(new CarRepository($pdo));
    $carController->edit($id);


} elseif(str_contains($requestUri,'/deletecar')) {
  // dd($_REQUEST['id']);
    $id=(int)$_REQUEST['id'];
      $carController = new CarController(new CarRepository($pdo));
      $carController->delete($id);


  

} elseif($requestUri === '/cars-delete') {
    $carController = new CarController( new CarRepository($pdo));
    $carController->delete($_POST['id']);


  }elseif(str_contains($requestUri,'editcar')) {
    $id=(int)explode('/', $requestUri)[2];
    $carController = new CarController(new CarRepository($pdo));
    $carController->show($id);

}

elseif($requestUri === '/admin'){
 // var_dump($requestUri);die();



 



  $adminController = new AdminController(new CarRepository($pdo));
  $adminController->index();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    // header('Content-Type: application/json');

    // // Get raw POST data
    // $rawData = file_get_contents("php://input");
    
    // // Decode the JSON into an associative array
    // $data = json_decode($rawData, true);
    
    // Check if the expected data is present
    if (isset($_POST['name']) && isset($_POST['age'])) {
        $name = htmlspecialchars($_POST['name']); // Optional: basic sanitization
        $age = (int)$_POST['age'];
    
        // Example logic: return a custom message
        $response = [
            'status' => 'success',
            'message' => "Hello, $name! You are $age years old."
        ];
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input data. Name and age are required.'
        ]);
    }
  }
}

elseif($requestUri === '/admin/addcar'){
  $adminController = new AdminController(new CarRepository($pdo));
  $adminController->addView();
}

elseif($requestUri === '/updateCarStatus') {
  $carController = new CarController(new CarRepository($pdo));
  $carController->updateStatusViaAjax();
}

 else {
  // dd($_REQUEST);die();
    http_response_code(404);
    echo "404 Not Found";
}



?>

