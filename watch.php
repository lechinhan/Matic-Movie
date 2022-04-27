<?php
// include './partials/mysqli_connect.php';
include './partials/header.php';
echo '    <link rel="stylesheet" href="./CSS/watch.css">';
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
        if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
            echo '<input type="hidden" value="' . $_SESSION['s_email'] . '" id="ses_email"> ';
            echo '<input type="hidden" value="' . $_SESSION['isLogged'] . '" id="ses_issLogged"> ';
            // echo '<h2>' . $_SESSION['s_name'] . ' ' . $_SESSION['s_email'] . '</h2>';
        }

        // <span class="input-group-text bd-radius-right" style="border-radius: 0 .4rem .4rem 0">as&nbsp <strong>' . $_SESSION['s_firstName'] . '</strong></span>
        // <input type="text" class="form-control" name="msg" id="cmt_msg" placeholder="Write a comment" aria-label="Comment" aria-describedby="basic-addon1" autocomplete="off" required>

        //Usage :
        #floor($difference / 60);
        // echo "<h2>Time Passed: " . $years . " Years, " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</h2>";
        echo '<input type="hidden" value="' . $_SESSION['FID'] . '" id="ses_FID"> ';
        ?>

        <hr>
        <div class="row text-light" id="watch_box">
        </div>

        <div class="row" id="comments">
            <div class="col-8 cmt__title">
                <p class="mb-2"> Comments</p>
            </div>
            <div class="col-9" id="cmt_section">
            </div>
            <div class="col-9 ms-1" id="cmt__post">
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
<script>

</script>
<?php
include './partials/footer.php';
?>