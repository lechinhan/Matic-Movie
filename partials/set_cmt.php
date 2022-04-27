<?php
// include './mysqli_connect.php';
include './preload.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$htmlspecialchars =  'htmlspecialchars';
$msg = $htmlspecialchars($_POST['msg']);
$email = $_POST['email'];
$FID   = $_POST['FID'];
$cmt_date = date("Y-m-d H:i:s");
$sql = "INSERT INTO comments(email, cmt_date, FID, msg) 
        VALUES ('$email', '$cmt_date', '$FID', '$msg')";
if ($result = mysqli_query($dbc, $sql)) {
    echo 1;
} else {
    echo 0;
}
