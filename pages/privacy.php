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
                        <a href="privacy.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['privacy-policy']; ?></a>  
                    </div>                    
                </div>
                <div style="text-align: justify;">
                    <p><strong>YOUR PERSONAL INFORMATION: WHAT WE COLLECT, AND HOW WE USE IT</strong></p>
                    <br/>
                    <p>We do not collect personal information about you when you visit this software 
                        unless you choose to provide that information to us. If you do nothing during your visit 
                        but browse through this software, read pages, or download information, the web server will 
                        automatically gather and store certain information about your visit. This information 
                        does not identify you personally. We may use such information or any information you do 
                        provide to monitor this software’s performance, and to make improvements where necessary.</p>
                    <br/><p><em>Information Stored Automatically</em></p>
                    <br/><p>By default, all web server log files capture Internet Provider (IP) addresses. 
                        We may use your IP address internally to help diagnose problems with our server, 
                        administer our software and to monitor network traffic to identify unauthorised attempts 
                        to upload or change information, or cause damage.</p>
                    <br/><p>A cookie is a small amount of information sent from a web server to your computer. 
                        We use cookies when someone logs onto our software to maintain that login, to retain login 
                        information (if requested). 
                        Any activity you engage in while you are at OSFAC-DMT may be tracked. 
                        We do not use cookies to track your Internet activity before you enter or after 
                        you leave our software.</p>
                    <br/><p><em>The Information You Provide</em></p>
                    <br/><p>If you are a registered user, you are required to provide your email address and password 
                        when you login to our website.</p>                    
                    <p>If you choose to provide us with personal information by sending an email to OSFAC, or by filling 
                        out a form with your personal information and submitting it through our website, we may use that 
                        information to provide the information, service(s) and/or product(s) you have requested.</p>
                    <br/><p>
                        Before submitting your data request, you will be asking to fill a form by providing information such as:
                        your first name, family name, sex, email, address, phone number, ... and all that information will be 
                        store in our database for statistic purposes, just to know who request those images, how often does 
                        he request satellite images, what's king of images he request the most, how did he learn about OSFAC, 
                        ... These information will help us to help you by providing you satellite images that you really need.
                    </p>

                    <br/><p>We do not collect personal information for other purposes. The information you provide is not 
                        released to any third party for commercial marketing and gains or otherwise, without your permission 
                        except where required by law to do so (such as in the investigation of fraud or other inappropriate 
                        activity).</p>
                    <br/><p><strong>EMAILS FROM OSFAC</strong></p>
                    <br/><p>OSFAC has found that attractive, graphics-rich emails are a quick and effective way to inform our 
                        registered users and subscribers of new resources, projects and events to 
                        provide them opportunities to support us. We maintain an opt-out, user-customisable subscription 
                        database of users who have requested to receive these emails. Every email provides an option for 
                        you to unsubscribe to such information.</p>
                    <br/><p><strong>SECURITY</strong></p>
                    <br/><p>To make online giving and shopping at the OSFAC website a safe and secure experience, we use a 
                        Secure Sockets Layer (SSL) capable browser. This means that any credit/debit card information you 
                        send is encrypted by your computer, and then decrypted again on our server, making it extremely 
                        difficult for others to access your private information during transmission.</p>
                    <p>While we will make reasonable efforts to store any personal information which we hold in a secure 
                        server or in secure files, and to keep this information accurate and up-to-date, the Internet is not 
                        a secure medium for the transmission of information. OSFAC cannot accept responsibility for the security 
                        of information you send to or receive from us over the Internet or for any unauthorised access to or use 
                        of that information.</p>
                    <br/><p>Unauthorised attempts to upload information to or change information on our software are strictly 
                        prohibited and may be punishable by law.</p>
                    <br/><p><strong>LINKS TO OTHER WEBSITES</strong></p>
                    <br/><p>Our software may contain links to other websites. OSFAC is not responsible for the privacy policies 
                        or the content of these other websites. Should you choose to follow a link to another website, you are 
                        subject to its privacy policy.</p>
                    <br/><p><strong>VARIATION</strong></p>
                    <br/><p>OSFAC may amend this Privacy Policy from time to time. We encourage you to visit our website regularly 
                        to stay updated of these changes.</p>
                </div>
            </div>
            <?php include_once("../template/template_pageBottom.php"); ?>
    </body>
</html>
