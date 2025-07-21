<?php
// facebook-login.php

$app_id = '752849183281927-vqqc22vbkvcrvsjdcc9d5gv1cqf89jk9.apps.facebookusercontent.com';
$redirect_uri = 'https://https://rigvesoft.com/homesquare/real-estate-panels-2/real/index.php/facebook-callback.php';
$state = bin2hex(random_bytes(8)); // store to validate later if you want
$scope = 'email';

$fb_auth_url = "https://www.facebook.com/v15.0/dialog/oauth?client_id={$app_id}&redirect_uri={$redirect_uri}&state={$state}&scope={$scope}";

header('Location: ' . $fb_auth_url);
exit;
