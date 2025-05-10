<?php
require_once 'repositories/CarRepository.php';

require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'repositories/BookingRepository.php';
require_once 'helpers/function.php';


class HomeController
{
 
    private $pdo;
    private $carRepository;
    private $carTypeRepository;
    private $carBrandRepository;
    private $bookingRepository;
    private $carList = [];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
        $this->carTypeRepository = new CarTypeRepository($this->pdo);
        $this->carBrandRepository = new CarBrandRepository($this->pdo);
        $this->bookingRepository = new BookingRepository($this->pdo);
        $list = $this->carRepository->getAllAvailableCar();
        foreach ($list as $car) {
            $this->carList[$car->getId()] = $car;
        }
    }

    public function index()
    {
       


           

        require_once 'views/client/index.php';
    }



// CarController.php
// Updated carList method with AJAX support

public function carList() {
    $_SESSION['displayForm'] = false;
    $brands = $this->carBrandRepository->getAll();
    $cars = $this->carList;
    
    // Determine if this is an AJAX request
    $isAjax = false;
    
    // Check for AJAX POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        
        // Get POST data (for AJAX requests)
        if ($isAjax) {
            // Get JSON data from request body
            $jsonData = file_get_contents('php://input');
            $requestData = json_decode($jsonData, true);
            
            // If JSON parsing failed, try regular POST data as fallback
            if ($requestData === null) {
                $requestData = $_POST;
            }
        } else {
            $requestData = $_POST;
        }
    } else {
        // For GET requests (initial page load)
        $requestData = $_GET;
    }
    
    // Get filter parameters
    $transmission = isset($requestData['transmission']) ? $requestData['transmission'] : '';
    $brand = isset($requestData['brand']) ? $requestData['brand'] : '';
    $maxPrice = isset($requestData['price']) && is_numeric($requestData['price']) ? (float)$requestData['price'] : 0;
    $carTypes = isset($requestData['car_type']) ? $requestData['car_type'] : [];
    
    // Apply filters if any
    if ($transmission || $brand || $maxPrice || !empty($carTypes)) {
        $filteredCars = [];
        foreach ($cars as $car) {
            $include = true;
            
            // Filter by transmission
            if ($transmission && $car->getTransmission() !== $transmission) {
                $include = false;
            }
            
            // Filter by brand
            if ($brand && $car->getBrand() != $brand) {
                $include = false;
            }
            
            // Filter by price
            if ($maxPrice > 0 && $car->getPricePerDay() > $maxPrice) {
                $include = false;
            }
            
            // Filter by car type
            if (!empty($carTypes)) {
                $carType = $car->getType();
                if (!in_array($carType, $carTypes)) {
                    $include = false;
                }
            }
            
            if ($include) {
                $filteredCars[] = $car;
            }
        }
        $cars = $filteredCars;
    }
    
    // Pagination
    $page = isset($requestData['page']) ? (int)$requestData['page'] : 1;
    $perPage = 9;
    $total = count($cars);
    $totalPages = max(1, ceil($total / $perPage));
    
    // Ensure page is within valid range
    $page = max(1, min($page, $totalPages));
    
    $offset = ($page - 1) * $perPage;
    $cars = array_slice($cars, $offset, $perPage);
    
    $pagination = [
        'total' => $total,
        'perPage' => $perPage,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'hasNextPage' => $page < $totalPages,
        'hasPrevPage' => $page > 1,
    ];
    
    // Handle AJAX requests
    if ($isAjax || (isset($requestData['ajax']) && $requestData['ajax'] === true)) {
        // Start output buffering to capture HTML
        ob_start();
        require_once 'views/partial/_car_items.php';
        $carHtml = ob_get_clean();
        
        ob_start();
        require_once 'views/partial/_pagination.php';
        $paginationHtml = ob_get_clean();
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'carHtml' => $carHtml,
            'paginationHtml' => $paginationHtml,
            'totalResults' => $total,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'hasNextPage' => $page < $totalPages,
            'hasPrevPage' => $page > 1
        ]);
        exit;
    }
    
    // For regular page load
    require_once 'views/client/carlist.php';
}
  
public function showPaymentForm() {
    $_SESSION['displayForm'] = false;
    // Get car ID from URL parameter
    $carId = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
    
    if (!$carId) {
        // Redirect to car listing if no car ID provided
        header('Location: carlist');
        exit;
    }
    
    // Get car details
    $car = $this->carRepository->getById($carId);
    
    if (!$car) {
        // Car not found, redirect to car listing
        $_SESSION['error'] = "Car not found";
        header('Location: carlist');
        exit;
    }
    
    // Get rental details from session if available
    $rental_details = [];
    
    if (isset($_SESSION['rental_details'])) {
        $rental_details = $_SESSION['rental_details'];
    } else {
        // Set default rental details (3 days from today)
        $rental_details = [
            'pickup_date' => date('Y-m-d'),
            'return_date' => date('Y-m-d', strtotime('+3 days')),
            'days' => 3
        ];
    }
    
    // Include the payment form view
    require_once 'views/client/payment_form.php';
}


    public function carDetails()
    {
            $_SESSION['displayForm'] = false;
       $id = (int)$_GET['id'];
        $car = $this->carRepository->getById($id);
        // dd($car);die();
        // $carTypes = $this->carTypeRepository->getAll();
        // $carBrands = $this->carBrandRepository->getAll();
       // $car = $this->carRepository->getById($id);
        require_once 'views/client/cardetails.php';
    }

    public function updateInputDate()
    {
     
        header('Content-Type: application/json');

        $rawData = file_get_contents('php://input');
      $data = json_decode($rawData, true);
//var_dump($data);die();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // $_SESSION['start_date'] = isset($data['start_date'])?? $data['start_date'] ;
          if (isset($_SESSION['start_date'])) {
            $startDate = $_SESSION['start_date'];
              $_SESSION['start_date'] = $startDate;
            } else {
                $_SESSION['start_date'] = $data['start_date'];
         }

           $_SESSION['end_date'] = isset($data['end_date'])? $data['end_date'] : null;
   
              $pickupDate = $_SESSION['start_date'];
                $dropoffDate = $_SESSION['end_date'];
       
           if($pickupDate && $dropoffDate) {
               $day= (strtotime($dropoffDate) - strtotime($pickupDate)) / (60 * 60 * 24);
               $response = [
                   'start_date' => $pickupDate,
                   'end_date' => $dropoffDate,
                   'days' => $day
               ];
               echo json_encode($response);
               unset($_SESSION['start_date']);
                unset($_SESSION['end_date']);
            } else {
               echo json_encode(['start_date' => $pickupDate]);
            }
        }
    }
    public function myBookings() 
    {
        $_SESSION['displayForm'] = false;
        $userId = $_SESSION['user']['id'];
        $bookings = $this->bookingRepository->getBookingsByUserId($userId);
     
        require_once 'views/client/mybooking.php';
        
    }
}

?>