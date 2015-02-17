<div id="login-form">
    <div id="loginFormBox" class="requestFormBox displayNone" style="width: 300px;">
        <table>
            <tr>
                <td><label for="username" style="width: 100%;"><?php echo $lang['username']; ?></label></td>
                <td><input style="width: 100%;margin-left: 10px; margin-top: 5px;" type="text" id="username" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td><label for="password" style="width: 100%;"><?php echo $lang['password']; ?></label></td>
                <td><input style="width: 100%;margin-left: 10px; margin-top: 5px;" type="password" id="password" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td><label style="width: 100%;"></label></td>
                <td>
                    <input type="checkbox" style="margin-left: 10px; margin-top: 5px;" id="rememberMe"/>
                    <label for="rememberMe" style="width: 100%;"><?php echo $lang['remember-me']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label style="width: 100%;"></label>
                </td>
                <td>
                    <a style="color: #327E04; float: right;"><?php echo $lang['password-forgot']; ?></a>
                </td>                            
            </tr>
        </table>
    </div>
</div>
<div id="passwordForgotten-form">
    <div id="passwordForgottenFormBox" class="requestFormBox displayNone" style="width: 300px;">
        <table>
            <tr>
                <td><label for="emailPF" style="width: 100%;"><?php echo $lang['email']; ?></label></td>
                <td><input style="margin-left: 10px; margin-top: 5px;" type="text" id="emailPF" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
        </table>
    </div>
</div>
<div id="loading-form">
    <div id="loadingFormBox" class="displayNone">
        <img src="../images/loader.gif" alt="loading" />
    </div>
</div>
<div id="register-form">
    <form name="signupform" id="signupform" onsubmit="return false;">
        <div id="registerFormBox" class="requestFormBox displayNone" style="width: 360px;">
            <table>
                <tr>
                    <td><label for="firstname" style="width: 100%;"><?php echo $lang['firstname']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="firstname" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="familyname" style="width: 100%;"><?php echo $lang['familyname']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="familyname" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="othername" style="width: 100%;"><?php echo $lang['othername']; ?></label></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="othername" class="text ui-widget-content ui-corner-all"/></td>
                </tr>                        
                <tr>
                    <td><label for="sex" style="width: 100%;"><?php echo $lang['sex']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td>
                        <select id="sex" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                            <option value="male"><?php echo $lang['male']; ?></option>
                            <option value="female"><?php echo $lang['female']; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="address" style="width: 100%;"><?php echo $lang['address']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="address" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="phone" style="width: 100%;"><?php echo $lang['phone']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="tel" id="phone" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="email" style="width: 100%;"><?php echo $lang['email']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="email" id="email" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="nationality" style="width: 100%;"><?php echo $lang['nationality']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td>
                        <select name="nationality" id="nationality" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                            <?php include_once("./template/template_country_list_" . $_SESSION['lang'] . ".php"); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="profession" style="width: 100%;"><?php echo $lang['profession']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="profession" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="institution" style="width: 100%;"><?php echo $lang['institution']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="institution" class="text ui-widget-content ui-corner-all"/></td>
                </tr>                        
            </table>
            <div class="requestFormBox" style="width: 310px; margin-top: 10px; margin-left: 15px;">
                <table>
                    <tr>
                        <td>
                            <label for="usernameRegister" style="width: 100%;"><?php echo $lang['username']; ?></label> <span style="color: #ff0000;">*</span>
                        </td>
                        <td>
                            <input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="text" id="usernameRegister" 
                                   class="text ui-widget-content ui-corner-all" onblur="checkusername()" onkeyup="restrict('usernameRegister')"/>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="passwordRegister" style="width: 100%;"><?php echo $lang['password']; ?></label> <span style="color: #ff0000;">*</span></td>
                        <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="passwordRegister" class="text ui-widget-content ui-corner-all"/></td>
                    </tr>
                    <tr>
                        <td><label for="repeatPasswordRegister" style="width: 100%;"><?php echo $lang['repeat-password']; ?></label> <span style="color: #ff0000;">*</span></td>
                        <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="repeatPasswordRegister" class="text ui-widget-content ui-corner-all"/></td>
                    </tr>
                </table>
            </div>
            <span style="color: #ff0000;">*</span>
            <span style="font-size: 11px;"> <?php echo $lang['required-field']; ?></span>
            <span id="loaderRegistration" class="displayNone" style="float: right;margin-right: 20px;font-size: 11px;color: #660000;">
                Saving your data ... <img alt="loading" src="./images/loader.gif" /> 
            </span>
        </div>        
    </form>
</div>
<div id="menufooter">
    <ul>
        <li><a href="../pages/terms.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['terms-of-use']; ?></a></li>
        <li><a href="../pages/privacy.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['privacy-policy']; ?></a></li>
        <li><a href="../pages/contact.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['contact-text']; ?></a></li>
        <li><a href="../pages/help.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['help-text']; ?></a></li>
    </ul>
    <div id="copyright">
        <p><strong>OSFAC-Data Management Tool</strong>. Email: <a href="mailto:dmt@osfac.net">dmt@osfac.net</a></p>
        <p>Copyright © 2012 - <?php echo date("Y") ?> OSFAC. <?php echo $lang['all-rights-reserved']; ?></p>
        <p style="color: #000000;"><em><?php echo $lang['powered-by-text']; ?></em></p>
    </div>
</div>