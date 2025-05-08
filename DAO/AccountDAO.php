<?php
require_once 'models/User.php';
class AccountDAO
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
            self::$instance = new AccountDAO($pdo);
        }
        return self::$instance;
    }
    public function getUser($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
       // $stmt->fetch(PDO::FETCH_ASSOC);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user['id'], $user['name'],$user['phone'], $user['email'], $user['id_auth']);
        } else {
            return null;
        }

    }
    public function createUser($email, $password, $name)
    {
 
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (email, password, name,id_auth) VALUES (:email, :password, :name,2)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message, etc.)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>