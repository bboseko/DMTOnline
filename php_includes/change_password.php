<?php

include_once ("../script/mysqlclass.php");
$u = $_COOKIE['user'];
$op = $_POST['op'];
$np = $_POST['np'];
$rp = $_POST['rp'];
$Connex = new db(0);
$Connex->connect();
$op_hash = md5($op);
$Connex->query("SELECT * FROM dmt_user WHERE username='$u' AND password='$op_hash' AND activated='1' LIMIT 1");
$numRow = $Connex->num_rows();
// Evaluate for a match in the system (0 = no match, 1 = match)
if ($numRow == 0) {
    echo "Old_password_error";
    exit();
} else if (strlen($np) < 5) {
    echo "Password_must_have_at_least_5_characters";
    exit();
} else if ($op == $np) {
    echo "New_password_can_not_be_the_same_to_old_one";
    exit();
} else {
    $password_hash = md5($np);
    $Connex->query("update dmt_user set password='$password_hash' WHERE username='$u' LIMIT 1");
    echo "Password_changed_success";
    exit();
}