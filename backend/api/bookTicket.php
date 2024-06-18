<?php
include 'database.php';  // Ensure the correct path if located in a different directory
include 'qr_code_generator.php';  // Ensure the correct path if located in a different directory
//include 'saveQRCode.php'; 

session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}



$input = json_decode(file_get_contents('php://input'), true);
$userId = $input['userId'] ?? null; // Ensure there's a fallback if session isn't set
$concertId = $input['concertId'] ?? null;
$concertName = $input['concertName'] ?? null;  // Added to handle concert name
$name = $input['name'] ?? null;
$phoneNumber = $input['phoneNumber'] ?? null;
$selectedSeat = $input['selectedSeat'] ?? null;

$pdo = getPDO(); // Ensure you have a function or connection setup to get your PDO instance

// Check seat availability
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE concertId = ? AND selectedSeat = ?");
$stmt->execute([$concertId, $selectedSeat]);
if ($stmt->rowCount() > 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Seat already booked for this concert. Please choose another seat.']);
    exit;
}

// Insert booking
$stmt = $pdo->prepare("INSERT INTO bookings (userId, concertId, concertName, name, phoneNumber, selectedSeat) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt->execute([$userId, $concertId, $concertName, $name, $phoneNumber, $selectedSeat])) {
    $bookingId = $pdo->lastInsertId(); 
  
    
}
?>
