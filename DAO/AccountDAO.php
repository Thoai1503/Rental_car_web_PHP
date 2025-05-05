<?php
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
            return new User($user['id'], $user['name'], $user['email'], $user['auth_id']);
        } else {
            return null;
        }

    }
}
?>