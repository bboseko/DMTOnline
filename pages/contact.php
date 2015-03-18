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
        <script type="text/javascript" src="../js/include/custom.js"></script>
        <script type="text/javascript" src="../languages/<?php echo $_SESSION['lang']; ?>/lang.<?php echo $_SESSION['lang']; ?>.js"></script>
    </head>
    <body>
        <div id="container" class="clearfix">
            <?php include_once("../template/template_pageTop.php"); ?>
            <div class="content">
                <div class="pageHeader">
                    <div style="margin-left: 30px;padding-top: 6px;" >
                        <a href="contact.php?lang=<?php echo $_SESSION['lang']; ?>">Contact</a>  
                    </div>                    
                </div>
                <form action="" method="">
                    <div style="padding: 10px;">
                        <div>
                            <label for="full_nameContact"><?php echo $lang['contact-full-name']; ?><span style="color: #ff0000;">*</span></label>
                        </div>                        
                        <div>
                            <input id="full_nameContact" type="text" style = "width:294px" /> 
                        </div>
                        <div id="full_nameContactError" class="errorMessageInFrom"></div>
                        <div style="margin-top: 10px;">
                            <label for="emailContact"><?php echo $lang['contact-email-address']; ?><span style="color: #ff0000;">*</span></label>
                        </div>                        
                        <div>
                            <input id="emailContact" type="email" style = "width:294px" />
                        </div>
                        <div id="emailContactError" class="errorMessageInFrom"></div>
                        <div style="margin-top: 10px;">
                            <label for="messageContact"><?php echo $lang['contact-your-message']; ?><span style="color: #ff0000;">*</span></label>
                        </div>
                        <div>
                            <textarea id="messageContact" style="margin-bottom: 5px;" cols="70" rows="17"></textarea>
                        </div>
                        <div id="messageContactError" class="errorMessageInFrom"></div>
                        <div>
                            <span style="color: #ff0000;">*</span>
                            <span style="font-size: 10px;"> <?php echo $lang['required-field']; ?></span> 
                        </div>
                        <div>
                            <input style="margin-top: 10px;" type="button" id="submitContact" class="button" value="<?php echo $lang['contact-send-message']; ?>" /> 
                            <input style="margin-top: 10px;" type="button" id="cancelContact" class="button" value="<?php echo $lang['contact-cancel-message']; ?>" />
                        </div>   
                    </div>                                        
                </form>
            </div>
        </div>
        <?php include_once("../template/template_pageBottom.php"); ?>
    </body>
</html>
