<?php
include './preload.php';

$cid = $_POST['CID'];
$sql = "DELETE FROM comments WHERE CID = '$cid'";
if ($result = mysqli_query($dbc, $sql)) {
    echo 1;
} else {
    echo 0;
}
