<?php
session_start();
function clean($string) {
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
}

include './preload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{    
    $movie__owner = $_SESSION['email'];
    $movie__name = $_POST['upload__movie__name'];
    $release__time = $_POST['upload__release__time'];
    $genre = $_POST['upload__genre'];
    $casts = $_POST['upload__casts'];
    $quality = $_POST['upload__quality'];
    $duration = $_POST['upload__duration'];
    $overview = $_POST['upload__overview'];
    $rating = $_POST['upload__rating'];

    if(isset($movie__name,$release__time,$genre,$casts,$quality,$duration,$overview) && $_FILES['upload__link']['error'] == 0 && $_FILES['upload__background']['error'] == 0 && $_FILES['upload__poster']['error'] == 0 ){
        $movie__dir = '../movies/';
        $background__dir = '../images/homepage/background/';
        $poster__dir = '../images/homepage/poster/';

        $private__name = explode("@", $movie__owner);

        $upload__movie = $movie__dir .  $private__name[0] . clean(basename($_FILES['upload__link']['name']));
        $upload__background = $background__dir .  $private__name[0] . clean(basename($_FILES['upload__background']['name']));
        $upload__poster = $poster__dir .  $private__name[0] . clean(basename($_FILES['upload__poster']['name']));

        move_uploaded_file($_FILES['upload__link']['tmp_name'], $upload__movie);
        move_uploaded_file($_FILES['upload__background']['tmp_name'], $upload__background);
        move_uploaded_file($_FILES['upload__poster']['tmp_name'], $upload__poster);

        $upload__movie__update = substr($upload__movie, 1);
        $upload__background__update = substr($upload__background,1);
        $upload__poster__update = substr($upload__poster, 1);

        $sql = "INSERT INTO moviedetail (movie__name,rating,quality,duration,release__time,genre,casts,background,poster,overview,link,typeof,movie__owner)
        VALUES ('$movie__name','$rating','$quality','$duration','$release__time','$genre','$casts','$upload__background__update','$upload__poster__update','$overview','$upload__movie__update','latest','$movie__owner')";
        if(mysqli_query($dbc, $sql)){
            echo 1;
        } else {
            echo 0;
        }
        mysqli_close($dbc);
    }
}else {
    echo 0;
}
