
<?php
require_once 'repositories/MiddlewareRepository.php';
require_once 'DAO/AccountDAO.php';
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
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
               header('Location: login?error=password_mismatch');
                return;
            }           

            // Call the middleware repository to check if the email already exists
       {
                // Email is unique, proceed with registration
                $accountDAO = AccountDAO::getInstance($this->pdo);
                 $result=  $accountDAO->createUser($email,$phone, $password, $name);
                if (!$result) {
                    header('Location: login.php?error=registration_failed');
                    return;
                }else{
                session_start();
                $_SESSION['user'] = [
                    'email' => $email,
                    'name' => $name,
                    'auth_id' => 2 // Assuming 2 is the auth_id for regular users
                ];
                header('Location: /car_rent/index?registration_successful=true&name=' . urlencode($name));
                exit();
            }
            } 
            }



            // Proceed with registration logic (e.g., save to database)
            // ...

          //  echo "Registration successful!";
        }
    }

?>