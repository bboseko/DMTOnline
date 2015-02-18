<?php

//session_start();
include_once("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_username = "";
$log_password = "";

// User Verify function
function evalLoggedUser($Connex, $id, $u, $p) {
    $sql = "SELECT ip_address FROM dmt_user WHERE id_user='$id' AND username='$u' AND password='$p' AND activated='1' LIMIT 1";
    $Connex->query($sql);
    $numrows = $Connex->num_rows();
    if ($numrows > 0) {
        return true;
    }
}

if (isset($_SESSION["id_user"]) && isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    $log_id = preg_replace('#[^0-9]#', '', $_SESSION['id_user']);
    $log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
    $log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
    // Verify the user
    $user_ok = evalLoggedUser($Connex, $log_id, $log_username, $log_password);
} else if (isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
    $_SESSION['id_user'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
    $log_id = $_SESSION['id_user'];
    $log_username = $_SESSION['username'];
    $log_password = $_SESSION['password'];
    // Verify the user
    $user_ok = evalLoggedUser($Connex, $log_id, $log_username, $log_password);
    if ($user_ok == true) {
        // Update their lastlogin datetime field
        $sql = "UPDATE dmt_user SET last_visit_date=now() WHERE id_user='$log_id' LIMIT 1";
        $Connex->query($sql);
    }
}
echo $log_username;