<?php

session_start();
header("content-type: text/html; charset=ISO-8859-1");
include_once ("./fonctions.php");

$idss = explode(";", $_POST['idss']);
$firstname = $_POST['firstname'];
$familyname = $_POST['familyname'];
$othername = $_POST['othername'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$profession = $_POST['profession'];
$institution = $_POST['institution'];
$nationality = $_POST['nationality'];
$applications = $_POST['applications'];
$interest = $_POST['interest'];
$description = $_POST['description'];
$comment = $_POST['comment'];
$size = getTotalSize($idss);

$subject = "Data Request confirmation";

$messageToDMT = '<div id=":pf" style="direction: ltr;">
                <div id=":pe" style="overflow: hidden;">
                    <div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;">
                        <div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">
                            OSFAC-DMT
                        </div>
                        <div style="padding:15px;padding-bottom:0px;background:#fff">
                            Hello
                            <div style="padding-top:13px">
                                <b>OSFAC\'s Database administrator</b>,
                            </div>
                        </div>
                        <div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;">
                            A satellite data request has been made by <b>' . $firstname . ' ' . $familyname . '</b><br><br>
                            Find more details in the remote database.
                            <div style="padding-top:15px">
                                With our compliments,<br>
                                OSFAC Data Management
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>';

$messageToRequester = '<div id=":pf" style="direction: ltr;">
                <div id=":pe" style="overflow: hidden;">
                    <div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;">
                        <div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">
                            OSFAC-DMT
                        </div>
                        <div style="padding:15px;padding-bottom:0px;background:#fff">
                            Hello,<br/>
                            Mr / Ms  <b>' . $firstname . ' ' . $familyname . ' </b><br><br>
                            <div style="padding-top:13px">
                                <b>Your request has been received and OSFAC thank you</b>.
                            </div>
                        </div>
                        <div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;">
                            Please kindly pass, with CDs or DVDs, in our offices in Kinshasa at the following address:<br/><br/>
                            <b>14 Avenue Sergent Moke, Quartier Socimat<br/>
                            SAFRICAS concession. Commune Ngaliema<br/>
                            Kinshasa - Democratic Republic of Congo.</b><br/><br/>
                            You can also call: (+243) 81 45 20 766 for more information on acquiring data.<br/><br/>
                            If you have technical questions related to the use of these data, email to contact@osfac.net.<br/><br/>
                            Visit our website www.osfac.net to learn more about our organization and services.<br/><br/>
                                                        
                            <div style="padding-top:15px">
                                With our compliments,<br>
                                OSFAC Data Management
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>';

$headerRequester = 'From:' . "OSFAC-DMT <dmt@osfac.net>" . "\n";
$headerRequester .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
$headerRequester .='Content-Transfer-Encoding: 8bit';
mail($email, $subject, $messageToRequester, $headerRequester);
$header = 'From:' . "Contact <contact@osfac.net>" . "\n";
$header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
$header .='Content-Transfer-Encoding: 8bit';
mail("dmt@osfac.net", "New data request", $messageToDMT, $header);

connectdb();
$query = "INSERT INTO dmt_requester VALUES('','" . mysql_real_escape_string($firstname) . "', '" . mysql_real_escape_string($familyname) . "', '" . mysql_real_escape_string($othername) . "','$sex', '" . mysql_real_escape_string($address) . "', '" . mysql_real_escape_string($phone) . "', '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($profession) . "', '" . mysql_real_escape_string($institution) . "', '" . mysql_real_escape_string($nationality) . "', '" . mysql_real_escape_string($interest) . "', '" . mysql_real_escape_string($description) . "', '" . mysql_real_escape_string($comment) . "')";
if (!mysql_query($query)) {
    die('Error: ' . mysql_error());
    echo "An error occured while saving into database";
} else {
    $idrequester = @mysql_insert_id();
    $daterequest = date("Y/m/d");
    $sql = "insert into dmt_delivery values ('', '$idrequester', '3','$size', '$daterequest', '', 'Yes', 'No', '')";
    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
        echo "An error occured while saving into database";
    } else {
        $iddelivery = @mysql_insert_id();
        $sql2 = "insert into dmt_choose values ('$iddelivery', '$applications')";
        if (!mysql_query($sql2)) {
            die('Error: ' . mysql_error());
            echo "An error occured while saving into database";
        } else {
            for ($i = 0; $i < count($idss); $i++) {
                if ($idss[$i] != "") {
                    mysql_query("insert into dmt_deliver values ($idss[$i], $iddelivery)");
                }
            }
            mysql_close();
            echo "Your data request has been sent to OSFAC and a confirmation Email has been sent into your inbox as well.";
        }
    }
}
?>
