<?php
include("../languages/langConfig.php");
?>
<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if ($msg == "activation_failure") {
    $message = '<div style="margin-bottom: 10px;font-size: 16px;">Activation Error</div> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
} else if ($msg == "activation_success") {
    $message = '<div style="margin-bottom: 10px;font-size: 16px;">Activation Success</div> Your account is now activated. <a href="../index.php">Click here to go home and login</a>';
} else if ($msg == "password_reset_success") {
    $message = '<div style="margin-bottom: 10px;font-size: 16px;">Password reset Success</div> Your password is now reset. <a href="../index.php">Click here to go home and login</a>';
} else {
    $message = $msg;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" ></meta>
        <title>OSFAC-DMT Online 2.0.1</title>
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

        <script type="text/javascript" src="../js/library/jquery-1.11.2.min.js"></script>
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
                    <li><a href="../index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['home']; ?></a></li>
                </ul>
            </div>
            <div class="content">
                <p align="justify">
                    <div style="font-size: 14px;"><?php echo $message; ?></div>
                </p>
            </div> 
            <?php include_once("../template/index_pageBottom.php"); ?>
        </div>       
    </body>
</html>