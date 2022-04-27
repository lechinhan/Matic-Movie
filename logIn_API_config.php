<?php
// require './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$fb_appID = $_ENV['FB_appID'];
$fbapp_secret = $_ENV['FBapp_secret'];

$client_ID = $_ENV['GG_ClientID'];
$client_secret = $_ENV['GG_Client_secret'];


$fb = new Facebook\Facebook([
    'app_id' => $fb_appID,
    'app_secret' => $fbapp_secret,
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$fb_loginUrl = $helper->getLoginUrl('http://localhost/movieweb/fb__logIn.php', $permissions);

$client = new Google\Client();

$client->setClientId($client_ID);
$client->setClientSecret($client_secret);
$client->setRedirectUri('http://localhost/movieweb/gg__logIn.php');

$client->addScope("email");
$client->addScope("profile");
$gg_loginUrl = $client->createAuthUrl();
