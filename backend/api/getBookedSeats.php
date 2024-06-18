<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

include 'database.php'; // Ensure database connection setup is correct

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $concertId = isset($_GET['concertId']) ? intval($_GET['concertId']) : 0;

    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT selectedSeat FROM bookings WHERE concertId = ?");
    $stmt->execute([$concertId]);
    $bookedSeats = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch only the seat numbers

    echo json_encode(['bookedSeats' => $bookedSeats]); // Return as JSON object with key 'bookedSeats'
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
