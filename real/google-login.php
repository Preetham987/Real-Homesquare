<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$client_id = '';
$redirect_uri = '';

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
