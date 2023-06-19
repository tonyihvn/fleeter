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
                        <li class="breadcrumb-item active">Live Map</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card" style="font-weight: normal !important; padding: 10px;" id="printableArea">
        <h4>TRIP LIVE MAP</h4>
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


                        @if ($trip->multipleTrip->count() > 0)
                            @foreach ($trip->multipleTrip as $mtrip)
                                <b>Next: </b> {{ $mtrip->destination }}

                            @endforeach
                        @endif

                    </div>
                </div>
            @endisset
        <hr>
        <div id="map" style="width: 100%; height: 500px"></div>

        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 14
        });

        const markers = {};

        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
        });

        const channel = pusher.subscribe('location-channel');
        channel.bind('update-location', function(data) {
            const { lat, lng, user_id, trip_id } = data;

            if (user_id == '{{ $trip->driver_id }}' && trip_id == '{{$trip->id}}') {
                if (!markers[user_id]) {
                    markers[user_id] = new google.maps.Marker({
                        position: { lat, lng },
                        map: map
                    });
                } else {
                    markers[user_id].setPosition({ lat, lng });
                }

                map.panTo({ lat, lng });
            }
        });

    </script>
    </div>
@endsection
