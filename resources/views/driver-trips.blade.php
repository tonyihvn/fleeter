@extends('layouts.template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Assigned Trips</h1>
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


    <div class="card">

        <div class="card-body" style="overflow: auto;">
            @foreach ($trips as $trip)
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
                        <div class="row" style="margin: 10px;">
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-success btn-lg btn-block">Drive to Destination <i
                                        class="fa fa-car-side"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-danger btn-lg btn-block">Stop at Destination</a>
                            </div>
                        </div>
                        @if ($trip->multipleTrip->count() > 0)
                            @foreach ($trip->multipleTrip as $mtrip)
                                <b>Next: </b> {{ $mtrip->destination }}
                                <div class="row" style="margin:10px">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-success btn-lg btn-block">Start Next Trip <i
                                                class="fa fa-car-side"></i></a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-danger btn-lg btn-block">Stop</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row" style="margin: 10px;">
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Start Return Trip</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-warning btn-lg btn-block">Stop</a>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <a href="{{ url('new-treport/' . $trip->id) }}" class="btn btn-info align-center">Write Trip
                                Report</a>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
