// Convert decimal coordinate to degrees/minutes/seconds
function convertDecToDMS(coordinate, type, symbols) {
// Make sure the coordinate is a string
    coordinate = '' + coordinate;
    if (coordinate.lastIndexOf('.', 0) === false) {
        coordinate += ".0";
    }
    var parts = coordinate.split('.');
    var degrees = Math.abs(parts[0]);
    var temp = "0." + parts[1];
    temp *= 3600;
    var minutes = (temp / 60) | 0;
    var seconds = (DMT.truncateSeconds) ? (temp - (minutes * 60)) | 0 : (temp - (minutes * 60)).toFixed(DMT.coordinatePrecision);
    var direction = '';
    if (type === 'lat') {
        degrees = padNumber(degrees, 2);
        direction = (coordinate < 0) ? 'S' : 'N';
    } else {
        degrees = padNumber(degrees, 3);
        direction = (coordinate < 0) ? 'W' : 'E';
    }
    minutes = padNumber(minutes, 2);
    seconds = padNumber(seconds, 2);
    coordinate = (symbols === false) ? degrees + ' ' + minutes + ' ' + seconds + ' ' + direction :
            degrees + '\u00B0 ' + minutes + '\u0027 ' + seconds + '\u0022' + ' ' + direction;
    return coordinate;
}
// Convert degrees/minutes/seconds coordinate to decimal
// Optimized
function convertDMSToDec(coordinate) {
// If the user didn't put a value, assume it is zero
    for (var i = 0; i < coordinate.length; i++) {
        if (coordinate[i].length < 1) {
            coordinate[i] = 0;
        }
    }
    var degrees = parseFloat(coordinate[0]);
    var minutes = parseFloat(coordinate[1]);
    var seconds = parseFloat(coordinate[2]);
    var direction = coordinate[3];
    coordinate = degrees + minutes / 60 + seconds / 3600;
    coordinate = (direction === 'W' || direction === 'S') ? coordinate * -1.0 : coordinate;
    return coordinate.toFixed(DMT.coordinatePrecision);
}
// Add leading zeros to numbers
// Examined
function padNumber(number, length) {
    var str = number.toString();
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}
// Increase the color values for RGB to a lighter shade
// Optimized
function brightenColor(color) {
    var rgb = parseInt(color.substring(1, 7), 16);
    var rVal = (rgb & 0xff0000) >> 16;
    rVal = ((rVal * 1.4 > 255) ? 255 : rVal * 1.4 | 0).toString(16);
    var gVal = (rgb & 0x00ff00) >> 8;
    gVal = ((gVal * 1.4 > 255) ? 255 : gVal * 1.4 | 0).toString(16);
    var bVal = (rgb & 0x0000ff);
    bVal = ((bVal * 1.4 > 255) ? 255 : bVal * 1.4 | 0).toString(16);
    return '#' + padNumber(rVal, 2) +
            padNumber(gVal, 2) +
            padNumber(bVal, 2);
}

DMT.gmaps = {
    coordinateList: [],
    geocoder: null,
    map: null,
    overlayMap: null,
    overlays: {
        browse: [],
        footprints: [],
        grid: null,
        infoWindows: [],
        markers: [],
        polygon: null
    },
    results: {
        datasets: 0
    },
    settings: {
        dragLock: false,
        footprintDisplayDefaults: {
            strokeWeight: 1,
            strokeOpacity: 0.9,
            fillColor: '#00FF00',
            fillOpacity: 0.5,
            geodesic: false
        },
        format: null,
        getFormat: function () {
//return ($('#latlonfmtdeg').is(':checked'))? 'dms' : 'dd';
            if (DMT.gmaps.settings.format === null) {
                DMT.gmaps.settings.format = ($('#latlonfmtdeg').prop('checked')) ? 'dms' : 'dd';
                return DMT.gmaps.settings.format;
            }
            else {
                return DMT.gmaps.settings.format;
            }
        },
        geodesic: false,
        latPan: 200,
        lngPan: 450,
        maxPoints: 20,
        getMaxPoints: function () {
            if (DMT.gmaps.settings.maxPoints === null)
                DMT.gmaps.settings.maxPoints = parseInt($('#maxPoints').val(), 10);
            return DMT.gmaps.settings.maxPoints;
        },
        resultsPerPage: 10
    },
    polygonTool: {
        changeTabs: function (polygonType) {
            var polygonType = DMT.gmaps.overlays.polygon.type;
// Deselect all geoTabs and areaTabs
            $('#geoTabs div.tab').removeClass('selected');
            $('#areaTabs div.tab').removeClass('selected');
// Hide the visible geoForm and areaForm
            $('#tab1data div.control-container div.geoForm:visible').hide();
            $('#tab1data div.control-container div.areaForm:visible').hide();
            if (polygonType === "polygon") {
// Select the Address/Place and Coordinate tabs
                $('#tabAddress').addClass('selected');
                $('#tabCoordinates').addClass('selected');
// Show the Address and Coordinates forms
                $('#tabAddressForm').show();
                $('#tabCoordinatesForm').show();
// Disable the Circle tab
                $('#tabCircle').addClass('disabled');
            }
            else if (polygonType === "circle") {
// Enable the Circle tag
                $('#tabCircle').removeClass('disabled');
// Select the Circle and Coordinate tabs
                $('#tabCircle').addClass('selected');
                $('#tabCoordinates').addClass('selected');
// Show the Circle and Coordinates forms
                $('#tabCircleForm').show();
                $('#tabCoordinatesForm').show();
            }
        },
        toggle: function () {
// Clear the previous coordinates
            DMT.gmaps.coordinates.clear();
            DMT.gmaps.polygonTool.disableKeyBounds();
            if ($('#polygonTypeCircle').prop('checked') === false)
            {
// Deselect the circle tab before disabling it
                if ($('#tabCircle').hasClass('selected'))
                {
                    $('#tabAddress').trigger('click');
                }
                $('#tabCircle').addClass('disabled');
                $('#tabCircle').attr('title', 'Select Circle Map Option');
                DMT.gmaps.overlays.polygon = new google.maps.Polygon({
                    paths: [new google.maps.LatLng(0, 0)],
                    map: DMT.gmaps.map,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.25,
                    geodesic: DMT.gmaps.settings.geodesic,
                    clickable: false
                });
                DMT.gmaps.overlays.polygon.type = 'polygon';
            }
            else
            {
// Enable the circle tab
                $('#tabCircle').removeClass('disabled');
                $('#tabCircle').attr('title', '');
// Click the circle tab
                $('#tabCircle').trigger('click');
                DMT.gmaps.overlays.polygon = new google.maps.Circle({
                    center: new google.maps.LatLng(0, 0),
                    map: DMT.gmaps.map,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.25,
                    radius: 0,
                    clickable: false
                });
                DMT.gmaps.overlays.polygon.type = 'circle';
            }
            DMT.gmaps.polygonTool.enableKeyBounds();
            if (getBrowserName() === 'IE')
            {
                window.scrollBy(0, 1);
            }
        },
        enableKeyBounds: function () {
            if (DMT.gmaps.overlays.polygon.type === 'circle') {
                DMT.gmaps.map.enableKeyCircleBounds();
            } else {
                DMT.gmaps.map.enableKeyDragBounds();
            }
        },
        disableKeyBounds: function () {
            if (DMT.gmaps.overlays.polygon.type === 'circle')
            {
                DMT.gmaps.map.disableKeyCircleBounds();
            }
            else
            {
                DMT.gmaps.map.disableKeyDragBounds();
            }
        },
        disableAllKeyBounds: function () {
            DMT.gmaps.map.disableKeyCircleBounds();
            DMT.gmaps.map.disableKeyDragBounds();
        }
    },
    // TODO: Rewrite
// Centers the map on the current polygon
    centerMap: function () {
        if (DMT.gmaps.coordinateList.length < 1) {
            return;
        }
        var bounds = new google.maps.LatLngBounds();
        if (DMT.gmaps.overlays.polygon.type === 'polygon') {
            for (var i = 0; i < DMT.gmaps.coordinateList.length; i++) {
                bounds.extend(DMT.gmaps.coordinateList[i]);
            }
        }
        else {
            bounds = DMT.gmaps.overlays.polygon.getBounds();
        }
        // TODO: Do we want to zoom? DMT.gmaps.map.fitBounds(bounds);
// Center the map according to the bounds
        DMT.gmaps.map.setCenter(bounds.getCenter());
//If we are using a map that uses imagery check the zoom level
        if ((google.maps.MapTypeId.HYBRID === DMT.gmaps.map.getMapTypeId()
                || google.maps.MapTypeId.SATELLITE === DMT.gmaps.map.getMapTypeId()) && !bounds.isEmpty()) {
            var maxZoomService = new google.maps.MaxZoomService();
            maxZoomService.getMaxZoomAtLatLng(bounds.getCenter(), function (response) {
                if (response.status === google.maps.MaxZoomStatus.OK) {
                    if (DMT.gmaps.map.getZoom() > response.zoom) {
//We are zoomed in too far
                        DMT.gmaps.map.setZoom(response.zoom);
                    }
                }
            });
        }
    },
    isDarkMapType: function () {
        var mapType = DMT.gmaps.map.getMapTypeId();
        if (mapType === google.maps.MapTypeId.SATELLITE || mapType === google.maps.MapTypeId.HYBRID) {
            return true;
        } else {
            return false;
        }
    },
    loadMap: function () {
// Default location over the DRC
//        if ($(document).height() > 241) {
//            $("#map").css("height", $(document).height() - 222);
//            $(".tabcontent").css("height", $(document).height() - 330);
//        }        
        var latlng = new google.maps.LatLng(0.3516, 23.3789);

        var myOptions = {
            zoom: 5,
            center: latlng,
            draggableCursor: 'crosshair',
            mapTypeId: google.maps.MapTypeId.HYBRID,
            streetViewControl: true,
            panControl: true,
            zoomControl: true,
            tilt: 0,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false
            },
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
            },
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DEFAULT
            },
            minZoom: 3
        };
        DMT.gmaps.map = new google.maps.Map(document.getElementById('map'), myOptions);
// Add map listener for clicks
        google.maps.event.addListener(DMT.gmaps.map, 'click', function (event) {
            // Check if the user is on tab 1
//            if (DMT.tabs.tabInfo.getCurrent() == 1) {
            // Check if the user is on the coordinates tab
//                if ($('#tabCoordinates').hasClass('selected') === false) {
//                    return;
//                }
            var draw = true;
            if (DMT.gmaps.coordinateList.length >= DMT.gmaps.settings.getMaxPoints()) {
                $.blockUI({
                    theme: true,
                    title: lang.max_point_exceeded_title,
                    message: lang.max_point_exceeded_message1 + DMT.gmaps.settings.getMaxPoints() + lang.max_point_exceeded_message2,
                    timeout: 4000
                });
                return;
            }
            if (DMT.gmaps.overlays.polygon.type === 'circle') {
                if (DMT.gmaps.coordinateList.length === 2) {
                    draw = false;
                    $.blockUI({
                        theme: true,
                        title: lang.warning,
                        message: lang.circle_error_message,
                        timeout: 4000
                    });
                }
            }
            if (draw === true) {
// Add the new coordinate
                DMT.gmaps.coordinates.add(event.latLng);
            }
//            }
        });
        // Add the mousemove listener
        google.maps.event.addListener(DMT.gmaps.map, 'mousemove', function (event) {
            DMT.gmaps.updateMouseLocation(event.latLng);
        });
        // TODO: Check if this needs rewriting
// Add the grid overlay listeners
        DMT.gmaps.overlays.grid = new LatLngOverlay();
        google.maps.event.addListener(DMT.gmaps.map, 'drag', function (event) {
            DMT.gmaps.overlays.grid.redraw();
        });
        // To handle the changing of grid lines on the map
        google.maps.event.addListener(DMT.gmaps.map, 'maptypeid_changed', function (event) {
            if (!DMT.gmaps.overlays.grid.hidden)
            {
                DMT.gmaps.overlays.grid.redraw();
            }
        });
        // Listen for the map to load, add the map features, then remove the listener
        var idleLoad = google.maps.event.addListener(DMT.gmaps.map, 'idle', function (event) {
            // Show the coordinates, options, and overlays controls
            $('#mouseLatLng').show();
            $('#optionsControl').show();
            $('#overlaysControl').show();
            var coordinates = [];
// Load the coordinates from the coordEntryArea
            $('#coordEntryArea li.coordinate').not('#coordinateElementEmpty').each(function ()
            {
                coordinates.push(
                        new google.maps.LatLng($(this).children('div.format_dd ').children('span.latitude').html(),
                                $(this).children('div.format_dd').children('span.longitude').html()));
            });
            if ($('#polygonType').val() === 'circle')
            {
                //var center = coordinates[0];
//var outer = coordinates[1];
                DMT.gmaps.overlays.polygon = new google.maps.Circle({
                    /*center: center,
                     radius: distance(center,outer),*/
                    map: DMT.gmaps.map,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.35,
                    clickable: false
                });
                DMT.gmaps.overlays.polygon.type = 'circle';
            }
            else
            {
                DMT.gmaps.overlays.polygon = new google.maps.Polygon({
//paths: coordinates,
                    map: DMT.gmaps.map,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.35,
                    geodesic: DMT.gmaps.settings.geodesic,
                    clickable: false
                });
                DMT.gmaps.overlays.polygon.type = 'polygon';
            }
            if (coordinates.length > 0)
            {
                // Save the coordinates in javascript
                DMT.gmaps.coordinateList = coordinates;
// Redraw the polygon
                DMT.gmaps.polygon.redraw();
// Load the markers
                for (var index = 0; index < coordinates.length; index++)
                {
                    DMT.gmaps.markers.create(index);
                }
// If not on tab 1, handle the map changes
                if (DMT.tabs.tabInfo.getCurrent() > 1)
                {
                    DMT.gmaps.polygon.decreaseOpacity();
                    if (DMT.gmaps.overlays.markers.length > 1)
                    {
                        DMT.gmaps.markers.hide();
                    }
                }
            }
            // TODO: Does this exist any more?
            google.maps.event.removeListener(idleLoad);
        });
    },
    coordinates: {
        add: function (latLng) {
//            if ($('#tabCoordinates').hasClass('selected') === true) {
            // Add the coordinate to the coordinateList
            DMT.gmaps.coordinateList.push(latLng);
            var index = DMT.gmaps.coordinateList.length - 1;
// Add the coordinate element to the html
            DMT.gmaps.coordinateElements.add(index);
// Redraw the polygon
            DMT.gmaps.polygon.redraw();
// Add the marker to the map
            DMT.gmaps.markers.create(index);
//            }
        },
        clear: function () {
// Clear the coordinateList
            DMT.gmaps.coordinateList.length = 0;
// Clear the coordinate elements
            DMT.gmaps.coordinateElements.clear();
// Clear the polygon
            DMT.gmaps.polygon.clear();
// Clear the markers
            DMT.gmaps.markers.clear();
        },
        remove: function (index) {
// Delete the coordinate from the coordinateList
            DMT.gmaps.coordinateList.splice(index, 1);
// Remove the coordinate element
            DMT.gmaps.coordinateElements.remove(index);
// Redraw the polygon
            DMT.gmaps.polygon.redraw();
// Remove the marker from the map
            DMT.gmaps.markers.remove(index);
        },
        update: function (index, latLng) {
// Update the coordinate in the coordinateList
            DMT.gmaps.coordinateList[index] = latLng;
// Update the coordinate element
            DMT.gmaps.coordinateElements.update(index);
// Redraw the polygon
            DMT.gmaps.polygon.redraw();
// Update the marker
            DMT.gmaps.markers.update(index);
        }
    },
    coordinateElements: {
        add: function (index) {
// Hide the "no coordinates" element
            $('#coordinateElementEmpty').hide();
            var template = $('#coordEntryTemplate').html();
            var showFormat = DMT.gmaps.settings.getFormat();
            var hideFormat = (showFormat === 'dms') ? 'dd' : 'dms';
            var latitude = DMT.gmaps.coordinateList[index].lat().toFixed(DMT.coordinatePrecision);
            var longitude = DMT.gmaps.coordinateList[index].lng().toFixed(DMT.coordinatePrecision);
            var dmsLatitude = convertDecToDMS(latitude, 'lat', true);
            var dmsLongitude = convertDecToDMS(longitude, 'lng', true);
            var fillValues = {
                "coordinateNum": (index + 1),
                "decLat": latitude,
                "decLng": longitude,
                "dmsLat": dmsLatitude,
                "dmsLng": dmsLongitude,
                "format": showFormat,
                "oddEven": (((index % 2) === 0) ? 'even' : 'odd'),
                "index": index
            };
            var content = template.replace(/!%([^%]*)%!/mg, function ($1, $2) {
                return fillValues[$2];
            });
            $('#coordEntryArea').append(content);
            $('#coordinate_' + index).children('div.format_' + hideFormat).hide();
        },
        clear: function () {
            $('#coordEntryArea li').not('#coordinateElementEmpty').remove();
            $('#coordinateElementEmpty').show();
        },
        remove: function (index) {
// Remove the HTML element
            $('#coordinate_' + index).remove();
// If this wasn't the last element, have to do some redrawing
            if (index < DMT.gmaps.coordinateList.length) {
                // Redo index to ending
                for (var i = index + 1; i < DMT.gmaps.coordinateList.length + 1; i++) {
                    var $coordinateElement = $('#coordinate_' + i);
                    index = (i - 1);
                    if ((index % 2) === 0) {
                        $coordinateElement.removeClass('odd').addClass('even');
                    } else {
                        $coordinateElement.removeClass('even').addClass('odd');
                    }
                    $coordinateElement.find('span.coordinateNum').html(i);
                    $coordinateElement.attr('id', 'coordinate_' + index);
                    $('#edit_' + i).attr('id', 'edit_' + index);
                    $('#delete_' + i).attr('id', 'delete_' + index);
                }
            }
        },
        splice: function (index, length)
        {
            for (var i = 0; i < length; i++, index++)
            {
                $('#coordinate_' + index).remove();
            }
        },
        update: function (index) {
            var latitude = DMT.gmaps.coordinateList[index].lat().toFixed(DMT.coordinatePrecision);
            var longitude = DMT.gmaps.coordinateList[index].lng().toFixed(DMT.coordinatePrecision);
            var dmsLatitude = convertDecToDMS(latitude, 'lat', true);
            var dmsLongitude = convertDecToDMS(longitude, 'lng', true);
            var $coordinateElement = $('#coordinate_' + index);
            $coordinateElement.children('div.format_dms').children('span.latitude').html(dmsLatitude);
            $coordinateElement.children('div.format_dms').children('span.longitude').html(dmsLongitude);
            $coordinateElement.children('div.format_dd').children('span.latitude').html(latitude);
            $coordinateElement.children('div.format_dd').children('span.longitude').html(longitude);
        }
    },
    footprints: {
        allChecked: function () {
        },
        attachFootprintClickEvent: function (footprint, entityId, resultNum)
        {
            google.maps.event.addListener(footprint, 'click', function (event) {
                if (DMT.tabs.tabInfo.getCurrent() === 4 && footprint.getVisible() === true)
                {
// Putting the info window where the user clicks, not the center any more
                    if (DMT.gmaps.overlays.infoWindows[entityId].getContent() === "")
                    {
                        var collectionID = ($("#show_search_data").val()).split("_")[2];
                        DMT.gmaps.overlays.infoWindows[entityId].setContent(
                                $.ajax({
                                    type: 'GET',
                                    url: DMT.defaultUrl + 'form/infowindowmetadata',
                                    data: {
                                        entity_id: entityId,
                                        row: resultNum,
                                        collection_id: collectionID
                                    },
                                    async: false
                                }).responseText
                                );
                    }
                    DMT.gmaps.overlays.infoWindows[entityId].setPosition(event.latLng);
                    DMT.gmaps.overlays.infoWindows[entityId].open(DMT.gmaps.map);
                }
            });
        },
        clearAll: function () {
            DMT.gmaps.footprints.hideAll();
            DMT.gmaps.overlays.footprints.length = 0;
            DMT.gmaps.overlays.footprints = [];
        },
        create: function (entityId, cornerPoints, resultNum, color, luma, fpType) {
            if (color === null) {
                color = '#526e87';
            }
            arrayColorfp[entityId] = color;
            var coordinates = [];
            cornerPoints = cornerPoints.split(',');
            for (var i = 0; i < cornerPoints.length; i += 2) {
                coordinates.push(new google.maps.LatLng(cornerPoints[i], cornerPoints[i + 1]));
            }
            //For point types we make a diamond polygon
//Per Ryan - he didn't like the diamond so it has been converted to points
            if (fpType === 'point') {
                var markerTextColor = (luma < 100) ? 'FFFFFF' : '000000';
                var image = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|' + color.substr(1) + '|' + markerTextColor, new google.maps.Size(20, 32), new google.maps.Point(0, 0), new google.maps.Point(10, 32));
                var shape = {
                    coord: [1, 1, 1, 32, 20, 32, 20, 1], type: 'poly'
                };
// Place each marker in an array so we can access them each for
// removal and dragging around
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(coordinates[0].lat(), coordinates[0].lng()),
                    map: DMT.gmaps.map,
                    icon: image,
                    shape: shape,
                    title: '' + entityId,
                    draggable: false,
                    raiseOnDrag: false
                });
                DMT.gmaps.overlays.footprints[entityId] = marker;
            }
            else {
                var polygonSettings = DMT.gmaps.settings.footprintDisplayDefaults;
                DMT.gmaps.overlays.footprints[entityId] = new google.maps.Polygon({
                    paths: coordinates,
                    strokeColor: color,
                    strokeOpacity: polygonSettings.strokeOpacity,
                    strokeWeight: polygonSettings.strokeWeight,
                    fillColor: color,
                    fillOpacity: polygonSettings.fillOpacity,
                    geodesic: polygonSettings.geodesic
                });
// Highlight effect for the footprints
                google.maps.event.addListener(DMT.gmaps.overlays.footprints[entityId], 'mouseover', function (event) {
// Increase the opacity and brighten the color
                    DMT.gmaps.overlays.footprints[entityId].setOptions({
                        fillOpacity: DMT.gmaps.settings.footprintDisplayDefaults.fillOpacity + 0.3,
                        fillColor: brightenColor(DMT.gmaps.overlays.footprints[entityId].color)
                    });
                });
                google.maps.event.addListener(DMT.gmaps.overlays.footprints[entityId], 'mouseout', function (event) {
// Reset the opacity and color to default
                    DMT.gmaps.overlays.footprints[entityId].setOptions({
                        fillOpacity: DMT.gmaps.settings.footprintDisplayDefaults.fillOpacity,
                        fillColor: DMT.gmaps.overlays.footprints[entityId].color
                    });
                });
            }
            DMT.gmaps.overlays.footprints[entityId].color = color;
            DMT.gmaps.overlays.footprints[entityId].resultNum = resultNum;
            DMT.gmaps.overlays.footprints[entityId].setVisible(false);
            DMT.gmaps.overlays.footprints[entityId].luma = luma;
            DMT.gmaps.overlays.footprints[entityId].fpType = fpType;
// Create the info window for this polygon
            DMT.gmaps.overlays.infoWindows[entityId] = new google.maps.InfoWindow({
                content: ""
            });
            DMT.gmaps.footprints.attachFootprintClickEvent(DMT.gmaps.overlays.footprints[entityId], entityId, resultNum);
        },
        hide: function (entityId) {
            // Remove the icon background color
            var $footCell = $('#fp_' + entityId);
            $footCell.css('background-color', 'transparent'); // Switch back to the black footprint if luma is below threshold
            arrayColorfp[entityId] = 'transparent';
            if (DMT.gmaps.overlays.footprints[entityId].luma < 100)
            {
                $footCell.children('div.ee-icon').attr('class', 'ee-icon ee-icon-footprint');
            }
            DMT.gmaps.overlays.footprints[entityId].setMap(null);
            DMT.gmaps.overlays.footprints[entityId].setVisible(false);
            DMT.gmaps.overlays.infoWindows[entityId].close();
            if ($('#showAllFootprints').hasClass('showAll') === false)
            {
                if (DMT.gmaps.footprints.allChecked())
                {
                    $('#showAllFootprints').prop('checked', true);
                }
                else
                {
                    $('#showAllFootprints').prop('checked', false);
                }
            }
        },
        hideAll: function () {
            for (var entityId in DMT.gmaps.overlays.footprints) {
                DMT.gmaps.footprints.hide(entityId);
            }
            $('#showAllFootprints').prop('checked', false);
        },
        show: function (entityId)
        {
            // Check if it is excluded first
            if ($('#resultRow_' + entityId).hasClass('excludedResultRow'))
            {
                return;
            }
            var $footCell = $('#fp_' + entityId);
            $footCell.css('background-color', DMT.gmaps.overlays.footprints[entityId].color);
// Check if the white footprint should be displayed
            if (DMT.gmaps.overlays.footprints[entityId].luma < 100)
            {
                $footCell.children('div.ee-icon').attr('class', 'ee-icon ee-icon-footprint-white');
            }
            DMT.gmaps.overlays.footprints[entityId].setMap(DMT.gmaps.map);
            DMT.gmaps.overlays.footprints[entityId].setVisible(true);
            if ($('#showAllFootprints').hasClass('showAll') === false)
            {
                DMT.gmaps.centerOnFootprintAndBrowse();
                if (DMT.gmaps.footprints.allChecked())
                {
                    $('#showAllFootprints').prop('checked', true);
                }
                else
                {
                    $('#showAllFootprints').prop('checked', false);
                }
            }
        },
        showAll: function (isChecked)
        {
            if (isChecked === true)
            {
                $('#showAllFootprints').addClass('showAll');
            }
            $('#search-results-container a.footprint:visible').each(function ()
            {
                var entityId = $(this).attr("id").substring(3);
                if (isChecked)
                {
// Show them all
                    if (DMT.gmaps.overlays.footprints[entityId] === undefined || DMT.gmaps.overlays.footprints[entityId].getVisible() === false)
                    {
                        $(this).trigger('click');
                    }
                }
                else
                {
// Hide them all
                    if (DMT.gmaps.overlays.footprints[entityId] !== undefined && DMT.gmaps.overlays.footprints[entityId].getVisible() === true)
                    {
                        $(this).trigger('click');
                    }
                }
            });
            $('#showAllFootprints').removeClass('showAll');
// Center the map on the footprints
            DMT.gmaps.centerOnFootprintAndBrowse();
        },
        toggle: function (entityId, cornerPoints, resultNum, color, luma, type) {
            if (DMT.gmaps.overlays.footprints[entityId] === undefined) {
                DMT.gmaps.footprints.create(entityId, cornerPoints, resultNum, color, luma, type);
            }
            if (DMT.gmaps.overlays.footprints[entityId].getVisible() === false) {
                DMT.gmaps.footprints.show(entityId);
            }
            else {
                DMT.gmaps.footprints.hide(entityId);
            }
        }
    },
    infoWindows: {
        clearAll: function ()
        {
            DMT.gmaps.infoWindows.hideAll();
            DMT.gmaps.overlays.infoWindows.length = 0;
            DMT.gmaps.overlays.infoWindows = [];
        },
        hideAll: function ()
        {
            for (var entityId in DMT.gmaps.overlays.infoWindows)
            {
                DMT.gmaps.overlays.infoWindows[entityId].close();
            }
        }
    },
    mapOverlays: {
        addOverlay: function (url, wmsLayer, projection)
        {
            var index = DMT.gmaps.map.overlayMapTypes.getLength();
            DMT.gmaps.map.overlayMapTypes.insertAt(index, new WMSMapType(url, wmsLayer, projection));
            return index;
        },
        removeOverlay: function (index) {
            DMT.gmaps.map.overlayMapTypes.removeAt(index);
        }
    },
    mapTypes: {
        availableMapTypes: [],
        addMapType: function (mapTypeKey, url, wmsLayer, projection)
        {
            //Only add the layer if it doesn't already exist
            if (DMT.gmaps.mapTypes.availableMapTypes.indexOf(mapTypeKey) === -1)
            {
                DMT.gmaps.mapTypes.availableMapTypes.push(mapTypeKey);
                DMT.gmaps.map.mapTypes.set(mapTypeKey, new WMSMapType(url, wmsLayer, projection));
            }
        },
        selectMapType: function (mapTypeKey)
        {
            //Make sure it exists before we try selecting it
            if (DMT.gmaps.mapTypes.availableMapTypes.indexOf(mapTypeKey) !== -1)
            {
                DMT.gmaps.map.setMapTypeId(mapTypeKey);
                return true;
            }
            else
            {
                return false;
            }
        }
    },
    markers: {
        attachDragEndListener: function (marker, index) {
            DMT.gmaps.overlays.markers[index].dragEndListener = google.maps.event.addListener(marker, 'dragend', function () {
                var mouseLocation = this.getPosition();
                DMT.gmaps.coordinateList[index] = mouseLocation;
                DMT.gmaps.polygon.redraw();
// Update the coordinates entry area
                var $coordinateElement = $('#coordinate_' + index);
                var latitude = mouseLocation.lat();
                var longitude = mouseLocation.lng();
                $coordinateElement.children('div.format_dd').children('span.latitude').html(parseFloat(latitude).toFixed(DMT.coordinatePrecision));
                $coordinateElement.children('div.format_dd').children('span.longitude').html(parseFloat(longitude).toFixed(DMT.coordinatePrecision));
                var dmsLatitude = convertDecToDMS(latitude, 'lat', true);
                var dmsLongitude = convertDecToDMS(longitude, 'lng', true);
                $coordinateElement.children('div.format_dms').children('span.latitude').html(dmsLatitude);
                $coordinateElement.children('div.format_dms').children('span.longitude').html(dmsLongitude);
                DMT.gmaps.settings.dragLock = false;
            });
        },
        clear: function () {
            var markers = DMT.gmaps.overlays.markers;
            for (var i = 0; i < markers.length; i++)
            {
                markers[i].setMap(null);
            }
            DMT.gmaps.overlays.markers.length = 0;
        },
        create: function (index) {
            // Create the numbered marker
            var image = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + (index + 1) + '|FF3333|000000', new google.maps.Size(20, 32), new google.maps.Point(0, 0), new google.maps.Point(10, 32));
            var shape = {
                coord: [1, 1, 1, 32, 20, 32, 20, 1], type: 'poly'
            };
            // Place each marker in an array so we can access them each for
// removal and dragging around
            var marker = new google.maps.Marker({
                position: DMT.gmaps.coordinateList[index],
                map: DMT.gmaps.map,
                icon: image,
                shape: shape,
                title: '' + (index + 1),
                draggable: (true),
                raiseOnDrag: false
            });
            // Attach the dragstart event
            google.maps.event.addListener(marker, 'dragstart', function ()
            {
                DMT.gmaps.settings.dragLock = true;
            });
            DMT.gmaps.overlays.markers.push(marker);
            DMT.gmaps.markers.attachDragEndListener(marker, index);
        },
        detachDragEndListener: function (index) {
            google.maps.event.removeListener(DMT.gmaps.overlays.markers[index].dragEndListener);
        },
        hide: function () {
            for (var i in DMT.gmaps.overlays.markers)
            {
                DMT.gmaps.overlays.markers[i].setOptions({
                    visible: false
                });
            }
        },
        redraw: function () {
            var currentTab = DMT.tabs.tabInfo.getCurrent();
            var markerLength = DMT.gmaps.overlays.markers.length;
            if (markerLength === 1)
            {
                DMT.gmaps.overlays.markers[0].setOptions({
                    draggable: (currentTab === 1),
                    title: (currentTab === 1) ? '1' : lang.area_of_interest,
                    visible: true
                });
            }
            else
            {
                for (var index = 0; index < markerLength; index++)
                {
                    DMT.gmaps.overlays.markers[index].setVisible(currentTab === 1);
                }
            }
        },
        remove: function (index) {
            DMT.gmaps.overlays.markers[index].setMap(null);
            DMT.gmaps.overlays.markers.splice(index, 1);
            var length = DMT.gmaps.overlays.markers.length;
// If this wasn't the last marker, have to do some reordering
            if (index < length)
            {
                for (var i = index; i < length; i++)
                {
// Redraw the icon
                    var image = new google.maps.MarkerImage('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + (i + 1) + '|FF3333|000000', new google.maps.Size(20, 32), new google.maps.Point(0, 0), new google.maps.Point(10, 32));
                    DMT.gmaps.overlays.markers[i].setIcon(image);
// Reset the listener
                    DMT.gmaps.markers.detachDragEndListener(i);
                    DMT.gmaps.markers.attachDragEndListener(DMT.gmaps.overlays.markers[i], i);
                }
                /* THIS WAY WORKS
                 // Remove the old markers from the map
                 for (var i = index; i < length; i++)
                 {
                 DMT.gmaps.overlays.markers[i].setMap(null);
                 }
                 // Remove the markers from the array
                 DMT.gmaps.overlays.markers.splice(index, length - index);
                 // Create the new markers
                 for (var i = index; i < length; i++)
                 {
                 DMT.gmaps.markers.create(i);
                 }*/
            }
        },
        show: function () {
            for (var i in DMT.gmaps.overlays.markers)
            {
                DMT.gmaps.overlays.markers[i].setOptions({
                    visible: true
                });
            }
        },
        update: function (index) {
            DMT.gmaps.overlays.markers[index].setPosition(DMT.gmaps.coordinateList[index]);
        }
    },
    polygon: {
        clear: function () {
            var type = DMT.gmaps.overlays.polygon.type;
            if (type === 'shape' && DMT.gmaps.overlays.polygon.spatialId !== undefined)
            {
                DMT.gmaps.overlays.polygon.setMap(null);
                DMT.gmaps.overlays.polygon.spatialId = undefined;
                DMT.gmaps.overlays.polygon.spatialName = '';
// Empty the shape control box
                $('#areaShapeSectionItem').hide();
                $('#areaShapeSectionEmpty').show();
            }
            else if (type === 'circle')
            {
                DMT.gmaps.overlays.polygon.setRadius(0);
            }
            else if (type === 'polygon')
            {
                // Reset the path for the polygon
                DMT.gmaps.overlays.polygon.setPath([]);
            }
        },
        decreaseOpacity: function () {
            if (DMT.gmaps.overlays.polygon !== null && DMT.gmaps.overlays.polygon.map !== undefined)
            {
                DMT.gmaps.overlays.polygon.setOptions({fillOpacity: 0.2, strokeOpacity: 0.5});
            }
        },
        hide: function () {
        },
        increaseOpacity: function () {
            if (DMT.gmaps.overlays.polygon !== null && DMT.gmaps.overlays.polygon.map !== undefined)
            {
                DMT.gmaps.overlays.polygon.setOptions({fillOpacity: 0.35, strokeOpacity: 0.8});
            }
        },
        redraw: function () {
            if (DMT.gmaps.overlays.polygon.type === 'circle')
            {
                if (DMT.gmaps.coordinateList.length >= 1)
                {
                    var center = DMT.gmaps.coordinateList[0];
                    DMT.gmaps.overlays.polygon.setCenter(center);
                }
                if (DMT.gmaps.coordinateList.length === 2)
                {
                    var outer = DMT.gmaps.coordinateList[1];
                    DMT.gmaps.overlays.polygon.setRadius(distance(center, outer));
                }
                else
                {
                    DMT.gmaps.overlays.polygon.setRadius(0);
                }
            }
            else
            {
                // Reset the path for the polygon
                DMT.gmaps.overlays.polygon.setPath(DMT.gmaps.coordinateList);
            }
        },
        show: function () {
        }
    },
    // TODO: See if you can improve this!!
    updateMouseLocation: function (latLng) {
        // To increase performance, do not update mouse location while dragging
        if (DMT.gmaps.settings.dragLock === true) {
            return;
        }
        var latitude = latLng.lat().toFixed(DMT.coordinatePrecision);
        var longitude = latLng.lng().toFixed(DMT.coordinatePrecision);
        if (DMT.gmaps.settings.getFormat() === 'dms') {
            var dmsLatitude = convertDecToDMS(latitude, 'lat', true);
            var dmsLongitude = convertDecToDMS(longitude, 'lng', true);
            latitude = dmsLatitude;
            longitude = dmsLongitude;
        }
        $('#mouseLatLng').html("(" + latitude + ", " + longitude + ")");
    },
    googleCoder: {
        clear: function () {
            $('#addressLoader').hide();
            $('#addressInfo').hide();
            $('#googleAddress').val('');
            $('#googleResults').stop(true, true).hide();
            $('#geoErrorMessageAddress').stop(true, true).hide();
        },
        codeAddress: function () {
            var address = $("#googleAddress").val();
            if (address === '') {
                $.blockUI({
                    theme: true,
                    title: lang.empty_address_or_place_title,
                    message: lang.empty_address_or_place_message,
                    timeout: 4000
                });
                return;
            }
            else {
                $('#addressInfo').hide();
                $('#addressLoader').show();//Show loader
                $('#geoErrorMessageAddress').stop(true, true).hide();
                // Hide the previous results
                $('#googleResults').stop(true, true).hide();
                if (DMT.gmaps.geocoder) {
                    DMT.gmaps.geocoder.geocode({'address': address},
                    function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            $('#googleRow').hide().html('');
                            $('#geoErrorMessageAddress').stop(true, true).hide();
                            var place, html = '';
                            for (var i = 0; i < results.length; i++) {
                                place = results[i];
                                html += '<tr' + (((i + 1) % 2 === 0) ? ' class="even"' : '') + '>';
                                html += '<td class="resultNum">' + (i + 1) + '</td>';
                                html += '<td><a class="address">' + place.formatted_address + '</a></td>';
                                html += '<td nowrap="nowrap" class="lat">' + place.geometry.location.lat().toFixed(DMT.coordinatePrecision) + '</td>';
                                html += '<td nowrap="nowrap" class="lng">' + place.geometry.location.lng().toFixed(DMT.coordinatePrecision) + '</td>';
                                html += '</tr>';
                            }
                            $('#addressLoader').hide();//Hide loader
                            $('#addressInfo').show();
                            $('#googleRow').html(html).show();
                            $('#googleResults').stop(true, true).show();//slideDown(DMT.resultsSlideSpeed);
                        }
                        else {
                            $('#addressLoader').hide();//Hide loader
                            $('#addressInfo').hide();
                            if (status === google.maps.GeocoderStatus.ZERO_RESULTS) {
                                $('#geoErrorMessageAddress').html(lang.address_place_no_results);
                            }
                            else {
                                $('#geoErrorMessageAddress').html(lang.address_place_unable_found);
                            }
                            $('#geoErrorMessageAddress').stop(true, true).show();//slideDown(DMT.resultsSlideSpeed);
                        }
                    });
                }
            }
        }
    },
    pathrowCoder: {
        clear: function () {
            $('#pathrowLoader').hide();
            $('#pathAddress').val('');
            $('#rowAddress').val('');
            $('#geoErrorMessagePathRow').stop(true, true).hide();
        },
        showLocation: function () {
            var path = $('#pathAddress').val();
            var row = $('#rowAddress').val();
            if (path === null || row === null) {
                $.blockUI({
                    theme: true,
                    title: lang.empty_path_row_title,
                    message: lang.empty_path_row_message,
                    timeout: 4000
                });
                return;
            }
            else {
                $('#pathrowLoader').show();
                $('#geoErrorMessagePathRow').stop(true, true).hide();
                $.ajax({
                    type: 'POST',
                    url: 'script/coordPathRow.php',
                    data: '&pathrow=' + path + row,
                    success: function (response) {
                        $('#pathrowLoader').hide();
                        if (response.length > 5) {
                            var Coord = response.split(";");
                            DMT.gmaps.displayCoderResult(Coord);
                        }
                        else {
                            $.blockUI({
                                theme: true,
                                title: lang.empty_path_row_title,
                                message: lang.path_row_outside_work_area,
                                timeout: 4000
                            });
                            $('#geoErrorMessagePathRow').html(lang.path_row_outside_work_area);
                            $('#geoErrorMessagePathRow').stop(true, true).show();
                        }
                    }
                });
            }
        }
    },
    featureCoder: {
        clear: function () {
            $('#province').val('');
            $('#district').val('');
            $('#territory').val('');
            $('#sector').val('');
            $('#locality').val('');
            $('#district').attr('disabled', true);
            $('#territory').attr('disabled', true);
            $('#sector').attr('disabled', true);
            $('#locality').attr('disabled', true);
            $('#wrsInputs1').show();
            $('#wrsInputs2').hide();
            $('#reddProject').val('');
            $('#adminBoundary').prop("checked", true);
            $('#bounderies_button').buttonset("refresh");
            $('#featureLoader').hide();
            $('#featureResults').stop(true, true).hide();
            $('#geoErrorMessageFeature').stop(true, true).hide();
        },
        codeAddress: function () {
            var boundaries = $('#wrsInputs1').is(":visible") === true;
            var dbTable = '';
            var dbID = '';
            var province = $("#province").val();
            var district = $("#district").val();
            var territory = $("#territory").val();
            var sector = $("#sector").val();
            var locality = $("#locality").val();
            var redd = $("#reddProject").val();
            if (boundaries) {
                if (province === null && district === null && territory === null && sector === null && locality === null) {
                    $.blockUI({
                        theme: true,
                        title: lang.empty_predefined_area_title,
                        message: lang.empty_predefined_area_message,
                        timeout: 4000
                    });
                }
                else {
                    if (province !== null) {
                        dbTable = 'province';
                        dbID = province;
                    }
                    if (district !== null) {
                        dbTable = 'district';
                        dbID = district;
                    }
                    if (territory !== null) {
                        dbTable = 'territory';
                        dbID = territory;
                    }
                    if (sector !== null) {
                        dbTable = 'sector';
                        dbID = sector;
                    }
                    if (locality !== null) {
                        dbTable = 'locality';
                        dbID = locality;
                    }
                    DMT.gmaps.coordinates.clear();
                    var query = 'select coordinates from dmt_' + dbTable + ' where id_' + dbTable + '=' + dbID;
                    $.ajax({
                        type: "POST",
                        url: "script/getCoordinates.php",
                        data: 'query=' + query,
                        success: function (response) {
                            var tabCoord = response.split(" ");
                            DMT.gmaps.coordinates.add(new google.maps.LatLng(parseFloat(tabCoord[0]), parseFloat(tabCoord[1])));
                        }
                    });
                }
            } 
            else {
                if (redd === null) {
                    $.blockUI({
                        theme: true,
                        title: lang.empty_predefined_area_title,
                        message: lang.empty_predefined_area_message,
                        timeout: 4000
                    });
                }
                else {
                    if (redd !== null) {
                        dbTable = 'redd';
                        dbID = redd;
                    }
                    DMT.gmaps.coordinates.clear();
                    var query = 'select coordinates from dmt_' + dbTable + ' where id_' + dbTable + '=' + dbID;
                    $.ajax({
                        type: "POST",
                        url: "script/getCoordinates.php",
                        data: 'query=' + query,
                        success: function (response) {
                            var tabCoord = response.split(" ");
                            DMT.gmaps.coordinates.add(new google.maps.LatLng(parseFloat(tabCoord[0]), parseFloat(tabCoord[1])));
                        }
                    });
                }
            }
        }
    },
    displayCoderResult: function (Coord) {
        DMT.gmaps.coordinates.clear();
        $('#googleResults').slideUp(DMT.resultsSlideSpeed);
        $('#geoErrorMessagePathRow').slideUp();
        for (var i = 0; i < Coord.length - 1; i++) {
            var tabCoord = Coord[i].split(",");
            DMT.gmaps.coordinates.add(new google.maps.LatLng(parseFloat(tabCoord[1]), parseFloat(tabCoord[0])));
        }
        DMT.gmaps.centerMap();
    },
    getWMSTile: function (baseUrl, tile, zoom) {
        var tsize = 256;
        var proj = DMT.gmaps.map.getProjection();
//Get the world coordinates
//(tilecoord * tile size) / 2^zoom level = world coord
        var llx = (tile.x * tsize) / (Math.pow(2, MyMap.map.getZoom()));
        var lly = ((tile.y + 1) * tsize) / (Math.pow(2, MyMap.map.getZoom()));
        var urx = ((tile.x + 1) * tsize) / (Math.pow(2, MyMap.map.getZoom()));
        var ury = (tile.y * tsize) / (Math.pow(2, MyMap.map.getZoom()));
//Convert the world coordinates to latlng
        var llpoint = proj.fromPointToLatLng(new google.maps.Point(llx, lly));
        var urpoint = proj.fromPointToLatLng(new google.maps.Point(urx, ury));
        var url = baseUrl + "&BBOX=" + llpoint.lng() + ',' + llpoint.lat() + ',' +
                urpoint.lng() + ',' + urpoint.lat() + "&WIDTH=256&HEIGHT=256";
        return url;
    },
    centerOnFootprintAndBrowse: function () {
        if ($('#optionAutoCenter').prop('checked')) {
            var bounds = new google.maps.LatLngBounds();
            for (var index in DMT.gmaps.overlays.footprints) {
                if (DMT.gmaps.overlays.footprints[index].getVisible() === true) {
                    if (DMT.gmaps.overlays.footprints[index].fpType === 'point') {
                        bounds.extend(DMT.gmaps.overlays.footprints[index].getPosition());
                    } else {
                        var path = DMT.gmaps.overlays.footprints[index].getPath();
                        for (var i = 0; i < path.length; i++)
                        {
                            bounds.extend(path.getAt(i));
                        }
                    }
                }
            }
            for (var index in DMT.gmaps.overlays.browse)
            {
                if (DMT.gmaps.overlays.browse[index].visible === true)
                {
                    bounds.union(DMT.gmaps.overlays.browse[index].bounds_);
                }
            }
            if (!bounds.isEmpty())
            {
                DMT.gmaps.map.fitBounds(bounds);
            }
        }
    }
}; 