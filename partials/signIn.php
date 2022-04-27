<?php
// include './mysqli_connect.php';
include './preload.php';
if (!session_id()) {
    session_start();
}
$isLogged = false;
$input_email = $_POST['email'];
$input_pass = $_POST['password'];
$account_query = "SELECT * FROM accounts WHERE `email` = '$input_email'";
if ($account_info = mysqli_query($dbc, $account_query)) {
    if ($row = mysqli_fetch_array($account_info)) {
        $pass = $row['password'];
        if (password_verify($input_pass, $pass)) {
            $user_info_query = mysqli_query($dbc, "SELECT `firstName`, `surName`, `permission` FROM userinfo WHERE `email`= '$input_email'");
            if ($user_info = mysqli_fetch_array($user_info_query)) {
                $name = $user_info['firstName'] . ' ' . $user_info['surName'];
                $_SESSION['isLogged'] = 1;
                $_SESSION['s_email'] = $input_email;
                $_SESSION['s_name'] = $name;
                $_SESSION['s_firstName'] = $user_info['firstName'];
                $_SESSION['log_method'] = 'Matic';
                $_SESSION['is_1st_view'] = 'yes';
                $_SESSION['s_permission'] = $user_info['permission'];
                if (isset($_POST['remember']) && $_POST['remember'] == 1) {
                    setcookie("c_email", $input_email, time() + (86400 * 30), "/");
                }
            }
            echo $name;
        } else {
            $_SESSION['isLogged'] = 0;
            echo -1;
        }
    } else {
        $_SESSION['isLogged'] = 0;
        echo -2;
    }
}
