@extends('layouts.member-template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
<!--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key')}}&libraries=geometry"></script>-->
  <script>
    function initMap() {
        var toDestination = '{{$trip->to_geocord}}';
        // var fromDestination = '{{$trip->from_geocord}}';

        if(toDestination!=''){
            var latlng = toDestination.split(/, ?/);

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12
            });
            directionsRenderer.setMap(map);

            if (navigator.geolocation) {
                var positionOptions = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
                };

                navigator.geolocation.watchPosition(function(position) {
                var currentPosition = new google.maps.LatLng(
                    position.coords.latitude,
                    position.coords.longitude
                );

                map.setCenter(currentPosition);
                console.log(position.coords.latitude+", "+position.coords.longitude);

                var start = currentPosition;
                var end = new google.maps.LatLng(parseFloat(latlng[0]),parseFloat(latlng[1])); // Destination coordinates

                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                directionsService.route(request, function(result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                    }
                });
                }, function(error) {
                console.error('Error occurred: ' + error.message);
                }, positionOptions);
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }else{
            $("#map").text("The destination cordinates was not provided!")
        }
    }

    // function trackDeviceMovement(directionsResult) {
    //   if (navigator.geolocation) {
    //     var positionOptions = {
    //       enableHighAccuracy: true,
    //       timeout: 5000,
    //       maximumAge: 0
    //     };

    //     var currentPosition;
    //     var currentPositionMarker;

    //     navigator.geolocation.watchPosition(function(position) {
    //       currentPosition = new google.maps.LatLng(
    //         position.coords.latitude,
    //         position.coords.longitude
    //       );

    //       if (!currentPositionMarker) {
    //         currentPositionMarker = new google.maps.Marker({
    //           position: currentPosition,
    //           map: directionsRenderer.getMap(),
    //           icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
    //         });
    //       } else {
    //         currentPositionMarker.setPosition(currentPosition);
    //       }

    //       // Check if device has reached the destination
    //       if (google.maps.geometry.spherical.computeDistanceBetween(
    //           currentPosition,
    //           directionsResult.routes[0].legs[0].end_location
    //         ) <= 10) {
    //         // Stop tracking device movement
    //         navigator.geolocation.clearWatch(watchId);
    //       }
    //     }, function(error) {
    //       console.error('Error occurred: ' + error.message);
    //     }, positionOptions);
    //   } else {
    //     console.error('Geolocation is not supported by this browser.');
    //   }
    // }

  </script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Active Trip</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trips</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div id="map" style="width:100%; height:300px">Live trip map loading ...</div>
    <div class="card">
        <div class="alert alert-success" role="alert" id="destinationAlert"
            style="text-align: center; font-weight: bold; font-size: 1.2em;"></div>

        <div class="card-body" style="overflow: auto;">
            @isset ($trip)
                <div class="card card-primary">
                    <div class="card-header">
                        Purpose: {{ $trip->request->purpose }} <small
                            class="badge badge-danger">{{ $trip->multipleTrip->count() > 0 ? ' Multiple Trip ' : '' }}</small>
                    </div>
                    <div class="card-body">
                        <h4>{{ $trip->from }} <i class="fa fa-angle-double-right"></i> {{ $trip->to }}</h4>
                        <hr>
                        <h6><i class="fa fa-clock fa-spin"></i> Take-Off: <b>{{ $trip->departure_timedate }}</b> <i
                                class="fa fa-clock fa-spin"></i>
                            Return:
                            <b> {{ $trip->arrival_timedate }}</b>
                        </h6>
                        <p class="card-text">Instructions: <br> {{ $trip->remarks }}</p>
                        <div style="text-align: center;">
                            <input type="number" step="0.01" id="odo{{ $trip->id }}" class="form-control"
                                placeholder="Enter Speedometer Reading">
                        </div>
                        <div class="row" style="margin: 10px;">
                            <div class="col-sm-6" style="margin-bottom: 10px;">
                                <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                    data-mtripid="" data-type="dstart" class="btn btn-success btn-lg btn-block drive">Drive
                                    to
                                    Destination <i class="fa fa-car-side"></i></a>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 10px;">
                                <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                    data-mtripid="" data-type="dstop" class="btn btn-danger btn-lg btn-block drive">Stop at
                                    Destination</a>
                            </div>
                        </div>
                        @if ($trip->multipleTrip->count() > 0)
                            @foreach ($trip->multipleTrip as $mtrip)
                                <b>Next: </b> {{ $mtrip->destination }}
                                <div class="row" style="margin:10px">
                                    <div class="col-sm-6" style="margin-bottom: 10px;">
                                        <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                            data-mtripid="{{ $mtrip->id }}" data-type="mstart"
                                            class="btn btn-success btn-lg btn-block drive">Start Next
                                            Trip <i class="fa fa-car-side"></i></a>
                                    </div>
                                    <div class="col-sm-6" style="margin-bottom: 10px;">
                                        <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                            data-mtripid="{{ $mtrip->id }}" data-type="mstop"
                                            class="btn btn-danger btn-lg btn-block drive">Stop</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row" style="margin: 10px;">
                            <div class="col-sm-6" style="margin-bottom: 10px;">
                                <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                    data-mtripid="" data-type="rstart" class="btn btn-primary btn-lg btn-block drive">Start
                                    Return
                                    Trip</a>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 10px;">
                                <a href="#" data-url="{{ url('/drive') }}" data-tripid="{{ $trip->id }}"
                                    data-mtripid="" data-type="rstop"
                                    class="btn btn-warning btn-lg btn-block drive">Stop</a>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <a href="{{ url('trip-report/' . $trip->id) }}" class="btn btn-info align-center">Write Trip
                                Report <i class="fa fa-pen"></i></a>
                        </div>

                    </div>
                </div>
            @endisset

        </div>
    </div>
    <script  async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key')}}&callback=initMap"></script>
    <script>
        function getLocation() {
            var user_id = '{{auth()->user()->id}}';
            var trip_id = '{{$trip->id}}';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const { latitude, longitude } = position.coords;

                        const data = {
                            latitude,
                            longitude,
                            user_id,
                            trip_id
                        };

                        fetch('/update-location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accep': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Location updated successfully');
                            })
                            .catch(error => {
                                console.log(response);

                                console.error('Error updating location:', error);
                            });
                    },
                    function(error) {
                        console.error('Error getting geolocation:', error);
                    }
                );
            } else {
                console.error('Geolocation is not supported');
            }
        }
        setInterval(getLocation, 3000);
</script>
@endsection

