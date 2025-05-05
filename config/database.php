 <?php
try {
    // Create a new PDO instance
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=rental_car_db', 'root', '123456');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
