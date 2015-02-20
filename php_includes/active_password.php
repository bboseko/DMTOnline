<?php

include_once ("../script/mysqlclass.php");
$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
$temppasshash = preg_replace('#[^a-z0-9]#i', '', $_GET['p']);
if (strlen($temppasshash) < 10) {
    exit();
}
$Connex = new db(0);
$Connex->connect();
$Connex->query("SELECT id_user FROM dmt_user WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1");
$numrows = $Connex->num_rows();

if ($numrows == 0) {
    header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
    exit();
} else {
    while ($Connex->next_record()) {
        $id = $Connex->f("id_user");
    }
    $Connex->query("UPDATE dmt_user SET password='$temppasshash', temp_pass='' WHERE id_user='$id' AND username='$u' LIMIT 1");
    header("location: message.php?msg=password_reset_success");
    exit();
}