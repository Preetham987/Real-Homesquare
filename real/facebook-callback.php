<?php
// facebook-callback.php

$app_id = '752849183281927-fhjwsc7282cnswnev.apps.facebookusercontent.com';
$app_secret = 'a3f8b4d5e7c946fa8be27c77f9a41e7a';
$redirect_uri = 'https://rigvesoft.com/homesquare/real-estate-panels-2/real/facebook-callback.php';

if (!isset($_GET['code'])) {
    exit('No code parameter found');
}

$code = $_GET['code'];

// Exchange code for access token
$token_url = "https://graph.facebook.com/v15.0/oauth/access_token?" . http_build_query([
    'client_id' => $app_id,
    'redirect_uri' => $redirect_uri,
    'client_secret' => $app_secret,
    'code' => $code,
]);

$token_response = file_get_contents($token_url);
$token_data = json_decode($token_response, true);

if (!isset($token_data['access_token'])) {
    exit('Failed to get access token');
}

$access_token = $token_data['access_token'];

// Fetch user info
$userinfo_url = "https://graph.facebook.com/me?fields=id,name,email&access_token={$access_token}";

$userinfo_response = file_get_contents($userinfo_url);
$userinfo = json_decode($userinfo_response, true);

echo 'Hello, ' . htmlspecialchars($userinfo['name']) . ' (' . htmlspecialchars($userinfo['email']) . ')';
