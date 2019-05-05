@extends('restaurant.default') 
@section('header')
<div class="container text-muted">
    <div class="row my-4">
        <h1>Restaurant Map</h1>
    </div>
</div>
@endsection
 
@section('content')
<div class="container embed-responsive embed-responsive-16by9 my-4">
    <div id="map" class="col-9 embed-responsive-item"></div>
    <div id="panels" class="offset-9 col-3 embed-responsive-item" style="overflow-y: scroll;">
        <div id="selectPanel" class="mb-4">
            <form action="{{route('restaurantMapOrder')}}" method="POST">
                @csrf
                <label for="orders"><b>Current orders:</b></label>
                <select name="order-id" class="form-control" id="order-id">
                    <option value="#">Choose an order</option>
                    @foreach ($orders as $order)
                    <option value="{{$order->id}}">{{$order->delivery_name}}</option>
                    @endforeach
                </select>
            </form>
        </div>
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
    var marker, directionsFormatted;
    console.log( directions)

    if(directions !== null)
    {
        directionsFormatted = getCoordinates( directions );
    }

    function initMap() {

        // var directions = {!! json_encode($directions) !!}
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        // var center = '37.27951800,-121.86790500';

        var center = new google.maps.LatLng([37.27951800,-121.86790500]);
        if (directions !== null && directions.status === 'OK') {
            center = directions.routes[0].legs[0].start_location;
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: center
        });

        marker = new google.maps.Marker({
            position: center,
            map: map,
            icon: '{!! asset('img/marker-icon.png') !!}',
            title: "Latitude:"+position[0]+" | Longitude:"+position[1]
        });

        directionsDisplay.setMap(map)
        directionsDisplay.setPanel(document.getElementById('directionsPanel'))

         if (directions !== null) {
            calculateAndDisplayRoute(directionsService, directionsDisplay)
         }

        @if($orders->first() !== null)
        @if($orders->first()->driver()->first() !== null)
        @if($directions !== null)
        for (var i = 0; i < directionsFormatted.length; i++){
        (function(i) {
            setTimeout(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('driverUpdateLocation') }}",
                    data: {
                        driverID: {{ $orders->first()->driver()->first()->id}},
                    },
                    success:function(data){
                    // var driverCoordinates = [data.lat, directionsFormatted[i].coordinates.lng];
                    // transition(driverCoordinates, directionsFormatted[i].duration);


                        console.log(data);
                    }
                });
            }, i * 3000);
        })(i);
    }
        @endif
        @endif
        @endif
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

            directionsService.route(request, function(response, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(response);
                }
            });
        }

        $(document).on('change', '#order-id', function() {
            var selectedOrder = $(this).val();

            $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
               });
               $.ajax({
                   type: 'POST',
                   url: "{{ route('restaurantMapOrder') }}",
                   data: {
                       'order-id': selectedOrder,
                   },
                   success: function(data){
                       console.log(data);
                       directions = data.directions;
                       initMap();



                   }
               });
        });

        
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('googlemaps.key')}}&callback=initMap"></script>
@endsection