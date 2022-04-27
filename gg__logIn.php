<?php

// use Google\Service\Script;
// use Google\Service\ServiceControl\Peer;

require './vendor/autoload.php';

if (!session_id()) {
    session_start();
}

echo 'Hello';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client_ID = $_ENV['GG_ClientID'];
$client_secret = $_ENV['GG_Client_secret'];
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];;

mysqli_report(MYSQLI_REPORT_OFF);
$dbc = @mysqli_connect($db_host, $db_user, '', $db_name);

$client = new Google\Client();

$client->setClientId($client_ID);
$client->setClientSecret($client_secret);
$client->setRedirectUri('http://localhost/movieweb/gg__logIn.php');

$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token["error"])) {

        $_SESSION['gg_token'] = $token['access_token'];
        $client->setAccessToken($token['access_token']);
        //         // getting profile information
        $google_oauth = new Google\Service\Oauth2($client);
        $user_info = $google_oauth->userinfo->get();

        //         // Storing data into database
        // $id = mysqli_real_escape_string($dbc, $google_account_info->id);
        $given_name = mysqli_real_escape_string($dbc, $user_info->givenName);
        $family_name = mysqli_real_escape_string($dbc, $user_info->familyName);
        $full_name = $family_name . ' ' . $given_name;
        $email = mysqli_real_escape_string($dbc, $user_info->email);
        $profile_pic = mysqli_real_escape_string($dbc, $user_info->picture);
        // echo 'Hello ' . $given_name .  ' ' . $family_name . '. You are log in to Matic with email: ' . $email;
        mysqli_begin_transaction($dbc);
        try {
            $check_existed_user = "SELECT * FROM `userinfo` WHERE `email` = '$email'";
            $check_existed__res = mysqli_query($dbc, $check_existed_user);
            if (mysqli_num_rows($check_existed__res) > 0) {
                // $query_info = mysqli_fetch_array($check_existed__res);
                $_SESSION['isLogged'] = 1;
                $_SESSION['s_email'] = $email;
                $_SESSION['s_name'] = $full_name;
                $_SESSION['s_surName'] = $given_name;
                $_SESSION['log_method'] = 'google';
                $_SESSION['is_1st_view'] = 'yes';
                $_SESSION['s_permission'] = 'nor';
                mysqli_commit($dbc);
                header("Location: ./index.php");
            } else {
                $insert_user = "INSERT INTO `userinfo`(`email`, `firstName`, `surName`,`avatar`) VALUES ('$email', '$given_name', '$family_name', '$profile_pic')";
                $insert__res = mysqli_query($dbc, $insert_user);
                if (mysqli_affected_rows($dbc) == 1) {
                    $_SESSION['isLogged'] = 1;
                    $_SESSION['s_email'] = $email;
                    $_SESSION['s_name'] = $full_name;
                    $_SESSION['s_surName'] = $given_name;
                    $_SESSION['log_method'] = 'Google';
                    $_SESSION['is_1st_view'] = 'yes';
                    $_SESSION['s_permission'] = 'nor';
                    mysqli_commit($dbc);
                    header("Location: ./index.php");
                }
            }
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($dbc);
            throw $exception;
            echo "Sign up failed!(Something went wrong).";
            header("Location: ./signIn_Up.php");
        }
        // echo 'Hello ' . $given_name .  ' ' . $family_name . '. You are log in to Matic with email: ' . $email;
        // echo '</br><img src="' . $profile_pic . '">';
    }
}
//         // checking user already exists or not
//         $get_user = mysqli_query($dbc, "SELECT `email, firstName` FROM `userinfo` WHERE `email`='$email'");
//         if (mysqli_num_rows($get_user) > 0) {
//             $row = mysqli_fetch_array($get_user);
//             $_SESSION['isLogged'] = 1;
//             $_SESSION['s_name'] = $row['firstName'];
//             $_SESSION['s_email'] = $row['email'];
//             header('Location: ./index.php');
//             exit;
//         } else {
//             // if user not exists we will insert the user
//             $hashed_pass = password_hash("testPass", PASSWORD_DEFAULT);
//             $insert = mysqli_query($db_connection, "INSERT INTO `userinfo`(`firstName`,`email`,`password`) VALUES('$full_name','$email','$hashed_pass')");
//             if ($insert) {
//                 $_SESSION['isLogged'] = 1;
//                 header('Location: index.php');
//                 exit;
//             } else {
//                 echo "Sign up failed!(Something went wrong).";
//             }
//         }
//         header("Location: ./index.php");
//     } else {
//         header('Location: ./gg__logIn.php');
//         exit;
//     }
// }
// Google Login Url = $client->createAuthUrl(); 


// if (isset($_GET['code'])) {

//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token['access_token']);

//     // getting profile information
//     $google_oauth = new Google\Service\Books($client);
//     $google_account_info = $google_oauth->userinfo->get();

//     // showing profile info
    // echo "<pre>";
    // var_dump($google_account_info);
// } else {
//     $google_login_url = $client->createAuthUrl();
// }
