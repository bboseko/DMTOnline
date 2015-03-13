<?php

include ("../languages/include_lang_file.php");
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
        $subject = $lang['data-request-confirmation'];
        $messageToDMT = $lang['email-to-admin1'] . $firstname . ' ' . $familyname . $lang['email-to-admin2'];
        $messageToRequester = $lang['email-to-data-requester1'] . $firstname . ' ' . $familyname . $lang['email-to-data-requester2'];

        $headerRequester = 'From:' . "OSFAC-DMT <dmt@osfac.net>" . "\n";
        $headerRequester .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
        $headerRequester .='Content-Transfer-Encoding: 8bit';
        mail($email, $subject, $messageToRequester, $headerRequester);
        $header = 'From:' . "Contact <contact@osfac.net>" . "\n";
        $header .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
        $header .='Content-Transfer-Encoding: 8bit';
        mail("dmt@osfac.net", $lang['new-data-request'], $messageToDMT, $header);

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

