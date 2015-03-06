<div id="header">
    <div id="header-left">
        <map name="Map">
            <area shape="rect" coords="1,1,76,90" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
            <area shape="rect" coords="85,3,335,60" href="index.php?lang=<?php echo $_SESSION['lang']; ?>" 
                  alt="OSFAC-DMT" target="_self" />
            <area shape="rect" coords="85,65,480,85" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
        </map>
        <img src="images/template/header_left.png" alt="logo" usemap="#Map" />
    </div>
    <div id="header-right">
    </div>
</div>
<div id="top-menu">
    <ul>
        <li><button id="homeCommand" style="margin-top: -5px;"><?php echo $lang['home']; ?></button></li>
        <li><button id="aboutCommand" style="margin-top: -5px;"><?php echo $lang['about']; ?></button></li>
        <li><button id="desktopCommand" style="margin-top: -5px;"><?php echo $lang['desktop']; ?></button></li>
        <li><button id="helpCommand" style="margin-top: -5px;"><?php echo $lang['help-text']; ?></button></li>   
        <!--<li><a href="pages/desktop.php"><?php echo $lang['desktop']; ?></a></li>-->
<!--        <li><a href="pages/tutorial.php"><?php echo $lang['tutorial']; ?></a></li>
        <li><a href="pages/whatnew.php"><?php echo $lang['whatsnew']; ?></a></li>
        <li><a href="pages/faq.php"><?php echo $lang['faq']; ?></a></li>
        <li><a href="pages/help.php"><?php echo $lang['help-text']; ?></a></li>-->

        <li id="liManageCriteria" class="backgroundNone">
            <button id="manageCriteria" class="displayNone" style="margin-top: -5px;">Manage Criteria</button>
        </li>
        <li id="liSaveCriteria" class="backgroundNone">
            <button id="saveCriteria" class="displayNone" style="margin-top: -5px;">Save Criteria</button>
        </li>     

        <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;margin-left: -10px;">
            <a href="index.php?lang=fr"><img src="images/fr.gif" /> <?php echo $lang['french']; ?></a>
        </li>
        <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;margin-left: -10px;">
            <a href="index.php?lang=en"><img src="images/en.gif" /> <?php echo $lang['english']; ?></a>
        </li>
        <li style="float:right !important;">
            <button class="displayNone" id="profileCommand" style="margin-top: -5px;"><?php echo $_COOKIE["user"]; ?></button>
        </li>
        <li style="float:right !important;">
            <button id="registerCommand" style="margin-top: -5px;"><?php echo $lang['register']; ?></button>
        </li>
        <li style="float:right !important; background: none;">
            <button id="logInCommand" style="margin-top: -5px;"><?php echo $lang['login']; ?></button>
        </li>
        <li style="float:right !important;">
            <button class="displayNone" id="logOutCommand" style="margin-top: -5px;"><?php echo $lang['logout']; ?></button>
        </li>
        <li class="displayNone" style="float:right !important; background: none;">
            <button id="cartCommand" style="margin-top: -5px;">Cart</button>
        </li>
    </ul>
</div>