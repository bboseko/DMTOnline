//Global variables
var hash = new Array();
var arrayColorfp = new Array();
var nRowResult = 0;
var loggedIN = false;
var manageCriteriaForm;
$(function () {
    var loginForm, registerForm, logoutForm, pfForm, pcForm, profileForm, editProfileForm;
    var saveCriteriaForm;
    $.sticky('<b>The page has loaded !</b>');
    $.ajax({
        type: 'POST',
        url: 'php_includes/check_login_status.php',
        success: function (response) {
            loggedIN = (response !== "");
            if (response !== "") {
                $("#cartCommand").removeClass('displayNone');
                $("#logInCommand").addClass('displayNone');
                $("#logOutCommand").removeClass('displayNone');
                $("#registerCommand").addClass('displayNone');
                $("#profileCommand").removeClass('displayNone');
                $("#manageCriteria").removeClass('displayNone');
                $("#liManageCriteria").removeClass('backgroundNone');
            }
            else {
                $("#cartCommand").addClass('displayNone');
                $("#logOutCommand").addClass('displayNone');
                $("#logInCommand").removeClass('displayNone');
                $("#profileCommand").addClass('displayNone');
                $("#registerCommand").removeClass('displayNone');
                $("#saveCriteria").addClass('displayNone');
                $("#manageCriteria").addClass('displayNone');
                $("#liSaveCriteria").addClass('backgroundNone');
                $("#liManageCriteria").addClass('backgroundNone');
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
            primary: "ui-icon-info"
        }
    });
    $("#aboutCommand").button().on("click", function () {
        window.location = "pages/about.php";
    });
    $("#desktopCommand").button({
        icons: {
            primary: "ui-icon-disk"
        }
    });
    $("#helpCommand").button({
        icons: {
            primary: "ui-icon-help"
        }
    });
    $("#saveCriteria").button({
        icons: {
            primary: "ui-icon-circle-check"
        }
    });
    $("#cartCommand").button({
        icons: {
            primary: "ui-icon-cart"
        }
    });
    $("#manageCriteria").button({
        icons: {
            primary: "ui-icon-gear"
        }
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
    $("#registerCommand").button({
        icons: {
            primary: "ui-icon-key"
        }
    });

    $("#saveCriteria").button().on("click", function () {
        saveCriteriaForm = $("#dialog-saveCriteria").dialog({
            resizable: false,
            height: 160,
            width: 350,
            modal: true,
            buttons: [
                {
                    text: lang.ok,
                    icons: {
                        primary: "ui-icon-check"
                    },
                    click: function () {
                        var criteria = $('#criteria-name').val();
                        //Gathering parameters
                        var category = $('#categorySelector span.text').html();//categories of images
                        var coordinates = "";//coordinates
                        for (var i = 0; i < DMT.gmaps.coordinateList.length; i++) {
                            var longitude = DMT.gmaps.coordinateList[i].lng().toFixed(DMT.coordinatePrecision);
                            var latitude = DMT.gmaps.coordinateList[i].lat().toFixed(DMT.coordinatePrecision);
                            coordinates += longitude + ',' + latitude + ' ';
                        }
                        coordinates = coordinates.substring(0, coordinates.length - 1);
                        var format = DMT.gmaps.settings.format;//format of coordinates
                        var active = $("#accordion").accordion("option", "active");//Active tab in accordion
                        var period = $('input:radio[name=dateType]:checked').val();//Period of images
                        var dateProp = $('#datepickerFrom').val() + ',' + $('#datepickerTo').val();
                        var yearProp = $('#yearFrom').val() + ',' + $('#yearTo').val();

                        var landsatSection = 0, spotSection = 0, srtmSection = 0;

                        if (category === '(all)') {
                            landsatSection = 1;
                            spotSection = 1;
                            srtmSection = 1;
                        }
                        else if (category === '(none)') {
                            landsatSection = 0;
                            spotSection = 0;
                            srtmSection = 0;
                        }
                        else {
                            if (category.indexOf("LANDSAT") >= 0) {
                                landsatSection = 1;
                            }
                            else {
                                landsatSection = 0;
                            }
                            if (category.indexOf("SRTM") >= 0) {
                                srtmSection = 1;
                            }
                            else {
                                srtmSection = 0;
                            }
                            if (category.indexOf("SPOT") >= 0) {
                                spotSection = 1;
                            }
                            else {
                                spotSection = 0;
                            }
                        }
                        var landsatProp = $('#missionLandsat').val() + ',' + $('#slc').val() + ',' + $('#orthorectified').val() + ',' + $('#stack').val();
                        var srtmProp = $('#missionSRTM').val() + ',' + $('#resolutionSRTM').val();
                        var spotProp = $('#verionSPOT').val();
                        var cloudCover = $('#cloudCover').val();

                        var parameters = "categorySelector:" + category + ";"
                                + "coordinates:" + coordinates + ";"
                                + "format:" + format + ";"
                                + "accordion:" + active + ";"
                                + "period:" + period + ";"
                                + "DateProperties:" + dateProp + ";"
                                + "YearProperties:" + yearProp + ";"
                                + "landsat:" + landsatSection + ";"
                                + "srtm:" + srtmSection + ";"
                                + "spot:" + spotSection + ";"
                                + "landsatProperties:" + landsatProp + ";"
                                + "srtmProperties:" + srtmProp + ";"
                                + "spotProperties:" + spotProp + ";"
                                + "cloudCoverProperties:" + cloudCover + ";";
                        if (criteria === "") {
                            $.blockUI({
                                theme: true,
                                title: lang.some_required_field_empty_title,
                                message: '<p>' + lang.some_required_field_empty + '</p>',
                                timeout: 4000
                            });
                            return;
                        } else {
                            $('#loaderSaveCriteria').removeClass('displayNone');
                            $.ajax({
                                type: 'POST',
                                url: 'criteria/save_criteria.php',
                                data: '&criteria=' + criteria + '&parameters=' + parameters,
                                success: function (response) {
                                    $('#loaderSaveCriteria').addClass('displayNone');
                                    if (response === "save_success") {
                                        saveCriteriaForm.dialog("close");
                                        $("#saveCriteria").addClass('displayNone');
                                        $("#liSaveCriteria").addClass('backgroundNone');
                                    } else {
                                        $.blockUI({
                                            theme: true,
                                            title: 'Fatal error',
                                            message: '<p>This criteria name already exists in the database !!!</p>',
                                            timeout: 4000
                                        });
                                        return;
                                    }
                                }
                            });
                        }
                    }
                },
                {
                    text: lang.cancel,
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
    $("#manageCriteria").button().on("click", function () {
        $('#manageCriteriasFormBox').removeClass('displayNone');

        manageCriteriaForm = $("#manage-Criterias-form").dialog({
            autoOpen: false,
            width: 500,
            modal: true,
            title: "Saved Criteria",
            buttons: [
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#manageCriteriasFormBox').addClass('displayNone');
                        $('#loaderMCriteria').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $('#manageCriteriasFormBox').addClass('displayNone');
                $('#loaderMCriteria').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
        $.ajax({
            type: 'POST',
            url: 'criteria/manage_criteria.php',
            success: function (response) {
                $('#manageCriteriasFormBox').html(response);
            }
        });
    });
    $("#homeCommandProfile").button().on("click", function () {
        window.location = "../index.php";
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
                                        $("#saveCriteria").removeClass('displayNone');
                                        $("#manageCriteria").removeClass('displayNone');
                                        $("#liSaveCriteria").removeClass('backgroundNone');
                                        $("#liManageCriteria").removeClass('backgroundNone');
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
    $('#password').keypress(function (e) {
        if (e.which === 13) {
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
            }
            else {
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
                        }
                        else if (response === "username_does_not_match") {
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
                            $("#saveCriteria").removeClass('displayNone');
                            $("#manageCriteria").removeClass('displayNone');
                            $("#liSaveCriteria").removeClass('backgroundNone');
                            $("#liManageCriteria").removeClass('backgroundNone');
                            window.location = response;
                        }
                    }
                });
            }
            return false;
        }
    });
    $("#profileCommand").button().on("click", function () {
        profileForm = $("#dialog-myProfile").dialog({
            resizable: true,
            width: 500,
            modal: true,
            buttons: [
                {
                    text: lang.change_password,
                    icons: {
                        primary: "ui-icon-locked"
                    },
                    click: function () {
                        $("#change-password-Form")[0].reset();
                        pcForm = $("#dialog-changePassword").dialog({
                            resizable: false,
                            autoOpen: false,
                            width: 345,
                            modal: true,
                            buttons: [
                                {
                                    text: lang.ok,
                                    icons: {
                                        primary: "ui-icon-check"
                                    },
                                    click: function () {
                                        var op = $('#oldPassword').val();
                                        var np = $('#newPassword').val();
                                        var rp = $('#retypePassword').val();
                                        if (op === "" || np === "" || rp === "") {
                                            $.blockUI({
                                                theme: true,
                                                title: lang.some_required_field_empty_title,
                                                message: '<p>' + lang.some_required_field_empty + '</p>',
                                                timeout: 4000
                                            });
                                            return;
                                        } else if (np !== rp) {
                                            $.blockUI({
                                                theme: true,
                                                title: "Passwords do not match",
                                                message: '<p>Your new password and the repeat one do not match</p>',
                                                timeout: 4000
                                            });
                                            return;
                                        } else {
                                            $('#loaderChangePassword').removeClass('displayNone');
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php_includes/change_password.php',
                                                data: '&op=' + op + '&np=' + np + '&rp=' + rp,
                                                success: function (response) {
                                                    $('#loaderChangePassword').addClass('displayNone');
                                                    if (response === "Old_password_error") {
                                                        $.blockUI({
                                                            theme: true,
                                                            title: "Old password error",
                                                            message: '<p>The old password entered is not correct</p>',
                                                            timeout: 4000
                                                        });
                                                        return;
                                                    } else if (response === "Password_must_have_at_least_5_characters") {
                                                        $.blockUI({
                                                            theme: true,
                                                            title: "Password error",
                                                            message: '<p>New password must have at least 5 characters</p>',
                                                            timeout: 4000
                                                        });
                                                        return;
                                                    } else if (response === "New_password_can_not_be_the_same_to_old_one") {
                                                        $.blockUI({
                                                            theme: true,
                                                            title: "Password error",
                                                            message: '<p>New password can not be the same to the old one</p>',
                                                            timeout: 4000
                                                        });
                                                        return;
                                                    } else {
                                                        $(this).dialog("close");
                                                        pcForm.dialog("close");
                                                        $.blockUI({
                                                            theme: true,
                                                            title: "Passwords changed successfully",
                                                            message: "Your password has been changed successfully",
                                                            timeout: 4000
                                                        });
                                                        return;
                                                    }
                                                }
                                            });
                                        }
                                    }
                                },
                                {
                                    text: lang.cancel,
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
                        }).dialog("open");
                    }
                }, {
                    text: lang.edit_profile,
                    icons: {
                        primary: "ui-icon-pencil"
                    },
                    click: function () {
                        $(this).dialog("close");
                        $("#registerFormBox-edit").removeClass('displayNone');
                        editProfileForm = $("#register-form-edit").dialog({
                            resizable: false,
                            autoOpen: false,
                            width: 400,
                            modal: true,
                            buttons: [
                                {
                                    text: lang.ok,
                                    icons: {
                                        primary: "ui-icon-check"
                                    },
                                    click: function () {
                                        var id = $('#id-user-edit').val();
                                        var firstname = $('#firstname-edit').val();
                                        var familyname = $('#familyname-edit').val();
                                        var othername = $('#othername-edit').val();
                                        var sex = $('#sex-edit').val();
                                        var address = $('#address-edit').val();
                                        var phone = $('#phone-edit').val();
                                        var email = $('#email-edit').val();
                                        var nationality = $('#nationality-edit').val();
                                        var profession = $('#profession-edit').val();
                                        var institution = $('#institution-edit').val();

                                        if (firstname === "" || familyname === "" || sex === "" || address === "" || phone === ""
                                                || email === "" || nationality === "" || profession === "" || institution === "") {
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
                                        } else {
                                            $("#loaderRegistration-edit").removeClass('displayNone');
                                            $.ajax({
                                                type: 'POST',
                                                url: 'php_includes/edit_profile.php',
                                                data: '&id-edit=' + id + '&firstname=' + firstname + '&familyname=' + familyname + '&othername=' + othername + '&sex=' + sex + '&address=' + address + '&phone=' + phone + '&email=' + email + '&nationality=' + nationality + '&profession=' + profession + '&institution=' + institution,
                                                success: function (response) {
                                                    $('#loaderRegistration').addClass('displayNone');
                                                    if (response !== "edit_success") {
                                                        $.blockUI({
                                                            theme: true,
                                                            title: lang.error_occured,
                                                            message: response,
                                                            timeout: 4000
                                                        });
                                                        return;
                                                    } else {
                                                        editProfileForm.dialog("close");
                                                        window.location = "index.php";
                                                    }
                                                }
                                            });
                                        }
                                    }
                                },
                                {
                                    text: lang.cancel,
                                    icons: {
                                        primary: "ui-icon-close"
                                    },
                                    click: function () {
                                        $("#loaderRegistration-edit").addClass('displayNone');
                                        $("#registerFormBox-edit").addClass('displayNone');
                                        $(this).dialog("close");
                                    }
                                }
                            ], close: function () {
                                $("#loaderRegistration-edit").addClass('displayNone');
                                $("#registerFormBox-edit").addClass('displayNone');
                                $(this).dialog('destroy');
                            }
                        }).dialog("open");
                    }
                },
                {
                    text: lang.cancel,
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
                                $("#saveCriteria").addClass('displayNone');
                                $("#manageCriteria").addClass('displayNone');
                                $("#liSaveCriteria").addClass('backgroundNone');
                                $("#liManageCriteria").addClass('backgroundNone');
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

function loadCriteria(idCriteria) {
    $.ajax({
        type: 'POST',
        url: 'criteria/load_criteria.php',
        data: '&idCriteria=' + idCriteria,
        success: function (response) {
            var tab = response.split(';');
            $('#tabs').tabs({active: 0});//Active the first tab
            //Setting up categories : tab[0]
            var category = tab[0].split(':');
            $('#' + category[0] + ' span.text').html(category[1]);

            if (category[1] === "(all)") {
                for (var i = 0; i < document.categoryForm.categoryBoxes.length; i++) {
                    document.categoryForm.categoryBoxes[i].checked = true;
                }
            }
            //Setting up coordinates : tab[1]
            DMT.gmaps.coordinates.clear();
            var coordinates = tab[1].split(':')[1].split(' ');

            for (var i = 0; i < coordinates.length; i++) {
                var latLong = coordinates[i].split(',');
                DMT.gmaps.coordinates.add(new google.maps.LatLng(parseFloat(latLong[1]), parseFloat(latLong[0])));
            }
            //Setting up latlong format : tab[2]
            var format = tab[2].split(':');
            DMT.gmaps.settings.format = format[1];
            var showFormat = format[1];
            var hideFormat = (format[1] === 'dd') ? 'dms' : 'dd';
            $('#coordEntryArea').find('div.format_' + hideFormat).hide();
            $('#coordEntryArea').find('div.format_' + showFormat).show();
            if (format[1] === 'dd') {
                $('#latlonfmtdec').prop("checked", true);
//                $('input:radio[name=latlonfmt]:nth(1)').attr('checked',true);
            } else {
                $('#latlonfmtdeg').prop("checked", true);
//                $('input:radio[name=latlonfmt]:nth(0)').attr('checked',true);
            }
            //Setting up accordion : tab[3]
            DMT.gmaps.featureCoder.clear();
            $("#accordion").accordion("option", "active", parseInt(tab[3].split(':')[1]));
            //Setting up period section : tab[4,5,6]
            $('#tabs').tabs({active: 1});//Active the second tab
            var showFeatureType = tab[4].split(':')[1];
            var hideFeatureType = (tab[4].split(':')[1] === 'Date') ? 'Year' : 'Date';
            $('#period' + hideFeatureType).hide();
            $('#period' + showFeatureType).show();
            var dateprop = tab[5].split(':')[1].split(',');
            $('#datepickerFrom').val(dateprop[0]);
            $('#datepickerTo').val(dateprop[1]);
            var yearprop = tab[6].split(':')[1].split(',');
            $('#yearFrom').val(yearprop[0]);
            $('#yearTo').val(yearprop[1]);
            //Setting up categories of images panel (show or hide) : tab[7,8,9]
            tab[7].split(':')[1] === '1' ? $('#MLandsat').show() : $('#MLandsat').hide();//landsat panel
            tab[8].split(':')[1] === '1' ? $('#MSRTM').show() : $('#MSRTM').hide();//srtm panel
            tab[9].split(':')[1] === '1' ? $('#MSPOT').show() : $('#MSPOT').hide();//spot panel
            //Setting up landsat properties tab[8]
            var lprop = tab[10].split(':')[1].split(',');
            $('#missionLandsat').val(lprop[0]);
            $('#slc').val(lprop[1]);
            $('#orthorectified').val(lprop[2]);
            $('#stack').val(lprop[3]);
            //Setting up srtm properties tab[9]
            var srtmprop = tab[11].split(':')[1].split(',');
            $('#missionSRTM').val(srtmprop[0]);
            $('#resolutionSRTM').val(srtmprop[1]);
            //Setting up spot properties tab[10]
            var spotprop = tab[12].split(':')[1].split(',');
            $('#verionSPOT').val(spotprop[0]);
            //Setting up cloud cover properties tab[11]
            var ccprop = tab[13].split(':')[1].split(',');
            $('#cloudCover').val(ccprop[0]);

            $('#seachButton').click();
            manageCriteriaForm.dialog("close");
        }
    });
}
function deleteCriteria(idCriteria) {
    var deleteCriteriaConfirm = $("#dialog-delete-criteria-confirm").dialog({
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
                    $('#loaderDeleteCriteria').removeClass('displayNone');
                    $.ajax({
                        type: 'POST',
                        url: 'criteria/delete_criteria.php',
                        data: '&idCriteria=' + idCriteria,
                        success: function () {
                            deleteCriteriaConfirm.dialog("close");
                            $('#loaderDeleteCriteria').addClass('displayNone');
                            $('#manageCriteriasFormBox').html('<span id="loaderMCriteria" style="color: #660000;margin-top: 2px;">Loading data ... <img alt="loading" src="./images/loader.gif" /></span>');
                            $.ajax({
                                type: 'POST',
                                url: 'criteria/manage_criteria.php',
                                success: function (response) {
                                    $('#manageCriteriasFormBox').html(response);
                                }
                            });
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
}
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
function pagination(nr, pn) {
    $('#search-results-container').html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="' + lang.loading + '" src="images/loader.gif" /><span> ' + lang.searching_images_loading + ' ...</span>');
    var itemsPerPage = 10;
    var lastPage = Math.ceil(nr / itemsPerPage);
    if (pn < 1) {
        pn = 1;
    }
    else if (pn > lastPage) {
        pn = lastPage;
    }
    var centerPages = "";
    var sub1 = pn - 1;
    var sub2 = pn - 2;
    var add1 = pn + 1;
    var add2 = pn + 2;
    if (pn === 1) {
        centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
    }
    else if (pn === lastPage) {
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')>' + sub1 + '</span> &nbsp;';
        centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
    }
    else if (pn > 2 && pn < (lastPage - 1)) {
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub2 + ')">' + sub2 + '</span> &nbsp;';
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')">' + sub1 + '</span> &nbsp;';
        centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
        centerPages += '&nbsp; <span " onClick="pagination(' + nr + ',' + add2 + ')">' + add2 + '</span> &nbsp;';
    }
    else if (pn > 1 && pn < lastPage) {
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')">' + sub1 + '</span> &nbsp;';
        centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
        centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
    }
    var limit = ' LIMIT ' + (pn - 1) * itemsPerPage + ', ' + itemsPerPage;
    var start = (pn - 1) * itemsPerPage;
    var paginationDisplay = "";
    if (lastPage !== "1") {
        paginationDisplay += '' + lang.page + ' <strong>' + pn + '</strong> ' + lang.of + ' ' + lastPage + ' ';
        if (pn !== 1) {
            var previous = pn - 1;
            paginationDisplay += '&nbsp; <span class="resultOther" onClick="pagination(' + nr + ',' + previous + ')"> ' + lang.back + '</span> ';
        }
        paginationDisplay += '<span class="paginationNumbers">' + centerPages + '</span>';
        if (pn !== lastPage) {
            var nextPage = pn + 1;
            paginationDisplay += '&nbsp; <span class="resultOther" onclick="pagination(' + nr + ',' + nextPage + ')"> ' + lang.next + '</span> ';
        }
    }
    if (nr === 0) {
        $('#catResult').hide();
        $('#pagingResultHeader, #pagingResultFooter').html('');
    } else {
        $('#catResult').show();
        $('#pagingResultHeader, #pagingResultFooter').html(paginationDisplay);
    }
    $.ajax({
        type: 'POST',
        url: 'script/searchImages.php',
        data: '&limit=' + limit + '&start=' + start + items,
        success: function (response) {
            $('#search-results-container').html(response);
            var t = 0;
            for (var id in hash) {
                if (hash[id] === true) {
                    t++;
                }
            }
            if (nRowResult >= 2) {
                t = t - 2;
            } else {
                t = t - 1;
            }
            if (t > 0) {
                $('#submitButton').removeClass('disabled');
            }
            else {
                $('#submitButton').addClass('disabled');
            }
        }
    });
}