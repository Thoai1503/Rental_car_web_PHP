<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 var_dump($requestUri);
if(str_contains($requestUri,'/admin')){
require_once 'views/_layout/admin.php';
}else{
    require_once 'route.php';
}


?>
