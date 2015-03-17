<?php

include_once ("../script/mysqlclass.php");
$idUser = $_COOKIE["id"];
$Connex = new db(0);
$Connex->connect();
$idImage = $_POST["idImage"];
$idDelivery = $_POST["idDelivery"];
$Connex->query("update dmt_deliver set deleted = '1' "
        . "where id_image = '$idImage' and id_delivery = '$idDelivery'");

$Connex->query("select id_image from dmt_deliver inner join dmt_delivery on dmt_deliver.id_delivery = "
        . "dmt_delivery.id_delivery where id_user = '$idUser' and dmt_deliver.deleted = '0'");
echo $Connex->num_rows();
