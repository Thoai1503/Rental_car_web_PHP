<?php
require_once 'controllers/PaymentController.php';

// Authentication routes
if ($requestUri === '/login') {
    require_once 'views/login.php';
    exit();
} elseif ($requestUri === '/checklogin') {
    $loginController = new LoginController($pdo);
    $loginController->login();
    exit();
} elseif ($requestUri === '/register') {
    $registerController = new RegisterController($pdo);
    $registerController->register();
    exit();
} elseif ($requestUri === '/logout') {
    session_start();
   
    unset($_SESSION['user']);
    header('Location: /car_rent/index');
    exit();
}

// Client routes
if ($requestUri === '/index' || $requestUri === '/') {
    $homeController = new HomeController($pdo);
    $homeController->index();
} elseif ($requestUri === '/carlist' || str_contains($requestUri, '/carlist')) {
    $homeController = new HomeController($pdo);
    $homeController->carList();
} elseif ($requestUri === '/cardetails') {
    $homeController = new HomeController($pdo);
    $homeController->carDetails();
} elseif ($requestUri === '/payment') {
   if (isset($_SESSION['user'])) {
        $homeController = new HomeController($pdo);
        $homeController->showPaymentForm();
    } else {
        header('Location: /car_rent/login');
        exit();
    }
    // $homeController = new HomeController($pdo);
    // $homeController->showPaymentForm();
} elseif ($requestUri ==='/submitpayment' || str_contains($requestUri, '/submitpayment')) {
    $paymentController = new PaymentController($pdo);
    $paymentController->processPayment();
} elseif ($requestUri === '/updateInputDate'){
    $homeController = new HomeController($pdo);
    $homeController->updateInputDate();
} elseif ($requestUri ==='/mybookings') {
    $homeController = new HomeController($pdo);
    $homeController->myBookings();
} elseif ($requestUri ==='/service'){
    $homeController = new HomeController(($pdo));
    $homeController->service();
} elseif ($requestUri ==='/about'){
     $homeController = new HomeController(($pdo));
    $homeController->about();
} elseif ($requestUri ==='/contact'){
     $homeController = new HomeController(($pdo));
  $homeController->contact();
}
// Admin/management routes
elseif ($requestUri === '/admin' || $requestUri === '/admin/index') {
    $adminController = new AdminController($pdo);
    $adminController->index();
} elseif ($requestUri === '/admin/cars-list') {
    $adminController = new AdminController($pdo);
    $adminController->carTable();
} elseif ($requestUri ==='/admin/user-list'){
    $adminController = new AdminController($pdo);
    $adminController->userTable();
} elseif ($requestUri === '/admin/addcar') {
    $adminController = new AdminController($pdo);
    $adminController->addView();
} elseif (str_contains($requestUri, 'admin/editcar')) {
    $id = (int) explode('/', $requestUri)[3];
    $adminController = new AdminController($pdo);
    $adminController->show($id);
} elseif ($requestUri === '/admin/updateCarStatus') {
    $carController = new CarController($pdo);
    $carController->updateStatusViaAjax();
} elseif ($requestUri === '/cars-add' || $requestUri === '/admin/cars-add') {
    $carController = new CarController($pdo);
    $carController->add();
} elseif ($requestUri === '/admin/booking-list') {
    $adminController = new AdminController($pdo);
    $adminController->bookingTable();
} elseif ($requestUri === '/admin/user-list') {
    $adminController = new AdminController($pdo);
   $adminController->userTable();
} elseif ($requestUri === '/admin/edituser') {
    $id = (int) $_REQUEST['id'];
    $adminController = new AdminController($pdo);
   // $adminController->editUser($id);
} elseif ($requestUri === '/admin/bookingdetail') {
    $id = (int) $_REQUEST['id'];
    $adminController = new AdminController($pdo);
    $adminController->bookingDetail($id);
}
elseif ($requestUri === '/admin/userdetail') {
    $id = (int) $_REQUEST['id'];
    $adminController = new AdminController($pdo);
    $adminController->userDetail($id);
} 


// Car management routes
 elseif (str_contains($requestUri, 'cars-edit')) {
    $id = (int) explode('/', $requestUri)[3];
    $carController = new CarController($pdo);
    $carController->edit($id);
} elseif ($requestUri === '/cars') {
    $id = (int) explode('/', $requestUri)[2];
    $carController = new CarController(new CarRepository($pdo));
    $carController->show($id);
} elseif ($requestUri === '/cars-delete' || $requestUri === '/admin/cars-delete') {
    $carController = new CarController($pdo);
    $carController->delete($_POST['id']);
} elseif (str_contains($requestUri, '/deletecar')) {
    $id = (int) $_REQUEST['id'];
    $carController = new CarController(new CarRepository($pdo));
    $carController->delete($id);
}

// Not found
else {
    http_response_code(404);
    echo '404 Not Found';
}
?>