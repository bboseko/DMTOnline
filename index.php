<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" ></meta>
        <title>OSFAC-DMT Online 2.1 Bêta</title>
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

        <link type="image/vnd.microsoft.icon" rel="shortcut icon" href="images/favicon.ico"></link>        
        <link type="text/css" href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet" ></link>
        <link type="text/css" href="css/custom.css" rel="stylesheet"></link>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx0xuNg12W0_nx2QjT1MlZgpP18pgOlQA&sensor=false"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>

        <script type="text/javascript" src="js/library/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/library/jquery-ui.js"></script>
        <script type="text/javascript" src="js/library/jquery.blockui.js"></script>

        <script type="text/javascript" src="js/include/DMT.js"></script>
        <script type="text/javascript" src="js/include/map.js"></script>
        <script type="text/javascript" src="js/include/load.js"></script>
        <script type="text/javascript" src="js/include/controls.js"></script>

        <script type="text/javascript" src="js/include/mapOverlays.js"></script>
        <script type="text/javascript" src="js/include/tabs.js"></script>     
        <script type="text/javascript" src="js/include/custom.js"></script> 
        <?php
        include("./languages/langConfig.php");
        ?>
        <script type="text/javascript" src="languages/<?php echo $_SESSION['lang']; ?>/lang.<?php echo $_SESSION['lang']; ?>.js"></script>
        <script type="text/javascript">
            var hash = new Array();
            var arrayColorfp = new Array();
            var nRowResult = 0;
            function quickLook(name, preview) {
                if (preview === '/preview/nobrowse_small.png') {
                    preview = '/preview/nobrowse.png';
                }
                $('#quickLookDialogArea').dialog({
                    bgiframe: true,
                    autoOpen: false,
                    resizable: false,
                    height: 600,
                    width: 600,
                    modal: true,
                    buttons: {
                        'Close': function () {
                            $(this).dialog('destroy');
                        }
                    },
                    title: 'Thumbnail of ' + name,
                    open: function () {
                        var $dialogContent = $('#quickLookDialogArea');
                        $dialogContent.html('<img alt="No Browse" src = http://www.osfac.net' + preview + ' width="574px" height="485px" />');
                    },
                    close: function () {
                        $(this).dialog('destroy');
                    }
                });
                $('#quickLookDialogArea').dialog('open');
            }
            function pagination(nr, pn) {
                $('#search-results-container').html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="' + lang.loading + '" src="images/loader.gif" /><span> ' + lang.searching_images_loading + ' ...</span>');
                var itemsPerPage = 10;
                var lastPage = Math.ceil(nr / itemsPerPage);
                if (pn < 1) {
                    pn = 1;
                }
                else if (pn > lastPage) {
                    pn = lastPage;
                }
                var centerPages = "";
                var sub1 = pn - 1;
                var sub2 = pn - 2;
                var add1 = pn + 1;
                var add2 = pn + 2;
                if (pn === 1) {
                    centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
                }
                else if (pn === lastPage) {
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')>' + sub1 + '</span> &nbsp;';
                    centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
                }
                else if (pn > 2 && pn < (lastPage - 1)) {
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub2 + ')">' + sub2 + '</span> &nbsp;';
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')">' + sub1 + '</span> &nbsp;';
                    centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
                    centerPages += '&nbsp; <span " onClick="pagination(' + nr + ',' + add2 + ')">' + add2 + '</span> &nbsp;';
                }
                else if (pn > 1 && pn < lastPage) {
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + sub1 + ')">' + sub1 + '</span> &nbsp;';
                    centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
                }
                var limit = ' LIMIT ' + (pn - 1) * itemsPerPage + ', ' + itemsPerPage;
                var start = (pn - 1) * itemsPerPage;
                var paginationDisplay = "";
                if (lastPage !== "1") {
                    paginationDisplay += '' + lang.page + ' <strong>' + pn + '</strong> ' + lang.of + ' ' + lastPage + ' ';
                    if (pn !== 1) {
                        var previous = pn - 1;
                        paginationDisplay += '&nbsp; <span class="resultOther" onClick="pagination(' + nr + ',' + previous + ')"> ' + lang.back + '</span> ';
                    }
                    paginationDisplay += '<span class="paginationNumbers">' + centerPages + '</span>';
                    if (pn !== lastPage) {
                        var nextPage = pn + 1;
                        paginationDisplay += '&nbsp; <span class="resultOther" onclick="pagination(' + nr + ',' + nextPage + ')"> ' + lang.next + '</span> ';
                    }
                }
                if (nr === 0) {
                    $('#catResult').hide();
                    $('#pagingResultHeader, #pagingResultFooter').html('');
                } else {
                    $('#catResult').show();
                    $('#pagingResultHeader, #pagingResultFooter').html(paginationDisplay);
                }
                $.ajax({
                    type: 'POST',
                    url: 'script/searchImages.php',
                    data: '&limit=' + limit + '&start=' + start + items,
                    success: function (response) {
                        $('#search-results-container').html(response);
                        var t = 0;
                        for (var id in hash) {
                            if (hash[id] === true) {
                                t++;
                            }
                        }
                        if (nRowResult >= 2) {
                            t = t - 2;
                        } else {
                            t = t - 1;
                        }
                        if (t > 0) {
                            $('#submitButton').removeClass('disabled');
                        }
                        else {
                            $('#submitButton').addClass('disabled');
                        }
                    }
                });
            }
        </script>
    </head>
    <body>        
        <?php
        include("./script/fonctions.php");
        ?>
        <div id="container" class="clearfix">
            <div id="header">
                <div id="header-left">
                    <map name="Map">
                        <area shape="rect" coords="1,1,76,90" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
                        <area shape="rect" coords="85,3,335,60" href="index.php" alt="OSFAC-DMT" target="_self" />
                        <area shape="rect" coords="85,65,480,85" href="http://www.osfac.net/" alt="OSFAC" target="_blank" />
                    </map>
                    <img src="images/template/header_left.png" alt="logo" usemap="#Map" />
                </div>
                <div id="header-right">                    
                </div>
            </div>
            <div id="top-menu">
                <ul>
                    <li><a href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $lang['home']; ?></a></li>
                    <li><a href="pages/about.php"><?php echo $lang['about']; ?></a></li>                    
                    <li><a href="pages/desktop.php"><?php echo $lang['desktop']; ?></a></li>
                    <li><a href="pages/tutorial.php"><?php echo $lang['tutorial']; ?></a></li>
                    <li><a href="pages/whatnew.php"><?php echo $lang['whatsnew']; ?></a></li>
                    <li><a href="pages/faq.php"><?php echo $lang['faq']; ?></a></li>
                    <li><a href="pages/help.php"><?php echo $lang['help-text']; ?></a></li>

                    <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;">
                        <a href="index.php?lang=fr"><img src="images/fr.gif" /> <?php echo $lang['french']; ?></a>
                    </li>
                    <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;">
                        <a href="index.php?lang=en"><img src="images/en.gif" /> <?php echo $lang['english']; ?></a>
                    </li>

                    <li style="float:right !important; font-weight: bold; 
                        text-transform: uppercase; margin-right: 50px; background: none; ">
                        <button id="registerCommand" style="margin-top: -5px;"><?php echo $lang['register']; ?></button></li>
                    <li style="float:right !important; background: none; font-weight: bold; text-transform: uppercase;">
                        <button id="logInCommand" style="margin-top: -5px;"><?php echo $lang['login']; ?></button>
                    </li>
                </ul>
            </div>
            <div id="left-col">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php echo $lang['search-criteria']; ?></a></li>
                        <li><a href="#tabs-2"><?php echo $lang['additional-criteria']; ?></a></li>
                        <li><a href="#tabs-3"><?php echo $lang['result']; ?></a></li>
                    </ul>
                    <div id="tabs-1">
                        <div class="control-container">
                            <div id="categorySelectorBox" class="clearfix" style="margin: 6px 0 6px 0;">
                                <div style="float:left;font-weight: bold;margin-bottom:2px;">
                                    <?php echo $lang['category-of-images']; ?> &nbsp;
                                </div>
                                <div style="float:left;">
                                    <a id="categorySelector">
                                        <span class="text">(all)</span>
                                        <span style="float:right;margin-top:3px;" class="ui-icon ui-icon-triangle-1-s"></span>
                                    </a>
                                    <div id="categorySelectorDropPanel">
                                        <form name="categoryForm">
                                            <a><input type="checkbox" value="" name="categoryBoxes" checked="checked" /> (all)</a>
                                            <?php loadComboboxCategory(); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="coordEntryDialogTemplate">
                            <span class="dd">
                                <div class="label">
                                    <label for="latitude"><?php echo $lang['latitude']; ?>:</label>
                                </div>
                                <div class="inputs">
                                    <input class="latitude txtbox decimalBox" name="latitude" type="text" value="" />
                                </div>
                                <div style="clear:both;"></div>
                                <div class="label">
                                    <label for="longitude"><?php echo $lang['longitude']; ?>:</label>
                                </div>
                                <div class="inputs">
                                    <input class="longitude txtbox decimalBox" name="longitude" type="text" value="" />
                                </div>
                                <div style="clear:both;"></div>
                            </span>
                            <span class="dms">
                                <div class="label">
                                    <label for="latitude"><?php echo $lang['latitude']; ?>:</label>
                                </div>
                                <div class="inputs">
                                    <input class="degreesLat txtbox degreeBox" name="degreesLat" type="text" /> <label for="degreesLat">&deg;</label>
                                    <input class="minutesLat txtbox degreeBox" name="minutesLat" type="text" /> <label for="minutesLat">&#39;</label>
                                    <input class="secondsLat txtbox degreeBox" name="secondsLat" type="text" /> <label for="secondsLat">&quot;</label>
                                    <select class="directionLat" style="width:70px;" name="directionLat">
                                        <option value="N"><?php echo $lang['north']; ?></option>
                                        <option value="S"><?php echo $lang['south']; ?></option>
                                    </select>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="label">
                                    <label for="longitude"><?php echo $lang['longitude']; ?>:</label>
                                </div>
                                <div class="inputs">
                                    <input class="degreesLng txtbox degreeBox" name="degreesLng" type="text" /> <label for="degreesLng">&deg;</label>
                                    <input class="minutesLng txtbox degreeBox" name="minutesLng" type="text" /> <label for="minutesLng">&#39;</label>
                                    <input class="secondsLng txtbox degreeBox" name="secondsLng" type="text" /> <label for="secondsLng">&quot;</label>
                                    <select class="directionLng" style="width:70px;" name="directionLng">
                                        <option value="W"><?php echo $lang['west']; ?></option>
                                        <option value="E"><?php echo $lang['east']; ?></option>
                                    </select>
                                </div>
                                <div style="clear:both;"></div>
                            </span>
                        </div>
                        <div id="coordEntryDialogArea">
                        </div>
                        <div id="accordion">
                            <h3 id="accordion1"><?php echo $lang['search-address']; ?></h3>
                            <div class="tabAccordion">
                                <span><?php echo $lang['type-in-address']; ?></span>
                                <input type="textbox" id="googleAddress" name="googleAddress" alt="Google Address" style="width:314px;margin-top: 3px;" />
                                <div class="buttons">
                                    <input id="geoShowAddress" type="button" class="button" value="<?php echo $lang['button-show']; ?>" />
                                    <input id="geoClearAddress" type="button" class="button" value="<?php echo $lang['button-clear']; ?>" />
                                </div> 
                                <span id="addressLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif">
                                        <span><?php echo $lang['loading-results']; ?> ...</span>
                                </span>
                                <div id="addressInfo">
                                    <?php echo $lang['search-address-text']; ?>
                                </div>
                                <div class="geoRow" id="googleResults">
                                    <table cellspacing="0" summary="">
                                        <thead>
                                            <tr>
                                                <th><?php echo $lang['number']; ?></th>
                                                <th><?php echo $lang['address-place']; ?></th>
                                                <th><?php echo $lang['latitude']; ?></th>
                                                <th><?php echo $lang['longitude']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="googleRow"></tbody>
                                    </table>
                                </div>
                                <div id="geoErrorMessageAddress" class="geoErrorMessage"></div>
                            </div>                                  
                            <h3 id="accordion2"><?php echo $lang['search-pathrow']; ?></h3>
                            <div class="tabAccordion">
                                <div id="wrsInputs">
                                    <label for="pathAddress"><?php echo $lang['path']; ?>:</label>
                                    <select id="pathAddress" name="pathAddress" style = "width:100px">
                                        <?php loadComboboxPath(); ?>
                                    </select>&nbsp;&nbsp;&nbsp;
                                    <label for="rowAddress"><?php echo $lang['row']; ?>:</label>
                                    <select id="rowAddress" name="rowAddress" style = "width:100px">
                                        <?php loadComboboxRow(); ?>
                                    </select>
                                </div>
                                <div class="buttons">
                                    <input id="geoShowPathRow" type="button" class="button" value="<?php echo $lang['button-show']; ?>" />
                                    <input id="geoClearPathRow" type="button" class="button" value="<?php echo $lang['button-clear']; ?>" />
                                </div>
                                <span id="pathrowLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif" /> <?php echo $lang['loading-results']; ?> ...
                                </span>
                                <div id="geoErrorMessagePathRow" class="geoErrorMessage"></div>
                            </div>
                            <h3 id="accordion3"><?php echo $lang['search-predefined-area']; ?></h3>
                            <div class="tabAccordion">
                                <div id="wrsInputs">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><label for="province"><?php echo $lang['province']; ?></label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="province" name="province" style = "margin-bottom: 3px;width:225px">
                                                            <?php loadComboboxProvince() ?>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="district"><?php echo $lang['district']; ?></label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="district" name="district" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="territory"><?php echo $lang['territory']; ?></label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="territory" name="territory" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sector"><?php echo $lang['sector']; ?></label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="sector" name="sector" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="locality"><?php echo $lang['locality']; ?></label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="locality" name="locality" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="buttons">
                                    <input id="geoShowFeature" type="button" class="button" value="<?php echo $lang['button-show']; ?>" />
                                    <input id="geoClearFeature" type="button" class="button" value="<?php echo $lang['button-clear']; ?>" />
                                </div>
                                <span id="featureLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif">
                                        <span><?php echo $lang['loading-results']; ?> ...</span>
                                </span>
                                <div id="geoErrorMessageFeature" class="geoErrorMessage"></div>
                            </div>
                            <h3 id="accordion4"><?php echo $lang['search-shapefile']; ?></h3>
                            <div class="tabAccordion">
                                <form id="shapefileUploadForm" action="#" method="">
<!--                                    <span style="font-size: 12px;margin-bottom: 3px;">
                                        <em>
                                            Shapefiles are limited to one record containing one polygon or line string with a maximum of 20 points.
                                        </em>
                                    </span>-->
                                    <div id="wrsInputs">
                                        <div class="row clearfix">
                                            <label for="shpFile">.shp </label>
                                            <input type="file" name="shpFile" id="shpFile" type="file" size="30" /><br />
                                        </div>
                                        <div class="row clearfix">
                                            <label for="shxFile">.shx </label>
                                            <input type="file" name="shxFile" id="shxFile" type="file" size="30" /><br />
                                        </div>
                                        <div class="row clearfix">
                                            <label for="dbfFile">.dbf </label>
                                            <input type="file" name="dbfFile" id="dbfFile" type="file" size="30" /><br />
                                        </div>
                                        <div class="row clearfix">
                                            <label for="prjFile">.prj </label>
                                            <input type="file" name="prjFile" id="prjFile" type="file" size="30" /><br />
                                        </div>                                        
                                    </div>
                                    <div class="buttons">
                                        <input id="shapefileSubmit" class="button" type="button" name="action" value="<?php echo $lang['button-upload']; ?>" />
                                        <input id="shapefileClear" class="button" type="reset" value="<?php echo $lang['button-clear']; ?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="control-container">
                            <div class="labelText"><?php echo $lang['coordinates']; ?></div>
                            <div id="lat_lon_section">
                                <label for="latlonfmtdeg"><?php echo $lang['latlonformatdeg']; ?></label>
                                <input id="latlonfmtdeg" type="radio" value="dms" name="latlonfmt" checked="checked" />
                                <label for="latlonfmtdec"><?php echo $lang['latlonformatdec']; ?></label>
                                <input id="latlonfmtdec" type="radio" value="dd" name="latlonfmt"/>
                            </div>                            
                            <div id="coordEntryTemplate">
                                <li id="coordinate_!%index%!" class="coordinate control-!%format%! !%oddEven%!">
                                    <div style="float:left;margin-right:8px;"> <span class="coordinateNum">!%coordinateNum%!</span>. </div>
                                    <div class="format_dms" style="float:left;">
                                        Lat: <span class="latitude">!%dmsLat%!</span>,
                                        Lon: <span class="longitude">!%dmsLng%!</span>
                                    </div>
                                    <div class="format_dd" style="float:left;">
                                        Lat: <span class="latitude">!%decLat%!</span>,
                                        Lon: <span class="longitude">!%decLng%!</span>
                                    </div>
                                    <div style="float:right;">
                                        <span class="coordinateElementOperations">
                                            <a id="edit_!%index%!" class="iconLink edit" title="<?php echo $lang['edit-coordinate']; ?>">
                                                <div class="ee-icon ee-icon-notepad"></div>
                                            </a>
                                            <a id="delete_!%index%!" class="iconLink delete" title="<?php echo $lang['delete-coordinate']; ?>">
                                                <div class="ee-icon ee-icon-delete"></div>
                                            </a>
                                        </span>
                                    </div>
                                    <div style="clear:both;"></div>
                                </li>
                            </div>
                            <ul id="coordEntryArea" class="mapPointContainer ui-sortable">
                                <li id="coordinateElementEmpty" class="coordinate even" style="display:block;">
                                    <div style="float:left;padding:1px 0 1px 0;">
                                        <div class="ee-icon ee-icon-info"></div>
                                    </div>
                                    <div style="float:left;">
                                        &nbsp;&nbsp;<?php echo $lang['no-coordinate']; ?>
                                    </div>
                                    <div style="clear:both;"></div>
                                </li>
                            </ul>                                    
                            <div class="buttons">
                                <!--<input id="coordUseMap" type="button" class="button" value="Use Map" />-->
                                <input id="coordEntryAdd" type="button" class="button" value="<?php echo $lang['add-coordinate']; ?>" />
                                <input id="coordEntryClear" type="button" class="button" value="<?php echo $lang['clear-coordinate']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div id="tabs-2">
                        <div class="control-container">
                            <div id="dateSection" style="margin-bottom: 6px;">
                                <label for="dateDate"><?php echo $lang['date-text']; ?></label>
                                <input id="dateDate" type="radio" value="Date" name="dateType" />
                                <label for="dateYear"><?php echo $lang['year-text']; ?></label>
                                <input id="dateYear" type="radio" value="Year" name="dateType" checked="checked" />
                            </div>
                            <div id="periodDate" class="additionalCriteriaBox">
                                <label for="datepickerFrom"><?php echo $lang['search-form-text']; ?> </label>
                                <input size="10" type="text" id="datepickerFrom" name="datepickerFrom" value="07/27/1972" />
                                <label for="datepickerTo">&nbsp;&nbsp;&nbsp;<?php echo $lang['search-to-text']; ?> </label>
                                <input size="10" type="text" id="datepickerTo" name="datepickerTo" value="06/11/2012" />
                            </div>
                            <div id="periodYear" class="additionalCriteriaBox">
                                <label for="start_year"><?php echo $lang['search-form-text']; ?> </label>
                                <select id="yearFrom" name="yearFrom" style = "width:110px">
                                    <?php loadComboboxYear(); ?>
                                </select>
                                <label for="end_year">&nbsp;&nbsp;&nbsp;<?php echo $lang['search-to-text']; ?> </label>
                                <select id="yearTo" name="yearTo" style = "width:110px">
                                    <?php loadComboboxYearTo(); ?>
                                </select>
                            </div>
                            <div id="MLandsat">
                                <div class="labelText">LANDSAT</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="missionLandsat"><?php echo $lang['mission-version']; ?></label></div>
                                    <div class="acright">
                                        <select id="missionLandsat" name="missionLandsat">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionLandsat(); ?>
                                        </select> 
                                    </div>                              
                                    <div class="acleft"><label for="slc"><?php echo $lang['slc-text']; ?></label>                                        
                                    </div>
                                    <div class="acright">
                                        <select id="slc" name="slc" style = "width:120px">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxSLC(); ?>
                                        </select> 
                                        <a href="http://landsat.usgs.gov/products_slcoffbackground.php" target="_blank" 
                                           title="<?php echo $lang['slc-text']; ?>" style="font-size:10px;">
                                            <em><?php echo $lang['whats-this-slc-text']; ?></em></a>
                                    </div>
                                    <div id="SLCInfo"></div>
                                    <div class="acleft">
                                        <label for="orthorectified"><?php echo $lang['ortho-rectified']; ?></label>
                                    </div>                                
                                    <div class="acright">
                                        <select id="orthorectified" name="orthorectified">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxOrtho(); ?>
                                        </select>
                                    </div>
                                    <div class="acleft"><label for="stack"><?php echo $lang['pre-statck-text']; ?></label> 
                                    </div>
                                    <div class="acright">
                                        <select id="stack" name="stack">
                                            <?php loadComboboxStack(); ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div id="MSRTM">
                                <div class="labelText">SRTM</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="missionSRTM"><?php echo $lang['srtm-version-text']; ?></label></div>
                                    <div class="acright">
                                        <select id="missionSRTM" name="missionSRTM">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionSRTM(); ?>
                                        </select> 
                                    </div>
                                    <div class="acleft"><label for="resolutionSRTM"><?php echo $lang['spatial-resolution-text']; ?></label></div>
                                    <div class="acright">
                                        <select id="resolutionSRTM" name="resolutionSRTM">
                                            <option value="all">(all)</option>
                                            <option value="30">30 <?php echo $lang['meters-text']; ?></option>
                                            <option value="90">90 <?php echo $lang['meters-text']; ?></option>
                                        </select> 
                                    </div>
                                </div>
                            </div> 
                            <div id="MSPOT">
                                <div class="labelText">SPOT</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="verionSPOT"><?php echo $lang['spot-version-text']; ?></label></div>
                                    <div class="acright">
                                        <select id="verionSPOT" name="verionSPOT">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionSPOT(); ?>
                                        </select> 
                                    </div>
                                </div> 
                            </div>
                            <div id="MCloudCover">
                                <div class="labelText"><?php echo $lang['cloud-cover']; ?></div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="cloudCover"><?php echo $lang['cloud-cover']; ?></label></div>
                                    <div class="acright">
                                        <select id="cloudCover" name="cloudCover" disabled>
                                            <option value="all">(all)</option>
                                        </select> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div id="tabs-3">
                        <span style="font-size: 12px;">
                            <em><?php echo $lang['use-dropdown-text']; ?>
                            </em>
                        </span>
                        <div id="catResult" style="font-size: 12px;clear: both;">
                            <label for="categoryResult">
                                <strong><em><?php echo $lang['category-text']; ?>: </em></strong> 
                            </label> 
                            <select id="categoryResult" name="categoryResult">
                            </select>
                            <div style="float: right;margin-top: 2px;">
                                <input type="checkbox" id="checkAllResult" checked />
                                <label for="checkAllResult"><?php echo $lang['check-uncheck-text']; ?></label>
                            </div> 
                        </div>

                        <div id="pagingResultHeader"></div>
                        <div id="search-results-container"></div>
                        <div id="pagingResultFooter"></div>
                        <div id="quickLookDialogArea"></div>
                    </div>
                </div>
                <div>
                    <input id="submitButton" class="pageButton disabled" type="button" value="<?php echo $lang['button-submit-text']; ?>" title="<?php echo $lang['button-submit-title']; ?>" />
                    <input id="resetButton" class="pageButton" type="button" value="<?php echo $lang['button-reset-all']; ?>" title="<?php echo $lang['button-reset-all']; ?>" />
                    <input id="seachButton" class="pageButton" type="button" value="<?php echo $lang['button-search']; ?>" title="<?php echo $lang['button-search']; ?>" />
                </div>
            </div>
            <div id="right-col">
                <div id="mapWrapper">
                    <div id="map"></div>
                    <div id="mapOverlays">
                        <div id="mouseLatLng">(<?php echo $lang['coordinates']; ?>)</div>
                    </div>
                </div>
            </div> 
            <div id="menufooter">
                <ul>
                    <li><a href="pages/terms.php"><?php echo $lang['terms-of-use']; ?></a></li>
                    <li><a href="pages/privacy.php"><?php echo $lang['privacy-policy']; ?></a></li>
                    <li><a href="pages/contact.php"><?php echo $lang['contact-text']; ?></a></li>
                    <li><a href="pages/help.php"><?php echo $lang['help-text']; ?></a></li>
                </ul>
                <div id="copyright">
                    <p><strong>OSFAC-Data Management Tool</strong>. Email: <a href="mailto:dmt@osfac.net">dmt@osfac.net</a></p>
                    <p>Copyright © 2012 - <?php echo date("Y") ?> OSFAC. <?php echo $lang['all-rights-reserved']; ?></p>
                    <p style="color: #000000;"><em><?php echo $lang['powered-by-text']; ?></em></p>
                </div>
            </div>

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
            <div id="register-form">
                <div id="registerFormBox" class="requestFormBox displayNone" style="width: 350px;">
                    <table>
                        <tr>
                            <td><label for="firstname" style="width: 100%;"><?php echo $lang['firstname']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="firstname" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="familyname" style="width: 100%;"><?php echo $lang['familyname']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="password" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="othername" style="width: 100%;"><?php echo $lang['othername']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="password" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>                        
                        <tr>
                            <td><label for="sex" style="width: 100%;"><?php echo $lang['sex']; ?></label></td>
                            <td>
                                <select id="sex" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                                    <option value="male"><?php echo $lang['male']; ?></option>
                                    <option value="female"><?php echo $lang['female']; ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="address" style="width: 100%;"><?php echo $lang['address']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="address" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="phone" style="width: 100%;"><?php echo $lang['phone']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="tel" id="phone" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="email" style="width: 100%;"><?php echo $lang['email']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="email" id="email" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="nationality" style="width: 100%;"><?php echo $lang['nationality']; ?></label></td>
                            <td>
                                <select name="nationality" id="nationality" class="text ui-widget-content ui-corner-all" style="margin-left: 10px; margin-top: 5px; width: 250px;">
                                    <option value=""><?php echo $lang['select-country']; ?></option>
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
                            <td><label for="profession" style="width: 100%;"><?php echo $lang['profession']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="profession" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><label for="institution" style="width: 100%;"><?php echo $lang['institution']; ?></label></td>
                            <td><input style="margin-left: 10px; margin-top: 5px; width: 250px;" type="text" id="institution" class="text ui-widget-content ui-corner-all"/></td>
                        </tr>                        
                    </table>
                    <div class="requestFormBox" style="width: 300px; margin-top: 10px; margin-left: 15px;">
                        <table>
                            <tr>
                                <td><label for="usernameRegister" style="width: 100%;"><?php echo $lang['username']; ?></label></td>
                                <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="text" id="usernameRegister" class="text ui-widget-content ui-corner-all"/></td>
                            </tr>
                            <tr>
                                <td><label for="passwordRegister" style="width: 100%;"><?php echo $lang['password']; ?></label></td>
                                <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="passwordRegister" class="text ui-widget-content ui-corner-all"/></td>
                            </tr>
                            <tr>
                                <td><label for="repeatPasswordRegister" style="width: 100%;"><?php echo $lang['repeat-password']; ?></label></td>
                                <td><input style="margin-left: 10px; margin-top: 5px; width: 150px;" type="password" id="repeatPasswordRegister" class="text ui-widget-content ui-corner-all"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
