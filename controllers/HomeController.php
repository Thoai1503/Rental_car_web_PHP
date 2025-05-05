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

/**
 * Process the payment form submission
 */
// public function processPayment() {
//     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//         header('Location: carlist');
//         exit;
//     }
    
//     // Get form data
//     $carId = isset($_POST['car_id']) ? (int)$_POST['car_id'] : 0;
//     $totalAmount = isset($_POST['total_amount']) ? (float)$_POST['total_amount'] : 0;
    
//     if (!$carId || !$totalAmount) {
//         $_SESSION['error'] = "Invalid payment information";
//         header('Location: carlist');
//         exit;
//     }
    
//     // Get car details
//     $car = $this->carRepository->findById($carId);
    
//     if (!$car) {
//         $_SESSION['error'] = "Car not found";
//         header('Location: carlist');
//         exit;
//     }
    
//     // Validate customer information
//     $requiredFields = [
//         'first_name', 'last_name', 'email', 'phone', 
//         'address', 'city', 'state', 'zip',
//         'license_number', 'license_expiry', 'dob'
//     ];
    
//     $formData = [];
//     $isValid = true;
    
//     foreach ($requiredFields as $field) {
//         if (empty($_POST[$field])) {
//             $isValid = false;
//             break;
//         }
//         $formData[$field] = $_POST[$field];
//     }
    
//     if (!$isValid) {
//         $_SESSION['error'] = "Please fill in all required fields";
//         $_SESSION['form_data'] = $_POST;
//         header('Location: payment?car_id=' . $carId);
//         exit;
//     }
    
//     // Check payment method
//     $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    
//     if ($paymentMethod === 'credit_card') {
//         // Validate credit card information
//         $creditCardFields = ['card_number', 'expiry_date', 'cvv', 'card_name'];
        
//         foreach ($creditCardFields as $field) {
//             if (empty($_POST[$field])) {
//                 $_SESSION['error'] = "Please fill in all credit card details";
//                 $_SESSION['form_data'] = $_POST;
//                 header('Location: payment?car_id=' . $carId);
//                 exit;
//             }
//         }
        
//         // Process credit card payment (this would be integrated with a payment gateway)
//         // For this example, we'll assume payment is successful
//         $paymentSuccess = true;
        
//     } else if ($paymentMethod === 'paypal') {
//         // In a real application, you would redirect to PayPal here
//         // For this example, we'll assume payment is successful
//         $paymentSuccess = true;
        
//     } else {
//         $_SESSION['error'] = "Invalid payment method";
//         $_SESSION['form_data'] = $_POST;
//         header('Location: payment?car_id=' . $carId);
//         exit;
//     }
    
//     // If payment is successful, create rental record
//     if ($paymentSuccess) {
//         // Get rental details
//         $rentalDetails = isset($_SESSION['rental_details']) ? $_SESSION['rental_details'] : [
//             'pickup_date' => date('Y-m-d'),
//             'return_date' => date('Y-m-d', strtotime('+3 days')),
//             'days' => 3
//         ];
        
//         // Create customer record
//         $customer = [
//             'first_name' => $formData['first_name'],
//             'last_name' => $formData['last_name'],
//             'email' => $formData['email'],
//             'phone' => $formData['phone'],
//             'address' => $formData['address'],
//             'city' => $formData['city'],
//             'state' => $formData['state'],
//             'zip' => $formData['zip'],
//             'license_number' => $formData['license_number'],
//             'license_expiry' => $formData['license_expiry'],
//             'dob' => $formData['dob']
//         ];
        
//         // Save customer and get customer ID
//         $customerId = $this->saveCustomer($customer);
        
//         // Create rental record
//         $rental = [
//             'customer_id' => $customerId,
//             'car_id' => $carId,
//             'pickup_date' => $rentalDetails['pickup_date'],
//             'return_date' => $rentalDetails['return_date'],
//             'total_days' => $rentalDetails['days'],
//             'total_amount' => $totalAmount,
//             'payment_method' => $paymentMethod,
//             'status' => 'confirmed',
//             'additional_driver' => isset($_POST['additional_driver']) ? 1 : 0,
//             'gps' => isset($_POST['gps']) ? 1 : 0,
//             'child_seat' => isset($_POST['child_seat']) ? 1 : 0,
//             'created_at' => date('Y-m-d H:i:s')
//         ];
        
//         // Save rental and get rental ID
//         $rentalId = $this->rentalRepository->create($rental);
        
//         // Create payment record
//         $payment = [
//             'rental_id' => $rentalId,
//             'amount' => $totalAmount,
//             'payment_method' => $paymentMethod,
//             'status' => 'completed',
//             'transaction_id' => 'TR' . time(), // Generate transaction ID
//             'created_at' => date('Y-m-d H:i:s')
//         ];
        
//         // Save payment
//         $this->paymentRepository->create($payment);
        
//         // Clear session data
//         unset($_SESSION['rental_details']);
//         unset($_SESSION['form_data']);
        
//         // Set success message
//         $_SESSION['success'] = "Payment successful! Your rental has been confirmed.";
        
//         // Redirect to confirmation page
//         header('Location: confirmation?rental_id=' . $rentalId);
//         exit;
//     } else {
//         // Payment failed
//         $_SESSION['error'] = "Payment failed. Please try again.";
//         $_SESSION['form_data'] = $_POST;
//         header('Location: payment?car_id=' . $carId);
//         exit;
//     }
// }
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
}

?>