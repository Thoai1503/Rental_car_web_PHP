
<?php
require_once 'repositories/MiddlewareRepository.php';
class RegisterController
{
    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;  
        
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
               header('Location: login.php?error=password_mismatch');
                return;
            }           

            // Call the middleware repository to check if the email already exists
            if (MiddlewareRepository::getInstance($this->pdo)->checkLogin($email, $password)) {
                echo "Email already exists.";
                return;
            }

            // Proceed with registration logic (e.g., save to database)
            // ...

            echo "Registration successful!";
        }
    }
}
?>