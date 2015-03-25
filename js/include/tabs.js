DMT.tabs = {
    criteria: {
        clear: function() {
// Clear the geocoders
            DMT.gmaps.googleCoder.clear();
            DMT.gmaps.pathrowCoder.clear();
            DMT.gmaps.featureCoder.clear();
// Clear the coordinates from the map
            DMT.gmaps.coordinates.clear();
// Reset the format to DMS
            $('#latlonfmtdeg').prop('checked', true);
            $('#lat_lon_section').buttonset('refresh');
            DMT.gmaps.settings.format = 'dms';
// Reset the date range
            $('#start_linked').val(DMT.startDate);
            $('#end_linked').val(DMT.endDate);
// Reset the selected categories to All
            for (var i = 0; i < document.categoryForm.categoryBoxes.length; i++) {
                document.categoryForm.categoryBoxes[i].checked = true;
            }
            $('#categorySelector span.text').html('(all)');
            $('#MLandsat').show();
            $('#MSPOT').show();
            $('#MSRTM').show();
            $.ajax({
                type: 'POST',
                url: 'script/loadYears.php',
                data: '&categories=(all)',
                success: function(response) {
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
        }
    },
    additionalCriteria: {
        clear: function() {
            $('#dateYear').click();
            $('#dateSection').buttonset('refresh');
            $('#missionLandsat').val('all');
            $('#slc').val('all');
            $('#orthorectified').val('all');
            $('#stack').val('yes');
            $('#missionSRTM').val('all');
            $('#resolutionSRTM').val('all');
            $('#verionSPOT').val('all');
            $('#cloudCover').val('all');
        }
    },
    results: {
        clear: function() {
            $('#submitButton').addClass('disabled');
            $('#categoryResult').find('option').remove().end();
            $('#pagingResultHeader, #pagingResultFooter').html('');
            $('#search-results-container').html('');
            DMT.gmaps.footprints.clearAll();
        }
    },
    clearAll: function() {
        DMT.tabs.criteria.clear();
        DMT.tabs.additionalCriteria.clear();
        DMT.tabs.results.clear();
        $('#accordion2').click();
        $('#accordion1').click();
        $('#tabs').tabs({active: 0});
        $('#checkAllResult').prop('checked', true);
    }};