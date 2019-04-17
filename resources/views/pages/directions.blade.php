<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

        #map {
            height: 500px;
        }

        /* Optional: Makes the sample page fill the window. */

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #right-panel {
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select,
        #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }

        #right-panel {
            height: 100%;
            float: right;
            width: 390px;
            overflow: auto;
        }

        #map {
            margin-right: 400px;
        }

        @media print {
            #map {
                height: 500px;
                margin: 0;
            }
            #right-panel {
                float: none;
                width: auto;
            }
        }
    </style>
</head>

<body>
    <div id="right-panel"></div>
    <div id="map"></div>
    <script>
        function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: 37.3382, lng: -121.8863}
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var start = "345 East William Street, ca";
        var end = {!! json_encode($destination) !!};


        directionsService.route({
          origin: start,
          destination: end,
          waypoints: [{
              location: '140 East San Carlos Street, ca',
              stopover: true
          }],
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2i3tIi6Yn9DOzeUQJf3DUcFbFh9IOcOY&callback=initMap">

    </script>
</body>

</html>