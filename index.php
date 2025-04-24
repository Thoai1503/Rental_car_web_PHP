<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(str_contains($requestUri,'0')){
    //var_dump($requestUri);die();
require_once 'views/_layout/admin.php';
}else{
   
    require_once 'route.php';
}


?>  













