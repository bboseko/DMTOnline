//A generic function to call setInterval
function customInterval(executeCode, checkCode, timeInterval) {
    var interval = setInterval(function() {
        if (checkCode()) {
            executeCode();
            clearInterval(interval);
        }
    }, timeInterval);
}
// Check if an element is in an array
// Examined
function in_array(needle, haystack, argStrict) {
    var key = '', strict = !!argStrict;
    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } 
    else {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    }
    return false;
}
function objectKeyExists(needle, haystack) {
    for (var key in haystack) {
        if (key === needle) {
            return true;
        }
    }
    return false;
}
// Prototype for trimming whitespace
String.prototype.trim = function() {
    return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
};
function isNumber(value) {
    return !isNaN(parseFloat(value)) && isFinite(value);
}
// Check that the values input in the add/edit dialogs are valid
// Examined
function validateDialogInput(latitude, longitude, type) {
    var errors = {
        latitude: lang.invalid_latitude,
        longitude: lang.invalid_longitude,
        numeric: lang.only_numeric,
        latRange: lang.latRange,
        lngRange: lang.lngRange,
        dmslatRange: lang.dmslatRange,
        dmslngRange: lang.dmslngRange
    };
    if (type === 'dd') {
        if (!isNumber(latitude))
        {
            return {valid: false, message: errors.latitude + ' ' + errors.numeric};
        }
        else if (!isNumber(longitude))
        {
            return {valid: false, message: errors.longitude + ' ' + errors.numeric};
        }
        if (latitude < -90.0 || latitude > 90.0)
        {
            return {valid: false, message: errors.latitude + ' ' + errors.latRange};
        }
        else if (longitude < -180.0 || longitude > 180.0)
        {
            return {valid: false, message: errors.longitude + ' ' + errors.lngRange};
        }
    }
    else if (type === 'dms')
    {
        for (var i = 0; i < 3; i++)
        {
            if (!isNumber(latitude[i]))
            {
                return {valid: false, message: errors.latitude + ' ' + errors.numeric};
            }
            else if (!isNumber(longitude[i]))
            {
                return {valid: false, message: errors.longitude + ' ' + errors.numeric};
            }
        }
        var degrees = [latitude[0] | 0, longitude[0] | 0];
        var minutes = [latitude[1] | 0, longitude[1] | 0];
        var seconds = [parseFloat(latitude[2]), parseFloat(longitude[2])];
        if (degrees[0] < 0 || degrees[0] > 90 ||
                minutes[0] >= 60 || minutes[0] < 0 ||
                seconds[0] >= 60.0 || seconds[0] < 0.0)
        {
            return {valid: false, message: errors.latitude + ' ' + errors.dmslatRange};
        }
        else if (degrees[1] < 0 || degrees[1] > 180 ||
                minutes[1] >= 60 || minutes[1] < 0 ||
                seconds[1] >= 60.0 || seconds[1] < 0.0)
        {
            return {valid: false, message: errors.longitude + ' ' + errors.dmslngRange};
        }
// If the degrees are lat -90 or 90, -180 or 180, then min and sec must be zero
        if ((Math.abs(degrees[0]) === 90) &&
                (minutes[0] > 0 || seconds[0] > 0.0))
        {
            return {valid: false, message: errors.latitude};
        }
        else if ((Math.abs(degrees[1]) === 180) &&
                (minutes[1] > 0 || seconds[1] > 0.0))
        {
            return {valid: false, message: errors.longitude};
        }
    }
    return {valid: true};
}
function getBrowserName() {
    if (navigator.userAgent.match(/Firefox/)) {
        return 'Firefox';
    } else if (navigator.userAgent.match(/Chrome/)) {
        return 'Chrome';
    } else if (navigator.userAgent.match(/Safari/)) {
        return 'Safari';
    } else if (navigator.appName === 'Microsoft Internet Explorer') {
        return 'IE';
    } else if (navigator.appName === 'Opera') {
        return 'Opera';
    } else {
        return 'Unknown';
    }
}
$(document).ready(function() {
    DMT.gmaps.loadMap();
    DMT.load.load();
});
DMT.controls = {
    bodyListener: {
        addListener: function() {
            $('body').bind('click', function(e) {
                if ($('#categorySelectorDropPanel').is(':visible') &&
                        !$(e.target).is('#categorySelectorDropPanel a') &&
                        !$(e.target).is('#categorySelectorDropPanel a input') &&
                        !$(e.target).is('#categorySelector') &&
                        !$(e.target).is('#categorySelector span')) {
                    $('#categorySelector').find('span.ui-icon').attr('class', 'ui-icon ui-icon-triangle-1-s');
                    $('#categorySelectorDropPanel').slideUp(75, function() {
                        DMT.controls.bodyListener.removeListener();
                    });
                }
            });
        },
        removeListener: function() {
            $('body').unbind('click');
        }
    }
};
