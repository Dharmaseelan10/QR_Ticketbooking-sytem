<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, X-Auth-Token, Content-Type');

// Get access token from Facebook using the provided code
function getAccessToken($code) {
    $appId = '1092660981841663';
    $appSecret = '40692ae63de990ee6e027d735ed11f6d';
    $redirectUri = 'http://localhost/QRTicket-vue-php/backend/api/fb_redirect.php'; // Change to your actual redirect URI
    
    $url = "https://graph.facebook.com/v12.0/oauth/access_token";
    $params = array(
        'client_id' => $appId,
        'client_secret' => $appSecret,
        'redirect_uri' => $redirectUri,
        'code' => $code
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return isset($data['access_token']) ? $data['access_token'] : null;
}

// Example endpoint to handle Facebook login
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        // Log received parameters for debugging
        error_log('Received code: ' . $code);

        $accessToken = getAccessToken($code);
        
        if ($accessToken) {
            // Forward the access token back to the frontend
            header('Content-Type: application/json');
            echo json_encode(array('access_token' => $accessToken));
        } else {
            // Handle error: Redirect to login page or display an error message
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array('error' => 'Failed to get access token from Facebook.'));
        }
    } else {
        // Handle error: Authorization code not found
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'Authorization code not found.'));
    }
}
?>
