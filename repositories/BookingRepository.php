    <?php
     require_once 'BaseRepositoryInterface.php';
  
    class BookingRepository implements BaseRepositoryInterface{
        private $pdo;
        private $table = 'bookings';
        public $bookings = [];
        private $userRepository;

        public function __construct($pdo)
        {
            require_once 'models/Booking.php';
            require_once 'helpers/function.php';
            require_once 'repositories/UserRepository.php';
            $this->pdo = $pdo;  
            $this->userRepository = new UserRepository($this->pdo);
        }

        public function getAll(): array {
            
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $results =[];
            foreach ($bookings as $bookingData) {
                $booking=new Booking($bookingData['id'], $bookingData['user_id'], $bookingData['car_id'],$bookingData['total_price'], $bookingData['start_date'], $bookingData['end_date'], $bookingData['status']);
                $booking->setUserPhone($this->userRepository->getById($bookingData['user_id'])->getPhone());
               $results[] = $booking;
            }
            return $results;
        }

        public function getById(int $id) {
           
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            $bookingData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($bookingData) {
               return new Booking($bookingData['id'], $bookingData['user_id'],$bookingData['car_id'],$bookingData['total_price'],  $bookingData['start_date'],  $bookingData['end_date'],  $bookingData['status']);
            }
          
            return null;
        }


        public function create(array $data): bool {
          //   var_dump($data);die();
              $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (user_id, car_id, start_date,total_price, end_date, status) VALUES (?,?,?, ?, ?, ?)");
           return     $stmt->execute([$data['user_id'], $data['car_id'], $data['pickup_date'],$data['total_price'], $data['dropoff_date'], 'confirmed']);
        }

        public function update(array $car): bool {
            // Implement logic to update an existing car brand
            return true;
        }

        public function delete(int $id): bool {
            // Implement logic to delete a car brand by ID
            return true;
        }
        public function getByUserId($userId) {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_id = ?");
            $stmt->execute([$userId]);
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $results =[];
            foreach ($bookings as $bookingData) {
                $booking=new Booking($bookingData['id'], $bookingData['user_id'], $bookingData['car_id'],$bookingData['total_price'], $bookingData['start_date'], $bookingData['end_date'], $bookingData['status']);
                $booking->setUserPhone($this->userRepository->getById($bookingData['user_id'])->getPhone());
                $booking->setUserName($this->userRepository->getById($bookingData['user_id'])->getName());
                $booking->setUserEmail($this->userRepository->getById($bookingData['user_id'])->getEmail());
               $results[] = $booking;
            }
            return $results;
        }
    }
    ?>