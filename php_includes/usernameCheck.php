<?php
include ("../languages/include_lang_file.php");
header("content-type: text/html; charset=UTF-8");
include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
$Connex->query("SELECT * FROM dmt_user WHERE username='$username' LIMIT 1");
$num = $Connex->num_rows();
if (strlen($username) < 3 || strlen($username) > 16) {
    echo '<p style="color:#F00;">' . $lang['username-error1'] . '</p>';
    $Connex->free();
    exit();
}
if (is_numeric($username[0])) {
    echo '<p style="color:#F00;">' . $lang['username-error2'] . '</p>';
    $Connex->free();
    exit();
}
if ($num == 1) {
    echo '<p style="color:#F00;">' . $username . $lang['username-error3'] . '</p>';
    $Connex->free();
    exit();
}
