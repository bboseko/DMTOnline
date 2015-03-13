<?php
include ("../languages/include_lang_file.php");
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if ($msg == "activation_failure") {
    $message = $lang['activation-failure'];
} else if ($msg == "activation_success") {
    $message = $lang['activation-success1'] . "../index.php?lang=" . $_SESSION['lang'] . $lang['activation-success2'];
} else if ($msg == "password_reset_success") {
    $message = $lang['password-reset-success1'] . "../index.php?lang=" . $_SESSION['lang'] . $lang['password-reset-success2'];
} else {
    $message = $msg;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" ></meta>
        <title><?php echo $lang['app-title'];?></title>
        <meta content="Request satellite images and products through OSFAC" name="description"></meta>
        <meta content="Observatoire Satellital des Forêts d'Afrique Centrale,OSFAC,satellite images,congo basin,DMT,osfacdmt,OSFAC-DMT,satellite data,
              central africa,comifac,cartographic,cartography,geographic,geography,geospatial data,geographic information system,GIS,mapping,maps,
              aerial photographs,satellite imagery,data,aster,landsat,srtm,mosaic,aster gdem,spot,remote sensing" name="keywords"></meta>
        <meta content="OSFAC - Observatoire Satellital des Forêts d'Afrique Centrale" name="author"></meta>
        <meta content="OSFAC - Observatoire Satellital des Forêts d'Afrique Centrale" name="publisher"></meta>
        <meta content="NGO" name="classification"></meta>
        <meta content="ALL" name="robots"></meta>
        <meta content="Global" name="distribution"></meta>
        <meta content="Safe For Kids" name="rating"></meta>
        <meta content="None" name="copyright"></meta>
        <meta content="English" name="language"></meta>
        <meta content="NGO" name="doc-type"></meta>
        <meta content="Living Document" name="doc-class"></meta>
        <meta content="Public Domain" name="doc-rights"></meta>
        <link type="image/vnd.microsoft.icon" rel="shortcut icon" href="../images/favicon.ico"></link>
        <link type="text/css" href="../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" ></link>
        <link type="text/css" href="../css/custom.css" rel="stylesheet"></link>

        <script type="text/javascript" src="../languages/<?php echo $_SESSION['lang']; ?>/lang.<?php echo $_SESSION['lang']; ?>.js"></script>
    </head>
    <body>
        <div id="container" class="clearfix">
            <div id="header">
                <div id="header-left">
                    <map name="Map">
                        <area shape="rect" coords="1,1,76,90" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
                        <area shape="rect" coords="85,3,335,60" href="../index.php?lang=<?php echo $_SESSION['lang']; ?>" 
                              alt="OSFAC-DMT" target="_self" />
                        <area shape="rect" coords="85,65,480,85" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
                    </map>
                    <img src="../images/template/header_left.png" alt="logo" usemap="#Map" />
                </div>
                <div id="header-right">
                </div>
            </div>
            <div id="top-menu">
                <ul>
                    <li style="font-weight: bold;"><a href="../index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['back-to-osfac-dmt']; ?></a></li>
                </ul>
            </div>
            <div class="content">
                <p align="justify">
                    <div style="font-size: 14px;"><?php echo $message; ?></div>
                </p>
            </div> 
            <?php include_once("../template/template_pageBottom.php"); ?>
        </div>       
    </body>
</html>