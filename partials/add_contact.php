<?php
// include './mysqli_connect.php';
include './preload.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$htmlspecialchars =  'htmlspecialchars';

if (!empty($_POST['msg']) && !empty($_POST['email'])) {
    $msg = $htmlspecialchars($_POST['msg']);
    $email = $_POST['email'];
    $add_date = date("Y-m-d H:i:s");
    $subject = $_POST['subject'];
    $sql = "INSERT INTO contacts(`email`, `msg`, `add_date`, `subject`) 
        VALUES ('$email', '$msg', '$add_date', '$subject')";
    if ($result = mysqli_query($dbc, $sql)) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo -1;
}
