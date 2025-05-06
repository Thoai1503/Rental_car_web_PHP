<?php
require_once 'controllers/CarController.php';
require_once 'repositories/CarRepository.php';
require_once 'controllers/AdminController.php';
require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/LoginController.php';



require_once 'helpers/function.php';
$pdo = require_once 'config/database.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/car_rent', '', $requestUri);

if($requestUri==='/hi'){
  //var_dump($requestUri);die();
    require_once 'views/admin/index.php';
}
elseif($requestUri === '/login') {
  require_once 'views/login.php';
 } elseif ($requestUri === '/checklogin') {
   $loginController = new LoginController($pdo);
   $loginController->login();

  

}
 elseif($requestUri === '/register') {
  require_once 'views/register.php';
} elseif($requestUri === '/logout') {
  session_start();
  session_destroy();
  header('Location: /car_rent/login');
  exit;
} elseif($requestUri === '/login/submit') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $middlewareRepository = new MiddlewareRepository($pdo);
  $user = $middlewareRepository->checkLogin($email, $password);
  
  if ($user) {
      session_start();
      $_SESSION['user'] = $user;
      header('Location: /car_rent/index');
      exit;
  } else {
      echo "Invalid email or password.";
  }
}
//route for client
if($requestUri === '/index' || $requestUri === '/') {

  $homeController = new HomeController($pdo);
  $homeController->index();
  } elseif($requestUri === '/carlist' || str_contains($requestUri,'/carlist')) {
  
    $homeController = new HomeController($pdo);
    $homeController->carList();
  } elseif($requestUri === '/cardetails') {
    $homeController = new HomeController($pdo);
    $homeController->carDetails(); 

  }
  elseif($requestUri === '/payment') {
    $homeController = new HomeController($pdo);
    $homeController->showPaymentForm();
  }


   elseif($requestUri === '/cars-add') {
    $carController = new CarController(new CarRepository($pdo));
    $carController->add();

  
} 
 //end of route for client
 

elseif(str_contains($requestUri,'cars-edit')) {
  $id=(int)explode('/', $requestUri)[3];
    $carController = new CarController($pdo);
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

elseif($requestUri === '/admin' || $requestUri === '/admin/index'){
 // var_dump($requestUri);die();
  $adminController = new AdminController($pdo);
  $adminController->index();


}
elseif(str_contains($requestUri,'admin/editcar')) {
  $id=(int)explode('/', $requestUri)[3];

  $adminController = new AdminController($pdo);
  $adminController->show($id);
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




elseif($requestUri === '/admin/updateCarStatus') {
  $carController = new CarController($pdo);
  $carController->updateStatusViaAjax();
}

 else {
  // dd($_REQUEST);die();
    http_response_code(404);
    echo "404 Not Found";
}



?>

