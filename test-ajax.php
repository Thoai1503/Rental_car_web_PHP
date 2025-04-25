<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
 
       header('Content-Type: application/json');

    // // Get raw POST data
    // $rawData = file_get_contents("php://input");
    
    // // Decode the JSON into an associative array
    // $data = json_decode($rawData, true);
    
    // Check if the expected data is present
    if (isset($_POST['name']) && isset($_POST['age'])) {
        $name = htmlspecialchars($_POST['name']); // Optional: basic sanitization
        $age = (int)$_POST['age'];
    
        // Example logic: return a custom message
        $response = [
            'status' => 'success',
            'message' => "Hello, $name! You are $age years old."
        ];
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input data. Name and age are required.'
        ]);
    }
  }
?>