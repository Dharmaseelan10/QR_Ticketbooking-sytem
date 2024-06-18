<?php
include 'database.php'; // Ensure this includes your PDO connection setup

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, X-Auth-Token, Content-Type');

// Check if userId is provided
$userId = isset($_GET['userId']) ? $_GET['userId'] : null;

if (empty($userId)) {
    // Respond with an error if userId is not provided
    echo json_encode(['error' => 'User ID is required']);
    http_response_code(400); // Bad request
    exit;
}

$pdo = getPDO();

// Prepare and execute the query
try {
    $stmt = $pdo->prepare("SELECT id, concertName, selectedSeat, qrCodeUrl FROM bookings WHERE userId = ?");
    $stmt->execute([$userId]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if bookings were found
    if ($bookings) {
        echo json_encode(['bookings' => $bookings]);
    } else {
        // Respond with no bookings found
        echo json_encode(['bookings' => [], 'message' => 'No bookings found']);
    }
} catch (PDOException $e) {
    // Handle SQL errors or issues with the database connection
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    http_response_code(500); // Internal server error
}
?>
