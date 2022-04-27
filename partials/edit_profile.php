<?php
include './preload.php';


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $content = $_POST['content'];
    $col_name = $_POST['col_name'];

    $query = "UPDATE userinfo SET $col_name='$content' WHERE email='$email'";
    if ($result = mysqli_query($dbc, $query)) {
        echo 1;
    } else {
        echo 0;
    }
}
