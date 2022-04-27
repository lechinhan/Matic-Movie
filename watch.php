<?php
// include './partials/mysqli_connect.php';
include './partials/header.php';
if (!session_id()) {
    session_start();
}

date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
<link rel="stylesheet" href="./CSS/watch.css">

<div class="container-fluid container__main" style="margin-top: 60px;">
    <div id="main" class="bg-lighter-dark mx-2">

        <?php
        if (isset($_POST['FID'])) {
            $_SESSION['FID'] = $_POST['FID'];
        } else {
            $_SESSION['FID'] = 1;
        }
        echo '<input type="hidden" value="' . $_SESSION['FID'] . '" id="ses_FID"> ';
        if (isset($_SESSION['isLogged'])) {
            echo '<input type="hidden" value="' . $_SESSION['s_email'] . '" id="ses_email"> ';
            echo '<input type="hidden" value="' . $_SESSION['isLogged'] . '" id="ses_issLogged"> ';
            if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
                // echo '<h2 class="text-light">' . $_SESSION['s_name'] . '</h2>';
                // echo '<h2 class="text-light">' . $_SESSION['s_email'] . '</h2>';
                // echo '<h2 class="text-light">' . 'You\'re logged in via: ' . $_SESSION['log_method'] . '</h2>';

            }
        }

        // <span class="input-group-text bd-radius-right" style="border-radius: 0 .4rem .4rem 0">as&nbsp <strong>' . $_SESSION['s_firstName'] . '</strong></span>
        // <input type="text" class="form-control" name="msg" id="cmt_msg" placeholder="Write a comment" aria-label="Comment" aria-describedby="basic-addon1" autocomplete="off" required>

        //Usage :
        #floor($difference / 60);
        // echo "<h2>Time Passed: " . $years . " Years, " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</h2>";
        ?>

        <hr>

        <div class="row text-light" id="watch_box">
        </div>
        <div class="row justify-content-around">
            <div class="col-5 ms-3" id="comments">
                <div class="row cmt__title">
                    <p class="mb-2"> Comments</p>
                </div>
                <div class="" id="cmt_section">
                </div>
                <div class="row" id="cmt__post">
                    <?php
                    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
                        $email = $_SESSION['s_email'];
                        echo '<form id="post_cmt" method="post" action="#">
                        <div class="input-group mt-2 flex-nowrap" id="cmt_row">
                        <input type="hidden" id="email" value="' . $_SESSION['s_email'] . '">
                            <input type="hidden" id="cmt_date" value="' . date("Y-m-d H:i:s")  . '">
                            <input type="hidden" id="FID" value="' . $_SESSION['FID']  . '">
                    ';
                        if ($selectInfo = mysqli_query($dbc, "SELECT avatar FROM userinfo WHERE email='$email'")) {
                            if ($info__user = mysqli_fetch_array($selectInfo)) {
                                echo ' <img src="' . $info__user['avatar'] . '" width="40" height="40" class="cmt__avatar" atl="..." title="Comment avatar"> ';
                            }
                        }
                        echo '<textarea class="form-control" name="msg" id="cmt_msg" placeholder="Write a comment"></textarea>
                        <button type="submit" class="btn d-none" id="btn_post_cmt">Comment</button>
                        </div>
                        </form>';
                    }
                    ?>

                </div>
            </div>
            <div id="rec_section" class="col-xl-4 col-12 h-100 pt-2 mb-xl-0 mb-3" style="background-image: linear-gradient(180deg,rgba(47, 52, 65, 1),rgba(47, 52, 65, 0.7),rgba(30, 33, 41, 0.8),rgba(30, 33, 41, 0.9),rgba(30, 33, 41, 1));">
                <div class="row cmt__title">
                    <p class="mb-2 "> Trending Films</p>
                </div>
                <div class="row">
                    <?php
                    $query2 = "SELECT * FROM `moviedetail` WHERE typeof='trending' ORDER BY rand() LIMIT 5";
                    if ($result = mysqli_query($dbc, $query2)) {
                        while ($other__array = mysqli_fetch_array($result)) {
                            $htmlspecialchars = 'htmlspecialchars';
                            echo '<div class="col-xl-12 col-sm-4 col-12">
                                    <div class="row mb-xl-2 rec__films">
                                        <div class="mb-2 mb-md-0 other__poster col-xl-3 col-md-4 col-sm-12 col-4 h-25">
                                            <img class="w-100 h-100" src="' . $htmlspecialchars($other__array["poster"]) . '" alt="">
                                        </div>
                                        <div class="other__film__detail text-lightgrey col-xl-9 px-0 col-md-8 col-sm-12 col-8 my-md-auto fs-8">
                                            <div class="other__film__rate w-100 row mb-1 align-items-center">
                                                <div class="col-1 d-flex align-items-center">  
                                                    <i class="fas fa-star" style="color: yellow;"></i>
                                                    <span class="other__rate__point ps-1">
                                                        ' . $other__array["rating"] . '
                                                    </span>
                                                </div>    
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
        </div>
    </div>

    <div class="row" id="film_suggestion" style="position: absolute;"></div>

    <div class="modal fade " id="delete_cmt_confirm" tabindex="-1" aria-labelledby="delete_cmt_confirm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal_gray_blur">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete this comment?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this comment ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="del_confirmed" class="btn btn-primary" data-bs-dismiss="modal">Delete Comment</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
// if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
?>
<script src="./JS/watch.js"></script>

<?php
include './partials/footer.php';
?>