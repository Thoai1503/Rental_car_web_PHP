<?php
class PaymentController
{
    private $pdo;
    private $carRepository;
    private $userRepository;
    private $bookingRepository;

    public function __construct($pdo)
    {
        require_once 'repositories/CarRepository.php';
 //       require_once 'repositories/UserRepository.php';
        require_once 'repositories/BookingRepository.php';
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
   
        $this->bookingRepository = new BookingRepository($this->pdo);
    }

    public function processPayment()
    {
        if(isset($_SESSION['user'])){
        $data =[
            'user_id' => $_SESSION['user']['id'],
            'car_id' => $_POST['car_id'],
            'pickup_date' => $_POST['pickup_date'],
            'total_price' => $_POST['total_price'],
            'dropoff_date' => $_POST['dropoff_date'],
//'status' => $_POST['status'],
        ];

        // Validate and sanitize input
        // $userId = filter_var($data['user_id'], FILTER_SANITIZE_NUMBER_INT);
        // $carId = filter_var($data['car_id'], FILTER_SANITIZE_NUMBER_INT);
        // $startDate = filter_var($data['start_date'], FILTER_SANITIZE_STRING);
        // $endDate = filter_var($data['end_date'], FILTER_SANITIZE_STRING);
        // $totalPrice = filter_var($data['total_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        // $status = filter_var($data['status'], FILTER_SANITIZE_STRING);
              
         $this->bookingRepository->create($data);

        // Redirect to a success page or show a success message
        header('Location: /car_rent/index');
        exit();

    
    } 
}
}
?>