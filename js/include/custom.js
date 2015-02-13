$(function () {
    var loginForm;
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
    $("#registerCommand").button({
        icons: {
            primary: "ui-icon-key"
        }
    });
    $("#registerCommand").button().on("click", function () {
        $('#registerFormBox').removeClass('displayNone');
        $("#register-form").dialog({
            autoOpen: false,
            height: 520,
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

                    }
                },
                {
                    text: lang.close,
                    icons: {
                        primary: "ui-icon-close"
                    },
                    click: function () {
                        $('#registerFormBox').addClass('displayNone');
                        $(this).dialog("close");
                    }
                }
            ],
            close: function () {
                $('#registerFormBox').addClass('displayNone');
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#logInCommand").button().on("click", function () {
        $('#loginFormBox').removeClass('displayNone');
        loginForm = $("#login-form").dialog({
            autoOpen: false,
            height: 240,
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