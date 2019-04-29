@extends('driver.default')

@section('header')
<div class="container text-muted">
    <div class="row my-4">
        <h1>Driver Map</h1>
    </div>
</div>
@endsection


@section('content')
<div class="container embed-responsive embed-responsive-16by9 my-4" >
    <div id="map" class="col-9 embed-responsive-item"></div>
    <div id="panels" class="offset-9 col-3 embed-responsive-item" style="overflow-y: scroll;">
        @if (isset($order))
        <div id="selectPanel" class="mb-4">
            <label for="orders"><b>Cancel order:</b></label>
            <form action="{{route('driverOrderCancel')}}" method="POST">
                @csrf
                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{$order->id}}">
                <button type="submit" class="btn btn-secondary btn-sm">{{ __('Cancel') }}</button>
            </form>
        </div>
        @endif
        <div id="directionsPanel">
            <label for=""><b>Directions:</b></label>
        </div>
    </div>
</div>
@endsection

@section('map')
<script>
    var directions = {!! json_encode($directions) !!}
    var position = [37.27951800, -121.86790500];
    var marker;

    console.log( directions)

    var directionsFormatted = getCoordinates( directions );

    function initMap() {

        // var directions = {!! json_encode($directions) !!}
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var center = '37.27951800,-121.86790500';


        if (directions.status === 'OK') {
            center = directions.routes[0].legs[0].start_location;
        }

        var myOptions = {
            zoom: 11,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map'), myOptions);

        marker = new google.maps.Marker({
            position: center,
            map: map,
            title: "Latitude:"+position[0]+" | Longitude:"+position[1]
        });



        directionsDisplay.setMap(map)
        directionsDisplay.setPanel(document.getElementById('directionsPanel'))

        calculateAndDisplayRoute(directionsService, directionsDisplay)

        for (var i = 0; i < directionsFormatted.length; i++)
            (function(i) {
                setTimeout(function() {
                    var result = [directionsFormatted[i].coordinates.lat, directionsFormatted[i].coordinates.lng];
                    transition(result, directionsFormatted[i].duration);
                }, i * 3000);
            })(i);

        // google.maps.event.addListener(map, 'click', function(event) {
        //     var result = [event.latLng.lat(), event.latLng.lng()];
        //     transition(result);
        // });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {

        var start = directions.routes[0].legs[0].start_location

        var waypoints = []
        for (var i = 1; i < directions.routes[0].legs.length; i++) {
            waypoints.push({
                location: directions.routes[0].legs[i].start_location,
                stopover: true
            });
        }

        var end = directions.routes[0].legs[1].end_location

        var request = {
            origin: start,
            waypoints: waypoints,
            optimizeWaypoints: true,
            destination: end,
            travelMode: 'DRIVING'
        };

        // var marker = new google.maps.Marker({
            //     position: myLatlng,
            //     title:"Hello World!"
            // });

        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsDisplay.setDirections(response);
            }
        });
    }

    function getCoordinates(directions){
        var locations = [];

        console.log(locations);
        for (var i = 1; i < directions.routes[0].legs.length; i++) {

            for (let j = 0; j < directions.routes[0].legs[i].steps.length; j++) {
                var lng = directions.routes[0].legs[i].steps[j].start_location.lng;
                var lat = directions.routes[0].legs[i].steps[j].start_location.lat;
                var distance = directions.routes[0].legs[i].steps[j].distance.value;
                var duration = directions.routes[0].legs[i].steps[j].duration.value;
                // adding all the steps into an array
                locations.push({
                    'coordinates' : {
                        'lng' : lng,
                        'lat' : lat
                    },
                    'distance' : distance,
                    'duration' : duration
                });

                // need to get the last step
                if (j == directions.routes[0].legs[i].steps.length - 1) {
                    lng = directions.routes[0].legs[i].steps[j].end_location.lng;
                    lat = directions.routes[0].legs[i].steps[j].end_location.lat;

                    locations.push({
                    'coordinates' : {
                        'lng' : lng,
                        'lat' : lat
                    },
                    'distance' : 0,
                    'duration' : 0
                });
                }
            }
        }
        return locations;
    }

    var numDeltas = 100;
    // var delay = 10; //milliseconds
    var i = 0;
    var delta = [];
    // var deltaLat;
    // var deltaLng;

    function transition(result, duration){
        console.log(result);
        i = 0;
        delta = [];
        delta.push((result[0] - position[0])/numDeltas);
        delta.push((result[1] - position[1])/numDeltas);
        moveMarker(duration);
    }

    function moveMarker(duration){
        position[0] += delta[0];
        position[1] += delta[1];
        var latlng = new google.maps.LatLng(position[0], position[1]);
        marker.setTitle("Latitude:"+position[0]+" | Longitude:"+position[1]);
        marker.setPosition(latlng);
        if(i!=numDeltas){
            i++;
            setTimeout(moveMarker, duration);
        }
    }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('googlemaps.key')}}&callback=initMap"></script>
    @endsection



