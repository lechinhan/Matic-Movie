<?php

// include './partials/mysqli_connect.php';
require './vendor/autoload.php';
require_once './fb_config.php';
if (!session_id()) {
    session_start();
}
if (isset($accessToken)) {
    if (!isset($_SESSION['access_token'])) {
        $_SESSION['access_token'] = (string) $accessToken;
        $oAuth2Client = $fb->getOAuth2Client();

        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['access_token']);
        $_SESSION['access_token'] = (string) $longLivedAccessToken;

        $fb->setDefaultAccessToken($_SESSION['access_token']);
    } else {
        $fb->setDefaultAccessToken($_SESSION['access_token']);
    }

    try {
        $fb_response = $fb->get('/me?fields=name,email');

        $fbUser = $fb_response->getGraphUser();
        $_SESSION['fb_user_name'] = $fbUser->getField('name');
        $_SESSION['fb_user_email'] = $fbUser->getField('email');
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Facebook API Error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK Error: ' . $e->getMessage();
        exit;
    }
} else {
    $login_url = $helper->getLoginUrl(FB_BASE_URL);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="<?php echo $login_url; ?>">Login to facebook</a>

    <?php if (isset($_SESSION['fb_user_name'])) {
        echo '<h2>' . $_SESSION['fb_user_name'] . '</h2>';
    }
    ?>
</body>

</html>