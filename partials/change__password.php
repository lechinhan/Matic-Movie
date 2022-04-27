<?php
// include "./mysqli_connect.php";
include './preload.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $realpass = $_POST['realpass'];
    $confirm_realpass = $_POST['confirm_realpass'];
    $new__pass = $_POST['new__pass'];
    $confirm__new__pass = $_POST['confirm__new__pass'];

    if (password_verify(htmlspecialchars($confirm_realpass), $realpass)) {
        if ($confirm__new__pass == $new__pass) {
            if ($result = mysqli_query($dbc, "UPDATE userinfo SET password='$new__pass' WHERE email='$email'")) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo -1;
        }
    } else {
        echo -2;
    }
}
