<?php

include_once ("mysqlclass.php");
$idParent = $_POST['idParent'];
$parent = $_POST['parent'];
$child = $_POST['child'];
$result = '';

$Connex = new db(0);
$Connex->connect();
$Connex->query("SELECT * FROM dmt_" . $child . " where id_" . $parent . "= " . $idParent . " order by " . $child . "_name");
if ($Connex->num_rows() >= 1) {
    while ($Connex->next_record()) {
        $id = $Connex->f("id_" . $child);
        $value = $Connex->f($child . "_name");
        $result.= "<option value=$id>$value</option>";
    }
} else {
    $result = null;
}

echo $result;
$Connex->free();
?>
