<?php

// OAUTH Configuration
$oauthClientID = '658482136014-l5le3frgqqnihp0oqjtk66cbqa6agn98.apps.googleusercontent.com';
$oauthClientSecret = 'cVQhu0f1g54qEfLnM3XNWEEc';
$baseURL = 'http://localhost/trello2/';
$redirectURL = 'http://localhost/trello2/display.php';

define('OAUTH_CLIENT_ID',$oauthClientID);
define('OAUTH_CLIENT_SECRET',$oauthClientSecret);
define('REDIRECT_URL',$redirectURL);
define('BASE_URL',$baseURL);

// Include google client libraries
require_once 'google-api-php/autoload.php'; 
require_once 'google-api-php/Client.php';
require_once 'google-api-php/YouTube.php';

session_start();

$client = new Google_Client();
$client->setClientId(OAUTH_CLIENT_ID);
$client->setClientSecret(OAUTH_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$client->setRedirectUri(REDIRECT_URL);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);
    
?>