<?php
class MiddlewareRepository{
    private static $instance = null;
    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new MiddlewareRepository($pdo);
        }
        return self::$instance;
    }

    public function checkLogin($email, $password)
    {
       return AccountDAO::getInstance($this->pdo)->getUser($email, $password);
    }
    public function  checkAuthorization($auth_id, $url)
    {
        return AuthorizationDAO::getInstance($this->pdo)->getAuthorization($auth_id, $url);
    }
} 
?>