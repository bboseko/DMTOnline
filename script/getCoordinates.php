<?php

include_once ("mysqlclass.php");
$query = $_POST['query'];
$coodinates = '';

$Connex = new db(0);
$Connex->connect();

$Connex->query($query);
if ($Connex->num_rows() >= 1) {
    while ($Connex->next_record()) {
        $coodinates .= $Connex->f("coordinates");
    }
}
echo $coodinates;
$Connex->free();
?>
