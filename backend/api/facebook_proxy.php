<?php

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your database connection file
include_once 'database.php';

// Function to generate a unique user token
function generateToken() {
    return bin2hex(random_bytes(16)); // Generate a random hexadecimal token
}

// Function to check if the user exists in the database
function userExists($email, $conn) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $rowCount = $stmt->num_rows;
    $stmt->close();
    return $rowCount > 0;
}

// Function to create a new user in the database
function createUser($username, $email, $password, $conn) {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    $stmt->close();
}

// Function to retrieve user token from the database
function getUserToken($email, $conn) {
    $stmt = $conn->prepare("SELECT token FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($token);
    $stmt->fetch();
    $stmt->close();
    return $token;
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Replace 'YOUR_APP_ID' with your actual Facebook App ID
    $appID = '1092660981841663';

    // Construct the Facebook OAuth URL with the App ID and other parameters
    $url = 'https://www.facebook.com/v2.10/dialog/oauth?' . http_build_query([
        'client_id' => $appID,
        'redirect_uri' => 'http://localhost:8080/ticket',  // Replace with your redirect URI
        'scope' => 'email',
        'response_type' => 'code',
        'approval_prompt' => 'auto'
    ]);

    // Set CORS headers to allow cross-origin requests
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

    // Output the OAuth dialog URL
    echo $url;
} else {
    // If the request method is not GET, return an error
    http_response_code(405); // Method Not Allowed
    echo "Error: Only GET requests are allowed.";
}
?>
