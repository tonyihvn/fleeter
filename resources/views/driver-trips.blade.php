@extends('layouts.member-template')
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
        <div class="alert alert-success" role="alert" id="destinationAlert"
            style="text-align: center; font-weight: bold; font-size: 1.2em;"></div>
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
                        <p class="card-text"><b>Instructions:</b> <br> {{ $trip->remarks }}</p>

                        <div class="row" style="margin: 10px; ">
                            <div class="col-sm-12" style="margin-bottom: 10px;">
                                <a href="{{ url('/start-trip/'.$trip->id) }}" class="btn btn-success btn-lg btn-block">                                    Start this Trip
                                     <i class="fa fa-car-side"></i></a>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

