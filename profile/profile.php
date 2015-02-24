<?php
include("../languages/langConfig.php");
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
        <script type="text/javascript" src="../js/library/jquery-ui.js"></script>

        <script type="text/javascript" src="../js/include/custom.js"></script>
        <script type="text/javascript" src="../languages/<?php echo $_SESSION['lang']; ?>/lang.<?php echo $_SESSION['lang']; ?>.js"></script>
        <script>
            $(function () {
                $("#menu").menu({
                    items: "> :not(.ui-widget-header)"
                });
            });
        </script>
        <style>
            .ui-menu { width: 200px; }
            .ui-widget-header { padding: 0.2em; }
        </style>
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
                    <li><button id="homeCommandProfile" style="margin-top: -5px;"><?php echo $lang['home']; ?></button></li>
                </ul>
            </div>
            <div class="content">
                <div id="left-profile">
                    <ul id="menu">
                        <li class="ui-widget-header">Category 1</li>
                        <li>Option 1</li>
                        <li>Option 2</li>
                        <li>Option 3</li>
                        <li class="ui-widget-header">Category 2</li>    
                        <li>Option 4</li>
                        <li>Option 5</li>
                        <li>Option 6</li>
                    </ul>
                </div>
                <div id="right-profile">

                </div>                
            </div> 
            <?php include_once("../template/template_pageBottom.php"); ?>
        </div>       
    </body>
</html>