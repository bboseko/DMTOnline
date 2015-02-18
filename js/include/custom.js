$(function () {
    var loginForm, registerForm, profileForm;
    $.ajax({
        type: 'POST',
        url: 'php_includes/check_login_status.php',
        success: function (response) {
            if (response !== "") {
                $("#logInCommand").addClass('displayNone');
                $("#logOutCommand").removeClass('displayNone');
                $("#registerCommand").addClass('displayNone');
                $("#profileCommand").removeClass('displayNone');
            } else {
                $("#logOutCommand").addClass('displayNone');
                $("#logInCommand").removeClass('displayNone');
                $("#profileCommand").addClass('displayNone');
                $("#registerCommand").removeClass('displayNone');
            }
        }
    });
    $("#tabs").tabs();
    $("#accordion").accordion({
        heightStyle: "content",
        collapsible: true
    });
    $("#datepickerFrom, #datepickerTo").datepicker({
        showOn: "button",
        buttonImage: "css/images/calendar.gif",
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true
    });
    $("#sex").buttonset();
    $("#logInCommand").button({
        icons: {
            primary: "ui-icon-person"
        }
    });
    $("#logOutCommand").button({
        icons: {
            primary: "ui-icon-power"
        }
    });
    $("#profileCommand").button({
        icons: {
            primary: "ui-icon-person"
        }
    });
    $("#registerCommand").button({
        icons: {
            primary: "ui-icon-key"
        }
    });
    $("#registerCommand").button().on("click", function () {
        $('#registerFormBox').removeClass('displayNone');
        $('#loaderRegistration').addClass('displayNone');
        $("#signupform")[0].reset();
        registerForm = $("#register-form").dialog({
            autoOpen: false,
            height: 540,
            width: 400,
            modal: true,
            title: lang.registration,
            buttons: [
                {
                    text: lang.ok,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        var firstname = $('#firstname').val();
                        var familyname = $('#familyname').val();
                        var othername = $('#othername').val();
                        var sex = $('#sex').val();
                        var address = $('#address').val();
                        var phone = $('#phone').val();
                        var email = $('#email').val();
                        var nationality = $('#nationality').val();
                        var profession = $('#profession').val();
                        var institution = $('#institution').val();

                        var username = $('#usernameRegister').val();
                        var password1 = $('#passwordRegister').val();
                        var password2 = $('#repeatPasswordRegister').val();
                        if (firstname === "" || familyname === "" || sex === "" || address === "" || phone === ""
                                || email === "" || nationality === "" || profession === "" || institution === ""
                                || username === "" || password1 === "" || password2 === "") {
                            $.blockUI({
                                theme: true,
                                title: lang.some_required_field_empty_title,
                                message: '<p>' + lang.some_required_field_empty + '</p>',
                                timeout: 4000
                            });
                            return;
                        } else if (!isValidEmail(email)) {
                            $.blockUI({
                                theme: true,
                                title: 'Email address error',
                                message: '<p>This email address is not correct</p>',
                                timeout: 4000
                            });
                            return;
                        } else if (password1 !== password2) {
                            $.blockUI({
                                theme: true,
                                title: lang.password_do_not_match_title,
                                message: '<p>' + lang.password_do_not_match + '</p>',
                                timeout: 4000
                            });
                            return;
                        } else {
                            $('#loaderRegistration').removeClass('displayNone');
                            $.ajax({
                                type: 'POST',
                                url: 'php_includes/signup.php',
                                data: '&firstname=' + firstname + '&familyname=' + familyname + '&othername=' + othername + '&sex=' + sex + '&address=' + address + '&phone=' + phone + '&email=' + email + '&nationality=' + nationality + '&profession=' + profession + '&institution=' + institution + '&username=' + username + '&username=' + username + '&password1=' + password1 + '&password2=' + password2,
                                success: function (response) {
                                    $('#loaderRegistration').addClass('displayNone');
                                    if (response !== "signup_success") {
                                        $.blockUI({
                                            theme: true,
                                            title: lang.error_occured,
                                            message: response,
                                            timeout: 4000
                                        });
                                        return;
                                    } else {
                                        registerForm.dialog("close");
                                        $.blockUI({
                                            theme: true,
                                            title: "Sign up success",
                                            message: '<span style="font-size:13px;">OK <b>' + firstname + ' ' + familyname + '</b>, check your email inbox and junk mail box at <b><u>' + email + '</u></b> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.</span>',
                                            timeout: 15000
                                        });
                                        return;
                                    }
                                }
                            });
                        }
                    }
                },
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#registerFormBox').addClass('displayNone');
                        $('#loaderRegistration').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ],
            close: function () {
                $('#registerFormBox').addClass('displayNone');
                $('#loaderRegistration').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#logInCommand").button().on("click", function () {
        $('#loginFormBox').removeClass('displayNone');
        $('#loaderConnection').addClass('displayNone');
//        $("#loginform")[0].reset();
        loginForm = $("#login-form").dialog({
            autoOpen: false,
            height: 250,
            width: 350,
            modal: true,
            title: lang.login_form_title,
            buttons: [
                {
                    text: lang.login,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        var username = $('#username').val();
                        var password = $('#password').val();
                        if (username === "" || password === "") {
                            $.blockUI({
                                theme: true,
                                title: lang.some_required_field_empty_title,
                                message: '<p>' + lang.some_required_field_empty + '</p>',
                                timeout: 4000
                            });
                            return;
                        } else {
                            $('#loaderConnection').removeClass('displayNone');
                            $.ajax({
                                type: 'POST',
                                url: 'php_includes/login.php',
                                data: '&username=' + username + '&password=' + password,
                                success: function (response) {
//                                    $("#logInCommand").button("option", "disabled", true);
                                    $('#loaderConnection').addClass('displayNone');
                                    if (response === "required_fields_empty") {
                                        $.blockUI({
                                            theme: true,
                                            title: lang.some_required_field_empty_title,
                                            message: '<p>' + lang.some_required_field_empty + '</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    } else if (response === "username_does_not_match") {
                                        $.blockUI({
                                            theme: true,
                                            title: "Username incorrect",
                                            message: '<p>The username entered does not exist in the system</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    } else if (response === "passwords_do_not_match") {
                                        $.blockUI({
                                            theme: true,
                                            title: "Password incorrect",
                                            message: '<p>The password entered is not correct</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    } else if (response === "account_not_activated_yet") {
                                        $.blockUI({
                                            theme: true,
                                            title: "Account not activated",
                                            message: '<p>Your account has not been activated yet</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    } else {
                                        loginForm.dialog("close");
                                        $("#logInCommand").addClass('displayNone');
                                        $("#logOutCommand").removeClass('displayNone');
                                        $("#registerCommand").addClass('displayNone');
                                        $("#profileCommand").removeClass('displayNone');
                                    }
                                }
                            });
                        }
                    }
                },
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#loginFormBox').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $('#loginFormBox').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#profileCommand").button().on("click", function () {
        $('#profileFormBox').removeClass('displayNone');
//        $("#loginform")[0].reset();
        profileForm = $("#profile-form").dialog({
            autoOpen: false,
            height: 600,
            width: 500,
            modal: true,
            title: "Details",
            buttons: [
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#profileFormBox').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $('#profileFormBox').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#passwordForgotten").button().on("click", function () {
        $('#passwordForgottenFormBox').removeClass('displayNone');
        $("#passwordForgotten-form").dialog({
            autoOpen: false,
            height: 220,
            width: 350,
            modal: true,
            title: lang.login_form_title,
            buttons: [
                {
                    text: lang.ok,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        $(loginForm).dialog("destroy");
                    }
                },
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#passwordForgottenFormBox').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $('#passwordForgottenFormBox').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#logOutCommand").button().on("click", function () {
        $.ajax({
            type: 'POST',
            url: 'php_includes/logout.php',
            success: function () {
                $("#logOutCommand").addClass('displayNone');
                $("#logInCommand").removeClass('displayNone');
                $("#profileCommand").addClass('displayNone');
                $("#registerCommand").removeClass('displayNone');
            }
        });
    });
    $("#passwordForgotten").button().on("click", function () {
        $('#passwordForgottenFormBox').removeClass('displayNone');
        $("#passwordForgotten-form").dialog({
            autoOpen: false,
            height: 220,
            width: 350,
            modal: true,
            title: lang.login_form_title,
            buttons: [
                {
                    text: lang.ok,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        $(loginForm).dialog("destroy");
                    }
                },
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#passwordForgottenFormBox').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $('#passwordForgottenFormBox').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
});
function isValidEmail(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(email);
}
function restrict(elem) {
    var tf = _(elem);
    var rx = new RegExp;
    if (elem === "email") {
        rx = /[' "]/gi;
    } else if (elem === "usernameRegister") {
        rx = /[^a-z0-9]/gi;
    }
    tf.value = tf.value.replace(rx, "");
}
function emptyElement(x) {
    _(x).innerHTML = "";
}
function checkusername() {
    var u = $("#usernameRegister").val();
    if (u !== "") {
        $.ajax({
            type: 'POST',
            url: 'php_includes/usernameCheck.php',
            data: '&usernamecheck=' + u,
            success: function (response) {
                if (response !== "") {
                    $.blockUI({
                        theme: true,
                        title: lang.username_error_title,
                        message: response,
                        timeout: 4000
                    });
                    return;
                }
            }
        });
    }
}
function openTerms() {
    _("terms").style.display = "block";
    emptyElement("status");
}
