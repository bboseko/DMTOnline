<?php

if (isset($_COOKIE["user"])) {
    $u = $_COOKIE['user'];
    $Connex = new db(0);
    $Connex->connect();

    $Connex->query("SELECT * FROM dmt_user WHERE username='$u' AND activated='1' LIMIT 1");
    $numRow = $Connex->num_rows();

    while ($Connex->next_record()) {
        $db_id = $Connex->f("id_user");
        $db_firstname = $Connex->f("firstname");
        $db_familyname = $Connex->f("familyname");
        $db_othername = $Connex->f("othername");
        $db_sex = $Connex->f("sex");
        $db_address = $Connex->f("address");
        $db_phone = $Connex->f("phone");
        $db_email = $Connex->f("email");
        $db_profession = $Connex->f("profession");
        $db_institution = $Connex->f("institution");
        $db_nationality = $Connex->f("nationality");
        $db_username = $Connex->f("username");
        $db_register_date = strftime("%b %d, %Y %I:%M:%S", strtotime($Connex->f("register_date")));
        $db_last_visit_date = strftime("%b %d, %Y %I:%M:%S", strtotime($Connex->f("last_visit_date")));
    }
}

function selectedOption($db_nationality, $value) {
    if ($db_nationality == $value) {
        echo "selected='selected'";
    }
}
