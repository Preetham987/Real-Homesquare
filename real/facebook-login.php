<?php
// facebook-login.php

$app_id = '';
$redirect_uri = '';
$state = bin2hex(random_bytes(8)); // store to validate later if you want
$scope = 'email';

$fb_auth_url = "https://www.facebook.com/v15.0/dialog/oauth?client_id={$app_id}&redirect_uri={$redirect_uri}&state={$state}&scope={$scope}";

header('Location: ' . $fb_auth_url);
exit;
