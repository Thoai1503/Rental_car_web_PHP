<?php
require_once 'controllers/CarController.php';
require_once 'repositories/CarRepository.php';
require_once 'controllers/AdminController.php';
require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'controllers/HomeController.php';



require_once 'helpers/function.php';
$pdo = require_once 'config/database.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/car_rent', '', $requestUri);


//route for client
if($requestUri === '/index' || $requestUri === '/') {

  $homeController = new HomeController($pdo);
  $homeController->index();
  } elseif($requestUri === '/carlist' || str_contains($requestUri,'/carlist')) {
  
    $homeController = new HomeController($pdo);
    $homeController->carList();
  } elseif($requestUri === '/searchfilter' ||str_contains($requestUri,'/searchfilter')) {
    $homeController = new HomeController($pdo);
    $homeController->searchFilter();
  
  } elseif($requestUri === '/cardetails') {
    $homeController = new HomeController($pdo);
    $homeController->carDetails(); 

  }


  elseif($requestUri === '/checkavailability') {
    $homeController = new HomeController($pdo);
    $homeController->checkAvailability();
  }
   elseif($requestUri === '/cars-add') {
    $carController = new CarController(new CarRepository($pdo));
    $carController->add();

  
} 
 //end of route for client
 

elseif(str_contains($requestUri,'cars-edit')) {
  $id=(int)explode('/', $requestUri)[3];
    $carController = new CarController(new CarRepository($pdo));
    $carController->edit($id);


} elseif(str_contains($requestUri,'/deletecar')) {
  // dd($_REQUEST['id']);
    $id=(int)$_REQUEST['id'];
      $carController = new CarController(new CarRepository($pdo));
      $carController->delete($id);

   }   elseif($requestUri === '/cars') {
        $id=(int)explode('/', $requestUri)[2];
        $carController = new CarController(new CarRepository($pdo));
        $carController->show($id);
    
    
    

  

} elseif($requestUri === '/cars-delete') {
    $carController = new CarController( new CarRepository($pdo));
    $carController->delete($_POST['id']);


  }

elseif($requestUri === '/admin'){
 // var_dump($requestUri);die();
  $adminController = new AdminController($pdo);
  $adminController->index();


}
elseif(str_contains($requestUri,'admin/editcar')) {
  $id=(int)explode('/', $requestUri)[3];
  $carController = new CarController(new CarRepository($pdo));
  $carController->show($id);

}

elseif($requestUri === '/admin/addcar'){
  $adminController = new AdminController($pdo);
  $adminController->addView();
}
elseif($requestUri === '/admin/cars-add'){
  $carController = new CarController($pdo);
  $carController->add();

  

}  elseif($requestUri === '/admin/cars-delete'){
  $carController = new CarController($pdo);
  $carController->delete($_POST['id']);


}  elseif($requestUri === '/admin/cars-list') {
  $adminController = new AdminController($pdo);
  $adminController->carTable();

}

 elseif($requestUri === '/admin/cars-list') {
  $adminController = new AdminController($pdo);
  $adminController->carTable();


} 


elseif($requestUri === '/admin/updateCarStatus') {
  $carController = new CarController(new CarRepository($pdo));
  $carController->updateStatusViaAjax();
}

 else {
  // dd($_REQUEST);die();
    http_response_code(404);
    echo "404 Not Found";
}



?>

