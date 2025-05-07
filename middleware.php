<?php
require_once 'controllers/CarController.php';
require_once 'repositories/CarRepository.php';
require_once 'controllers/AdminController.php';
require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/LoginController.php';
require_once 'repositories/MiddlewareRepository.php';

require_once 'controllers/RegisterController.php';



require_once 'helpers/function.php';
$pdo = require_once 'config/database.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/car_rent', '', $requestUri);

if ($requestUri === '/login') {
    require_once 'views/login.php';
    die();
} elseif ($requestUri === '/checklogin') {
    $loginController = new LoginController($pdo);
    $loginController->login();
} elseif ($requestUri === '/register') {
    $registerController = new RegisterController($pdo);
    $registerController->register();
} elseif ($requestUri === '/logout') {
    session_start();
    session_destroy();
    header('Location: /car_rent/index');
    exit();
}

if (isset($_SESSION['user'])) {
    $auth_id = $_SESSION['user']['auth_id'];
    $url = $requestUri;

    $authorization = MiddlewareRepository::getInstance($pdo)->checkAuthorization($auth_id, $url);
    if ($authorization == false) {
        if ($auth_id == 1) {
            header('Location: /car_rent/admin/index');
            die();
        } elseif ($auth_id == 2) {
            header('Location: /car_rent/index');
            exit();
        }
        echo 'required route';
        exit();
    }
    require_once 'route.php';
} elseif (str_contains($requestUri, '/admin')) {
    header('Location: /car_rent/index');
    exit();
} else {
    require_once 'route.php';
}
?>
