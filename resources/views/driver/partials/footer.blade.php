<footer class="text-muted">
    <div class="container mt-5">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
    </div>
    @if(request()->is('*map'))
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
        @endif
</footer>
