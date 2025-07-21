<?php
session_start();

$client_id = "";
$client_secret = "";
$redirect_uri = "";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Exchange code for access token
    $token_url = "https://oauth2.googleapis.com/token";
    $post_fields = [
        "code" => $code,
        "client_id" => $client_id,
        "client_secret" => $client_secret,
        "redirect_uri" => $redirect_uri,
        "grant_type" => "authorization_code",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
        $user_info_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $access_token;
        $user_info = file_get_contents($user_info_url);
        $user = json_decode($user_info, true);

        // Optionally store user info in session
        $_SESSION['username'] = $user;
        $_SESSION['loggedin'] = true;


        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // Error handling
        header("Location: index.php?error=login_failed");
        exit();
    }
} else {
    // No code provided
    header("Location: index.php?error=no_code");
    exit();
}
?>