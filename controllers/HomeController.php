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

    public function carList()
    {
        $_SESSION['displayForm'] = false;
        $cars = $this->carList;
       // create pagination for 10 items per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
           $perPage = 9;
           $total = count($cars);
           $totalPages = ceil($total / $perPage);
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
      //   $cars = array_filter($cars, function($car) {
       //     return $car->getBrand()==5;});

        require_once 'views/client/carlist.php';
    }
    public function searchFilter()
    {
        $_SESSION['displayForm'] = false;
        $cars = $this->carList;
        if (isset($_GET['brand']) && $_GET['brand'] != '') {
            $cars = array_filter($cars, function ($car) {
                return $car->getBrand() == $_GET['brand'];
            });
        }
   
        require_once 'views/client/searchfilter.php';
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