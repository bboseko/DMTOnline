<?php

include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$idImage = $_POST["idImage"];

$Connex->query("SELECT download_link FROM dmt_image INNER JOIN dmt_support "
        . "ON (`dmt_image`.`id_support` = `dmt_support`.`id_support`) WHERE id_image = '$idImage';");
$number = $Connex->num_rows();
if ($number > 0) {
    while ($Connex->next_record()) {
        $download_link = $Connex->f("download_link");
    }
    echo $download_link;
}
