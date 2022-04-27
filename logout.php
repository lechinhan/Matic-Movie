<?php
include './vendor/autoload.php';
include './logIn_API_config.php';
session_start();
// $_SESSION = array();
unset($_COOKIE['c_email']);
setcookie('c_email', null, -1, '/');
// setcookie("c_name", "", time() - (86400 * 30), "/");
// setcookie("c_firstName", "", time() - (86400 * 30), "/");
// setcookie("log_method", 'Matic', time() - (86400 * 30), "/");
// setcookie("is_1st_view", 'yes', time() - (86400 * 30), "/");
// setcookie("s_permission", 'nor', time() - (86400 * 30), "/");
session_unset();
$_SESSION['is_1st_view'] = 'no';
// header("Location: https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/movieweb/index.php");
header('Location: http://localhost/movieweb/index.php');
