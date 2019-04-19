@extends('driver.default')

@section('header')
<div class="container text-muted">
    <div class="row">
        <h1>Driver Map</h1>
    </div>
</div>
@endsection


@section('content')
<div class="container">
    <div id="right-panel"></div>
    <div id="map"></div>
</div>
@endsection

@section('map')
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = {lat: -25.344, lng: 131.036};
        // The map, centered at Uluru
        var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 4, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('googlemaps.key')}}&callback=initMap"></script>
@endsection



