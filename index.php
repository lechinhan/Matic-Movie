<?php

include './partials/header.php';

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
    if (isset($_SESSION['is_1st_view']) &&  $_SESSION['is_1st_view'] == 'yes') {
        echo '
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
            <div id="toast_logIn" class="toast" role="alert" aria-live="assertive" aria-atomic="true" >
                <div class="toast-header bg-success text-light">
                    <strong class="me-auto">Welcome back, ' . $_SESSION['s_name'] . '!</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    We are glad to welcome you back. <br>
                    You have logged in via your ' . $_SESSION['log_method'] . ' Account
                </div>
            </div>
        </div>';
        $_SESSION['is_1st_view'] = 'no';
    }
} ?>
<div class="container-fluid over__container">
    <div id="main" class="bg-lighter-dark mx-2">
        <div class="row">
        </div>
        <div id="intro" class="row h-100">

            <div id="slider__carousel" class="carousel slide col-xl-7 col-12 mb-3 mb-xl-0" data-bs-ride="carousel">
                <div class="carousel-inner ">
                    <?php
                    $query = "SELECT * FROM `moviedetail` WHERE typeof='slider' AND FID=1";
                    if ($result = mysqli_query($dbc, $query)) {

                        if ($slider_1 = mysqli_fetch_array($result)) {

                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="carousel-item active position-relative">
                                    <div class="film__background opacity-75">
                                        <img src="' . $htmlspecialchars($slider_1["background"]) . '" class="d-block w-100" alt="..." style="aspect-ratio: 9 / 5.1;">
                                    </div>
                                    <div class="position-absolute w-100 h-auto d-flex" style="background-image: linear-gradient(360deg,rgba(30, 33, 41, 1),rgba(30, 33, 41, 0.99),rgba(30, 33, 41, 0.98),rgba(30, 33, 41, 0.95),rgba(30, 33, 41, 0.90),rgba(30, 33, 41, 0.75),rgba(30, 33, 41, 0.7),rgba(30, 33, 41, 0.65), transparent); bottom: 0; left: 0; right: 0;">
                                        <div class="film__poster d-none d-sm-block mx-3 my-auto" style="width: 18%; height: 27%;">
                                            <img class="w-100 h-100" src="' . $htmlspecialchars($slider_1["poster"]) . '" alt="" style="box-shadow: 2px 2px 8px 2px #1E2129; aspect-ratio: 2 / 3;">
                                        </div>
                                        <div class="film__detail text-white my-auto mx-sm-0" style="width: 80%; height: auto;">
                                            <div>
                                                <h3 class="film__name">
                                                    ' . $slider_1["movie__name"] . '
                                                </h3>
                                            </div>
                                            <div class="film__rate mb-2">
                                                <i class="fas fa-star" style="color: yellow;"></i>
                                                <span class="rate__point p-1">
                                                ' . $htmlspecialchars($slider_1["rating"]) . '
                                                </span>
                                                <span class="film__quality fw-bold m-3">
                                                ' . $slider_1["quality"] . '
                                                </span>
                                                <span class="film__duration">
                                                    <i class="fas fa-clock"></i>
                                                    ' . $slider_1["duration"] . ' min
                                                </span>
                                            </div>
                                            <div class="film__genre mb-2">
                                                <span>
                                                    <span class="fw-bold">Genre: </span>' . $slider_1["genre"] . '
                                                </span>
                                            </div>
                                            <div class="film__detail mb-2 d-md-block d-none">
                                                <span>
                                                    <span class="fw-bold">Release: </span>
                                                <span class="release__time">' . $slider_1["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class="film__casts mb-3 d-md-block d-none">
                                                <span class="d-block" style=" white-space: nowrap; width: 90%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">
                                                        Casts:
                                                    </span>' . $slider_1["casts"] . '
                                                </span>
                                            </div>
                                            <div class="film__button">
                                                <form action="./watch.php" method="post">
                                                    <input type="hidden" name="FID" value="' . $slider_1["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $query . '</p>';
                    }

                    ?>

                    <?php
                    $query1 = "SELECT * FROM `moviedetail` WHERE typeof='slider' AND FID!=1";
                    if ($result = mysqli_query($dbc, $query1)) {

                        while ($slider__array = mysqli_fetch_array($result)) {

                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="carousel-item position-relative">
                                    <div class="film__background opacity-75">
                                        <img src="' . $htmlspecialchars($slider__array["background"]) . '" class="d-block w-100" alt="..." style="aspect-ratio: 9 / 5.1;">
                                    </div>
                                    <div class="position-absolute w-100 h-auto d-flex" style="background-image: linear-gradient(360deg, rgba(30, 33, 41, 1),rgba(30, 33, 41, 0.95),rgba(30, 33, 41, 0.9),rgba(30, 33, 41, 0.85),rgba(30, 33, 41, 0.8),rgba(30, 33, 41, 0.75),rgba(30, 33, 41, 0.7),rgba(30, 33, 41, 0.65), transparent); bottom: 0; left: 0; right: 0;">
                                        <div class="film__poster d-none d-sm-block mx-3 my-auto" style="width: 18%; height: 27%;">
                                            <img class="w-100 h-100" src="' . $htmlspecialchars($slider__array["poster"]) . '" alt="" style="box-shadow: 2px 2px 8px 2px #1E2129; aspect-ratio: 2 / 3;">
                                        </div>
                                        <div class="film__detail text-white my-auto mx-sm-0" style="width: 80%; height: auto;">
                                            <div class="film__name">
                                                <h3>
                                                    ' . $slider__array["movie__name"] . '
                                                </h3>
                                            </div>
                                            <div class="film__rate mb-2">
                                                <i class="fas fa-star" style="color: yellow;"></i>
                                                <span class="rate__point p-1">
                                                    ' . $slider__array["rating"] . '
                                                </span>
                                                <span class="film__quality fw-bold m-3">
                                                    ' . $slider__array["quality"] . '
                                                </span>
                                                <span class="film__duration">
                                                    <i class="fas fa-clock"></i>
                                                    ' . $slider__array["duration"] . ' min
                                                </span>
                                            </div>
                                            <div class="film__genre mb-2">
                                                <span>
                                                    <span class="fw-bold">Genre: </span>' . $slider__array["genre"] . '
                                                </span>
                                            </div>
                                            <div class="film__detail mb-2 d-md-block d-none">
                                                <span>
                                                    <span class="fw-bold">Release: </span>
                                                <span class="release__time">' . $slider__array["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class="film__casts mb-3 d-md-block d-none">
                                                <span class="d-block " style=" white-space: nowrap; width: 90%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">
                                                        Casts:
                                                    </span>' . $slider__array["casts"] . '
                                                </span>
                                            </div>
                                            <div class="film__button">
                                                <form action="./watch.php" method="post">
                                                    <input type="hidden" name="FID" value="' . $slider__array["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                                <!-- <div class="addp__favorite__button btn btn-orange" style="border-radius: 50px;">
                                                    <i class="fas fa-plus-circle p-1"></i>Add to favorite
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $query1 . '</p>';
                    }

                    ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slider__carousel" data-bs-slide="prev">
                        <span aria-hidden="true">
                            <i class="fs-4 fas fa-angle-double-left"></i>
                        </span>
                    </button>


                    <button class="carousel-control-next" type="button" data-bs-target="#slider__carousel" data-bs-slide="next">
                        <span aria-hidden="true">
                            <i class="fs-4 fas fa-angle-double-right"></i>
                        </span>
                    </button>
                </div>
            </div>
            <div id="other__discover" class="col-xl-4 col-12 h-100 pt-2 mb-xl-0 mb-3" style="background-image: linear-gradient(180deg,rgba(47, 52, 65, 1),rgba(47, 52, 65, 0.7),rgba(30, 33, 41, 0.8),rgba(30, 33, 41, 0.9),rgba(30, 33, 41, 1));">
                <div class="row">
                    <?php
                    $query2 = "SELECT * FROM `moviedetail` WHERE typeof='other'";
                    if ($result = mysqli_query($dbc, $query2)) {

                        while ($other__array = mysqli_fetch_array($result)) {

                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="col-xl-12 col-sm-4 col-12">
                                    <div class="row mb-xl-2">
                                        <div class="mb-2 mb-md-0 other__poster col-xl-3 col-md-4 col-sm-12 col-4 h-25">
                                            <img class="w-100 h-100" src="' . $htmlspecialchars($other__array["poster"]) . '" alt="">
                                        </div>
                                        <div class="other__film__detail text-lightgrey col-xl-9 px-0 col-md-8 col-sm-12 col-8 my-md-auto fs-8">
                                            <div class="other__film__rate w-100 row mb-1 align-items-center ">
                                                <i class="fas fa-star col-1" style="color: yellow;"></i>
                                                <span class="other__rate__point col-1">
                                                        ' . $other__array["rating"] . '
                                                    </span>
                                                <span class="col-2 other__film__quality fw-bold col-xl-5 text-center">
                                                        ' . $other__array["quality"] . '
                                                    </span>
                                                <span class="other__film__duration col-xl-5 col-md-6 col-7">
                                                        <i class="fas fa-clock"></i>
                                                        ' . $other__array["duration"] . ' min
                                                    </span>
                                            </div>
                                            <div class="other__film__name w-100 row text-white">
                                                <h6 class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    ' . $other__array["movie__name"] . '
                                                </h6>
                                            </div>
                                            <div class="other__film__genre w-100 row mb-2">
                                                <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">Genre: </span>' . $other__array["genre"] . '
                                                </span>
                                            </div>
                                            <div class="other__film__release w-100 row d-block mb-2 d-md-none">
                                                <span>
                                                        <span class="fw-bold">Release: </span>
                                                <span class="other__release__time">' . $other__array["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class="other__film__casts w-100 d-md-block d-block d-sm-none row mb-2">
                                                <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">
                                                            Casts:
                                                        </span>' . $other__array["casts"] . '
                                                </span>
                                            </div>
                                            <div class="other__film__button w-100 row">
                                                <form action="./watch.php" method="post">
                                                    <input type="hidden" name="FID" value="' . $other__array["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="other__play__button w-50 col-12 btn btn-orange fs-8" style="border-radius: 50px;margin-left: 12px; padding: 4px 2px;">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $query2 . '</p>';
                    }
                    ?>
                </div>
            </div>

            <div id="social__sharing" class="col-xl-1 col-12 h-100" style=" background-clip: content-box; background-image: linear-gradient(rgba(38, 42, 53, 1),rgba(38, 42, 53, 0.7),rgba(30, 33, 41, 1)); ">
                <div class="row text-lightgrey text-center mt-3 ">
                    <div class="social__head col-12 fw-light fs-7 ">Share with</div>
                    <div class="social__body col-12 ">
                        <div class="row justify-content-center ">
                            <div class="col-xl-12 col-1 social__icon my-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" target="blank" class="fa-stack fa-lg ">
                                    <i class="fa fa-circle fa-stack-2x " style="color: #3B5998; "></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse "></i>
                                </a>
                            </div>
                            <div class="col-xl-12 col-1 social__icon my-3">
                                <a href="https://twitter.com/share?text=<?php echo 'Share your feellings' ?>&url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="fa-stack fa-lg ">
                                    <i class="fa fa-circle fa-stack-2x " style="color: #00ACEE; "></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse "></i>
                                </a>
                            </div>
                            <div class="col-xl-12 col-1 social__icon my-3">
                                <a href="https://t.me/share?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="fa-stack fa-lg ">
                                    <i class="fa fa-circle fa-stack-2x " style="color: #0088CC; "></i>
                                    <i class="fas fa-paper-plane fa-stack-1x fa-inverse "></i>
                                </a>
                            </div>
                            <div class="col-xl-12 col-1 social__icon my-3">
                                <a href="http://pinterest.com/pin/create/link/?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="fa-stack fa-lg ">
                                    <i class="fa fa-circle fa-stack-2x " style="color: #F0002A; "></i>
                                    <i class="fab fa-pinterest-p fa-stack-1x fa-inverse "></i>
                                </a>
                            </div>
                            <div class="col-xl-12 col-1 social__icon my-3">
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="fa-stack fa-lg ">
                                    <i class="fa fa-circle fa-stack-2x " style="color: #0E76A8; "></i>
                                    <i class="fa-brands fa-linkedin-in fa-stack-1x fa-inverse "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="row mt-5 pt-lg-4 text-lightgrey ">
            <div id="trending" class="trending col-12 mb-5">
                <div class="trending__header row mb-3">
                    <div class="trending__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,transparent, transparent, rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8)); "></div>
                    <h4 class="trending__title my-auto col-auto p-1 mx-auto">
                        TRENDING
                    </h4>
                    <div class="trending__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8),transparent, transparent ); "></div>
                </div>
                <div class="trending__body row ">
                    <?php
                    $trending__query = "SELECT * FROM `moviedetail` WHERE typeof='trending'";
                    if ($result = mysqli_query($dbc, $trending__query)) {

                        while ($trending__array = mysqli_fetch_array($result)) {

                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="trending__item mb-4 col-xl-2 col-md-3 col-sm-4 col-6 d-flex flex-column">
                                    <div class="row bg-dark-blue m-0">
                                        <img class="col-12 p-0 mb-2" src="' . $htmlspecialchars($trending__array["poster"]) . '" alt="" style="aspect-ratio: 2 / 3;">
                                        <div class="trending__film__detail text-lightgrey fs-8 col-12">
                                            <div class="row mb-1">
                                                <span class="trending__rate col-4">
                                                    <i class="fas fa-star rate__star" style="color: yellow;"></i>
                                                    <span class="trending__rate__point">
                                                        ' . $trending__array["rating"] . '
                                                    </span>
                                                </span>
                                                <span class="col-2 trending__film__quality fw-bold text-center">
                                                ' . $trending__array["quality"] . '
                                                </span>
                                                <span class=" col-6 d-block text-end">
                                                    <i class="fas fa-clock"></i>
                                                    <span class="trending__film__duration ">
                                                    ' . $trending__array["duration"] . ' min
                                                    </span>
                                                </span>
                                            </div>
                                            <div class=" row text-white mt-2 mb-3">
                                                <h6 class="d-block trending__film__name " style="white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                ' . $trending__array["movie__name"] . '
                                                </h6>
                                            </div>
                                            <div class="row mb-2 d-none">
                                                <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">Genre: </span>
                                                <span class="trending__film__genre">
                                                ' . $trending__array["genre"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class=" row mb-2 d-none">
                                                <span>
                                                    <span class="fw-bold">Release: </span>
                                                <span class="trending__film__release__time">' . $trending__array["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class=" d-none row mb-2">
                                                <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">
                                                        Casts:
                                                    </span>
                                                <span class="trending__film__casts">
                                                    ' . $trending__array["casts"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="trending__film__button row my-2 justify-content-center">
                                                <form action="./watch.php" method="post" class="text-center">
                                                    <input type="hidden" name="FID" value="' . $trending__array["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="trending__play__button col-11 btn btn-orange fs-8" style="border-radius: 4px;">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $trending__query . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div id="latest" class="latest col-12 mb-5">
                <div class="latest__header row mb-3">
                    <div class="trending__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,transparent, transparent, rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8)); "></div>
                    <h4 class="latest__title my-auto col-auto p-1 mx-auto">
                        LATEST MOVIES
                    </h4>
                    <div class="latest__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8),transparent, transparent ); "></div>
                </div>
                <div class="latest__body row ">
                    <?php
                    $latest__query = "SELECT * FROM `moviedetail` WHERE typeof='latest'";
                    if ($result = mysqli_query($dbc, $latest__query)) {
                        while ($latest__array = mysqli_fetch_array($result)) {
                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="latest__item mb-4 col-xl-2 col-md-3 col-sm-4 col-6 d-flex flex-column">
                                    <div class="row bg-dark-blue m-0">
                                        <img class="col-12 p-0 mb-2" src="' . $htmlspecialchars($latest__array["poster"]) . '" alt="" style="aspect-ratio: 2 / 3;">
                                        <div class="latest__film__detail text-lightgrey fs-8 col-12">
                                            <div class="row mb-1">
                                                <span class="latest__rate col-4">
                                                    <i class="fas fa-star rate__star" style="color: yellow;"></i>
                                                    <span class="latest__rate__point">
                                                        ' . $latest__array["rating"] . '
                                                    </span>
        
                                                </span>
                                                <span class="col-2 latest__film__quality fw-bold text-center">
                                                        ' . $latest__array["quality"] . '
                                                </span>
                                                <span class=" col-6 d-block text-end">
                                                    <i class="fas fa-clock"></i>
                                                    <span class="latest__film__duration ">
                                                        ' . $latest__array["duration"] . ' min
                                                    </span>
                                                </span>
                                            </div>
                                            <div class=" row text-white mt-2 mb-3">
                                                <h6 class="d-block latest__film__name " style="white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    ' . $latest__array["movie__name"] . '
                                                </h6>
                                            </div>
                                            <div class="row mb-2 d-none">
                                                <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">Genre: </span>
                                                <span class="latest__film__genre">
                                                        ' . $latest__array["genre"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class=" row mb-2 d-none">
                                                <span>
                                                    <span class="fw-bold">Release: </span>
                                                <span class="latest__film__release__time">' . $latest__array["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class=" d-none row mb-2">
                                                <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">
                                                        Casts:
                                                    </span>
                                                <span class="latest__film__casts">
                                                    ' . $latest__array["casts"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="latest__film__button row my-2 justify-content-center">
                                                <form action="./watch.php" method="post" class="text-center">
                                                    <input type="hidden" name="FID" value="' . $latest__array["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="latest__play__button col-11 btn btn-orange fs-8" style="border-radius: 4px; ">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $latest__query . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div id="upcoming" class="upcoming col-12 ">
                <div class="upcoming__header row mb-3">
                    <div class="trending__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,transparent, transparent, rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8)); "></div>
                    <h4 class="upcoming__title my-auto col-auto p-1 mx-auto">
                        COMING SOON
                    </h4>
                    <div class="upcoming__line my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8),transparent, transparent ); "></div>
                </div>
                <div class="upcoming__body row ">
                    <?php
                    $upcoming__query = "SELECT * FROM `moviedetail` WHERE typeof='upcoming'";
                    if ($result = mysqli_query($dbc, $upcoming__query)) {
                        while ($upcoming__array = mysqli_fetch_array($result)) {
                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="upcoming__item mb-4 col-xl-2 col-md-3 col-sm-4 col-6 d-flex flex-column">
                                    <div class="row bg-dark-blue m-0">
                                        <img class="col-12 p-0 mb-2" src="' . $htmlspecialchars($upcoming__array["poster"]) . '" alt="" style="aspect-ratio: 2 / 3;">
                                        <div class="upcoming__film__detail text-lightgrey fs-8 col-12">
                                            <div class="row mb-1 upcoming__status">
                                                <span>
                                                    Updating...
                                                </span>
                                            </div>
                                            <div class=" row text-white mt-2 mb-3">
                                                <h6 class="d-block upcoming__film__name " style="white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    ' . $upcoming__array["movie__name"] . '
                                                </h6>
                                            </div>
                                            <div class="row mb-2 d-none">
                                                <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">Genre: </span>
                                                    <span class="upcoming__film__genre">
                                                        ' . $upcoming__array["genre"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class=" row mb-2 d-none">
                                                <span>
                                                    <span class="fw-bold">Release: </span>
                                                <span class="upcoming__film__release__time">' . $upcoming__array["release__time"] . '</span>
                                                </span>
                                            </div>
                                            <div class=" d-none row mb-2">
                                                <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    <span class="fw-bold">
                                                        Casts:
                                                    </span>
                                                <span class="upcoming__film__casts">
                                                        ' . $upcoming__array["casts"] . '
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="upcoming__film__button row my-2 justify-content-center">
                                                <form action="./watch.php" method="post" class="text-center">
                                                    <input type="hidden" name="FID" value="' . $upcoming__array["FID"] . '" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                    <button type="submit" class="upcoming__play__button disabled col-11 btn btn-orange fs-8" style="border-radius: 4px; ">
                                                        <i class="fas fa-play-circle p-1"></i>Watch now
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                            '.</p><p>Câu truy vấn là: ' . $upcoming__query . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        if ($("#toast_logIn").length > 0) {
            var logIn_toast = new bootstrap.Toast($("#toast_logIn"));
            logIn_toast.show();
        }
    })
</script>
<?php
include './partials/footer.php';
?>