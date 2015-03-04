<?php

include_once ("../script/mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$idCriteria = $_POST["idCriteria"];
$Connex->query("delete from dmt_criteria where id_criteria ='$idCriteria'");
