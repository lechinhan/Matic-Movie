<?php

// include './partials/mysqli_connect.php';
include './partials/header.php';
require './vendor/autoload.php';
include './logIn_API_config.php';
if (!session_id()) {
    session_start();
}

?>
<script>
    $(function() {
        var img = "<img src='./images/signIn/bg3.png' class='back_ground' alt='...'>"
        $("#header").before(img);
    })
</script>
<link rel="stylesheet" href="./CSS/signIn_Up.css">

<div class="container">
    <div id="main" style="position:relative">
        <!-- Dang nhap -->
        <div class="wrapper"></div>
        <form class="col-12" id="signInForm" method="POST" action="./signIn_Up.php">
            <div class="row" id="formName">
                <div class="col-12 pt-1">
                    <h2>Welcome Back !</h2>
                    <span>Sign in for a better experience</span>
                </div>
            </div>
            <hr style="margin-top:8px; margin-bottom:12px;">
            <div class="row ps-3">
                <div class="col-md-3">
                    <label for="email_logIn" class="form-label">Email</label>
                </div>
                <div class="col-md-9 pe-3">
                    <input type="email" id="email_logIn" name="email_logIn" onclick="dismiss_error('error_alert')" oninput="dismiss_error('error_alert')" class="form-control signIn_input" placeholder="email@example.com " required>
                </div>
            </div>
            <div class="row ps-3">
                <div class="col-md-3 pt-2">
                    <label for="password_logIn" class="form-label">Password</label>
                </div>
                <div class="col-md-9 pe-3 pt-2">
                    <input type="password" id="password_logIn" name="password_logIn" onclick="dismiss_error('error_alert')" oninput="dismiss_error('error_alert')" class="form-control signIn_input" placeholder="Ex@mple#pass1" required>
                </div>
            </div>
            <div class="row pt pt-2 remember">
                <span><input type="checkbox" name="remember" id="remember"> Remember Me</span>
            </div>

            <div class="row social" id="social">
                <span style="margin-bottom: 7px;"><strong>Or Sign in</strong></span>
                <a href="<?php echo $fb_loginUrl; ?>" class="col-5 social_links" style="margin-left: 20px">
                    <span>Via Facebook </span>
                    <img src="./images/signIn/facebook.png" alt="...">
                </a>
                <a href="<?php echo $gg_loginUrl; ?>" class="col-5 social_links" style="margin-right: 20px">
                    <span>Via Gooogle </span>
                    <img src="./images/signIn/google.png" alt="...">
                </a>
            </div>
            <div id="error_alert" class="row m-2" style="display: none;"></div>
            <div class="row mx-4 mt-2" style="display: none;" id="forgot_pass"> <a href="#">Forgot Password ?</a></div>

            <div class="row mt-3 mb-3 text-center justify-content-center" id="logIn_btn_wrap">
                <button type="button" class="btn signIn_btn" id="logIn_btn">Sign In</button>
            </div>
            <hr style="margin-bottom: 4px;">

            <div class="row text-center ">
                <p>You are not a member? Create account for free now!</p>
            </div>
            <div class="row text-center justify-content-center">
                <button type="button" class="btn signIn_btn" data-bs-toggle="modal" id="sign_request_btn" data-bs-target="#signUp_form">
                    Free Sign Up
                </button>
            </div>

        </form>

        <!-- Ket thuc dang nhap -->
        <!-- Dang ky tai khoan  -->



        <!-- Modal -->
        <div class="modal fade" id="signUp_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content signUpForm_modal">
                    <form class="container-fluid" id="signUpForm" name='signUpForm' method="post" action="#">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Sign Up</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-2">
                                <div class="col-6 d-flex align-items-center" style="padding-right:5px;">
                                    <input type="text" name="firstName" oninput="dismiss_error('name_error')" onclick="dismiss_error('name_error')" class="form-control" id="firstName" placeholder="First Name" required>
                                </div>
                                <div class="col-6 d-flex align-items-center" style="padding-left:5px">
                                    <input type="text" name="surName" oninput="dismiss_error('name_error')" onclick="dismiss_error('name_error')" class="form-control input-group" id="surName" placeholder="Last Name" required>
                                </div>
                                <div class="col-12 pt-2" id="name_error" style="display: none;">
                                    <div class="alert alert-danger" role="alert">
                                        Firstname and/or Surname must not include special characters.
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-12 d-flex align-items-center">
                                    <input type="email" name="email_dky" class="form-control" id="email_dky" oninput="dismiss_error('email_error')" onclick="dismiss_error('email_error')" placeholder="Email Address" required>
                                </div>
                                <div class="col-12 pt-2" id="email_error" style="display: none;">
                                    <div class="alert alert-danger" role="alert">
                                        This email looks like an invalid email.
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-6" style="padding-right:5px">
                                    <input type="password" name="password_dky" class="form-control" id="password_dky" oninput="dismiss_error('pwd_strg_error')" onclick="dismiss_error('pwd_strg_error')" placeholder="New password" required>
                                </div>

                                <div class="col-6" style="padding-left:5px">
                                    <input type="password" name="password2_dky" class="form-control" id="password2_dky" oninput="dismiss_error('pwd_match_error')" onclick="dismiss_error('pwd_match_error')" placeholder="Confirm password" required>
                                </div>
                                <div class="col-12 pt-2" id="pwd_strg_error" style="display: none;">
                                    <div class="alert alert-danger" role="alert">
                                        Your password must include 1 CAPITAL , 1 special character, 1 number and has at least 8 characters.
                                    </div>
                                </div>
                                <div class="col-12 pt-2" id="pwd_match_error" style="display: none;">
                                    <div class="alert alert-danger" role="alert">
                                        The confirm passwords you have entered did not match.
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <label for="" class="form-label">Date of Birth</label>
                                <div class="col-3 " style="padding-right:3px ">
                                    <select class="form-select" aria-label="Day" name="birthday_day" id="day" onclick="dismiss_error('bday_error')" title="Day" tabindex="0" required>
                                        <?php
                                        for ($i = 1; $i < 32; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-5 " style="padding: 0 3px ">
                                    <select class="form-select" aria-label="Month" name="birthday_month" id="month" onclick="dismiss_error('bday_error')" title="Month" tabindex="0">
                                        <option value="01">January</option>
                                        <option value="02" selected>February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-4" style="padding-left: 3px ">
                                    <select class="form-select" aria-label="Year" name="birthday_year" id="year" onclick="dismiss_error('bday_error')" title="Year" tabindex="0">
                                        <?php
                                        for ($i = 2022; $i > 1950; $i--) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 pt-2" id="bday_error" style="display: none;">
                                    <div class="alert alert-danger" role="alert">
                                        This is not a valid date
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-4 ">
                                    <label class="form-label">Gender</label>
                                </div>
                                <div class="col-8 ">
                                    <select class="form-select" aria-label="gender" name="gender" id="gender" title="Gender" tabindex="0 " required>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-12 ">
                                    <span id="policies">By clicking Sign Up, you agree to our <a href="# ">Terms</a>, <a href="# ">Data Policies</a> and <a href="# ">Cookies Policies</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" name="signUp_btn" onclick="return validate_form()" class="btn" id='signUp_btn'>Sign Up</button>
                        </div>
                        <?php
                        if (isset($_POST['signUp_btn'])) {
                            if (!empty($_POST['email_dky'])) {
                                $input_email = $_POST['email_dky'];
                                $isSetQuery = "SELECT * FROM `accounts` WHERE `email`='$input_email'";
                                $result = mysqli_query($dbc, $isSetQuery);
                                $row = mysqli_fetch_array($result);
                                if ($row) {
                        ?>
                                    <script>
                                        $(function() {
                                            $("#account_existed").modal("show");
                                        });
                                    </script>
                                    <?php
                                } else {
                                    $htmlspecialchars =  'htmlspecialchars';
                                    $email = $htmlspecialchars($_POST['email_dky']);
                                    $firstName = $htmlspecialchars($_POST['firstName']);
                                    $surName = $htmlspecialchars($_POST['surName']);
                                    $gender = $htmlspecialchars($_POST['gender']);
                                    $bDayString = "" . $_POST['birthday_year'] . "-" . $_POST['birthday_month'] . "-" . $_POST['birthday_day'];
                                    mysqli_begin_transaction($dbc);
                                    try {
                                        // Check if user informations have been added in advance
                                        $check_user_info = "SELECT * FROM `userinfo` WHERE `email`='$email'";
                                        $userinfo_res = mysqli_query($dbc, $check_user_info);

                                        // $user_infor = mysqli_fetch_array($userinfo_res);
                                        if (!mysqli_num_rows($userinfo_res)) {
                                            $query_userinfo = "INSERT INTO userinfo(`email`, `firstName`, `surName`, `birthDay`, `gender`) VALUES (?,?,?,?,?)";
                                            $stmt_userinfo = mysqli_prepare($dbc, $query_userinfo);

                                            mysqli_stmt_bind_param($stmt_userinfo, 'sssss', $email, $firstName, $surName, $bDayString, $gender);
                                            mysqli_stmt_execute($stmt_userinfo);
                                        }
                                        // Insert user to accounts table
                                        $query_account = "INSERT INTO accounts(`email`, `password`) VALUES (?,?) ";

                                        $stmt_account = mysqli_prepare($dbc, $query_account);

                                        $hashed_pass = password_hash($_POST['password_dky'], PASSWORD_DEFAULT);

                                        mysqli_stmt_bind_param($stmt_account, 'ss', $email, $hashed_pass);
                                        mysqli_stmt_execute($stmt_account);

                                        if (mysqli_stmt_affected_rows($stmt_account) == 1) {
                                            $_SESSION['isLogged'] = 1;
                                            $_SESSION['s_email'] = $email;
                                            $_SESSION['s_name'] = $firstName . ' ' . $surName;
                                            $_SESSION['s_firstName'] = $firstName;
                                            $_SESSION['log_method'] = 'Matic';
                                            $_SESSION['is_1st_view'] = 'yes';
                                            $_SESSION['s_permission'] = 'nor';

                                    ?>
                                            <script>
                                                $(function() {
                                                    $("#account_created").modal("show");
                                                    $("#account_created").on("hidden.bs.modal", function() {
                                                        window.location.href = './index.php';
                                                    })
                                                });
                                            </script>
                        <?php
                                        }
                                        mysqli_commit($dbc);
                                    } catch (mysqli_sql_exception $exception) {
                                        mysqli_rollback($dbc);
                                        throw $exception;
                                    }
                                }
                            }
                        }
                        ?>
                    </form>

                </div>
            </div>
        </div>

        <!-- Ket thua dang ky -->
        <div class="modal fade" id="account_existed" tabindex="-1" aria-labelledby="account_existed" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="account_existed_title">Opps, This account had been used</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This email is already connected to a Matic account. Do you want to <a href="#">Log In</a>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="account_created" tabindex="-1" aria-labelledby="account_created" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="account_created_title">Congratulations! </br> Your account has been successfully created.</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You are now a new member of Matic. Let's go to homepage and enjoy our endless movie lists now!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Go to homepage</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>


<script src='./JS/signUp.js'></script>
<script>
    $(function() {

        $('#year').val('2001').attr('selected', true);
        $('#day').val('27').attr('selected', true);
        $("#account_existed").on("hidden.bs.modal", function() {
            $("#email_logIn").focus();
        })
        // document.body.classList.remove("bg-lighter-dark");
        // document.body.classList.add("back_ground");

    });
</script>
<?php
include './partials/footer.php';
?>