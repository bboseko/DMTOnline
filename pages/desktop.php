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
        <link type="text/css" href="../css/custom.css" rel="stylesheet"></link>
        <script type="text/javascript" src="../js/library/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#emailDownload').blur(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('errorInForm');
                        $('#emailDownloadLabel').addClass('errorMessageInFrom');
                        $('#DownloadNow').addClass('disabled');
                    } else if (!isValidEmailAddress($(this).val())) {
                        $(this).addClass('errorInForm');
                        $('#emailDownloadLabel').addClass('errorMessageInFrom');
                        $('#DownloadNow').addClass('disabled');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#emailDownloadLabel').removeClass('errorMessageInFrom');
                        $('#DownloadNow').removeClass('disabled');
                    }
                });
                $('#DownloadNow').click(function() {
                    var emailD = $('#emailDownload').val();
                    if ($(this).hasClass('disabled')) {
                        if (emailD === '') {
                            $('#emailDownload').addClass('errorInForm');
                            $('#emailDownloadLabel').addClass('errorMessageInFrom');
                        } else if (!isValidEmailAddress(emailD)) {
                            $('#emailDownload').addClass('errorInForm');
                            $('#emailDownloadLabel').addClass('errorMessageInFrom');
                        }
                        return;
                    } else {
                        $('#emailDownloadError').slideDown().html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="" src="../images/loader.gif" /><span> Sending your request ...</span>');
                        $.ajax({
                            type: "POST",
                            url: "scripts/saveDownload.php",
                            data: '&email=' + emailD,
                            success: function(response) {
                                document.location.href = 'http://dmt.osfac.net/pages/download.php';
                            }
                        });
                    }
                });
                function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                    return pattern.test(emailAddress);
                }
            });
        </script>
    </head>
    <body>
        <?php include("./scripts/HeaderFooter.php"); ?>
        <?php headerPage(); ?>
        <div id="container" class="clearfix">
            <div class="content">
                <div class="pageHeader">
                    <div style="margin-left: 30px;padding-top: 6px;" >
                        <a href="desktop.php">OSFAC-DMT Desktop</a>  
                    </div>                    
                </div>
                <div style="float: left;width: 64%;padding: 5px;text-align: justify;">
                    <p style="text-align: justify;"><img style="margin-top: 3px;margin-right: 10px; float: left;" src="../images/dmt_desktop.JPG" alt="dmt desktop" width="200" height="128" /><strong>OSFAC-DMT Desktop</strong> is a tool which allows you to make and manage requests for satellite images to OSFAC interactively. In other words, it allows you to post a request for satellite images remotely (from your computer) and the request is automatically sent to the administrator of OSFAC's database via Internet.</p>
                    <p style="text-align: justify;"><strong>OSFAC-DMT Desktop</strong> allows you to view and manipulate spatial data easily and an intuitive manner. It allows you to view but also edit, save and analyze spatial data. It handles vector data but also allows to read Raster. <em>It should be noted that this tool does not allow you to download satellite images</em>.</p>
                    <br/>
                    <p style="text-align: justify;">This software was developed in Java (JDK 1.7 and Netbeans 7.2) and works with a MySQL database, the geographic part is based on JUMP Pilot Project as a platform.
                        OSFAC-DMT Desktop is available in 2 versions:</p>
                    <div style="padding: 20px;">
                        <ul type="circle">
                            <li><strong>OSFAC-DMT Desktop Lite</strong> (98 MB): See the right side for download;</li>
                            <li><strong>OSFAC-DMT Desktop Full</strong>: Available for OSFAC team only.</li>
                        </ul> 
                    </div>
                    <div>
                        <p>
                            This software offers two search options: <em>Geographic Search and Query Search</em>.
                        </p>
                    </div>
                    <h3 style="margin: 10px 0;color: #000000;font-size: 14px;">Geographic Search</h3>
                    <p style="text-align: justify;">
                        <img style="margin-right: 10px; float: left;" src="../images/image1.jpg" alt="image1" width="150" height="84" />
                        This search option allows user to search for satellite images that intersected the selected features and display 
                        the result in a new window.</p><br/>
                    <p style="text-align: justify;">Features to be Selected can be:</p>
                    <div style="padding: 10px 20px;">
                        <ul type="circle">
                            <li>A feature of an existing layer ;</li>
                            <li>A feature designed (point, line or polygon) using the editing tools ;</li>
                            <li>A geometric object from a WKT file (Well Known Text).</li>
                        </ul> 
                    </div>
                    <img style="margin-left: 10px; float: right;" src="../images/image2.jpg" alt="image2" width=150" height="93" />
                    <p style="text-align: justify;">Once the selection is made, Search button displays satellite images that intersected 
                        the selection and user can filter the result and submit his data request.</p>                       

                    <h3 style="margin: 10px 0;color: #000000;font-size: 14px;">Query Search</h3>
                    <img style="margin-right: 10px;margin-bottom: 5px; float: left;" src="../images/image3.jpg" alt="image3" width="150" height="89" />
                    <p style="text-align: justify;">This search option allows user to search for satellite images by constructing a query 
                        on selecting criterias in the dropdown list.<br/>There are 2 types of criteria: 
                        The main criteria and geographic criteria.</p><br/>
                    <img style="margin-left: 10px; float: right;" src="../images/image4.jpg" alt="image4" width="150" height="88" />
                    <p style="text-align: justify;">
                        The interface "Geographic criteria" allows you to define search criteria based on geometry which can be: 
                        <em>point</em>, <em>line</em> or <em>polygon</em>. Coordinate of your area of interest 
                        <span style="color: #ff0033;"><em>must be geographic</em></span>. 
                        User has the ability to import different values of Latitude and Longitude from an Excel file.</p>
                </div>
                <div style="width: 240px;padding: 5px;margin-left:66%;clear: none;height: 900px;">
                    <div style="border: 1px solid #cccccc;border-radius: 5px;padding: 10px;">
                        <div style="font-size: 16px;font-weight: bold;color:#000000;margin: 10px 0;text-align:center;">
                            Download OSFAC-DMT
                        </div>
                        <div style="background: url(../images/winxp_icon.gif) no-repeat top left;">
                            <div style="margin-left: 30px;">
                                OSFAC-DMT Desktop lite 2.0.1 for Windows XP, Vista or Windows 7
                            </div>
                        </div>
                        <div style="margin: 10px;">
                            <input type="checkbox" id="checkBoxUpdate" style="margin-bottom: 2px;" checked /> 
                            <div style="display: block !important;margin-left: 15px;margin-top: -16px !important;line-height: 1.25em;">
                                <label for="checkBoxUpdate"> 
                                    Keep me up to date with OSFAC news, software updates, and the latest information 
                                    on products and services.
                                </label> 
                            </div>                           
                        </div>
                        <div style="margin: 10px;margin-left: 15px;">
                            <label id="emailDownloadLabel" for="emailDownload" style="font-weight: bold;">Email Address</label>
                            <input type="text" id="emailDownload" style="width: 180px;" />
                        </div>
                        <div style="text-align: center;">
                            <input class="ExtraButton disabled" alt="Download" id="DownloadNow" title="Download Now" type="button" 
                                   value="Download Now" style="width: 180px;height: 35px;font-size: 14px;" />   
                        </div>
                        <h3 style="margin: 15px 0;text-align: center;">Windows System Requirements</h3>
                        <div id="winsysreq" style="margin:5px 25px;font-size: 12px;">

                            <ul class="square">
                                <li>PC with a 1GHz Intel or AMD processor and 512MB of RAM</li>
                                <li>Windows XP Service Pack 2 or later, 32/64-bit editions of Windows Vista, Windows 7, or Windows 8</li>
                                <li>286MB of available disk space</li>
                                <li>Broadband Internet connection to send your request to OSFAC</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        <?php footerPage(); ?>
    </body>
</html>
