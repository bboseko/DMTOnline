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
                var idss = window.location.search.substring(1);
                $('#firstname').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#firstnameLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#firstnameLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#familyname').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#familynameLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#familynameLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#sex').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#sexLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#sexLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#email').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#emailLabel').addClass('errorMessageInFrom');
                    } else if (!isValidEmailAddress($(this).val())) {
                        $(this).addClass('errorInForm');
                        $('#emailLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#emailLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#nationality').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#nationalityLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#nationalityLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#phone').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#phoneLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#phoneLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#address').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#addressLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#addressLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#profession').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#professionLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#professionLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#institution').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#institutionLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#institutionLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#applications').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#applicationsLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#applicationsLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#description').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#descriptionLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#descriptionLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#interest').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#interestLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#interestLabel').removeClass('errorMessageInFrom');
                    }
                });
                $('#comment').blur(function() {
                    if ($(this).val() == '') {
                        $(this).addClass('errorInForm');
                        $('#commentLabel').addClass('errorMessageInFrom');
                    } else {
                        $(this).removeClass('errorInForm');
                        $('#commentLabel').removeClass('errorMessageInFrom');
                    }
                });

                $('#submitRequest').click(function() {
                    var firstname = $('#firstname').val();
                    var familyname = $('#familyname').val();
                    var othername = $('#othername').val();
                    var sex = $('#sex').val();
                    var email = $('#email').val();
                    var nationality = $('#nationality').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var profession = $('#profession').val();
                    var institution = $('#institution').val();
                    var applications = $('#applications').val();
                    var description = $('#description').val();
                    var interest = $('#interest').val();
                    var comment = $('#comment').val();

                    if (firstname != '' && familyname != '' && sex != '' && isValidEmailAddress(email) && nationality != ''
                            && phone != '' && address != '' && profession != '' && institution != '' && applications != ''
                            && description != '' && interest != '' && comment != '' &&
                            !$('#firstname').hasClass('errorInForm') &&
                            !$('#familyname').hasClass('errorInForm') &&
                            !$('#sex').hasClass('errorInForm') &&
                            !$('#email').hasClass('errorInForm') &&
                            !$('#nationality').hasClass('errorInForm') &&
                            !$('#phone').hasClass('errorInForm') &&
                            !$('#address').hasClass('errorInForm') &&
                            !$('#profession').hasClass('errorInForm') &&
                            !$('#institution').hasClass('errorInForm') &&
                            !$('#applications').hasClass('errorInForm') &&
                            !$('#description').hasClass('errorInForm') &&
                            !$('#interest').hasClass('errorInForm') &&
                            !$('#comment').hasClass('errorInForm')) {
                        var data = 'idss=' + idss + '&firstname=' + firstname + '&familyname=' + familyname + '&othername=' + othername
                                + '&sex=' + sex
                                + '&email=' + email + '&nationality=' + nationality + '&phone=' + phone + '&address=' + address
                                + '&profession=' + profession + '&institution=' + institution + '&applications=' + applications
                                + '&description=' + description + '&interest=' + interest + '&comment=' + comment;
                        $('#commentError').slideDown().html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="loading" src="../images/loader.gif" /><span> Submitting your data request ...</span>');
                        $.ajax({
                            type: "POST",
                            url: "../script/saveRequest.php",
                            data: data,
                            success: function(response) {
                                $('#commentError').html('').slideUp(500);
                                alert(response);
                                document.location.href = '../index.php';
                            }
                        });
                    }
                    else {
                        if ($('#firstname').val() == '') {
                            $('#firstname').addClass('errorInForm');
                            $('#firstnameLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#firstname').removeClass('errorInForm');
                            $('#firstnameLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#familyname').val() == '') {
                            $('#familyname').addClass('errorInForm');
                            $('#familynameLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#familyname').removeClass('errorInForm');
                            $('#familynameLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#sex').val() == '') {
                            $('#sex').addClass('errorInForm');
                            $('#sexLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#sex').removeClass('errorInForm');
                            $('#sexLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#email').val() == '') {
                            $('#email').addClass('errorInForm');
                            $('#emailLabel').addClass('errorMessageInFrom');
                        } else if (!isValidEmailAddress($('#email').val())) {
                            $('#email').addClass('errorInForm');
                            $('#emailLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#email').removeClass('errorInForm');
                            $('#emailLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#nationality').val() == '') {
                            $('#nationality').addClass('errorInForm');
                            $('#nationalityLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#nationality').removeClass('errorInForm');
                            $('#nationalityLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#phone').val() == '') {
                            $('#phone').addClass('errorInForm');
                            $('#phoneLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#phone').removeClass('errorInForm');
                            $('#phoneLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#address').val() == '') {
                            $('#address').addClass('errorInForm');
                            $('#addressLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#address').removeClass('errorInForm');
                            $('#addressLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#profession').val() == '') {
                            $('#profession').addClass('errorInForm');
                            $('#professionLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#profession').removeClass('errorInForm');
                            $('#professionLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#institution').val() == '') {
                            $('#institution').addClass('errorInForm');
                            $('#institutionLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#institution').removeClass('errorInForm');
                            $('#institutionLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#applications').val() == '') {
                            $('#applications').addClass('errorInForm');
                            $('#applicationsLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#applications').removeClass('errorInForm');
                            $('#applicationsLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#description').val() == '') {
                            $('#description').addClass('errorInForm');
                            $('#descriptionLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#description').removeClass('errorInForm');
                            $('#descriptionLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#interest').val() == '') {
                            $('#interest').addClass('errorInForm');
                            $('#interestLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#interest').removeClass('errorInForm');
                            $('#interestLabel').removeClass('errorMessageInFrom');
                        }
                        if ($('#comment').val() == '') {
                            $('#comment').addClass('errorInForm');
                            $('#commentLabel').addClass('errorMessageInFrom');
                        } else {
                            $('#comment').removeClass('errorInForm');
                            $('#commentLabel').removeClass('errorMessageInFrom');
                        }

                        $('#commentError').slideDown(500).html('Please fill all required fields with valid information ...');
                    }
                });
                function isValidEmailAddress(emailAddress) {
                    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                    return pattern.test(emailAddress);
                }
                $('#cancelRequest').click(function() {
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
                        <span>Request form of satellite images</span>  
                    </div>                    
                </div>
                <form id="formRequest" action="#" name="formRequest">
                    <div class="requestFormBox">
                        <table width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td><label id="firstnameLabel" for="firstname" style="margin-left:15px;font-weight: bold;">First Name<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="firstname" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="familynameLabel" for="familyname" style="margin-left:15px;font-weight: bold;">Family Name<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="familyname" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="othername" style="margin-left:15px;font-weight: bold;">Other Name</label></td>
                                    <td>
                                        <input id="othername" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="sexLabel" for="sex" style="margin-left:15px;font-weight: bold;">Sex<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <select id="sex" style = "margin-right: 5px;width:297px;margin-bottom: 5px;">
                                            <option value="">Please select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="emailLabel" for="email" style="margin-left:15px;font-weight: bold;">Email<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="email" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="nationalityLabel" for="nationality" style="margin-left:15px;font-weight: bold;">Nationality<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <select name="nationality" id="nationality" style = "margin-right: 5px;width:297px;margin-bottom: 5px;">
                                            <option value="">Please select a country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Aland Islands">Aland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="DR Congo">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="phoneLabel" for="phone" style="margin-left:15px;font-weight: bold;">Phone<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="phone" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="addressLabel" for="address" style="margin-left:15px;font-weight: bold;">Address<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="address" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="requestFormBox">
                        <table width="100%" border="0" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td><label id="professionLabel" for="profession" style="margin-left:15px;font-weight: bold;">Profession<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="profession" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;margin-left:12px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="institutionLabel" for="institution" style="margin-left:15px;font-weight: bold;">Institution<span style="color: #ff0000;">*</span></label></td>
                                    <td>
                                        <input id="institution" type="text" style = "margin-right: 5px;width:294px;margin-bottom: 5px;margin-left:12px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="applicationsLabel" for="applications" style="margin-left:15px;font-weight: bold;">Applications<span style="color: #ff0000;">*</span></label></td>
                                    <td><select id="applications" style = "width:297px;margin-right: 5px;margin-bottom: 5px;margin-left:12px;">
                                            <option value="">Please select</option>
                                            <option value="1">Academic</option>
                                            <option value="2">Professional</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                    <div class="requestFormBox" style="margin-bottom: 1px;">
                        <table width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td><label id="descriptionLabel" for="description" style="margin-left:15px;font-weight: bold;">Brief description of proposed application</label><span style="color: #ff0000;">*</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea style="margin-left:15px;margin-bottom: 5px;" id="description" name="description" rows="5" cols="68"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="interestLabel" for="interest" style="margin-left:15px;font-weight: bold;">Area of interest</label><span style="color: #ff0000;">*</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea style="margin-left:15px;margin-bottom: 5px;" id="interest" name="interest" rows="5" cols="68"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label id="commentLabel" for="comment" style="margin-left:15px;font-weight: bold;">How you did learn about OSFAC ?</label><span style="color: #ff0000;">*</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea style="margin-left:15px;margin-bottom: 5px;" id="comment" name="comment" rows="5" cols="68"></textarea>
                                        <div id="commentError" class="errorMessageInFrom" style="margin-left:15px;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <span style="color: #ff0000;">*</span>
                    <span style="font-size: 10px;"> Required Field</span>
                    <div style="height: 15px;">
                        <input style="margin-right: 5px;width: 100px;" type="button" id="submitRequest" class="button" value="Submit" />
                        <input style="margin-left: 10px;width: 100px;" type="button" id="cancelRequest" class="button" value="Cancel" />
                    </div>
                </form>
            </div>
            <?php footerPage(); ?>
        </div>
    </body>
</html>
