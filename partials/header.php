<?php
session_start();
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];
mysqli_report(MYSQLI_REPORT_OFF);
$dbc = @mysqli_connect($db_host, $db_user, '', $db_name);
if (isset($_COOKIE['c_email'])) {
    $email = $_COOKIE['c_email'];
    $user_info_query = mysqli_query($dbc, "SELECT `firstName`, `surName`, `permission` FROM userinfo WHERE `email`= '$email'");
    if ($user_info = mysqli_fetch_array($user_info_query)) {
        $name = $user_info['firstName'] . ' ' . $user_info['surName'];
        $_SESSION['isLogged'] = 1;
        $_SESSION['s_email'] = $email;
        $_SESSION['s_name'] = $name;
        $_SESSION['s_firstName'] = $user_info['firstName'];
        $_SESSION['log_method'] = 'Matic';
        $_SESSION['is_1st_view'] = 'yes';
        $_SESSION['s_permission'] = $user_info['permission'];
    }
}
// include './partials/mysqli_connect.php';
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matic - Phimmoi\'s Successor</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./CSS/common.css">
    <script src="./JS/jQuery.js"></script>
</head>


<body class="bg-lighter-dark">
    <div class="preloader" id="preloader">
        <div class="loader__inner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

<div id="header" class="bg-dark-blue fixed-top">
        <header class="p-1">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/movieweb/index.php" id="logo" class="col-xl-1 col-sm-2 col-2 nav-link fs-3 fw-bold text-lightgrey">
                    Matic
                </a>
                <div class="col-xl-1 col-md-2 col-3 browse__form text-center " style="height: 36px;">
                    <button class="btn btn-secondary bg-lighter-blue browse__button border-none text-lightgrey" style="font-size: 16px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="fas fa-bars p-1 browse__icon"></i>
                        Browse
                    </button>
                    <!-- Canvas Sidebar -->
                    <div class="offcanvas offcanvas-start text-start bg-lighter-dark" style="width: 20rem;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header" style="padding: 4px 16px;">
                            <button type="button" class="border-none btn text-lightgrey" data-bs-dismiss="offcanvas" aria-label="Close"> 
                                <i class="fas fa-arrow-alt-circle-left fs-3"></i>
                            </button>
                        </div>
                        <hr style="margin-top: 0;">
                        <div class="offcanvas-body ">
                            <div class="browse__latest">
                                <h5 class="fw-bold text-white">Browse latest</h5>
                                <div class="d-flex flex-column m-2">
                                    <div class="row discover text-white m-1">
                                        <a href="#" class="col-1 text-white">
                                            <i class="fas fa-compass"></i>
                                        </a>
                                        <h6 class="col-10 m-auto">
                                            <a href="#" class="text-decoration-none text-white"> Discover</a>
                                        </h6>
                                    </div>
                                    <div class="row trending text-white m-1">
                                        <a href="#trending" class="col-1 text-white">
                                            <i class="fa-solid fa-chart-column"></i>
                                        </a>
                                        <h6 class="col-10 m-auto">
                                            <a href="#trending" class="text-decoration-none text-white"> Trending</a>
                                        </h6>
                                    </div>
                                    <div class="row news text-white m-1">
                                        <a href="#latest" class="col-1 text-white">
                                            <i class="fa-solid fa-meteor"></i>
                                        </a>
                                        <h6 class="col-10 m-auto">
                                            <a href="#latest" class="text-decoration-none text-white"> New</a>
                                        </h6>
                                    </div>
                                    <div class="row upcoming text-white m-1">
                                        <a href="#upcoming" class="col-1 text-white">
                                            <i class="fa-solid fa-arrow-up-right-dots"></i>
                                        </a>
                                        <h6 class="col-10 m-auto">
                                            <a href="#upcoming" class="text-decoration-none text-white"> Upcoming</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="genre">
                                <h5 class="fw-bold text-white">Genre</h5>
                                <div class="genre__list p-0">
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Action">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Action                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Adventure">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Adventure                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Animation">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Animation                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Biography">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Biography                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Comedy">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Comedy                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Crime">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Crime                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Documentary">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Documentary                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Drama">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Drama                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Family">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Family                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Fantasy">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Fantasy                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="History">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            History                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Horror">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Horror                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Kids">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Kids                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Music">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Music                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Mystery">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Mystery                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="News">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            News                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Reality">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Reality                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Romance">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Romance                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="ScienceFiction">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Science Fiction                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Soap">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Soap                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Talk">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Talk                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="Thriller">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            Thriller                                            
                                        </button>
                                    </form>
                                    <form action="search__genre.php" method="POST" class="d-inline-block"> 
                                        <input type="hidden" name="genre" value="War">
                                        <button type="submit" class="genre__item nav-link border border-grey text-white d-inline-block fs-7 rounded-2 btn m-1 px-2 py-1" style="box-shadow: none !important;">
                                            War                                            
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search__form col-xl-8 col-6 col-md-6 bg-lighter-blue rounded-2 " >
                    <div class="row" style="positon: relative;" >
                        <div class="col-12">
                            <div class="d-flex">
                                    <label for="search__input" class="text-center d-block" style="width: 36px; height: 36px;">
                                        <i class="fas fa-search text-lightgrey" style="line-height: 2.25;"></i>
                                    </label>
                                    <form method="post" id="search_form" class="w-100 " style="margin-bottom: 0px !important;   ">
                                        <input name="search__input" id="search__input" type="text" class="form-control text-light bg-lighter-blue border-none" style="padding-left: 0;" autocomplete="off" placeholder="Search..." aria-label="Search">
                                    </form>
                            </div>
                        </div>
                        <div class="col-12" id="search__input_result" > 
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-1 text-end user__form">';
if (isset($_SESSION['isLogged'])) {
    if ($_SESSION['isLogged'] == 1) {
        $email = $_SESSION['s_email'];
        if ($selectInfo = mysqli_query($dbc, "SELECT * FROM userinfo WHERE email='$email'")) {
            if ($info__user = mysqli_fetch_array($selectInfo)) {
                echo '<div class="dropdown">
                                        <a class="btn dropdown__form border-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                                            <img src="' . $info__user["avatar"] . '" alt="avatar" width="32" height="32" class="rounded-circle">
                                        </a>

                                        <ul class="dropdown-menu bg-lighter-blue dropdown__list" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item text-lightgrey " href="./profile.php">Manage</a></li>
                                            <li><a class="dropdown-item text-lightgrey" href="./upload.php">Upload</a></li>
                                            <div class="dropdown-divider text-lightgrey"></div>
                                            <li><a class="dropdown-item text-lightgrey" href="./logout.php">Log out</a></li>
                                        </ul>
                                    </div>';
            }
        }
    }
} else {
    echo '<div>
                            <a class="m-md-3 text-decoration-none fw-bold text-lightgrey" href="./signIn_Up.php" style="margin-right: 6px;">
                                <i class="far fa-user p-1 my-auto"></i>
                                <p class="d-none d-md-inline-block my-auto">
                                    Login
                                </p>
                            </a>
                        </div>';
}
echo '</div>
            </div>
        </header>
    </div>';
