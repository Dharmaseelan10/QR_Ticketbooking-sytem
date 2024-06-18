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
$query = $pdo->prepare("SELECT userId, username, email FROM users WHERE username = ?");
$query->execute([$data['username']]);
$user = $query->fetch();
if ($user && $user['email'] == $data['email']) {
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
    if (isset($data['username']) && isset($data['email'])) {
      $password = "";
      $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
      $stmt->bindParam(':username', $data['username']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':password', $password);
      $stmt->execute();
      $query = $pdo->prepare("SELECT userId, username, email FROM users WHERE username = ?");
      $query->execute([$data['username']]);
      $new_user = $query->fetch();
      if ($stmt->rowCount() > 0) {
          $response = [
            'success' => true,
            'message' => 'User registered successfully',
            'token' => 'your_generated_token_here',  // Token should be generated in a secure way if used for session management
            'userID' => $new_user['userId']
          ];
      } else {
          $response = [
            'success' => false,
            'message' => 'Registration failed'
          ];
      }
      echo json_encode($response);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
    }
}
?>



