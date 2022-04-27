<?php
include './partials/header.php';

$email = $_SESSION['s_email'];
if ($queryResult = mysqli_query($dbc, "SELECT * FROM userinfo WHERE  email='$email' ")) {
    if ($info = mysqli_fetch_array($queryResult))
        echo '
        <div class="container-fluid over__container text-lightgrey" >
            <div class="row justify-content-center py-3">
                <div class="col-xl-5 col-md-5 col-4 user__last__name text-end my-auto">
                    <h5 class="w-100">
                        ' . $info["firstName"] . '
                    </h5>
                </div>
                <div class="col-xl-1 col-md-2 col-4 position-relative text-center ">
                    <img class="w-100 h-100 rounded-circle" src="';
    if (file_exists($info["avatar"])) {
        echo $info["avatar"];
    } else {
        echo './images/User/DefaultUser.png';
    }
    echo '" alt="" style="aspect-ratio: 1; box-shadow: 0px 0px 8px 4px #FFD154; border: 2px solid #FFD154;">
                    <form id="upload__avatar__form" method="POST" class="position-absolute border-none bg-lighter-blue rounded-circle" style="bottom: -0.8rem; left: 0; right: 0; margin-left: auto; margin-right: auto; width: 26px;">
                        <i id="upload__avatar__icon" class="fas fa-camera"></i>
                        <input id="input__avatar__file" type="file" accept="image/*" name="input__avatar__file" class="d-none">
                        <input id="old__avatar" type="hidden" name="old__avatar" value="' . $info["avatar"] . '">
                    </form>
                </div>
                <div class="col-xl-5 col-md-5 col-4 user__firts__name my-auto" >
                    <h5 class="w-100">
                        ' . $info["surName"] . '
                    </h5>
                </div>
            </div>    
            <hr class="m-1">
            <div class="row m-0">
                <div class="col-12">
                    <ul class="profile-nav row justify-content-evenly nav nav-tabs border-none row my-auto " id="myTab" role="tablist">
                        <li class="nav-item position-relative px-0 col-6 text-center" role="presentation">
                            <a class="fs-5 fw-bold profile__nav__item nav-link active text-lightgrey" id="account-tab" data-bs-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account</a>
                        </li>
                        <li class="nav-item position-relative px-0 col-6 text-center" role="presentation">
                            <a class="fs-5 fw-bold profile__nav__item nav-link text-lightgrey" id="Mymovies-tab" data-bs-toggle="tab" href="#Mymovies" role="tab" aria-controls="Mymovies" aria-selected="false">My movies</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row m-0">
                <div class="tab-content col-12 text-white">
                    <div class="tab-pane row slide bg-dark-blue border show active" id="account" role="tabpanel" aria-labelledby="account-tab" style="border-top: none !important; ">
                        <div class="col-12 pt-4 mb-3">
                            <div class="row mx-auto align-items-center align-items-center">
                                <input id="email" type="hidden" value="' . $_SESSION["s_email"] . '">
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    First name:
                                </div>
                                <input id="firstName__input" type="text" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1" value="' . $info["firstName"] . '">
                                <div class="col-1" >
                                    <button id="firstName__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    Last name:
                                </div>
                                <input id="surName__input" type="text" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1" value="' . $info["surName"] . '">
                                <div class="col-1" >
                                    <button id="surName__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-4 mb-3">
                            <div class="row mx-auto align-items-center">
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    D.o.B:
                                </div>
                                <input id="date__input" type="date" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1" value="' . $info["birthDay"] . '">
                                <div class="col-1" >
                                    <button id="date__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    Gender:
                                </div>
                                <select id="gender__input" name="cars" id="cars" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1">
                                    <option selected value="M">';
    if ($info["gender"] = "M") {
        echo 'Male';
    } elseif ($info["gender"] = "F") {
        echo 'Female';
    } else {
        echo 'Other';
    };
    echo '</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                                </select>
                                <div class="col-1" >
                                    <button id="gender__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-4 mb-3">
                            <div class="row mx-auto align-items-center">
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    Email:
                                </div>
                                <input id="email__input" type="email" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1" value="' . $info["email"] . '">
                                <div class="col-1" >
                                    <button id="email__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-xl-1 col-sm-2 col-3 p-1 text-end fw-bold">
                                    Password:
                                </div>
                                <div id="passWord__input" class="profile__input border border-lighgrey bg-dark-blue col-xl-4 col-sm-3 col-8 p-1">
                                    *********
                                </div>
                                <div class="col-1" >
                                    <button id="passWord__button" type="button" class="btn btn-orange border-none" style="style="margin-left: 1rem;">
                                        <i class="fas fa-exchange"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-4 my-4 mt-5">
                            <div class="row ">
                                <input type="hidden" value="">
                                <h6 class="text-lightgrey text-center">
                                    If you want to remove this account from our system, press the button below. Think carefully before making a decision.
                                </h6>
                                <button id="remove__account__button" type="button" class="btn btn-orange w-25 mx-auto mt-4">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane row slide bg-dark-blue border" id="Mymovies" role="tabpanel" aria-labelledby="Mymovies-tab" style="border-top: none !important; ">
                        <div class="col-12 pt-4 mb-3">
                            <table class="table text-white">
                                <thead>
                                    <tr>
                                    <th scope="col">Movie name</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Realease</th>
                                    <th scope="col" class="col-1 text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-fixed bottom-0 end-0 p-3">
                <div class="toast fade" id="profile__toast">
                    <div class="toast-header bg-success">
                        <strong class="me-auto text-white">Updated !!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body bg-lighter-blue" style="color: white;">
                        Your information has been updated.
                    </div>
                </div>
            </div>
            <div class="position-fixed bottom-0 end-0 p-3">
                <div class="toast fade" id="change__pass__toast">
                    <div class="toast-header bg-success">
                        <strong class="me-auto text-white">Changed !!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body bg-lighter-blue" style="color: white;">
                        Your password has been changed.
                    </div>
                </div>
            </div>
            <div class="position-fixed bottom-0 end-0 p-3">
                <div class="toast fade" id="change__pass__error__oldpass">
                    <div class="toast-header bg-danger">
                        <strong class="me-auto text-white">Error !!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body bg-lighter-blue" style="color: white;">
                        Current password is not correct !!
                    </div>
                </div>
            </div>
            <div class="position-fixed bottom-0 end-0 p-3">
                <div class="toast fade" id="change__pass__confirm__pass">
                    <div class="toast-header bg-danger">
                        <strong class="me-auto text-white">Error !!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body bg-lighter-blue" style="color: white;">
                        New password does not match !!
                    </div>
                </div>
            </div>
            <div class="modal fade" id="avatar__preview__modal" tabindex="-1" role="dialog" aria-labelledby="avatar__preview__modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-glass">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="avatarmodaltitle">Avatar Preview</h5>
                            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times text-white"></i>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <img width=220 height=220 id="image__modal__preview" class="rounded-circle" src="" alt="" style="aspect-ratio: 1;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Close</button>
                            <button id="confirm__upload__avatar" data-delid="' . $info["email"] . '" name="confirm__upload__avatar" data-bs-dismiss="modal" class="del__movie btn btn-orange" type="button">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="change__password__modal" tabindex="-1" role="dialog" aria-labelledby="change__password__modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-glass">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="repassmodaltitle">Change your password</h5>
                            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times text-white"></i>
                            </button>
                        </div>
                        <form id="change__pass_modal__form" method="POST" class="modal-body text-center mx-3">
                            <div class="row mb-2">
                                <label for="old__pass" class="col-12 text-start mb-2 fw-bold px-0">
                                    Current password:
                                </label>
                                <input id="old__pass" type="password" class="modal__pass__input bg-lighter-dark col-12 border border-lighgrey rounded-2 p-1" placeholder="Your current password">
                            </div>
                            <div class="row mb-2">
                                <label for="new__pass" class="col-12 text-start mb-2 fw-bold px-0">
                                    New password:
                                </label>
                                <input id="new__pass" type="password" class="modal__pass__input bg-lighter-dark col-12 border border-lighgrey rounded-2 p-1" placeholder="New password">
                            </div>
                            <div class="row mb-2">
                                <label for="confirm__new__pass" class="col-12 text-start mb-2 fw-bold px-0">
                                    Confirm new password:
                                </label>
                                <input id="confirm__new__pass" type="password" class="modal__pass__input bg-lighter-dark col-12 border border-lighgrey rounded-2 p-1" placeholder="Confirm new password">
                            </div>
                            <input id="realpass" type="hidden" value=""> 
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Close</button>
                            <button id="confirm__change__password" name="confirm__change__password" data-bs-dismiss="modal" class="del__movie btn btn-orange" type="button">Change</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="remove__account__modal" tabindex="-1" role="dialog" aria-labelledby="remove__account__modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-glass">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="repassmodaltitle">Remove account</h5>
                            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times text-white"></i>
                            </button>
                        </div>
                        <div class="modal-body text-center mx-3">
                            <h5 class="fw-bold">
                            Do you really want to remove this account?
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Close</button>
                            <button id="confirm__remove__account" name="confirm__remove__account" data-bs-dismiss="modal" class="btn btn-orange" type="button">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
} else {
    echo '
    <div class="container-fluid over__container text-lightgrey" >
        <h5 class="text-center">
            Cannot download your personal page, reload the page or try logging in again !!!
        </h5>
    </div>';
}
include './partials/footer.php';
