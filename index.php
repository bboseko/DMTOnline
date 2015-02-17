<?php
include("./languages/langConfig.php");
?>
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
            <?php include_once("./template/index_pageTop.php"); ?>
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
            <?php include_once("./template/index_pageBottom.php"); ?>            
        </div>
    </body>
</html>
