<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" ></meta>
        <title>OSFAC-DMT Online 2.0.1 Beta</title>
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

        <script type="text/javascript" src="js/library/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/library/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" src="js/library/jquery.blockui.js"></script>

        <script type="text/javascript" src="js/include/DMT.js"></script>
        <script type="text/javascript" src="js/include/map.js"></script>
        <script type="text/javascript" src="js/include/load.js"></script>
        <script type="text/javascript" src="js/include/controls.js"></script>

        <script type="text/javascript" src="js/include/mapOverlays.js"></script>
        <script type="text/javascript" src="js/include/tabs.js"></script>

        <script type="text/javascript">
            var hash = new Array();
            var arrayColorfp = new Array();
            var nRowResult = 0;
            $(function() {
                $("#tabs").tabs();
                $("#accordion").accordion({
                    heightStyle: "content",
                    collapsible: true
                });
                $("#datepickerFrom, #datepickerTo").datepicker({
                    showOn: "button",
                    buttonImage: "css/images/calendar.gif",
                    buttonImageOnly: true,
                    changeMonth: true,
                    changeYear: true
                });
            });
            function quickLook(name, preview) {
                if (preview == '/preview/nobrowse_small.png') {
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
                        'Close': function() {
                            $(this).dialog('destroy');
                        }
                    },
                    title: 'Thumbnail for ' + name,
                    open: function() {
                        var $dialogContent = $('#quickLookDialogArea');
                        $dialogContent.html('<img alt="No Browse" src = http://www.osfac.net' + preview + ' width="574px" height="485px" />');
                    },
                    close: function() {
                        $(this).dialog('destroy');
                    }
                });
                $('#quickLookDialogArea').dialog('open');
            }
            function pagination(nr, pn) {
                $('#search-results-container').html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="loading" src="images/loader.gif" /><span> Searching available images for your area of interest ...</span>');
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
                if (pn == 1) {
                    centerPages += '&nbsp; <span class="pagNumActive">' + pn + '</span> &nbsp;';
                    centerPages += '&nbsp; <span onClick="pagination(' + nr + ',' + add1 + ')">' + add1 + '</span> &nbsp;';
                }
                else if (pn == lastPage) {
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
                if (lastPage != "1") {
                    paginationDisplay += 'Page <strong>' + pn + '</strong> of ' + lastPage + ' ';
                    if (pn != 1) {
                        var previous = pn - 1;
                        paginationDisplay += '&nbsp; <span class="resultOther" onClick="pagination(' + nr + ',' + previous + ')"> Back</span> ';
                    }
                    paginationDisplay += '<span class="paginationNumbers">' + centerPages + '</span>';
                    if (pn != lastPage) {
                        var nextPage = pn + 1;
                        paginationDisplay += '&nbsp; <span class="resultOther" onclick="pagination(' + nr + ',' + nextPage + ')"> Next</span> ';
                    }
                }
                if (nr == 0) {
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
                    success: function(response) {
                        $('#search-results-container').html(response);
                        var t = 0;
                        for (var id in hash) {
                            if (hash[id] == true) {
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
                        <area shape="rect" coords="1,1,76,90" href="http://www.osfac.net/" alt="OSFAC" target="_self" />
                        <area shape="rect" coords="85,3,335,60" href="index.php" alt="OSFAC-DMT" target="_self" />
                        <area shape="rect" coords="85,65,480,85" href="http://www.osfac.net/" alt="OSFAC" target="_self" />
                    </map>
                    <img src="images/template/header_left.png" alt="logo" usemap="#Map" />
                </div>
                <div id="header-right">                    
                </div>
            </div>
            <div id="top-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pages/about.php">About</a></li>                    
                    <li><a href="pages/desktop.php">OSFAC-DMT Desktop</a></li>
                    <li><a href="pages/tutorial.php">Tutorial</a></li>
                    <li><a href="pages/whatnew.php">What's New?</a></li>
                    <li><a href="pages/faq.php">FAQ</a></li>
                    <li><a href="pages/help.php">Help</a></li>
                </ul>
            </div>
            <div id="left-col">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Search criteria</a></li>
                        <li><a href="#tabs-2">Additional Criteria</a></li>
                        <li><a href="#tabs-3">Results</a></li>
                    </ul>
                    <div id="tabs-1">
                        <div class="control-container">
                            <div id="categorySelectorBox" class="clearfix" style="margin: 6px 0 6px 0;">
                                <div style="float:left;font-weight: bold;margin-bottom:2px;">
                                    Category of images &nbsp;
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
                                    <label for="latitude">Latitude:</label>
                                </div>
                                <div class="inputs">
                                    <input class="latitude txtbox decimalBox" name="latitude" type="text" value="" />
                                </div>
                                <div style="clear:both;"></div>
                                <div class="label">
                                    <label for="longitude">Longitude:</label>
                                </div>
                                <div class="inputs">
                                    <input class="longitude txtbox decimalBox" name="longitude" type="text" value="" />
                                </div>
                                <div style="clear:both;"></div>
                            </span>
                            <span class="dms">
                                <div class="label">
                                    <label for="latitude">Latitude:</label>
                                </div>
                                <div class="inputs">
                                    <input class="degreesLat txtbox degreeBox" name="degreesLat" type="text" /> <label for="degreesLat">&deg;</label>
                                    <input class="minutesLat txtbox degreeBox" name="minutesLat" type="text" /> <label for="minutesLat">&#39;</label>
                                    <input class="secondsLat txtbox degreeBox" name="secondsLat" type="text" /> <label for="secondsLat">&quot;</label>
                                    <select class="directionLat" style="width:70px;" name="directionLat">
                                        <option value="N">North</option>
                                        <option value="S">South</option>
                                    </select>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="label">
                                    <label for="longitude">Longitude:</label>
                                </div>
                                <div class="inputs">
                                    <input class="degreesLng txtbox degreeBox" name="degreesLng" type="text" /> <label for="degreesLng">&deg;</label>
                                    <input class="minutesLng txtbox degreeBox" name="minutesLng" type="text" /> <label for="minutesLng">&#39;</label>
                                    <input class="secondsLng txtbox degreeBox" name="secondsLng" type="text" /> <label for="secondsLng">&quot;</label>
                                    <select class="directionLng" style="width:70px;" name="directionLng">
                                        <option value="W">West</option>
                                        <option value="E">East</option>
                                    </select>
                                </div>
                                <div style="clear:both;"></div>
                            </span>
                        </div>
                        <div id="coordEntryDialogArea">
                        </div>
                        <div id="accordion">
                            <h3 id="accordion1">Search by Address or Place name</h3>
                            <div class="tabAccordion">
                                <span>Type in an Address or Place name</span>
                                <input type="textbox" id="googleAddress" name="googleAddress" alt="Google Address" style="width:314px;margin-top: 3px;" />
                                <div class="buttons">
                                    <input id="geoShowAddress" type="button" class="button" value="Show" />
                                    <input id="geoClearAddress" type="button" class="button" value="Clear" />
                                </div> 
                                <span id="addressLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif">
                                        <span>Loading results ...</span>
                                </span>
                                <div id="addressInfo">
                                    Click on an Address/Place to show the
                                    location on the map.
                                </div>
                                <div class="geoRow" id="googleResults">
                                    <table cellspacing="0" summary="">
                                        <thead>
                                            <tr>
                                                <th>Num</th>
                                                <th>Address/Place</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                            </tr>
                                        </thead>
                                        <tbody id="googleRow"></tbody>
                                    </table>
                                </div>
                                <div id="geoErrorMessageAddress" class="geoErrorMessage"></div>
                            </div>                                  
                            <h3 id="accordion2">Search by Path and Row</h3>
                            <div class="tabAccordion">
                                <div id="wrsInputs">
                                    <label for="pathAddress">Path:</label>
                                    <select id="pathAddress" name="pathAddress" style = "width:100px">
                                        <?php loadComboboxPath(); ?>
                                    </select>&nbsp;&nbsp;&nbsp;
                                    <label for="rowAddress">Row:</label>
                                    <select id="rowAddress" name="rowAddress" style = "width:100px">
                                        <?php loadComboboxRow(); ?>
                                    </select>
                                </div>
                                <div class="buttons">
                                    <input id="geoShowPathRow" type="button" class="button" value="Show" />
                                    <input id="geoClearPathRow" type="button" class="button" value="Clear" />
                                </div>
                                <span id="pathrowLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif" /> Loading results ...
                                </span>
                                <div id="geoErrorMessagePathRow" class="geoErrorMessage"></div>
                            </div>
                            <h3 id="accordion3">Search by Predefined Area (DR CONGO only)</h3>
                            <div class="tabAccordion">
                                <div id="wrsInputs">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><label for="province">Province</label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="province" name="province" style = "margin-bottom: 3px;width:225px">
                                                            <?php loadComboboxProvince() ?>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="district">District</label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="district" name="district" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="territory">Territory</label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="territory" name="territory" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sector">Sector</label></td>
                                                <td>
                                                    <span style="margin-left: 10px">
                                                        <select id="sector" name="sector" style = "margin-bottom: 3px;width:225px" disabled>
                                                        </select>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="locality">Locality</label></td>
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
                                    <input id="geoShowFeature" type="button" class="button" value="Show" />
                                    <input id="geoClearFeature" type="button" class="button" value="Clear" />
                                </div>
                                <span id="featureLoader" style="display: none;">
                                    <img align="top" alt="loading" src="images/loader.gif">
                                        <span>Loading results ...</span>
                                </span>
                                <div id="geoErrorMessageFeature" class="geoErrorMessage"></div>
                            </div>
                            <h3 id="accordion4">Search by Shapefile</h3>
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
                                        <input id="shapefileSubmit" class="button" type="button" name="action" value="Upload" />
                                        <input id="shapefileClear" class="button" type="reset" value="Clear" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="control-container">
                            <div class="labelText">Coordinates</div>
                            <div id="lat_lon_section">
                                <label for="latlonfmtdeg">Degree/Minute/Second</label>
                                <input id="latlonfmtdeg" type="radio" value="dms" name="latlonfmt" checked="checked" />
                                <label for="latlonfmtdec">Decimal Degree</label>
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
                                            <a id="edit_!%index%!" class="iconLink edit" title="Edit this coordinate">
                                                <div class="ee-icon ee-icon-notepad"></div>
                                            </a>
                                            <a id="delete_!%index%!" class="iconLink delete" title="Delete this coordinate">
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
                                        &nbsp;&nbsp;No coordinates selected.
                                    </div>
                                    <div style="clear:both;"></div>
                                </li>
                            </ul>                                    
                            <div class="buttons">
                                <!--<input id="coordUseMap" type="button" class="button" value="Use Map" />-->
                                <input id="coordEntryAdd" type="button" class="button" value="Add Coordinate" />
                                <input id="coordEntryClear" type="button" class="button" value="Clear Coordinates" />
                            </div>
                        </div>
                    </div>
                    <div id="tabs-2">
                        <div class="control-container">
                            <div id="dateSection" style="margin-bottom: 6px;">
                                <label for="dateDate">Date</label>
                                <input id="dateDate" type="radio" value="Date" name="dateType" />
                                <label for="dateYear">Year</label>
                                <input id="dateYear" type="radio" value="Year" name="dateType" checked="checked" />
                            </div>
                            <div id="periodDate" class="additionalCriteriaBox">
                                <label for="datepickerFrom">Search from: </label>
                                <input size="10" type="text" id="datepickerFrom" name="datepickerFrom" value="07/27/1972" />
                                <label for="datepickerTo">&nbsp;&nbsp;&nbsp;to: </label>
                                <input size="10" type="text" id="datepickerTo" name="datepickerTo" value="06/11/2012" />
                            </div>
                            <div id="periodYear" class="additionalCriteriaBox">
                                <label for="start_year">Search from: </label>
                                <select id="yearFrom" name="yearFrom" style = "width:110px">
                                    <?php loadComboboxYear(); ?>
                                </select>
                                <label for="end_year">&nbsp;&nbsp;&nbsp;to: </label>
                                <select id="yearTo" name="yearTo" style = "width:110px">
                                    <?php loadComboboxYearTo(); ?>
                                </select>
                            </div>
                            <div id="MLandsat">
                                <div class="labelText">LANDSAT</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="missionLandsat">Mission/Version</label></div>
                                    <div class="acright">
                                        <select id="missionLandsat" name="missionLandsat">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionLandsat(); ?>
                                        </select> 
                                    </div>                              
                                    <div class="acleft"><label for="slc">Scan Line Corrector (SLC)</label>                                        
                                    </div>
                                    <div class="acright">
                                        <select id="slc" name="slc" style = "width:120px">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxSLC(); ?>
                                        </select> 
                                        <a href="http://landsat.usgs.gov/products_slcoffbackground.php" target="_blank" 
                                           title="Scan Line Corrector" style="font-size:10px;"><em>(What's this?)</em></a>
                                    </div>
                                    <div id="SLCInfo"></div>
                                    <div class="acleft">
                                        <label for="orthorectified">Ortho Rectified</label>
                                    </div>                                
                                    <div class="acright">
                                        <select id="orthorectified" name="orthorectified">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxOrtho(); ?>
                                        </select>
                                    </div>
                                    <div class="acleft"><label for="stack">Pre-Stack (3 Bands RGB)</label> 
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
                                    <div class="acleft"><label for="missionSRTM">SRTM Version</label></div>
                                    <div class="acright">
                                        <select id="missionSRTM" name="missionSRTM">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionSRTM(); ?>
                                        </select> 
                                    </div>
                                    <div class="acleft"><label for="resolutionSRTM">Spatial Resolution</label></div>
                                    <div class="acright">
                                        <select id="resolutionSRTM" name="resolutionSRTM">
                                            <option value="all">(all)</option>
                                            <option value="30">30 Meters</option>
                                            <option value="90">90 Meters</option>
                                        </select> 
                                    </div>
                                </div>
                            </div> 
                            <div id="MSPOT">
                                <div class="labelText">SPOT</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="verionSPOT">SPOT Version</label></div>
                                    <div class="acright">
                                        <select id="verionSPOT" name="verionSPOT">
                                            <option value="all">(all)</option>
                                            <?php loadComboboxMissionSPOT(); ?>
                                        </select> 
                                    </div>
                                </div> 
                            </div>
                            <div id="MCloudCover">
                                <div class="labelText">Cloud cover</div>
                                <div class="additionalCriteriaBox">
                                    <div class="acleft"><label for="cloudCover">Cloud cover</label></div>
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
                            <em>Use the dropdown to see the search results for each specific category.
                            </em>
                        </span>
                        <div id="catResult" style="font-size: 12px;clear: both;">
                            <label for="categoryResult">
                                <strong><em>Category: </em></strong> 
                            </label> 
                            <select id="categoryResult" name="categoryResult">
                            </select>
                            <div style="float: right;margin-top: 2px;">
                                <input type="checkbox" id="checkAllResult" checked />
                                <label for="checkAllResult">Check/Uncheck All</label>
                            </div> 
                        </div>

                        <div id="pagingResultHeader"></div>
                        <div id="search-results-container"></div>
                        <div id="pagingResultFooter"></div>
                        <div id="quickLookDialogArea"></div>
                    </div>
                </div>
                <div>
                    <input id="submitButton" class="pageButton disabled" type="button" value="Submit Request" title="Submit my data request to OSFAC" />
                    <input id="resetButton" class="pageButton" type="button" value="Reset All" title="Reset All" />
                    <input id="seachButton" class="pageButton" type="button" value="Search" title="Search" />
                </div>
            </div>
            <div id="right-col">
                <div id="mapWrapper">
                    <div id="map"></div>
                    <div id="mapOverlays">
                        <div id="mouseLatLng">(Coordinates)</div>
                    </div>
                </div>
            </div> 
            <div id="menufooter">
                <ul>
                    <li><a href="pages/terms.php">Terms of use</a></li>
                    <li><a href="pages/privacy.php">Privacy policy</a></li>
                    <li><a href="pages/contact.php">Contact</a></li>
                    <li><a href="pages/help.php">Help</a></li>
                </ul>
                <div id="copyright">
                    <p><strong>OSFAC-Data Management Tool</strong>. Email: <a href="mailto:dmt@osfac.net">dmt@osfac.net</a></p>
                    <p>Copyright © <?php echo date("Y") ?> OSFAC. All Rights Reserved.</p>
                    <p style="color: #000000;"><em>Powered by OSFAC Team</em></p>
                </div>
            </div>
        </div>
    </body>
</html>
