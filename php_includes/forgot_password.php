<?php

include ("../languages/include_lang_file.php");
include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$e = $_POST['email'];
$Connex->query("SELECT id_user, username FROM dmt_user WHERE email='$e' AND activated='1' LIMIT 1");
$numrows = $Connex->num_rows();

if ($numrows > 0) {
    while ($Connex->next_record()) {
        $id = $Connex->f("id_user");
        $u = $Connex->f("username");
    }
    $emailcut = substr($e, 0, 4);
    $randNum = rand(10000, 99999);
    $tempPass = "$emailcut$randNum";
    $hashTempPass = md5($tempPass);
    $Connex->query("UPDATE dmt_user SET temp_pass='$hashTempPass' WHERE id_user='$id' LIMIT 1");
    $to = "$e";
    $from = "dmt@osfac.net";
    $headers = "From: OSFAC-DMT <$from>\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
    $subject = $lang['temporary-password'];
    $msg = $lang['email-forgot-password1'] . $u . $lang['email-forgot-password2'] . $tempPass . $lang['email-forgot-password3'] . $u . $lang['email-forgot-password4'] . $hashTempPass . $lang['email-forgot-password5'];
    if (mail($to, $subject, $msg, $headers)) {
        echo "success";
        exit();
    } else {
        echo "email_send_failed";
        exit();
    }
} else {
    echo "no_exist";
}