<?php

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
    $subject = "OSFAC-DMT Temporary Password";
    $msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>OSFAC-DMT Forgot Password</title></head><body><div id=":pf" style="direction: ltr;"><div id=":pe" style="overflow: hidden;"><div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;"><div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">OSFAC-DMT</div><div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;"><p>Hello  <b>' . $u . ' </b><br></p><p>This is an automated message from OSFAC-DMT. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>' . $tempPass . '</b></p><p><a href="http://www.osfac.net/dev/php_includes/active_password.php?u=' . $u . '&p=' . $hashTempPass . '">Click here now to apply the temporary password shown below to your account</a></p><p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p><br/>With our compliments,<br>OSFAC Data Management Team</div></div></div></div></body></html>';
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