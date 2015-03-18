<?php

include_once ("../languages/include_lang_file.php");
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$message = $_POST['message'];

$header = 'From:' . utf8_decode($full_name . ' <' . $email . '>') . "\n";
$header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
$header .='Content-Transfer-Encoding: 8bit';
if (mail("dmt@osfac.net", "OSFAC-DMT Feedback", $message, $header)) {
    echo $lang['contact-success-message'];
} else {
    echo $lang['contact-failed-message'];
}
