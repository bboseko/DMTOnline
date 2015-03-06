<?php

include_once ("mysqlclass.php");
$pathrow = $_POST['pathrow'];
$result = '';

$Connex = new db(0);
$Connex->connect();
$Connex->query("select asText(shape) as shape from dmt_image inner join dmt_concern on dmt_concern.id_image = dmt_image.id_image 
    inner join dmt_pathrow on dmt_pathrow.path_row = dmt_concern.path_row where dmt_pathrow.path_row = " . $pathrow);
if ($Connex->num_rows() >= 1) {
    while ($Connex->next_record()) {
        $result.= $Connex->f("shape");
        $result = str_replace(" ", ",", str_replace(",", ";", str_replace("))", "", substr($result, 9))));
        break;
    }
} else {
    $result = null;
}

echo $result;
$Connex->free();
?>

