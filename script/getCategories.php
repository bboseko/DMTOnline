<?php

include_once ("mysqlclass.php");
$category = "(all),";
$Connex = new db(0);
$Connex->connect();
$Connex->query("SELECT id_category,category_name FROM dmt_category ORDER BY category_name");
if ($Connex->num_rows() >= 1) {
    while ($Connex->next_record()) {
        $category .= $Connex->f("category_name");
        $category .= ",";
    }
}
$category{ strlen($category) - 1 } = '';
echo $category;
$Connex->free();
?>