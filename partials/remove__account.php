<?php
session_start();
// include "./mysqli_connect.php";
include './preload.php';


$mail = $_POST["mail"];
$htmlspecialchars = 'htmlspecialchars';
$query__comment = "DELETE FROM comments WHERE email='$mail'";
$query__user = "DELETE FROM userinfo WHERE email='$mail'";
if (mysqli_query($dbc, $query__comment) && mysqli_query($dbc, $query__comment)) {
    echo 1;
    session_unset();
} else {
    echo mysqli_error($dbc);
}
