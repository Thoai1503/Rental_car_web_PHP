<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 
if(str_contains($requestUri,'/admin')){
 echo "Admin page";
  exit();
}
    require_once 'route.php';



?>
