<?php

include_once ("../script/mysqlclass.php");
include_once ("../script/fonctions.php");
connectdb();
$idUser = $_COOKIE["id"];
$idUsage = $_POST["id_usage"];
$interest = $_POST["interest"];
$description = $_POST["description"];
$comment = $_POST["comment"];
$idss = explode(";", $_POST['idss']);
$size = getTotalSize($idss);

$Connex = new db(0);
$Connex->connect();
// Check their credentials against the database
$Connex->query("SELECT firstname, familyname, email FROM dmt_user WHERE id_user='$idUser' LIMIT 1");
$numberAct = $Connex->num_rows();
// Evaluate for a match in the system (0 = no match, 1 = match)
if ($numberAct > 0) {
    while ($Connex->next_record()) {
        $firstname = $Connex->f("firstname");
        $familyname = $Connex->f("familyname");
        $email = $Connex->f("email");
    }
    $query = "INSERT INTO dmt_delivery VALUES "
            . "('','$idUser','$idUsage','" . mysql_real_escape_string($interest) . "','"
            . mysql_real_escape_string($description) . "','"
            . mysql_real_escape_string($comment) . "', now(), '$size', '1', '0','0')";
    if (!mysql_query($query)) {
        die('Error: ' . mysql_error());
        echo "An_error_occured";
        exit();
    } else {
        $iddelivery = @mysql_insert_id();
        for ($i = 0; $i < count($idss); $i++) {
            if ($idss[$i] != "") {
                mysql_query("insert into dmt_deliver values ($idss[$i], $iddelivery, '0')");
            }
        }
        sendEmail($email, $firstname, $familyname);

        $Connex->query("select id_image from dmt_deliver inner join dmt_delivery on dmt_deliver.id_delivery = "
                . "dmt_delivery.id_delivery where id_user = '$idUser' and dmt_deliver.downloaded = '0'");
        echo $Connex->num_rows();
        mysql_close();
        exit();
    }
} else {
    echo "user_not_found";
    exit();
}

function sendEmail($email, $firstname, $familyname) {
    $subject = "Data Request confirmation";
    $messageToDMT = '<div id=":pf" style="direction: ltr;"><div id=":pe" style="overflow: hidden;"><div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;"><div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">OSFAC-DMT</div><div style="padding:15px;padding-bottom:0px;background:#fff">Hello <b>Database administrator</b>,</div><div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;">A satellite data request has been made by <b>' . $firstname . ' ' . $familyname . '</b><br><br>Find more details in the remote database.<div style="padding-top:15px">With our compliments,<br>OSFAC Data Management</div></div></div></div></div>';
    $messageToRequester = '<div id=":pf" style="direction: ltr;"><div id=":pe" style="overflow: hidden;"><div style="background:#f4f4f4;font-size:16px;padding:20px;font-family:Arial, Helvetica, sans-serif;"><div style="background:#67b021;font-size:20px;min-height:50px;color:#fff;line-height:50px;padding-left:15px;margin-bottom:0px">OSFAC-DMT</div><div style="padding:15px;padding-bottom:0px;background:#fff">Hello <b>' . $firstname . ' ' . $familyname . ' </b>,<br><br><div style="padding-top:13px"><b>Your request has been received and OSFAC thank you</b>.</div></div><div style="background:#fff;padding:15px;font-family:Arial, Helvetica, sans-serif;">Please kindly pass, with CDs or DVDs, in our offices in Kinshasa at the following address:<br/><br/><b>14 Avenue Sergent Moke, Quartier Socimat<br/>SAFRICAS concession. Commune Ngaliema<br/>Kinshasa - Democratic Republic of Congo.</b><br/><br/>You can also call: (+243) 81 45 20 766 for more information on acquiring data.<br/><br/>If you have technical questions related to the use of these data, email to <a href="mailto:contact@osfac.net">contact@osfac.net</a>.<br/><br/>Visit our website <a href="http://www.osfac.net">www.osfac.net</a> to learn more about our organization and services.<br/><br/><div style="padding-top:15px">With our compliments,<br>OSFAC Data Management</div></div></div></div></div>';

    $headerRequester = 'From:' . "OSFAC-DMT <dmt@osfac.net>" . "\n";
    $headerRequester .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
    $headerRequester .='Content-Transfer-Encoding: 8bit';
    mail($email, $subject, $messageToRequester, $headerRequester);
    $header = 'From:' . "Contact <contact@osfac.net>" . "\n";
    $header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
    $header .='Content-Transfer-Encoding: 8bit';
    mail("dmt@osfac.net", "New data request", $messageToDMT, $header);
}
