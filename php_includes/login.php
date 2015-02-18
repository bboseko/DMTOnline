<?php

// CONNECT TO THE DATABASE
include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
$username = $_POST['username'];
$password = md5($_POST['password']);
// GET USER IP ADDRESS
$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
// FORM DATA ERROR HANDLING
if ($username == "" || $password == "") {
    echo "required_fields_empty";
    exit();
} else {
    // END FORM DATA ERROR HANDLING
    $db_id = 0;
    $Connex->query("SELECT id_user, username, password, activated FROM dmt_user WHERE username='$username' LIMIT 1");
    while ($Connex->next_record()) {
        $db_id = $Connex->f("id_user");
        $db_username = $Connex->f("username");
        $db_pass_str = $Connex->f("password");
        $db_activated = $Connex->f("activated");
    }

    if ($db_id == 0) {
        echo "username_does_not_match";
        exit();
    } else if ($password != $db_pass_str) {
        echo "passwords_do_not_match";
        exit();
    } else if ($db_activated == 0) {
        echo "account_not_activated_yet";
        exit();
    } else {
        // CREATE THEIR SESSIONS AND COOKIES
        $_SESSION['id_user'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $db_pass_str;
        setcookie("id", $db_id, strtotime('+30 days'), "/", "", "", TRUE);
        setcookie("user", $db_username, strtotime('+30 days'), "/", "", "", TRUE);
        setcookie("pass", $db_pass_str, strtotime('+30 days'), "/", "", "", TRUE);
        // UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
        $Connex->query("UPDATE dmt_user SET ip_address='$ip', last_visit_date=now() WHERE username='$db_username' LIMIT 1");
        echo $db_username;
        exit();
    }
}
