<?php
//initialize facebook sdk
require './vendor/autoload.php';
if (!session_id()) {
    session_start();
}
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$fb_appID = $_ENV['FB_appID'];
$fbapp_secret = $_ENV['FBapp_secret'];

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];;

mysqli_report(MYSQLI_REPORT_OFF);
$dbc = mysqli_connect($db_host, $db_user, '', $db_name);

$fb = new Facebook\Facebook([
    'app_id' => $fb_appID,
    'app_secret' => $fbapp_secret,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    // redirect the user to the profile page if it has "code" GET variable
    if (isset($_GET['code'])) {
        header('Location: ./index.php');
    }
    // getting basic info about user
    try {
        $htmlspecialchars =  'htmlspecialchars';

        $profile_request = $fb->get('/me?fields=first_name,last_name,email,id');
        $requestPicture = $fb->get('/me/picture?redirect=0&height=200&width=200&type=normal'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getField('id');           // To Get Facebook ID
        $fbFirstName = $profile->getField('first_name');   // To Get Facebook full name
        $fbLastName = $profile->getField('last_name');   // To Get Facebook full name
        if ($fbemail = $profile->getField('email')) {
            $_SESSION['s_email'] = $fbemail;
        } else {
            $_SESSION['s_fbID'] = $fbid;
        }
        // $fbGender = $profile->getField('gender');
        // if ($fbGender === 'male') {
        //     $fbGender = 'M';
        // } elseif ($fbGender === 'female') {
        //     $fbGender = 'F';
        // } else {
        //     $fbGender = 'O';
        // }
        // $fbGender = $profile->getField('gender');
        // $fbbirthDay = $profile->getField('birthday');
        $fbfullname = $fbFirstName . ' ' . $fbLastName;
        $fbpic = $htmlspecialchars($picture['url']);
        # save the user nformation in session variable
        // $_SESSION['fb_id'] = $fbid;
        $_SESSION['isLogged'] = 1;
        $_SESSION['s_name'] = $fbfullname;
        $_SESSION['s_email'] = $fbemail;
        $_SESSION['log_method'] = 'Facebook';
        $_SESSION['is_1st_view'] = 'yes';
        $_SESSION['s_permission'] = 'nor';
        mysqli_begin_transaction($dbc);
        try {
            $check_user_info = "SELECT * FROM `userinfo` WHERE `email`='$email'";
            $userinfo_res = mysqli_query($dbc, $check_user_info);
            if (!mysqli_num_rows($userinfo_res)) {
                $insert_user_info = "INSERT INTO userinfo(`email`, `firstName`, `surName`, `avatar`) VALUES (?,?,?,?) ";
                $stmt_userinfo = mysqli_prepare($dbc, $insert_user_info);

                mysqli_stmt_bind_param($stmt_userinfo, 'ssss', $fbemail, $fbFirstName, $fbLastName, $fbpic);
                mysqli_stmt_execute($stmt_userinfo);

                if (mysqli_stmt_affected_rows($stmt_userinfo)) {
                    mysqli_commit($dbc);
                }
            }
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($dbc);
            throw $exception;
            header("Location: ./signIn_Up.php");
        }

        // $_SESSION['fb_pic'] = $fbpic;
        header("Location: ./index.php");
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        header("Location: ./");
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}
