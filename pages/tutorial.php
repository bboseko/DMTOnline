<?php
include("../languages/langConfig.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" ></meta>
        <title><?php echo $lang['app-title']; ?></title>
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
        <link type="text/css" href="../css/sticky.full.css" rel="stylesheet"></link>

        <script type="text/javascript" src="../js/library/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="../js/library/jquery-ui.js"></script>
        <script type="text/javascript" src="../languages/<?php echo $_SESSION['lang']; ?>/lang.<?php echo $_SESSION['lang']; ?>.js"></script>
    </head>
    <body>
        <div id="container" class="clearfix">
            <?php include_once("../template/template_pageTop.php"); ?>
            <div class="content">
                <div class="pageHeader">
                    <div style="margin-left: 30px;padding-top: 6px;" >
                        <a href="tutorial.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['tutorial-title']; ?></a>  
                    </div>                    
                </div>
                <div style="font-size: 13px;text-align: justify;border:1px solid #71b24a;margin: 20px;padding: 20px;color: #000000;border-radius: 5px;">
                    <span style="font-weight: bold;">
                        <?php echo $lang['tutorial-message1']; ?>
                    </span>
                    <?php echo $lang['tutorial-message2']; ?>
                </div>
            </div>
        </div>
        <?php include_once("../template/template_pageBottom.php"); ?>
    </body>
</html>
