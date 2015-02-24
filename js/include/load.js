var categories, items, landsat = '', srtm = '', spot = '', aster = '', asterdem = '', other = '';

DMT.load = {
    load: function () {
        $.get("script/getCategories.php", function (response) {
            categories = response.split(",");
        });
// Load the Geocoderalert();
        DMT.gmaps.geocoder = new google.maps.Geocoder();
// Load settings
        DMT.gmaps.maxPoints = parseInt($('#maxPoints').val());
        DMT.load.attachPageListeners();
        DMT.load.attachTab1Listeners();
        DMT.load.attachTab3Listeners();
    },
    attachPageListeners: function () {
        $('#coordUseMap').click(function () {
            DMT.gmaps.coordinates.clear();
// Create a polygon that is the map bounds
            var mapBounds = DMT.gmaps.map.getBounds();
            var NE = mapBounds.getNorthEast();
            var SW = mapBounds.getSouthWest();
            var NW = new google.maps.LatLng(NE.lat(), SW.lng());
            var SE = new google.maps.LatLng(SW.lat(), NE.lng());
            var polygon = [NE, NW, SW, SE];
// If the map is larger than a set size, draw extra points
            if (DMT.gmaps.map.getZoom() <= 4) {
                if ($('#map').width() > 1020 && DMT.gmaps.map.getZoom() >= 3 && $('#map').width() < 2047) {
                    var NC = new google.maps.LatLng(NW.lat(), DMT.gmaps.map.getCenter().lng());
                    var SC = new google.maps.LatLng(SW.lat(), DMT.gmaps.map.getCenter().lng());
                    polygon = [NW, NC, NE, SE, SC, SW];
                } else if ($('#map').width() >= 2047) {
                    $.blockUI({
                        theme: true,
                        title: 'Notice',
                        message: '<p>' + lang.search_entire_map + '</p>',
                        timeout: 2500
                    });
                    polygon = null;
                }
            }
            if (polygon !== null) {
                for (var i = 0; i < polygon.length; i++) {
                    DMT.gmaps.coordinates.add(polygon[i]);
                }
            }
        });
        function isContain(item) {
            var category = $('#categorySelector span.text').html();
            if (category === '(all)') {
                category = 'ASTER, ASTER GDEM, LANDSAT, MOSAIC LANDSAT, SPOT, SRTM';
            }
            var catTab = category.split(', ');
            for (var i = 0; i < catTab.length; i++) {
                if (catTab[i] === item) {
                    return true;
                }
            }
            return false;
        }
        $('#seachButton').click(function () {
            $('#submitButton').addClass('disabled');
            $('#categoryResult').find('option').remove().end();
            $('#pagingResultHeader, #pagingResultFooter').html('');
            DMT.gmaps.footprints.clearAll();
            var category = $('#categorySelector span.text').html();
            if (category === '(none)') {
                $.blockUI({
                    theme: true,
                    title: lang.empty_category_title,
                    message: '<p>' + lang.empty_category_message + '</p>',
                    timeout: 4000
                });
                return;
            }
            else if (category === '(all)') {
                category = '';
                for (var i = 0; i < categories.length; i++) {
                    category += categories[i] + ', ';
                }
                category = category.replace('(all), ', '');
                category = category.substring(0, category.length - 2);
            }
            landsat = '', srtm = '', spot = '', aster = '', asterdem = '', other = '';
            if (isContain('LANDSAT')) {
                landsat = '(category_name in (\'LANDSAT\')) and ';
            }
            if (isContain('SRTM')) {
                srtm = '(category_name in (\'SRTM\')) and ';
            }
            if (isContain('SPOT')) {
                spot = '(category_name in (\'SPOT\')) and ';
            }
            if (isContain('ASTER')) {
                aster = '(category_name in (\'ASTER\')) and ';
            }
            if (isContain('ASTER GDEM')) {
                asterdem = '(category_name = \'ASTER GDEM\') and ';
            }
            if (isContain('MOSAIC LANDSAT')) {
                other = '(category_name in (\'MOSAIC LANDSAT\')) and ';
            }

            var coordinates = '(';
            if (DMT.gmaps.coordinateList.length <= 0) {
                $.blockUI({
                    theme: true,
                    title: lang.empty_interest_are_title,
                    message: '<p>' + lang.empty_interest_are_message + '</p>',
                    timeout: 4000
                });
                return;
            }
            else if (DMT.gmaps.coordinateList.length === 1) {
                coordinates += '(Intersects(GeomFromText(\'POINT (';
                for (var i = 0; i < DMT.gmaps.coordinateList.length; i++) {
                    var longitude = DMT.gmaps.coordinateList[i].lng().toFixed(DMT.coordinatePrecision);
                    var latitude = DMT.gmaps.coordinateList[i].lat().toFixed(DMT.coordinatePrecision);
                    coordinates += longitude + ' ' + latitude;
                }
                coordinates += ')\'), shape) = 1))';
            }
            else if (DMT.gmaps.coordinateList.length === 2) {
                coordinates += '(Intersects(GeomFromText(\'LINESTRING (';
                for (var i = 0; i < DMT.gmaps.coordinateList.length; i++) {
                    var longitude = DMT.gmaps.coordinateList[i].lng().toFixed(DMT.coordinatePrecision);
                    var latitude = DMT.gmaps.coordinateList[i].lat().toFixed(DMT.coordinatePrecision);
                    coordinates += longitude + ' ' + latitude + ',';
                }
                coordinates = coordinates.substr(0, coordinates.length - 1);
                coordinates += ')\'), shape) = 1))';
            }
            else {
                coordinates += '(Intersects(GeomFromText(\'POLYGON ((';
                for (var i = 0; i < DMT.gmaps.coordinateList.length; i++) {
                    var longitude = DMT.gmaps.coordinateList[i].lng().toFixed(DMT.coordinatePrecision);
                    var latitude = DMT.gmaps.coordinateList[i].lat().toFixed(DMT.coordinatePrecision);
                    coordinates += longitude + ' ' + latitude + ',';
                }
                coordinates += DMT.gmaps.coordinateList[0].lng().toFixed(DMT.coordinatePrecision) + ' '
                        + DMT.gmaps.coordinateList[0].lat().toFixed(DMT.coordinatePrecision) + ',';
                coordinates = coordinates.substr(0, coordinates.length - 1);
                coordinates += '))\'), shape) = 1))';
            }
//            alert(coordinates);
            var yearFrom = $('#yearFrom').val();
            var yearTo = $('#yearTo').val();
            var dateFrom = new Date($('#datepickerFrom').val()).format('Y-m-d');
            var dateTo = new Date($('#datepickerTo').val()).format('Y-m-d');

            var period = '';
            if ($('#dateYear').is(":checked")) {
                if (dateFrom === null || yearTo === null) {
                    $.ajax({
                        type: 'POST',
                        url: 'script/loadYears.php',
                        data: '&categories=' + category,
                        success: function (response) {
                            if (response.length > 5) {
                                $('#yearFrom').find('option').remove().end().append(response);
                                $('#yearTo').find('option').remove().end().append(response);
                                $('#yearTo option:last-child').attr('selected', 'selected');
                            }
                            else {
                                $('#yearFrom').find('option').remove().end();
                                $('#yearTo').find('option').remove().end();
                            }
                        }
                    });
                    $.blockUI({
                        theme: true,
                        title: lang.filling_years_title,
                        message: lang.filling_years_message,
                        timeout: 4000
                    });
                    return;
                }
                period = ' and (year(date) BETWEEN ' + yearFrom + ' and ' + yearTo + ')';
            }
            else {
                period = ' and (date BETWEEN DATE(\'' + dateFrom + '\') and DATE(\'' + dateTo + '\'))';
            }
            if (landsat !== '') {
                var mission = '', slc = '', ortho = '', stack = '';
                if (isContain('LANDSAT')) {
                    if ($('#missionLandsat').val() === 'all') {
                        mission = '';
                    } else {
                        mission = ' and (mission = ' + $('#missionLandsat').val() + ')';
                    }
                    if ($('#slc').val() === 'all') {
                        slc = '';
                    } else {
                        slc = ' and (slc = \'' + $('#slc').val() + '\')';
                    }
                    if ($('#orthorectified').val() === 'all') {
                        ortho = '';
                    } else {
                        ortho = ' and (ortho = \'' + $('#orthorectified').val() + '\')';
                    }
                    if ($('#stack').val() === 'yes') {
                        stack = '';
                    } else {
                        stack = ' and (stack = \'' + $('#stack').val() + '\')';
                    }
                }
                landsat += coordinates + period + mission + slc + ortho + stack;
            }
            if (srtm !== '') {
                var version = '', resolution = '';
                if (isContain('SRTM')) {
                    if ($('#missionSRTM').val() === 'all') {
                        version = '';
                    } else {
                        version = ' and (mission = \'' + $('#missionSRTM').val() + '\')';
                    }
                    if ($('#resolutionSRTM').val() === 'all') {
                        resolution = '';
                    } else if ($('#resolutionSRTM').val() === '30') {
                        resolution = ' and (format = \'DT2\')';
                    } else {
                        resolution = ' and (format <> \'DT2\')';
                    }
                }
                srtm += coordinates + period + version + resolution;
            }
            if (spot !== '') {
                var versionSpot = '';
                if (isContain('SPOT')) {
                    if ($('#verionSPOT').val() === 'all') {
                        versionSpot = '';
                    }
                    else {
                        versionSpot = ' and (mission = \'' + $('#verionSPOT').val() + '\')';
                    }
                }
                spot += coordinates + period + versionSpot;
            }
            if (aster !== '') {
                aster += coordinates + period;
            }
            if (asterdem !== '') {
                asterdem += coordinates + period;
            }
            if (other !== '') {
                other += coordinates + period;
            }

            $('#search-results-container').html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="' + lang.loading + '" src="images/loader.gif" /><span> ' + lang.searching_images_loading + ' ...</span>');

            $('#tabs').tabs({active: 2});
            var criteria = '&landsat=' + landsat + '&srtm=' + srtm + '&spot=' + spot + '&aster=' + aster + '&asterdem=' + asterdem + '&other=' + other;
            $.ajax({
                type: 'POST',
                url: 'script/getCategoriesResult.php',
                data: criteria,
                success: function (response) {
                    $('#categoryResult').find('option').remove().end().append(response);
                    var selected = $('#categoryResult').val();
                    if (selected === 'LANDSAT') {
                        items = '&landsat=' + landsat;
                    }
                    else if (selected === 'SRTM') {
                        items = '&srtm=' + srtm;
                    }
                    else if (selected === 'SPOT') {
                        items = '&spot=' + spot;
                    }
                    else if (selected === 'ASTER') {
                        items = '&aster=' + aster;
                    }
                    else if (selected === 'ASTER GDEM') {
                        items = '&asterdem=' + asterdem;
                    }
                    else {
                        items = '&other=' + other;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'script/getNumRow.php',
                        data: items,
                        success: function (response) {
                            var nr = parseInt(response);
                            nRowResult = nr;
                            if (nr === 0) {
                                $('#search-results-container').html('');
                                $.blockUI({
                                    theme: true,
                                    title: lang.no_image_found_title,
                                    message: '<span style="color:#D10500;padding:7px;">' + lang.no_image_found_message + '</span>',
                                    timeout: 4000
                                });
                                return;
                            }
                            else {
                                $('#checkAllResult').prop('checked', true);
                                hash = {};
                                arrayColorfp = {};
                                $.ajax({
                                    type: 'POST',
                                    url: 'script/getIDs.php',
                                    data: criteria,
                                    success: function (response) {
                                        var tab = response.split(';');
                                        for (var i = 0; i < tab.length; i++) {
                                            hash[tab[i]] = true;
                                            arrayColorfp[tab[i]] = 'transparent';
                                        }
                                    }
                                });
                                var pn = 1;
                                pagination(nr, pn);
                            }
                        }
                    });
                }
            });
        });
        $('#resetButton').click(function () {
            if ($(this).hasClass('disabled')) {
                return;
            }
            DMT.tabs.clearAll();
        });
        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            return pattern.test(emailAddress);
        }
        $('#submitButton').click(function () {
            if ($(this).hasClass('disabled')) {
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'php_includes/check_login_status.php',
                success: function (response) {
                    if (response === "") {
                        $.blockUI({
                            theme: true,
                            title: 'Warning',
                            message: '<p>You must log in before submitting your data request</p>',
                            timeout: 4000
                        });
                        return;
                    } else {
                        var tabID = ReturnIdsChecked().split(';');
                        var idss = '';
                        var limit;
                        tabID.length >= 1 ? limit = tabID.length - 1 : limit = tabID.length;
                        for (var i = 0; i < limit; i++) {
                            idss += tabID[i] + ';';
                        }
                        idss = idss.substring(0, idss.length - 1);
                        document.location.href = 'pages/requestForm.php?' + idss;
                    }
                }
            });

        });
        $('#categoryResult').change(function () {
            $('#pagingResultHeader, #pagingResultFooter').html('');
            var selected = $('#categoryResult').val();
            if (selected !== '') {
                $('#search-results-container').html('<img style="padding-left:5px;padding-top:5px;" align="bottom" alt="' + lang.loading + '" src="images/loader.gif" /><span> ' + lang.searching_images_loading + ' ...</span>');
                if (selected === 'LANDSAT') {
                    items = '&landsat=' + landsat;
                }
                else if (selected === 'SRTM') {
                    items = '&srtm=' + srtm;
                }
                else if (selected === 'SPOT') {
                    items = '&spot=' + spot;
                } else if (selected === 'ASTER GDEM') {
                    items = '&asterdem=' + asterdem;
                }
                else if (selected === 'ASTER') {
                    items = '&aster=' + aster;
                }
                else {
                    items = '&other=' + other;
                }
                $.ajax({
                    type: 'POST',
                    url: 'script/getNumRow.php',
                    data: items,
                    success: function (response) {
                        var nr = parseInt(response);
                        var pn = 1;
                        alert(pn + " " + nr);
                        pagination(nr, pn);
                    }
                });
            }
        });
        $('#checkAllResult').click(function () {
            var selected = $(this).is(':checked');
            selected ? $('#submitButton').removeClass('disabled') : $('#submitButton').addClass('disabled');
            $('input.resultCheckBox').prop('checked', selected);
            for (var id in hash) {
                var resultRow = $('#resultRow_' + id);
                hash[id] = selected;
                selected ? resultRow.removeClass('excludedResultRow') : resultRow.addClass('excludedResultRow');
            }

        });
        function ReturnIdsChecked() {
            var result = '';
            for (var id in hash) {
                if (hash[id] === true) {
                    result += id + ';';
                }
            }
            return result;
        }
        $('#shapefileSubmit').click(function () {
            $.blockUI({
                theme: true,
                title: lang.shapefile_submit_title,
                message: lang.shapefile_submit_message,
                timeout: 4000
            });
            return;
//            var ctaLayer = new google.maps.KmlLayer({
//                url: 'http://gmaps-samples.googlecode.com/svn/trunk/ggeoxml/cta.kml'
//            });
//            ctaLayer.setMap(DMT.gmaps.map);
        });
    },
    attachTab1Listeners: function () {
// Create the DMS/DD buttonset
        $('#lat_lon_section').buttonset();
// Create the date buttonset
        $('#dateSection').buttonset();
        $('#googleAddress').keypress(function (e) {
            if (e.which === 13) {
                $('#geoShowAddress').click();
                return false;
            }
        });
        $('#googleRow').click(function (event) {
            var eventTarget = $(event.target);
            if (eventTarget.hasClass('address')) {
                var row = eventTarget.parent().parent();
// Add the coordinate
                DMT.gmaps.coordinates.add(new google.maps.LatLng(row.children('td.lat').html(), row.children('td.lng').html()));
// Center on the point
                DMT.gmaps.centerMap();
// Clear the form
                $('#geoClearAddress').trigger('click');
            }
        });
        $('#geoShowAddress').click(function () {
            $('#googleAddress').val($('#googleAddress').val().trim());
            DMT.gmaps.googleCoder.codeAddress();
        });
        $('#geoShowPathRow').click(function () {
            DMT.gmaps.pathrowCoder.showLocation();
        });
        $('#geoShowFeature').click(function () {
            DMT.gmaps.featureCoder.codeAddress();
        });
        $('#geoClearAddress').click(function () {
            DMT.gmaps.googleCoder.clear();
        });
        $('#geoClearPathRow').click(function () {
            DMT.gmaps.pathrowCoder.clear();
        });
        $('#geoClearFeature').click(function () {
            DMT.gmaps.featureCoder.clear();
        });
        //Manage feature
        $('#province').change(function () {
            var idParent = $('#province').val();
            var parent = 'province';
            var child = 'district';
            var idChild = '#district';
            var ErrorMessage = 'This ' + parent + ' doesn\'t have predefined ' + child + 's  ...';
            if (idParent !== null) {
                $(idChild).attr('disabled', false);
                $('#territory').attr('disabled', true);
                $('#territory').find('option').remove().end();
                $('#sector').attr('disabled', true);
                $('#sector').find('option').remove().end();
                $('#locality').attr('disabled', true);
                $('#locality').find('option').remove().end();
                $('#featureLoader').show();
                $('#geoErrorMessageFeature').stop(true, true).hide();
                $.ajax({
                    type: 'POST',
                    url: 'script/loadFeature.php',
                    data: '&idParent=' + idParent + '&parent=' + parent + '&child=' + child,
                    success: function (response) {
                        $('#featureLoader').hide();
                        if (response.length > 5) {
                            $(idChild).find('option').remove().end().append(response);
                            $(idChild).val('');
                        } else {
                            $(idChild).find('option').remove().end();
                            $(idChild).attr('disabled', true);
                            $.blockUI({
                                theme: true,
                                title: lang.error_occured,
                                message: '<p>' + ErrorMessage + '</p>',
                                timeout: 3000
                            });
                        }
                    }
                });
            } else {
                DMT.gmaps.featureCoder.clear();
            }
        });
        $('#district').change(function () {
            var idParent = $('#district').val();
            var parent = 'district';
            var child = 'territory';
            var idChild = '#territory';
            var ErrorMessage = 'This ' + parent + ' doesn\'t have predefined ' + child + 's  ...';
            if (idParent !== null) {
                $(idChild).attr('disabled', false);
                $('#sector').attr('disabled', true);
                $('#sector').find('option').remove().end();
                $('#locality').attr('disabled', true);
                $('#locality').find('option').remove().end();
                $('#featureLoader').show();
                $('#geoErrorMessageFeature').stop(true, true).hide();
                $.ajax({
                    type: 'POST',
                    url: 'script/loadFeature.php',
                    data: '&idParent=' + idParent + '&parent=' + parent + '&child=' + child,
                    success: function (response) {
                        $('#featureLoader').hide();
                        if (response.length > 5) {
                            $(idChild).find('option').remove().end().append(response);
                            $(idChild).val('');
                        } else {
                            $(idChild).find('option').remove().end();
                            $(idChild).attr('disabled', true);
                            $.blockUI({
                                theme: true,
                                title: lang.error_occured,
                                message: '<p>' + ErrorMessage + '</p>',
                                timeout: 3000
                            });
                        }
                    }
                });
            }
            else {
                $(idChild).attr('disabled', true);
            }
        });
        $('#territory').change(function () {
            var idParent = $('#territory').val();
            var parent = 'territory';
            var child = 'sector';
            var idChild = '#sector';
            var ErrorMessage = 'This ' + parent + ' doesn\'t have predefined ' + child + 's  ...';
            if (idParent !== null) {
                $(idChild).attr('disabled', false);
                $('#locality').attr('disabled', true);
                $('#locality').find('option').remove().end();
                $('#featureLoader').show();
                $('#geoErrorMessageFeature').stop(true, true).hide();
                $.ajax({
                    type: 'POST',
                    url: 'script/loadFeature.php',
                    data: '&idParent=' + idParent + '&parent=' + parent + '&child=' + child,
                    success: function (response) {
                        $('#featureLoader').hide();
                        if (response.length > 5) {
                            $(idChild).find('option').remove().end().append(response);
                            $(idChild).val('');
                        } else {
                            $(idChild).find('option').remove().end();
                            $(idChild).attr('disabled', true);
                            $.blockUI({
                                theme: true,
                                title: lang.error_occured,
                                message: '<p>' + ErrorMessage + '</p>',
                                timeout: 3000
                            });
                        }
                    }
                });
            }
            else {
                $(idChild).attr('disabled', true);
            }
        });
        $('#sector').change(function () {
            var idParent = $('#sector').val();
            var parent = 'sector';
            var child = 'locality';
            var idChild = '#locality';
            var ErrorMessage = 'This ' + parent + ' doesn\'t have predefined ' + child + 's  ...';
            if (idParent !== null) {
                $(idChild).attr('disabled', false);
                $('#featureLoader').show();
                $('#geoErrorMessageFeature').stop(true, true).hide();
                $.ajax({
                    type: 'POST',
                    url: 'script/loadFeature.php',
                    data: '&idParent=' + idParent + '&parent=' + parent + '&child=' + child,
                    success: function (response) {
                        $('#featureLoader').hide();
                        if (response.length > 5) {
                            $(idChild).find('option').remove().end().append(response);
                            $(idChild).val('');
                        } else {
                            $(idChild).find('option').remove().end();
                            $(idChild).attr('disabled', true);
                            $.blockUI({
                                theme: true,
                                title: lang.error_occured,
                                message: '<p>' + ErrorMessage + '</p>',
                                timeout: 3000
                            });
                        }
                    }
                });
            }
            else {
                $(idChild).attr('disabled', true);
            }
        });
        $('#slc').change(function () {
            var value = $('#slc').val();
            if (value === 'all') {
                $('#SLCInfo').slideUp(500);
            }
            else {
                if (value === 'on') {
                    $('#SLCInfo').html('L7 ETM+ SLC-on (1999-2003)').slideDown(500);
                }
                else {
                    $('#SLCInfo').html('L7 ETM+ SLC-off (2003-present)').slideDown(500);
                }
                $('#SLCInfo').delay(4000).slideUp(500);
            }
        });
        $('#accordion1, #accordion2, #accordion3, #accordion4').click(function () {
            DMT.gmaps.googleCoder.clear();
            DMT.gmaps.pathrowCoder.clear();
            DMT.gmaps.featureCoder.clear();
        });
        $('#coordEntryClear').click(function () {
            DMT.gmaps.coordinates.clear();
        });
        $('#datepickerFrom, #datepickerTo').blur(function () {
            if ($(this).val() === "") {
                if ($(this).attr('id') === 'datepickerFrom') {
                    $(this).val('07/27/1972');
                }
                else {
                    $(this).val('06/11/2012');
                }
            }
            if (new Date($('#datepickerFrom').val()) > new Date($('#datepickerTo').val())) {
                alert(lang.error_greater_date);
                $('#datepickerTo').val(new Date($('#datepickerFrom').val()).format('m/d/Y'));
            }
        });
        $('#yearFrom, #yearTo').blur(function () {
            if (parseInt($('#yearFrom').val()) > parseInt($('#yearTo').val())) {
                alert(lang.error_greater_year);
                $('#yearTo').val($('#yearFrom').val());
            }
        });
        $('#categorySelector').click(function () {
            if ($('#categorySelectorDropPanel').is(':visible')) {
                $('#categorySelector span.ui-icon').attr('class', 'ui-icon ui-icon-triangle-1-s');
                $('#categorySelectorDropPanel').slideUp(75);
                DMT.controls.bodyListener.removeListener();
            }
            else {
                $('#categorySelector span.ui-icon').attr('class', 'ui-icon ui-icon-triangle-1-n');
                $('#categorySelectorDropPanel').slideDown(75);
                DMT.controls.bodyListener.addListener();
            }
        });
        $('#categorySelectorDropPanel a input').click(function () {
            $(this).parent().click();
        });
        $('#categorySelectorDropPanel a').click(function () {
            $element = $(this).children('input');
            var selected = $element.prop('checked');
            var categoryBoxesLength = document.categoryForm.categoryBoxes.length;
            if ($element.val() === '') {
                var allSelected = !$element.prop('checked');
// The user is clicking (all) so check/uncheck them all
                for (var i = 0; i < categoryBoxesLength; i++) {
                    document.categoryForm.categoryBoxes[i].checked = allSelected;
                }
                if (allSelected) {
                    $('#categorySelector span.text').html('(all)');
                } else {
                    $('#categorySelector span.text').html('(none)');
                }
            }
            else {
                $element.prop('checked', !selected);
                var selected = [];
// Determine if all are selected
                for (var i = 1; i < categoryBoxesLength; i++) {
                    if (document.categoryForm.categoryBoxes[i].checked === true) {
                        selected.push(i);
                    }
                }
                if (selected.length === 0) {
                    $('#categorySelector span.text').html('(none)');
                }
                else {
                    document.categoryForm.categoryBoxes[0].checked = (selected.length === (categoryBoxesLength - 1));
                    if (document.categoryForm.categoryBoxes[0].checked === true) {
                        $('#categorySelector span.text').html('(all)');
                    }
                    else {
                        var categoriesChecked = [];
                        for (var i = 0; i < selected.length; i++) {
                            categoriesChecked.push(categories[selected[i]]);
                        }
                        $('#categorySelector span.text').html(categoriesChecked.join(", "));
                    }
                }
            }
            var catSelected = $('#categorySelector span.text').html();
            if (catSelected === '(all)') {
                $('#MLandsat').show();
                $('#MSPOT').show();
                $('#MSRTM').show();
            }
            else if (catSelected === '(none)') {
                $('#MLandsat').hide();
                $('#MSPOT').hide();
                $('#MSRTM').hide();
            }
            else {
                if (catSelected.indexOf("LANDSAT") >= 0) {
                    $('#MLandsat').show();
                }
                else {
                    $('#MLandsat').hide();
                }
                if (catSelected.indexOf("SRTM") >= 0) {
                    $('#MSRTM').show();
                }
                else {
                    $('#MSRTM').hide();
                }
                if (catSelected.indexOf("SPOT") >= 0) {
                    $('#MSPOT').show();
                }
                else {
                    $('#MSPOT').hide();
                }
            }
//            alert(catSelected);
            //Loading years according to categories of images selected
            $.ajax({
                type: 'POST',
                url: 'script/loadYears.php',
                data: '&categories=' + catSelected,
                success: function (response) {
                    if (response.length > 5) {
                        $('#yearFrom').find('option').remove().end().append(response);
                        $('#yearTo').find('option').remove().end().append(response);
                        $('#yearTo option:last-child').attr('selected', 'selected');
                    }
                    else {
                        $('#yearFrom').find('option').remove().end();
                        $('#yearTo').find('option').remove().end();
                    }
                }
            });
        });
        $('#lat_lon_section input:radio').click(function () {
            DMT.gmaps.settings.format = $(this).val();
            var showFormat = $(this).val();
            var hideFormat = ($(this).val() === 'dd') ? 'dms' : 'dd';
            $('#coordEntryArea').find('div.format_' + hideFormat).hide();
            $('#coordEntryArea').find('div.format_' + showFormat).show();
        });
        $('#dateSection input:radio').click(function () {
            var showFeatureType = $(this).val();
            var hideFeatureType = ($(this).val() === 'Date') ? 'Year' : 'Date';
            $('#period' + hideFeatureType).hide();
            $('#period' + showFeatureType).show();
        });
        $('#coordEntryAdd').click(function () {
            if (DMT.gmaps.coordinateList.length >= DMT.gmaps.settings.getMaxPoints()) {
                $.blockUI({
                    theme: true,
                    title: lang.max_point_exceeded,
                    message: lang.max_point_exceeded_message1 + DMT.gmaps.settings.getMaxPoints() + lang.max_point_exceeded_message2,
                    timeout: 4000
                });
                return;
            }
// Don't let them add any more points - 2 in enough for a circle
            if (DMT.gmaps.overlays.polygon.type === 'circle' && DMT.gmaps.coordinateList.length >= 2) {
                $.blockUI({
                    theme: true,
                    title: lang.warning,
                    message: lang.circle_error_message,
                    timeout: 4000
                });
                return;
            }
            $('#coordEntryDialogArea').dialog({
                bgiframe: true,
                autoOpen: false,
                resizable: false,
                height: 170,
                width: 400,
                modal: true,
                buttons: [
                    {
                        text: lang.add,
                        icons: {
                            primary: "ui-icon-check"
                        },
                        click: function () {
                            var error = '';
                            var response;
                            var format = DMT.gmaps.settings.getFormat();
                            var latitude, longitude, response;
                            var $dialogContent = $('#coordEntryDialogArea');
                            if (format === 'dd') {
                                latitude = $dialogContent.find('input.latitude').val();
                                longitude = $dialogContent.find('input.longitude').val();
                                response = validateDialogInput(latitude, longitude, format);
// Make sure the input is numeric
                                if (response.valid) {
                                    DMT.gmaps.coordinates.add(new google.maps.LatLng(latitude, longitude));
                                } else {
                                    error = response.message;
                                }
                            } else {
                                latitude = ['', '', '', ''];
                                longitude = ['', '', '', ''];
                                latitude[0] = $dialogContent.find('input.degreesLat').val();
                                latitude[1] = $dialogContent.find('input.minutesLat').val();
                                latitude[2] = $dialogContent.find('input.secondsLat').val();
                                latitude[3] = $dialogContent.find('select.directionLat').val();
                                longitude[0] = $dialogContent.find('input.degreesLng').val();
                                longitude[1] = $dialogContent.find('input.minutesLng').val();
                                longitude[2] = $dialogContent.find('input.secondsLng').val();
                                longitude[3] = $dialogContent.find('select.directionLng').val();
                                response = validateDialogInput(latitude, longitude, format);
                                if (response.valid) {
                                    var latitudeDec = convertDMSToDec(latitude);
                                    var longitudeDec = convertDMSToDec(longitude);
                                    DMT.gmaps.coordinates.add(new google.maps.LatLng(latitudeDec, longitudeDec));
                                } else {
                                    error = response.message;
                                }
                            }
                            if (error.length < 1) {
                                $(this).dialog('close');
                            } else {
                                alert(lang.error + ': ' + error);
                            }
// Center the map on the new polygon
                            DMT.gmaps.centerMap();
                        }
                    },
                    {
                        text: lang.close,
                        icons: {
                            primary: "ui-icon-close"
                        },
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                ],
                title: lang.add_new_coordinate,
                open: function () {
                    var $dialogContent = $('#coordEntryDialogArea');
                    if (DMT.gmaps.settings.getFormat() === 'dd') {
                        $dialogContent.html($('#coordEntryDialogTemplate span.dd').html());
                    }
                    else {
                        $dialogContent.html($('#coordEntryDialogTemplate span.dms').html());
                    }
                },
                close: function () {
                    $(this).dialog('destroy');
                }
            });
            $('#coordEntryDialogArea').dialog('open');
        });
        $('#coordEntryArea').click(function (event) {
            var eventTarget = $(event.target);
            var clicked = (eventTarget.is('a')) ? eventTarget : eventTarget.parents('a');
            if (clicked.attr('class') !== undefined)
            {
                var index = clicked.attr('id').split('_')[1] | 0;
                if (clicked.hasClass('edit')) {
                    $('#coordEntryDialogArea').dialog({
                        bgiframe: true,
                        autoOpen: false,
                        resizable: false,
                        height: 170,
                        width: 400,
                        modal: true,
                        buttons: [
                            {
                                text: lang.save,
                                icons: {
                                    primary: "ui-icon-check"
                                },
                                click: function () {
                                    var error = '';
                                    var response;
                                    var format = DMT.gmaps.settings.getFormat();
                                    var latitude, longitude, response;
                                    var $dialogContent = $('#coordEntryDialogArea');
                                    if (format === 'dd') {
                                        latitude = $dialogContent.find('input.latitude').val();
                                        longitude = $dialogContent.find('input.longitude').val();
                                        response = validateDialogInput(latitude, longitude, format);
// Make sure the input is numeric
                                        if (response.valid) {
                                            DMT.gmaps.coordinates.update(index, new google.maps.LatLng(latitude, longitude));
                                        } else {
                                            error = response.message;
                                        }
                                    } else {
                                        latitude = ['', '', '', ''];
                                        longitude = ['', '', '', ''];
                                        latitude[0] = $dialogContent.find('input.degreesLat').val();
                                        latitude[1] = $dialogContent.find('input.minutesLat').val();
                                        latitude[2] = $dialogContent.find('input.secondsLat').val();
                                        latitude[3] = $dialogContent.find('select.directionLat').val();
                                        longitude[0] = $dialogContent.find('input.degreesLng').val();
                                        longitude[1] = $dialogContent.find('input.minutesLng').val();
                                        longitude[2] = $dialogContent.find('input.secondsLng').val();
                                        longitude[3] = $dialogContent.find('select.directionLng').val();
                                        response = validateDialogInput(latitude, longitude, format);
                                        if (response.valid) {
                                            var latitudeDec = convertDMSToDec(latitude);
                                            var longitudeDec = convertDMSToDec(longitude);
                                            DMT.gmaps.coordinates.update(index, new google.maps.LatLng(latitudeDec, longitudeDec));
                                        } else {
                                            error = response.message;
                                        }
                                    }
                                    if (error.length < 1) {
                                        $(this).dialog('close');
                                    } else {
                                        alert(lang.error + ': ' + error);
                                    }
// Center the map on the new polygon
                                    DMT.gmaps.centerMap();
                                }
                            },
                            {
                                text: lang.close,
                                icons: {
                                    primary: "ui-icon-close"
                                },
                                click: function () {
                                    $(this).dialog("close");
                                }
                            }
                        ],
                        title: lang.edit_coordinate + ' #' + (index + 1).toString(),
                        open: function () {
                            var $dialogContent = $('#coordEntryDialogArea');
                            var latitude = DMT.gmaps.coordinateList[index].lat().toFixed(DMT.coordinatePrecision);
                            var longitude = DMT.gmaps.coordinateList[index].lng().toFixed(DMT.coordinatePrecision);
                            if (DMT.gmaps.settings.getFormat() === 'dd') {
                                $dialogContent.html($('#coordEntryDialogTemplate span.dd').html());
                                $dialogContent.find('input.latitude').val(latitude);
                                $dialogContent.find('input.longitude').val(longitude);
                            } else {
                                $dialogContent.html($('#coordEntryDialogTemplate span.dms').html());
                                var dmsLatitude = convertDecToDMS(latitude, 'lat', false);
                                var dmsLongitude = convertDecToDMS(longitude, 'lng', false);
                                latitude = dmsLatitude.split(' ');
                                longitude = dmsLongitude.split(' ');
                                $dialogContent.find('input.degreesLat').val(latitude[0]);
                                $dialogContent.find('input.minutesLat').val(latitude[1]);
                                $dialogContent.find('input.secondsLat').val(latitude[2]);
                                $dialogContent.find('select.directionLat').val(latitude[3]);
                                $dialogContent.find('input.degreesLng').val(longitude[0]);
                                $dialogContent.find('input.minutesLng').val(longitude[1]);
                                $dialogContent.find('input.secondsLng').val(longitude[2]);
                                $dialogContent.find('select.directionLng').val(longitude[3]);
                            }
                        },
                        close: function () {
//$('#coordEntryDialogContainer_' + elementNum).hide();
                            $(this).dialog('destroy');
                        }
                    });
                    $('#coordEntryDialogArea').dialog('open');
                }
                else if (clicked.hasClass('delete')) {
                    DMT.gmaps.coordinates.remove(index);
// Check if this was the last element
                    if ($('#coordEntryArea li').not('#coordinateElementEmpty').size() === 0)
                    {
                        $('#coordinateElementEmpty').show();
                    }
                }
            }
        });
        $("#coordEntryArea").sortable({
            opacity: 0.8,
            axis: 'y',
            items: 'li:not(:first)',
            update: function (event, ui) {
                var order = $('#coordEntryArea').sortable('toArray');
                var pos = 0;
// Locate the first location a change takes place
                for (var i = 0; i < order.length; i++)
                {
                    if (parseInt(order[i].split('_')[1], 10) !== i)
                    {
                        pos = i;
                        break;
                    }
                }
                var temp = [];
// Push the coordinates into a temporary array for the new order
                for (var i = 0; i < order.length; i++)
                {
                    temp.push(DMT.gmaps.coordinateList[parseInt(order[i].split('_')[1], 10)]);
                }
// Set the coordinateList to the temporary list
                DMT.gmaps.coordinateList = temp;
// Remove the coordinate elements after the change, inclusive
                DMT.gmaps.coordinateElements.splice(pos, (temp.length - pos));
// Starting from the first change, update all elements after
                for (var j = pos; j < temp.length; j++)
                {
// Add the coordinate element
                    DMT.gmaps.coordinateElements.add(j);
// Update the marker
                    DMT.gmaps.markers.update(j);
                }
// Redraw the polygon
                DMT.gmaps.polygon.redraw();
            }
        });
        $("#coordEntryArea").disableSelection();
    },
    attachTab3Listeners: function () {
        $('#search-results-container').on('click', '.excludeReset', function () {
            DMT.dataset.includeAllResults();
        });
        $("#showAllFootprints").click(function () {
            DMT.gmaps.footprints.showAll($(this).prop('checked'));
        });
// Handle icon clicking
        $('#search-results-container').click(function (e) {
            var eventTarget = $(e.target);
            var clicked = (eventTarget.is('a')) ? eventTarget : eventTarget.parents('a');
            if (clicked.attr('class') !== undefined) {
                if (clicked.hasClass('footprint')) {
                    var details = clicked.children('span').attr('class').split(';');
                    DMT.gmaps.footprints.toggle(details[0], details[1], details[2], details[3], details[4], details[5]);
                }
            }
        });
        $('#search-results-container').on('change', '.pageSelector', function () {
            var page = $(this).val().split('_');
// Remove the browse and footprints from the map
            DMT.gmaps.footprints.clearAll();
            DMT.gmaps.browse.clearAll();
            $("#tab4data a.footprint").css('background-color', 'transparent');
            $("#tab4data a.browse").css('background-color', 'transparent');
// Remove info windows from the map
            for (var i in DMT.gmaps.infowindowsOverlay) {
                DMT.gmaps.infowindowsOverlay[i].close();
            }
            if ($('#showAllFootprints').prop('checked')) {
                DMT.gmaps.footprints.showAll(true);
            }
            if ($('#showAllBrowse').prop('checked')) {
                DMT.gmaps.browse.showAll(true);
            }
            DMT.dataset.getResultPage(page[1], page[0]);
        });
    }
};