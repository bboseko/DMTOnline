<!DOCTYPE html>
<html>
  <head>
<meta name="description" content="Load and remove GeoJSON" />
    <title>Data Layer: Styling</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
      var map;
      function initialize() {
        // Create a simple map.
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 4,
          center: {lat: -28, lng: 137.883}
        });

        // Load a GeoJSON from the same server as our demo. (original example)
        //map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');
        
        // Load the GeoJSON manually (works cross-origin since google sets the required HTTP headers)
        $.getJSON('https://storage.googleapis.com/maps-devrel/google.json', function (data) {
          var features = map.data.addGeoJson(data);
          
          // Setup event handler to remove GeoJSON features
          google.maps.event.addDomListener(document.getElementById('removeBtn'), 'click', function () {
            for (var i = 0; i < features.length; i++)
              map.data.remove(features[i]);
          }); 
        }); 
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <button id="removeBtn">Remove</button>
    <div id="map-canvas"></div>
  
<script id="jsbin-source-html" type="text/html"><!DOCTYPE html>
<html>
  <head>
<meta name="description" content="Load and remove GeoJSON" />
    <title>Data Layer: Styling</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"><\/script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"><\/script>
    <script>
      var map;
      function initialize() {
        // Create a simple map.
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 4,
          center: {lat: -28, lng: 137.883}
        });

        // Load a GeoJSON from the same server as our demo. (original example)
        //map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');
        
        // Load the GeoJSON manually (works cross-origin since google sets the required HTTP headers)
        $.getJSON('https://storage.googleapis.com/maps-devrel/google.json', function (data) {
          var features = map.data.addGeoJson(data);
          
          // Setup event handler to remove GeoJSON features
          google.maps.event.addDomListener(document.getElementById('removeBtn'), 'click', function () {
            for (var i = 0; i < features.length; i++)
              map.data.remove(features[i]);
          }); 
        }); 
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    <\/script>
  </head>
  <body>
    <button id="removeBtn">Remove</button>
    <div id="map-canvas"></div>
  </body>
</html></script>

</body>
</html>