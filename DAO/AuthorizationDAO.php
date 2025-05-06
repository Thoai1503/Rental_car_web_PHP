
<?php
require_once 'models/Authorization.php';
require_once 'DAO/AccountDAO.php';
require_once 'DAO/AuthorizationDAO.php';
 class AuthorizationDAO
{
    private static $instance = null;
    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    
    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new AuthorizationDAO($pdo);
        }
        return self::$instance;
    }

public function getAuthorization($auth_id,$url)
{
    $stmt = $this->pdo->prepare("SELECT * FROM authorization WHERE id_authen = :auth_id");
    $stmt->bindParam(':auth_id', $auth_id);
   
    $stmt->execute();
 
    $authorization = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $results =[];
    foreach ($authorization as $authData) {
        $item= new Authorization($authData['id_authen'], $authData['url'], $authData['title']);
        $results[] = $item;
    }
   $re= array_find($results, function($item) use ($url) {
        return str_contains($url, $item->getUrl());
    });
    if($re){
        return true;
    }else{
        return false;
    }
}
}
?>