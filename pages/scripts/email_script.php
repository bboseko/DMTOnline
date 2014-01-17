<?php

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$message = $_POST['message'];

$header = 'From:' . utf8_decode($full_name . ' <' . $email . '>') . "\n";
$header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
$header .='Content-Transfer-Encoding: 8bit';
if (mail("dmt@osfac.net", "OSFAC-DMT Feedback", $message, $header)) {
    echo "Your message has been sent successfully.";
} else {
    echo "An error occured while sending your Email.";
}
?>
