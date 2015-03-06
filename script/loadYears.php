<?php

include_once ("mysqlclass.php");
$categories = $_POST['categories'];
$result = '';
$sql = '';
$Connex = new db(0);
$Connex->connect();
if ($categories == '(all)') {
    $sql = 'SELECT distinct year(date) as year FROM dmt_image order by year';
} else {
    $catTab = split(', ', $categories);
    $cat = '';
    for ($i = 0; $i < count($catTab); $i++) {
        $cat .= '\'' . $catTab[$i] . '\',';
    }
    $categories = substr($cat, 0, -1);
    $sql = 'SELECT distinct year(date) as year FROM dmt_image where id_category in 
        (select id_category from dmt_category where category_name in (' . $categories . ')) order by year';
}
$Connex->query($sql);
if ($Connex->num_rows() >= 1) {
    while ($Connex->next_record()) {
        $id = $Connex->f("year");
        $value = $Connex->f("year");
        $result.= "<option value=$id>$value</option>";
    }
} else {
    $result = null;
}
echo $result;
$Connex->free();
?>