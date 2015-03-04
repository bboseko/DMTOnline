<?php

include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$idUser = $_COOKIE["id"];
$criteria = $_POST["criteria"];
$parameters = $_POST["parameters"];
$Connex->query("select * from dmt_criteria where criteria_name ='$criteria' and id_user ='$idUser'");
$num = $Connex->num_rows();
if ($num == 0) {
    $Connex->query("INSERT INTO dmt_criteria (criteria_name, parameters, register_date, id_user) VALUES "
            . "('" . mysql_real_escape_string($criteria) . "','" . mysql_real_escape_string($parameters) . "', now(), $idUser)");
    echo "save_success";
    exit();
} else {
    echo "An_error_occured";
    exit();
}
$Connex->free();
