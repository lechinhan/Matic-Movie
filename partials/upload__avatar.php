<?php
session_start();
// include "./mysqli_connect.php";
include './preload.php';


function clean($string)
{
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
}
if (isset($_FILES['input__avatar__file'])) {
    $email = $_SESSION['s_email'];
    $old_avatar = $_POST['old__avatar'];
    $avatar__dir = '../images/User/';
    $avatar__file = $avatar__dir . clean(basename($_FILES['input__avatar__file']['name']));

    move_uploaded_file($_FILES['input__avatar__file']['tmp_name'], $avatar__file);

    $avatar__file__update = substr($avatar__file, 1);

    $query = "UPDATE userinfo SET avatar='$avatar__file__update' WHERE email='$email'";
    if ($result = mysqli_query($dbc, $query)) {
        if (strcmp($old_avatar, "./images/User/DefaultUser.png") == 0) {
            echo 1;
        } else {
            unlink(".$old_avatar");
            echo 1;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
    // else {
    //     if(mysqli_query($dbc, "UPDATE userinfo SET avatar='./images/User/DefaultUser.png' WHERE email='$email'"))
    //     {
    //         echo 2;
    //     }else {
    //         echo 0;
    //     }
    // } 
