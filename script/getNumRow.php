<?php

header("content-type: text/html; charset=ISO-8859-1");
include_once ("mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$totalRecord = 0;
$landsat = $_POST['landsat'];
$srtm = $_POST['srtm'];
$spot = $_POST['spot'];
$aster = $_POST['aster'];
$asterdem = $_POST['asterdem'];
$other = $_POST['other'];
if ($landsat != '') {
    $Qlandsat = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $landsat . " order by dmt_image.id_image";
    $Qlandsat = str_replace('\\', '', $Qlandsat);
    $Connex->query($Qlandsat);
    $totalRecord += $Connex->num_rows();
}
if ($srtm != '') {
    $Qsrtm = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $srtm . " order by dmt_image.id_image";
    $Qsrtm = str_replace('\\', '', $Qsrtm);
    $Connex->query($Qsrtm);
    $totalRecord += $Connex->num_rows();
}
if ($spot != '') {
    $Qspot = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $spot . " order by dmt_image.id_image";
    $Qspot = str_replace('\\', '', $Qspot);
    $Connex->query($Qspot);
    $totalRecord += $Connex->num_rows();
}
if ($aster != '') {
    $Qaster = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $aster . " order by dmt_image.id_image";
    $Qaster = str_replace('\\', '', $Qaster);
    $Connex->query($Qaster);
    $totalRecord += $Connex->num_rows();
}
if ($asterdem != '') {
    $Qasterdem = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $asterdem . " order by dmt_image.id_image";
    $Qasterdem = str_replace('\\', '', $Qasterdem);
    $Connex->query($Qasterdem);
    $totalRecord += $Connex->num_rows();
}if ($other != '') {
    $Qother = "select distinct * from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category inner join 
    dmt_support on dmt_support.id_support = dmt_image.id_support where " . $other . " order by dmt_image.id_image";
    $Qother = str_replace('\\', '', $Qother);
    $Connex->query($Qother);
    $totalRecord += $Connex->num_rows();
}
echo $totalRecord;
//echo $result;
$Connex->free();
?>