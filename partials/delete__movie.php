<?php
include './preload.php';

$FID = $_POST['delid'];
$background = $_POST['delete__movie__background'];
$poster = $_POST['delete__movie__poster'];
$link = $_POST['delete__movie__link'];

if (mysqli_query($dbc, "DELETE FROM moviedetail WHERE FID='$FID'")) {
    unlink(".$background");
    unlink(".$poster");
    unlink(".$link");
} else {
    echo mysqli_error($dbc);
}
