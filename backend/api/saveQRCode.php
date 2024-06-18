<?php
require_once 'database.php'; // Ensure this file is properly set up for database connections
include 'qr_code_generator.php'; 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $image = $data['image'];
    $filename = basename($data['filename']); // Basic sanitation
    $name = $data['name']; // Receive booking ID from the request
    $phoneNumber = $data['phoneNumber'];
    $userId = $data['userId'];
    $selectedSeat = $data['selectedSeat'];
    $concertName = $data['concertName'];
    
   


    
    // Decode the image
    list(, $image) = explode(',', $image);
    $image = base64_decode($image);

    if (!$image) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid image data"]);
        exit;
    }

    $directory = __DIR__ . '/qrcode';
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    $filePath = $directory . '/' . $filename;

    if (file_put_contents($filePath, $image)) {
        $pdo = getPDO(); 
        $urlPath = "http://localhost/QRTicket-vue-php/backend/api/qrcode/" . $filename;
        // Store the QR Code URL in the booking record
        $updateStmt = $pdo->prepare("UPDATE bookings SET qrCodeUrl = ? WHERE name = ? AND userId = ? AND phoneNumber = ? AND selectedSeat = ? AND concertName = ?");
        if (!$updateStmt->execute([$urlPath, $name, $userId, $phoneNumber, $selectedSeat, $concertName ])) {
      http_response_code(500);
      echo json_encode(['error' => 'Failed to update booking with QR Code URL']);
      exit;
  }
      
        }
}
?>
