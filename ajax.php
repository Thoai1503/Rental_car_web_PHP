

<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Get raw POST data
$rawData = file_get_contents("php://input");

// Decode the JSON into an associative array
$data = json_decode($rawData, true);

// Check if the expected data is present
if (isset($data['name']) && isset($data['age'])) {
    $name = htmlspecialchars($data['name']); // Optional: basic sanitization
    $age = (int)$data['age'];

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
