var upload__avatar__icon = $('#upload__avatar__icon');
var input__avatar__file = $('#input__avatar__file');
var upload__avater_form = $('#upload__avater_form');
var tbody = $("#tbody");
var search__body = $('#search__body');
var runAll;


$(document).ready(function() {
    $("#search__input").keyup(function() {
        var text = $(this).val();
        if (text == '') {
            $("#search__input_result").html("");
        } else {
            $("#search__input_result").html("");
            $.ajax({
                url: "./partials/search.php",
                type: "post",
                data: {
                    data: text
                },
                success: function(return_data) {
                    $("#search__input_result").html(return_data);
                }
            })
        }
    });
    $(window).click(function() {
        $("#search__input_result").html("");
    });

    $('#search__input_result').click(function(event) {
        event.stopPropagation();
    });
    var header__height = $('#header').height();
    var main__height = $('.over__container').height();

    $('.over__container').css('margin-top', header__height + 18);
    $('.footer').css('margin-top', main__height);

    upload__avatar__icon.on('click', function() {
        input__avatar__file.trigger('click');
    });

    input__avatar__file.on('change', function() {
        upload__avater_form.submit();
    });

    // Get value of multiple select and set to the input tag below
    $('#multiple__genre').on('change', function() {
        var selected = $(this).find("option:selected");
        var arrSelected = [];
        selected.each(function() {
            arrSelected.push($(this).val());
        });
        $('#upload__genre').val(arrSelected);
    });

    //  Load data
    function runAll() {
        $.ajax({
            url: "./partials/load__mymovies.php",
            method: "POST",
            data: null,
            success: function(data) {
                tbody.html(data);
            }
        });
    }
    runAll();

    //Upload movie

    $('#confirm__upload__movie').on("click", function() {
        var content = $("#firstName__input").val();
        edit__data(email__var, content, 'firstName');
    });

    $("form#upload__form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "./partials/uploader.php",
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data == 1) {
                    $("#upload__Toast").toast("show");
                    $("#upload__form")[0].reset();
                } else {
                    alert(data);
                    $("#upload__form")[0].reset();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    // Preview avatar
    $("#input__avatar__file").on("change", function(event) {
        $('#image__modal__preview').attr('src', URL.createObjectURL(event.target.files[0]));
        $("#avatar__preview__modal").modal("show");
    });

    $("#confirm__upload__avatar").on("click", function() {
        $("#upload__avatar__form").submit();
    });

    $("form#upload__avatar__form").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "./partials/upload__avatar.php",
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data == 1) {
                    location.reload();
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    var email__var = $("#email").val();


    // Remove account
    $("#remove__account__button").on("click", function() {
        $("#remove__account__modal").modal("show");
    });

    $('#confirm__remove__account').on("click", function() {
        var mail = email__var;
        $.ajax({
            url: "./partials/remove__account.php",
            method: "POST",
            data: {
                mail: mail
            },
            success: function(data) {
                if (data == 1) {
                    window.location.replace("http://localhost/movieweb/login.php");
                } else {
                    alert("Something went wrong !!");
                }
                runAll();
            }
        });
    });

    // Change pass
    $("#passWord__button").on("click", function() {
        $("#change__password__modal").modal("show");
    });

    $('#confirm__change__password').on("click", function() {
        var realpass = $("#realpass").val();
        var confirm_realpass = $("#old__pass").val();
        var new__pass = $("#new__pass").val();
        var confirm__new__pass = $("#confirm__new__pass").val();
        $.ajax({
            url: "./partials/change__password.php",
            method: "POST",
            data: {
                realpass: realpass,
                confirm_realpass: confirm_realpass,
                new__pass: new__pass,
                confirm__new__pass: confirm__new__pass,
                email: email__var
            },
            success: function(data) {
                if (data == 1) {
                    $("#change__pass__toast").toast("show");
                    $("#change__pass_modal__form")[0].reset();

                } else if (data == -1) {
                    $("#change__pass__confirm__pass").toast("show");
                    $("#passWord__button").trigger("click");

                } else if (data == -2) {
                    $("#change__pass__error__oldpass").toast("show");
                    $("#passWord__button").trigger("click");
                } else {
                    alert("Something went wrong !!");
                    $("#change__pass_modal__form")[0].reset();
                }
                runAll();
            }
        });
    });



    // Delete movie
    $(document).on('click', '.del__movie', function() {
        var delid = $(this).data('delid');
        var delete__movie__background = $("#delete__movie__background").val();
        var delete__movie__link = $("#delete__movie__link").val();
        var delete__movie__poster = $("#delete__movie__poster").val();
        $.ajax({
            url: "./partials/delete__movie.php",
            method: "POST",
            data: {
                delid: delid,
                delete__movie__background: delete__movie__background,
                delete__movie__link: delete__movie__link,
                delete__movie__poster: delete__movie__poster
            },
            success: function(data) {
                runAll();
            }
        });
    });

    // Edittttttttttttt profile
    function edit__data(email, content, col_name) {
        $.ajax({
            url: "./partials/edit_profile.php",
            method: "POST",
            data: {
                email: email,
                content: content,
                col_name: col_name
            },
            success: function(data) {
                if (data == 1) {
                    $("#profile__toast").toast("show");
                }
                runAll();
            }
        });
    }
    var email__var = $("#email").val();
    $('#firstName__button').on("click", function() {
        var content = $("#firstName__input").val();
        edit__data(email__var, content, 'firstName');
    });

    $('#surName__button').on("click", function() {
        var content = $("#surName__input").val();
        edit__data(email__var, content, 'surName');
    });

    $('#date__button').on("click", function() {
        var content = $("#date__input").val();
        edit__data(email__var, content, 'birthDay');
    });

    $('#gender__button').on("click", function() {
        var content = $("#gender__input").val();
        edit__data(email__var, content, 'gender');
    });

    $('#email__button').on("click", function() {
        var content = $("#email__input").val();
        edit__data(email__var, content, 'email');
    });

});