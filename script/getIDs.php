<?php

include_once ("mysqlclass.php");
$Connex = new db(0);
$Connex->connect();
$result = '';

$landsat = $_POST['landsat'];
$srtm = $_POST['srtm'];
$spot = $_POST['spot'];
$aster = $_POST['aster'];
$asterdem = $_POST['asterdem'];
$other = $_POST['other'];

if ($landsat != '') {
    $Qlandsat = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $landsat;
    $Qlandsat = str_replace('\\', '', $Qlandsat);
    $Connex->query($Qlandsat);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}
if ($aster != '') {
    $Qaster = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $aster;
    $Qaster = str_replace('\\', '', $Qaster);
    $Connex->query($Qaster);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}
if ($asterdem != '') {
    $Qasterdem = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $asterdem;
    $Qasterdem = str_replace('\\', '', $Qasterdem);
    $Connex->query($Qasterdem);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}
if ($srtm != '') {
    $Qsrtm = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $srtm;
    $Qsrtm = str_replace('\\', '', $Qsrtm);
    $Connex->query($Qsrtm);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}
if ($spot != '') {
    $Qspot = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $spot;
    $Qspot = str_replace('\\', '', $Qspot);
    $Connex->query($Qspot);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}
if ($other != '') {
    $Qother = "select distinct id_image from dmt_category inner join dmt_image on dmt_category.id_category = dmt_image.id_category 
        where " . $other;
    $Qother = str_replace('\\', '', $Qother);
    $Connex->query($Qother);
    while ($Connex->next_record()) {
        $id = $Connex->f("id_image");
        $result.= $id . ";";
    }
}

if ($result != '') {
    $result{ strlen($result) - 1 } = '';
    echo $result;
}
//echo $result;
$Connex->free();
