<?php
  require_once 'DAO/AccountDAO.php';
class LoginController
{
    private $accountDAO;
    private $carRepository;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // Check if the user exists in the database
            $user = AccountDAO::getInstance($this->pdo)->getUser($email, $password);
   
            if ($user) {
                // Store user information in session
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'phone' => $user->getPhone(),
                    'auth_id' => $user->getAuthId(),
                ];
                switch ($user->getAuthId()) {
                    case 1:
                        header('Location: admin');
                        exit;
                    case 2:
                        header('Location: index');
                        exit;
                    default:
                    header('Location: index');
                        exit();
                }
                // header('Location: /car_rent/index');
                // exit();
            } else {
                echo "Invalid email or password.";
            }   
        } else {
            require 'views/login.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /index.php');
        exit();
    }
}
?>