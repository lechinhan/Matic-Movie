var name_regEx = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
var pass_regEx = /^(?=.*[A-Z])(?=.*[!@#$&^*])(?=.*[0-9])(?=.*[a-z]).{8}/;


$(function() {
    validate_form = function() {
        var check = 1;
        var fname = document.forms["signUpForm"]["firstName"].value;
        var sname = document.forms["signUpForm"]["surName"].value;
        var email = document.forms["signUpForm"]["email_dky"].value;
        var pass = document.forms["signUpForm"]["password_dky"].value;
        var pass_confirm = document.forms["signUpForm"]["password2_dky"].value;
        var day = parseInt(document.forms["signUpForm"]["day"].value);
        var month = parseInt(document.forms["signUpForm"]["month"].value);
        var year = parseInt(document.forms["signUpForm"]["year"].value);
        if (!vad_name(fname) || fname == '') {
            $("#name_error").fadeIn();
            $("#firstName").focus();
            check = 0;
        }
        if (!vad_name(sname) || sname == '') {
            $("#name_error").fadeIn();
            $("#surName").focus();
            check = 0;
        }
        if (!vad_email(email)) {
            $("#email_error").fadeIn();
            $("#email_dky").focus();
            check = 0;
        }
        if (!pass_regEx.test(pass)) {
            $("#pwd_strg_error").fadeIn();
            $("#password_dky").focus();
            check = 0;
        }
        if (pass !== pass_confirm) {
            $("#pwd_match_error").fadeIn();
            $("#password2_dky").focus();
            check = 0;
        }
        if (!vad_b_day(day, month, year)) {
            $("#bday_error").fadeIn();
            $("#birthday_day").focus();
            check = 0;
        }
        if (check) {
            return true;
        } else {
            return false;
        }
    }

    vad_name = function(buffer) {
        return !name_regEx.test(buffer);
    }
    vad_email = function(email) {
        return (email).toLowerCase().match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };
    vad_b_day = function(d, m, y) {
        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        // Adjust for leap years
        if (y % 400 == 0 || (y % 100 != 0 && y % 4 == 0))
            monthLength[1] = 29;
        // Check the range of the day
        return d <= monthLength[m - 1];
    }

    dismiss_error = function(buffer) {
        elementId = "#" + buffer;
        $(elementId).fadeOut();
    }
    $("#logIn_btn").on("click", function(event) {
        call_signIn();
    });
    $("#password_logIn").on('keyup', function(e) {
        if (e.keyCode === 13 || e.key === 'Enter') {
            document.getElementById("logIn_btn").click();
        }
    });

    function call_signIn() {
        var email = $("#email_logIn").val();
        var password = $("#password_logIn").val();
        var remember = $('#remember').prop('checked') == true ? 1 : 0;
        if (email != '' && password != '') {
            $.ajax({
                url: "./partials/signIn.php",
                type: "POST",
                data: {
                    email: email,
                    password: password,
                    remember: remember
                },
                success: function(data) {
                    var output;
                    if (isNaN(data)) {
                        output = '<div class="alert alert-success mt-2" role="alert">' +
                            'Welcome back <strong>' + data + '</strong>. You will be redirected to homepage soon!' +
                            '</div>';
                        $("#error_alert").html(output);
                        $("#error_alert").fadeIn();
                        setTimeout(() => {
                            location.href = "./index.php";
                        }, 2500);
                    } else {
                        if (data == -1) {
                            output = '<div class="alert alert-danger" role="alert">The password that you\'ve entered is incorrect.</div>';
                            $("#forgot_pass").fadeIn();
                        } else {
                            output = '<div class="alert alert-danger mt-2" role="alert">' +
                                'The email address you entered isn\'t connected to an account.' +
                                '</div>';
                        }
                        $("#error_alert").html(output);
                        $("#error_alert").fadeIn();
                    }


                }
            });
        }
    }
});






// function vad_bDate(d, m, y) {
//     check = 1;
//     const maxDayofM = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
//     if (m == 2) {
//         if ((y % 4 == 0 && y % 100 != 0) || (y % 400 == 0)) {
//             check &= (d <= maxDayofM[d] + 1);
//             alert("yes" + check + maxDayofM[d]);
//         }
//     }
//     check &= d < maxDayofM[d];
//     return check;
// }