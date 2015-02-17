<?php

// Connect to database and sanitize incoming $_GET variables
include_once ("../script/mysqlclass.php");
$id = preg_replace('#[^0-9]#i', '', $_GET['id']);
$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
$e = $_GET['e'];
$p = $_GET['p'];
// Evaluate the lengths of the incoming $_GET variable
if ($id == "" || strlen($u) < 3 || strlen($e) < 5 || strlen($p) != 74) {
    // Log this issue into a text file and email details to yourself
    header("location: message.php?msg=activation_string_length_issues");
    exit();
}
$Connex = new db(0);
$Connex->connect();
// Check their credentials against the database
$Connex->query("SELECT * FROM dmt_user WHERE id_user='$id' AND username='$u' AND email='$e' AND password='$p' LIMIT 1");
$numberAct = $Connex->num_rows();
// Evaluate for a match in the system (0 = no match, 1 = match)
if ($numberAct == 0) {
    // Log this potential hack attempt to text file and email details to yourself
    header("location: message.php?msg=Your credentials are not matching anything in our system");
    exit();
}
// Match was found, you can activate them
$Connex->query("UPDATE dmt_user SET activated = 1 WHERE id_user='$id' LIMIT 1");
//$activationTest = $Connex->num_rows();
// Optional double check to see if activated in fact now = 1
$Connex->query("SELECT * FROM dmt_user WHERE id_user='$id' AND activated='1' LIMIT 1");
$numActivationTest = $Connex->num_rows();
// Evaluate the double check
if ($numActivationTest == 0) {
    // Log this issue of no switch of activation field to 1
    header("location: message.php?msg=activation_failure");
    exit();
} else if ($numActivationTest == 1) {
    // Great everything went fine with activation!
    header("location: message.php?msg=activation_success");
    exit();
}