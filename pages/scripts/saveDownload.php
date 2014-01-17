<?php

session_start();
header("content-type: text/html; charset=ISO-8859-1");
include_once ("../../script/fonctions.php");
$email = $_POST['email'];
$subject = "OSFAC-DMT Desktop";
$messageToDownloader = '<div id=":pf" style="direction: ltr;">
                <div id=":pe" style="overflow: hidden;">
                    <div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;">
                        <div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">
                            OSFAC-DMT
                        </div>
                        <div style="padding:15px;padding-bottom:0px;background:#fff">
                            Hello,
                            <div style="padding-top:13px">
                                Thank you for downloading <b>OSFAC-DMT Desktop</b>.
                            </div>
                        </div>
                        <div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;">
                            We are OSFAC Team, here to assist in your usage of OSFAC products. 
                            Should you have any queries or feedback, just reply to this message.<br/><br/>

If you have technical questions related to the use of satellite images, email to contact@osfac.net.<br/><br/>
Visit our website at www.osfac.net to learn more about our organization and services.<br/><br/>
                            <div style="padding-top:15px">
                                With our compliments,<br>
                                    OSFAC Team
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>';

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
    echo "Downloader saved successfully.";
}
?>
