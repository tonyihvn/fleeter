@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
@php

    $events = [];
    $events['dstart'] = 'Started Trip';
    $events['dstop'] = 'Arrived at Destination';
    $events['mstart'] = 'Started Next Trip';
    $events['mstop'] = 'Arrived at Destination';
    $events['rstart'] = 'Started Return Trip';
    $events['rstop'] = 'Returned Back';
@endphp
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
    <div class="card" style="font-weight: normal !important; padding: 10px; overflow: auto;" id="printableArea">
        <h4>TRIP REPORT</h4>
        <hr>
        <table class="table table-bordered table-responsive">
            <tbody>
                <tr>
                    <td>
                        <i class="fa fa-map-marker-alt"></i> {{ $trip->from }} <i class="fa fa-angle-double-right"></i> {{ $trip->to }}
                    </td>
                    <td>
                        <b>{{ date('F d, Y @ H:m', strtotime($trip->departure_timedate)) }} </b> <i
                            class="fa fa-angle-double-right"></i><b>
                            {{ date('F d, Y @ H:m', strtotime($trip->departure_timedate)) }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered responsive-table">

            <tbody>
                <tr>
                    <td>Driver: <b>{{ $trip->driver->name }}</b></td>
                    <td>Vehicle: <b>{{ $trip->vehicle->reg_no }}</b></td>
                    <td>Requested By: <b>{{ $trip->request->requestedBy->name }}</b></td>
                    <td>Status: <b>{{ $trip->status }}</b></td>
                </tr>
            </tbody>
        </table>
        <div class="card-body">

            <div>
                <h4>Purpose:</h4>
                <p>{{ $trip->request->purpose }}</p>
                <h4>Instructions:</h4>
                <p>{{ $trip->remarks }}</p>
                <h4>People on this Trip</h4>
                <table class="table responsive-table" style="font-weight:normal !important; font-size: 0.9em;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department/Facility</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->request->noPeople as $trip)
                            <tr>
                                <td>{{ $trip->person->name ?? '' }}</td>
                                <td>{{ $trip->person->department->department_name ?? '' }} /
                                    {{ $trip->person->facility->facility_name }}
                                </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>
                @isset($tripRoutes)
                    <h4>ACTUAL DATE/TIME AND ROUTES</h4>
                    <div class="row">
                        <table class="table responsive-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>
                                        Event
                                    </th>
                                    <th>Date/Time</th>
                                    <th>Geolocation <small>(Latitude,Longitude)</small></th>
                                    <th>Destination</th>
                                    <th>Odometer Reading</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tripRoutes as $route)
                                    <tr>
                                        <td>{{ $events[$route->type] }}</td>
                                        <td>{{ date('F d, Y @ H:m', strtotime($route->timedate)) }}</td>
                                        <td>{{ $route->geocord }}</td>
                                        <td>{{ $route->destination }}</td>
                                        <td>{{ $route->odometer }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endisset
                @isset($report)
                    <div>
                        <h4>TRIP REPORTS SUBMITTED</h4>
                        @foreach ($report as $tre)
                            <h6>Submited by <b>{{ $tre->submitedBy->name }}</b> on
                                {{ date('F d, Y @ H:m', strtotime($tre->timedate)) }}</h6>

                            <p>{!! $tre->details !!}}</p>
                            <hr>
                        @endforeach

                    </div>
                @endisset
            </div>
        </div>
    </div>

@endsection
