<?php

include_once ("./script/mysqlclass.php");
$numCart = 0;
if (isset($_COOKIE["id"])) {
    $id_user = $_COOKIE['id'];
    $Connex = new db(0);
    $Connex->connect();
    $Connex->query("select id_image as image, dmt_deliver.id_delivery as delivery from dmt_deliver inner join "
            . "dmt_delivery on dmt_deliver.id_delivery = dmt_delivery.id_delivery "
            . "where id_user = '$id_user' and dmt_deliver.deleted = '0'");
    $numCart = $Connex->num_rows();
}

