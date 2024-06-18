<?php
include 'database.php'; // Make sure this path is correct

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);
$bookingId = $data['bookingId'] ?? '';

if (!$bookingId) {
    echo json_encode(['error' => 'Booking ID is required']);
    exit;
}

$pdo = getPDO();

// Cancel the booking
$stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
$result = $stmt->execute([$bookingId]);

if ($result) {
    echo json_encode(['message' => 'Booking cancelled successfully']);
} else {
    echo json_encode(['error' => 'Failed to cancel booking']);
}
?>
