<?php
include './vendor/autoload.php';
include './logIn_API_config.php';
session_start();
unset($_COOKIE['c_email']);
setcookie('c_email', null, -1, '/');
session_unset();
$_SESSION['is_1st_view'] = 'no';
header('Location: http://localhost/movieweb/index.php');
