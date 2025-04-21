<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 
if(str_contains($requestUri,'/admin')){
require_once 'views/layout/admin.php';
}else{
    require_once 'route.php';
}


?>
