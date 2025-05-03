<?php
require_once 'repositories/CarRepository.php';

require_once 'repositories/CarTypeRepository.php';
require_once 'repositories/CarBrandRepository.php';
require_once 'helpers/function.php';


class HomeController
{
 
    private $pdo;
    private $carRepository;
    private $carTypeRepository;
    private $carBrandRepository;
    private $carList = [];

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->carRepository = new CarRepository($this->pdo);
        $this->carTypeRepository = new CarTypeRepository($this->pdo);
        $this->carBrandRepository = new CarBrandRepository($this->pdo);
        $list = $this->carRepository->getAll();
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
    public function searchFilter()
    {
        $_SESSION['displayForm'] = false;
        $cars = $this->carList;
       

        if($_SERVER["REQUEST_METHOD"] == "GET"){
 
            header('Content-Type: application/json');
     
      
         if (isset($_GET['brand']) ) {
             $brand = htmlspecialchars($_GET['brand']); // Optional: basic sanitization
            // $type = (int)$_GET['type'];
       }
            // Example logic: return a custom message
                $response = [
                    'status' => 'success',
                    'message' => "Hello, $brand! You are 8 years old."
                ];
                echo json_encode($response);
        
            }
    }

    public function checkAvailability()
    {   
        $formmatDate = 'm/d/Y';
       if(isset($_GET['pickup_date'])&&isset($_GET['return_date'])){
            $pickupDate = DateTime::createFromFormat($formmatDate, $_GET['pickup_date']);
            $returnDate = DateTime::createFromFormat($formmatDate, $_GET['return_date']);
            $interval = $pickupDate->diff($returnDate);

            $pickupDate = $pickupDate->format('Y-m-d');
            $returnDate = $returnDate->format('Y-m-d');
            echo $interval->d .'<br>';
            echo $pickupDate .'</br>';
            echo $returnDate-$pickupDate;
       }
            // }else{
        //     $pickupDate = date('Y-m-d');
        //     $returnDate = date('Y-m-d', strtotime('+1 day'));
        // }
        $cars = $this->carRepository->getAllCarsMapped();
       // require_once 'views/client/checkavailability.php';

    }
    public function carDetails()
    {
        $_SESSION['displayForm'] = false;
        // $id = (int)$_GET['id'];
        // $car = $this->carRepository->getById($id);
        // dd($car);die();
        // $carTypes = $this->carTypeRepository->getAll();
        // $carBrands = $this->carBrandRepository->getAll();
       // $car = $this->carRepository->getById($id);
        require_once 'views/client/cardetails.php';
    }
}

?>