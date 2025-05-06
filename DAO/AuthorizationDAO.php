
<?php
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
    $stmt = $this->pdo->prepare("SELECT * FROM authorization WHERE auth_id = :auth_id AND url = :url");
    $stmt->bindParam(':auth_id', $auth_id);
    $stmt->bindParam(':url', $url);
    $stmt->execute();
 
   return $authorization = $stmt->fetch(PDO::FETCH_ASSOC);
    
}
}
?>