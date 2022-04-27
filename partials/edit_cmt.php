<?php
include './preload.php';


date_default_timezone_set('Asia/Ho_Chi_Minh');
$cid = $_POST['CID'];
$cmt_date = date("Y-m-d H:i:s");
$htmlspecialchars =  'htmlspecialchars';
$msg = $htmlspecialchars($_POST['msg']);
$sql = "UPDATE comments SET msg = '$msg', cmt_date= '$cmt_date' WHERE CID = '$cid'";
if ($result = mysqli_query($dbc, $sql)) {
    echo 1;
} else {
    echo 0;
}
