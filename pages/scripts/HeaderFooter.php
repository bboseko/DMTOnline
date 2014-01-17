<?php

function headerPage() {
    ?>
    <div id="header">
        <div id="header-left"> 
            <map name="Map">
                <area shape="rect" coords="1,1,76,90" href="http://www.osfac.net/" alt="OSFAC" target="_self" />
                <area shape="rect" coords="85,3,335,60" href="../index.php" alt="OSFAC-DMT" target="_self" />
                <area shape="rect" coords="85,65,480,85" href="http://www.osfac.net/" alt="OSFAC" target="_self" />
            </map>
            <img src="../images/template/header_left.png" alt="logo" usemap="#Map" />
        </div>
        <div id="header-right">                    
        </div>
    </div>
    <div id="top-menu">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.php">About</a></li>                    
            <li><a href="desktop.php">OSFAC-DMT Desktop</a></li>
            <li><a href="tutorial.php">Tutorial</a></li>
            <li><a href="whatnew.php">What's New?</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="help.php">Help</a></li>
        </ul>
    </div>
    <?php
}

function footerPage() {
    ?><div id="menufooter">
        <ul>
            <li><a href="terms.php">Terms of use</a></li>
            <li><a href="privacy.php">Privacy policy</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="help.php">Help</a></li>
        </ul>
        <div id="copyright">
            <p><strong>OSFAC-Data Management Tool</strong>. Email: <a href="mailto:dmt@osfac.net">dmt@osfac.net</a></p>
            <p>Copyright © <?php echo date("Y") ?> OSFAC. All Rights Reserved.</p>
            <p style="color: #000000;"><em>Powered by OSFAC Team</em></p>
        </div>                    
    </div>
<?php }
?>
