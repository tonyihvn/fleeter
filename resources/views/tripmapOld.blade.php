@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trip</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <a href="#" onclick="printDiv('printableArea')" class="btn btn-primary float-right">Print Report <i
            class="fa fa-print"></i></a>
    <div class="card" style="font-weight: normal !important; padding: 10px;" id="printableArea">
        <h4>TRIP LIVE MAP</h4>
        <hr>
        <div id="map" style="width:100%; height: 500px;"></div>

        <script>
            // Initialize and load the Google Maps API
            function initMap() {
                // Define the map options
                var mapOptions = {
                    center: {
                        lat: 37.7749,
                        lng: -122.4194
                    }, // Initial map center (San Francisco)
                    zoom: 12 // Initial zoom level
                };

                // Create the map object
                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                // Function to update the vehicle position on the map
                function updateVehiclePosition(lat, lng) {
                    // Clear previous marker, if any
                    if (typeof vehicleMarker !== 'undefined') {
                        vehicleMarker.setMap(null);
                    }

                    // Create a new marker for the vehicle position
                    vehicleMarker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(lat),
                            lng: parseFloat(lng)
                        },
                        map: map
                    });

                    // Pan the map to the updated vehicle position
                    map.panTo(vehicleMarker.getPosition());
                }

                // Function to update the vehicle position based on the browser's location
                function updateVehiclePositionFromBrowserLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.watchPosition(function(position) {
                            // Get the current browser location coordinates
                            var lat = position.coords.latitude;
                            var lng = position.coords.longitude;

                            // Update the vehicle position on the map
                            updateVehiclePosition(lat, lng);
                        });
                    } else {
                        alert('Geolocation is not supported by this browser.');
                    }
                }

                // Call the updateVehiclePositionFromBrowserLocation function to start tracking the vehicle
                updateVehiclePositionFromBrowserLocation();
            }
        </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ_YWWnq5qwxQ3_ZFMDLSQyMx6mDrLPLo&callback=initMap"></script>
                </div>
@endsection
