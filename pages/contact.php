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
                $('#full_nameContact').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#full_nameContactError').html('Full name is required').slideDown(500);
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#full_nameContactError').html('').slideUp(500);
                    }
                });
                $('#emailContact').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#emailContactError').html('Email address is required').slideDown(500);
                    } else if (!isValidEmailAddress($(this).val())) {
                        $(this).addClass('errorInForm');
                        $('#emailContactError').html('This email address is not valid ...').slideDown(500);
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#emailContactError').html('').slideUp(500);
                    }
                });
                $('#messageContact').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#messageContactError').html('Your message is required').slideDown(500);
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#messageContactError').html('').slideUp(500);
                    }
                });
                $('#submitContact').click(function() {
                    var full_name = $('#full_nameContact').val();
                    var email = $('#emailContact').val();
                    var message = $('#messageContact').val();
                    if (full_name != '' && isValidEmailAddress(email) && message != '' &&
                            !$('#full_nameContact').hasClass('errorInForm') &&
                            !$('#emailContact').hasClass('errorInForm') &&
                            !$('#messageContact').hasClass('errorInForm')) {
                        var items = 'full_name=' + full_name + '&email=' + email + '&message=' + message;
                        $.ajax({
                            type: "POST",
                            url: "scripts/email_script.php",
                            data: items,
                            success: function(response) {
                                alert(response);
                                document.location.href = '../index.php';
                            }
                        });
                    } else {
                        $('#messageContactError').slideDown(500).html('Please fill all required fields with valid information ...');
                    }
                });
                function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                    return pattern.test(emailAddress);
                }
                $('#cancelContact').click(function() {
                    document.location.href = '../index.php';
                });
            });
        </script>

    </head>
    <body>
        <?php include("./scripts/HeaderFooter.php"); ?>
        <div id="container" class="clearfix">
            <?php headerPage(); ?>
            <div class="content">
                <div class="pageHeader">
                    <div style="margin-left: 30px;padding-top: 6px;" >
                        <a href="contact.php">Contact</a>  
                    </div>                    
                </div>
                <form action="" method="">
                    <div style="padding: 10px;">
                        <div>
                            <label for="full_nameContact">Full Name<span style="color: #ff0000;">*</span></label>
                        </div>                        
                        <div>
                            <input id="full_nameContact" type="text" style = "width:294px" /> 
                        </div>
                        <div id="full_nameContactError" class="errorMessageInFrom"></div>
                        <div style="margin-top: 10px;">
                            <label for="emailContact">Email Address<span style="color: #ff0000;">*</span></label>
                        </div>                        
                        <div>
                            <input id="emailContact" type="email" style = "width:294px" />
                        </div>
                        <div id="emailContactError" class="errorMessageInFrom"></div>
                        <div style="margin-top: 10px;">
                            <label for="messageContact">Your Message<span style="color: #ff0000;">*</span></label>
                        </div>
                        <div>
                            <textarea id="messageContact" style="margin-bottom: 5px;" cols="70" rows="17"></textarea>
                        </div>
                        <div id="messageContactError" class="errorMessageInFrom"></div>
                        <div>
                            <span style="color: #ff0000;">*</span>
                            <span style="font-size: 10px;"> Required Field</span> 
                        </div>
                        <div>
                            <input style="margin-top: 10px;" type="button" id="submitContact" class="button" value="Send Message" /> 
                            <input style="margin-top: 10px;" type="button" id="cancelContact" class="button" value="Cancel" />
                        </div>   
                    </div>                                        
                </form>
            </div>
            <?php footerPage(); ?>
        </div>
    </body>
</html>
