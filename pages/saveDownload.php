<?php

include_once ("../languages/include_lang_file.php");
include_once ("../script/fonctions.php");
$email = $_POST['email'];
$subject = "OSFAC-DMT Desktop";
$messageToDownloader = $lang['desktop-email'];

$header = 'From:' . "OSFAC Team <dmt@osfac.net>" . "\n";
$header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
$header .='Content-Transfer-Encoding: 8bit';
mail($email, $subject, $messageToDownloader, $header);

connectdb();
$query = "INSERT INTO downloader VALUES('','" . mysql_real_escape_string($email) . "')";
if (!mysql_query($query)) {
    die('Error: ' . mysql_error());
    echo "An error occured while saving into database";
} else {
    mysql_close();
    echo $_SESSION['lang'];
}

