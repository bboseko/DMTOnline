<?php

include_once ("../script/mysqlclass.php");
$idCriteria = $_POST['idCriteria'];
$Connex = new db(0);
$Connex->connect();
$Connex->query("select parameters from dmt_criteria where id_criteria ='$idCriteria' limit 1");
$numRow = $Connex->num_rows();

while ($Connex->next_record()) {
    $parameters = $Connex->f("parameters");
}
echo $parameters;
