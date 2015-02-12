$(function () {
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
        $("#register-form").dialog({
            autoOpen: false,
            height: 600,
            width: 350,
            modal: true,
            title: lang.register,
            buttons: {
                "Register": function () {
                },
                "Cancel": function () {
                    $(this).dialog("close");
                }
            },
            close: function () {
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
    $("#logInCommand").button().on("click", function () {
        $("#login-form").dialog({
            autoOpen: false,
            height: 210,
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
                        $(this).dialog("close");
                    }
                }
            ], close: function () {
                $(this).dialog('destroy');
            }
        }).dialog("open");
    });
});