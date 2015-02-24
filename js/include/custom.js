$(function () {
    var loginForm, registerForm, logoutForm, pfForm;
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
    $("#homeCommand").button({
        icons: {
            primary: "ui-icon-home"
        }
    });
    $("#homeCommand").button().on("click", function () {
        window.location = "index.php";
    });
    $("#aboutCommand").button({
        icons: {
            primary: "ui-icon-star"
        }
    });
    $("#aboutCommand").button().on("click", function () {
        window.location = "pages/about.php";
    });
    $("#passwordForgot").button({
    });
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
    $("#homeCommandProfile").button({
        icons: {
            primary: "ui-icon-home"
        }
    });
    $("#homeCommandProfile").button().on("click", function () {
        window.location = "../index.php";
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
                                        $("#dialog-message").dialog({
                                            modal: true,
                                            hide: {
                                                effect: "explode",
                                                duration: 1000
                                            },
                                            buttons: {
                                                Ok: function () {
                                                    $(this).dialog("close");
                                                }
                                            }
                                        });
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
        loginForm = $("#login-form").dialog({
            autoOpen: false,
            height: 235,
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
                                        window.location = response;
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
        window.location = "profile/profile.php";
    });
    $("#logOutCommand").button().on("click", function () {
        logoutForm = $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: [
                {
                    text: lang.yes,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        $('#loaderLogout').removeClass('displayNone');
                        $.ajax({
                            type: 'POST',
                            url: 'php_includes/logout.php',
                            success: function () {
                                logoutForm.dialog("close");
                                $('#loaderLogout').addClass('displayNone');
                                $("#logOutCommand").addClass('displayNone');
                                $("#logInCommand").removeClass('displayNone');
                                $("#profileCommand").addClass('displayNone');
                                $("#registerCommand").removeClass('displayNone');
                            }
                        });
                    }
                },
                {
                    text: lang.no,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $(this).dialog('destroy');
            }
        });
    });
    $("#passwordForgot").button().on("click", function () {
        $('#passwordForgottenFormBox').removeClass('displayNone');
        loginForm.dialog("close");
        pfForm = $("#passwordForgotten-form").dialog({
            autoOpen: false,
            height: 190,
            width: 300,
            modal: true,
            title: "Password forgotten",
            buttons: [
                {
                    text: lang.ok,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        var emailPF = $('#emailPF').val();
                        if (emailPF === "") {
                            $.blockUI({
                                theme: true,
                                title: 'Empty email',
                                message: '<p>Email field is empty</p>',
                                timeout: 4000
                            });
                            return;
                        } else if (!isValidEmail(emailPF)) {
                            $.blockUI({
                                theme: true,
                                title: 'Email address error',
                                message: '<p>This email address is not correct</p>',
                                timeout: 4000
                            });
                            return;
                        } else {
                            $('#loaderPF').removeClass('displayNone');
                            $.ajax({
                                type: 'POST',
                                url: 'php_includes/forgot_password.php',
                                data: '&email=' + emailPF,
                                success: function (response) {
                                    if (response === "no_exist") {
                                        $('#loaderPF').addClass('displayNone');
                                        $.blockUI({
                                            theme: true,
                                            title: 'Email address error',
                                            message: '<p>This email address does not exist in the system</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    } else if (response === "email_send_failed") {
                                        $('#loaderPF').addClass('displayNone');
                                        $.blockUI({
                                            theme: true,
                                            title: lang.error_occured,
                                            message: '<p>An error occured while sending an email to </p>' + emailPF,
                                            timeout: 4000
                                        });
                                        return;
                                    } else {
                                        pfForm.dialog("close");
                                        $('#loaderPF').addClass('displayNone');
                                        $("#dialog-message-forgot-password").dialog({
                                            modal: true,
                                            hide: {
                                                effect: "explode",
                                                duration: 1000
                                            },
                                            buttons: {
                                                Ok: function () {
                                                    $(this).dialog("close");
                                                }
                                            }
                                        });
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
function quickLook(name, preview) {
    if (preview === '/preview/nobrowse_small.png') {
        preview = '/preview/nobrowse.png';
    }
    $('#quickLookDialogArea').dialog({
        bgiframe: true,
        autoOpen: false,
        resizable: false,
        height: 600,
        width: 600,
        modal: true,
        buttons: [
            {
                text: lang.close,
                icons: {
                    primary: "ui-icon-close"
                },
                click: function () {
                    $(this).dialog('destroy');
                }
            }
        ],
        title: lang.thumbnail + name,
        open: function () {
            var $dialogContent = $('#quickLookDialogArea');
            $dialogContent.html('<img alt="No Browse" src = http://www.osfac.net' + preview + ' width="574px" height="485px" />');
        },
        close: function () {
            $(this).dialog('destroy');
        }
    });
    $('#quickLookDialogArea').dialog('open');
}
