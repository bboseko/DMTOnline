<?php
include('./php_includes/profile.php');
?>
<div id="download-image-form">
    <div id="download-imageFormBox" class="displayNone">
        <span id="downloadCriteria" style="color: #660000;margin-top: 2px;">
            <?php echo $lang['loading-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" />
        </span>
    </div>
</div>
<div id="dialog-myProfile" title="<?php echo $lang['my-profile']; ?>" class="requestFormBox displayNone">
    <div class="requestFormBox" style="width: 450px; margin: 5px;">
        <table>
            <tr>
                <td>
                    <label><b><?php echo $lang['firstname']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_firstname; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['familyname']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_familyname; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['othername']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_othername; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['sex']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $lang[$db_sex]; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['email']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_email; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['phone']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_phone; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['address']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_address; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['profession']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_profession; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['institution']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_institution; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['nationality']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_nationality; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['register-date']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_register_date; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><b><?php echo $lang['last-visit-date']; ?></b></label>
                </td>
                <td>
                    <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_last_visit_date; ?></label>
                </td>
            </tr>
        </table>
        <div class="requestFormBox" style="margin-top: 10px; width: 420px;margin-left: 5px;">
            <table>
                <tr>
                    <td>
                        <label><b><?php echo $lang['username']; ?></b></label>
                    </td>
                    <td>
                        <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: <?php echo $db_username; ?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><b><?php echo $lang['password']; ?></b></label>
                    </td>
                    <td>
                        <label style="margin-left: 10px; margin-top: 5px; width: 150px;">: *******************</label>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="dialog-changePassword" title="<?php echo $lang['change-password-text']; ?>" class="requestFormBox displayNone">
    <form id="change-password-Form" onsubmit="return false;" >
        <table>
            <tr>
                <td>
                    <label for ="oldPassword" style="width: 100%;"><?php echo $lang['old-password']; ?></label>
                </td>
                <td>
                    <input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="oldPassword" 
                           class="text ui-widget-content ui-corner-all" />
                </td>
            </tr>
            <tr>
                <td><label for="newPassword" style="width: 100%;"><?php echo $lang['new-password']; ?></label></td>
                <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="newPassword" 
                           class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td><label for="retypePassword" style="width: 100%;"><?php echo $lang['repeat-new-password']; ?></label></td>
                <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="retypePassword" 
                           class="text ui-widget-content ui-corner-all"/></td>
            </tr>
        </table>
        <span id="loaderChangePassword" class="displayNone" 
              style="float: right;margin-right: 20px;font-size: 11px;color: #660000;">
            <?php echo $lang['saving-your-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
        </span>
    </form>
</div>
<div id="dialog-delete-image-in-cart-confirm" title="<?php echo $lang['delete-image-in-cart']; ?>" class="displayNone">
    <p>
        <span class="ui-icon ui-icon-alert" style="text-align: justify;float:left; margin:0 7px 5px 0;">            
        </span>
        <?php echo $lang['delete-image-in-cart-message']; ?>
        <span id="loaderDeleteImageInCart" class="displayNone" 
              style="text-align: justify;float: right;margin-left: 10px;font-size: 11px;color: #660000;">
            <img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
        </span>
    </p>
</div>
<div id="dialog-delete-criteria-confirm" title="<?php echo $lang['delete-criteria']; ?>" class="displayNone">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 5px 0;">            
        </span>
        <?php echo $lang['delete-criteria-message']; ?>
        <span id="loaderDeleteCriteria" class="displayNone" 
              style="text-align: justify;float: right;margin-left: 10px;font-size: 11px;color: #660000;">
            <img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
        </span>
    </p>
</div>
<div id="dialog-confirm" title="<?php echo $lang['logout']; ?>" class="displayNone">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 5px 0;">            
        </span>
        <?php echo $lang['logout-text']; ?>
        <span id="loaderLogout" class="displayNone" 
              style="float: right;margin-left: 10px;font-size: 11px;color: #660000;">
            <img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
        </span>
    </p>
</div>
<div id="dialog-message" title="<?php echo $lang['sign-up-success']; ?>" class="requestFormBox displayNone" style="width: 400px;">
    <p style="font-size:13px;">
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <?php echo $lang['sign-up-success-message1']; ?>
    </p><br/>
    <p>
        <?php echo $lang['sign-up-success-message2']; ?>
    </p>
</div>
<div id="dialog-not-logged-in" title="<?php echo $lang['user-not-logged-in']; ?>" class="requestFormBox displayNone" style="width: 400px;">
    <p style="font-size:13px;text-align: justify;">
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
        <?php echo $lang['user-not-logged-in-message']; ?>
    </p>
</div>
<div id="dialog-dataRequestForm" title="<?php echo $lang['request-form-title']; ?>" class="displayNone">
    <div class="requestFormBox" style="margin-bottom: 1px;width: 460px;">
        <table>
            <tr>
                <td>
                    <label for="applications" style="margin-left:15px;"><?php echo $lang['request-form-usage']; ?></label><span style="color: #ff0000;">*</span>
                </td>
                <td>
                    <div id="applications" style="margin-left:15px;">
                        <label for="academic"><?php echo $lang['academic']; ?></label>
                        <input type="radio" id="academic" name="applications" value="1" checked="checked">
                        <label for="profesionnal"><?php echo $lang['professional']; ?></label>
                        <input type="radio" id="profesionnal" name="applications" value="2">
                        <label for="other"><?php echo $lang['other']; ?></label>
                        <input type="radio" id="other" name="applications" value="3">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="interestArea" style="margin-left:15px;"><?php echo $lang['interest-area']; ?></label>
                    <span style="color: #ff0000;">*</span>
                </td>
                <td>
                    <input class="text ui-widget-content ui-corner-all" 
                           style="width: 310px;margin-left:15px;margin-top: 5px;margin-bottom: 5px;" 
                           id="interestArea" type="text">
                </td>
            </tr>
        </table>
        <table>
            <tbody>

                <tr>
                    <td><label id="descriptionLabel" for="description" style="margin-left:15px;"><?php echo $lang['description-application']; ?></label><span style="color: #ff0000;">*</span></td>
                </tr>
                <tr>
                    <td>
                        <textarea class="text ui-widget-content ui-corner-all" style="margin-left:15px;margin-bottom: 5px;" id="description" name="description" rows="5" cols="68"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><label id="commentLabel" for="comment" style="margin-left:15px;"><?php echo $lang['how-about-distribution']; ?></label><span style="color: #ff0000;">*</span></td>
                </tr>
                <tr>
                    <td>
                        <textarea class="text ui-widget-content ui-corner-all" style="margin-left:15px;margin-bottom: 5px;" id="comment" name="comment" rows="5" cols="68"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <span id="loaderSaveRequester" class="displayNone" 
          style="float: right;margin-left: 10px;font-size: 11px;color: #660000;">
        <?php echo $lang['saving-your-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
    </span>
</div>
<div id="dialog-message-forgot-password" title="<?php echo $lang['password-forgotten-title']; ?>" class="requestFormBox displayNone" style="width: 400px;">
    <p style="font-size:13px;">
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <?php echo $lang['forgot-password-process-message']; ?>
    </p>
</div>
<div id="login-form">
    <form name="loginform" id="loginform" onsubmit="return false;">
        <div id="loginFormBox" class="requestFormBox displayNone" style="width: 300px;">
            <table>
                <tr>
                    <td style="width: 110px;"><label for="username" style="width: 100%;"><?php echo $lang['username']; ?></label></td>
                    <td><input style="width: 100%;margin-left: 10px; margin-top: 5px;" type="text" id="username" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td style="width: 100px;"><label for="password" style="width: 100%;"><?php echo $lang['password']; ?></label></td>
                    <td><input style="width: 100%;margin-left: 10px; margin-top: 5px;" type="password" id="password" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td>
                        <label style="width: 100%;"></label>
                    </td>
                    <td>
                        <a id="passwordForgot" style="margin-top: 5px;color: #327E04; float: right;background: none;border: none;"><?php echo $lang['password-forgot']; ?></a>
                    </td>                            
                </tr>
            </table>
            <span id="loaderConnection" class="displayNone" 
                  style="float: right;margin-right: 20px;font-size: 11px;color: #660000;">
                <?php echo $lang['connecting']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
            </span>
        </div>
    </form>
</div>
<div id="passwordForgotten-form">
    <div id="passwordForgottenFormBox" class="requestFormBox displayNone" style="width: 250px;">
        <table>
            <tr>
                <td>
                    <label for="emailPF" style="width: 100%;"><?php echo $lang['email']; ?></label>
                </td>
                <td>
                    <input style="margin-left: 10px; margin-top: 5px;width: 190px;" type="text" id="emailPF" 
                           class="text ui-widget-content ui-corner-all"/>
                    <span id="loaderPF" class="displayNone" 
                          style="float: right;margin-right: 20px;font-size: 11px;color: #660000;margin-top: 2px;">
                        <?php echo $lang['sending']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
                    </span>
                </td>
            </tr>
        </table>        
    </div>
</div>
<div id="dialog-saveCriteria" title="<?php echo $lang['save-criteria-title']; ?>" class="displayNone">
    <table>
        <tr>
            <td style="width: 200px;">
                <label for="criteria-name"><?php echo $lang['criteria-name']; ?></label><span style="color: #ff0000;">*</span>
            </td>
            <td>
                <input id="criteria-name" style="width: 200px;margin-left: 10px;" type="text" 
                       class="text ui-widget-content ui-corner-all"/> 
            </td>
        </tr>
    </table>
    <span id="loaderSaveCriteria" class="displayNone" 
          style="float: right;margin-left: 10px;font-size: 11px;color: #660000;">
        <?php echo $lang['saving-your-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
    </span>
</div>
<div id="metadata-image-form">
    <div id="metadataFormBox" class="displayNone">
        <span id="loaderMetadata" style="color: #660000;margin-top: 2px;">
            <?php echo $lang['loading-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" />
        </span>
    </div>
</div>
<div id="cart-images-form">
    <div id="cartImagesFormBox" class="displayNone">
        <span id="loaderCartImages" style="color: #660000;margin-top: 2px;">
            <?php echo $lang['loading-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" />
        </span>
    </div>
</div>
<div id="manage-Criterias-form">
    <div id="manageCriteriasFormBox" class="displayNone">
        <span id="loaderMCriteria" style="color: #660000;margin-top: 2px;">
            <?php echo $lang['loading-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" />
        </span>
    </div>
</div>
<div id="register-form-edit" title="<?php echo $lang['edit-my-profile']; ?>">
    <form name="signupform-edit" id="signupform-edit" onsubmit="return false;">
        <div id="registerFormBox-edit" class="requestFormBox displayNone" style="width: 360px;">
            <table>
                <tr>
                    <td><label for="firstname-edit" style="width: 100%;"><?php echo $lang['firstname']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_firstname; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="firstname-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="familyname-edit" style="width: 100%;"><?php echo $lang['familyname']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_familyname; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="familyname-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="othername-edit" style="width: 100%;"><?php echo $lang['othername']; ?></label></td>
                    <td><input value="<?php echo $db_othername; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="othername-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>                        
                <tr>
                    <td><label for="sex" style="width: 100%;"><?php echo $lang['sex']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td>
                        <select id="sex-edit" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                            <option value="male" <?php selectedOption($db_sex, "male") ?>><?php echo $lang['male']; ?></option>
                            <option value="female" <?php selectedOption($db_sex, "female") ?>><?php echo $lang['female']; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="address-edit" style="width: 100%;"><?php echo $lang['address']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_address; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="address-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="phone-edit" style="width: 100%;"><?php echo $lang['phone']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_phone; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="tel" id="phone-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="email-edit" style="width: 100%;"><?php echo $lang['email']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_email; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="email" id="email-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="nationality-edit" style="width: 100%;"><?php echo $lang['nationality']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td>
                        <select name="nationality" id="nationality-edit" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                            <?php include_once("./template/template_country_list_edit_" . $_SESSION['lang'] . ".php"); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="profession-edit" style="width: 100%;"><?php echo $lang['profession']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td><input value="<?php echo $db_profession; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="profession-edit" class="text ui-widget-content ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label for="institution-edit" style="width: 100%;"><?php echo $lang['institution']; ?></label> <span style="color: #ff0000;">*</span></td>
                    <td>
                        <input value="<?php echo $db_institution; ?>" style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="institution-edit" class="text ui-widget-content ui-corner-all"/>
                        <input id="id-user-edit" value="<?php echo $db_id; ?>" type="hidden"/>
                    </td>
                </tr>
            </table>  
<!--            <span style="color: #ff0000;">*</span>
            <span style="font-size: 11px;"> <?php echo $lang['required-field']; ?></span>-->
        </div>
        <span id="loaderRegistration-edit" class="displayNone" style="float: right;margin-right: 20px;font-size: 11px;color: #660000;">
            <?php echo $lang['saving-your-data']; ?><img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
        </span>

    </form>
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
                <?php echo $lang['saving-your-data']; ?> <img alt="<?php echo $lang['loading']; ?>" src="./images/loader.gif" /> 
            </span>
        </div>        
    </form>
</div>
<div id="menufooter">
    <ul>
        <li><a href="pages/terms.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['terms-of-use']; ?></a></li>
        <li><a href="pages/privacy.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['privacy-policy']; ?></a></li>
        <li><a href="pages/contact.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['contact-text']; ?></a></li>
        <li><a href="pages/help.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['help-text']; ?></a></li>
    </ul>
    <div id="copyright">
        <p><strong>OSFAC-Data Management Tool</strong>. Email: <a href="mailto:dmt@osfac.net">dmt@osfac.net</a></p>
        <p>Copyright © 2012 - <?php echo date("Y") ?> OSFAC. <?php echo $lang['all-rights-reserved']; ?></p>
        <p style="color: #000000;"><em><?php echo $lang['powered-by-text']; ?></em></p>
    </div>
</div>
