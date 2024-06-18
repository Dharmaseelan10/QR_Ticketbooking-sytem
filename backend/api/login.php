<?php
session_start();  // Start the session at the beginning of the script

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include 'database.php'; // Include your database configuration and connection
$pdo = getPDO();

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$query = $pdo->prepare("SELECT userId, username, password FROM users WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch();

if ($user && password_verify($password, $user['password'])) {
    // Set user information in session
    $_SESSION['userId'] = $user['userId'];  // Store userId in session
    $_SESSION['username'] = $user['username'];  // Optionally store username

    $response = [
        'success' => true,
        'token' => 'your_generated_token_here',  // Token should be generated in a secure way if used for session management
        'user_id' => $user['userId']
    ];
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
}
?>
