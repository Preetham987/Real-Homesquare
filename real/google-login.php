<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$client_id = '335879000635-vqqc22vbkvcrvsjdcc9d5gv1cqf89jk9.apps.googleusercontent.com';
$redirect_uri = 'https://rigvesoft.com/homesquare/real-estate-panels-2/real/google-callback.php';

$scope = urlencode('openid email profile');
$state = bin2hex(random_bytes(8));
$_SESSION['oauth2state'] = $state;

$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'response_type' => 'code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'openid email profile',
    'state' => $state,
    'access_type' => 'offline',
]);

header('Location: ' . $auth_url);
exit;
