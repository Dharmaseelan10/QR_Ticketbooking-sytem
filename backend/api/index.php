<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up a simple routing system
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handleGetRequest();
        break;
    case 'POST':
        handlePostRequest();
        break;
    default:
        echo json_encode(['message' => 'Method not supported']);
}

function handleGetRequest() {
    echo json_encode(['message' => 'This is a GET request']);
}

function handlePostRequest() {
    // Assuming JSON input
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode(['received' => $data]);
}
