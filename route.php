<?php
require_once 'controllers/CarController.php';
require_once 'repositories/CarRepository.php';
require_once 'helpers/function.php';
$pdo = require_once 'config/database.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/car_rent', '', $requestUri);



if($requestUri === '/index.php' || $requestUri === '/') {
 // var_dump(value: __DIR__);die();
  $carController = new CarController(new CarRepository($pdo));
  $carController->index();


} 
  elseif($requestUri === '/addcar') {
    $title = 'Thêm xe';
    require_once 'views/add-car.php';


  } elseif($requestUri === '/cars-add'){
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

 else {
  dd($_REQUEST);die();
    http_response_code(404);
    echo "404 Not Found";
}



?>

