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
        <li><a href="../pages/about.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['about']; ?></a></li>                    
        <li><a href="../pages/desktop.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['desktop']; ?></a></li>
        <li><a href="../pages/tutorial.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['tutorial']; ?></a></li>
        <li><a href="../pages/whatnew.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['whatsnew']; ?></a></li>
        <li><a href="../pages/faq.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['faq']; ?></a></li>
        <li><a href="../pages/help.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['help-text']; ?></a></li>

        <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;">
            <a href="?lang=fr"><img src="../images/fr.gif" /> <?php echo $lang['french']; ?></a>
        </li>
        <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;">
            <a href="?lang=en"><img src="../images/en.gif" /> <?php echo $lang['english']; ?></a>
        </li>
    </ul>
</div>