<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];;

mysqli_report(MYSQLI_REPORT_OFF);
$dbc = @mysqli_connect($db_host, $db_user, '', $db_name);
