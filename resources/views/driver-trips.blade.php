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
                <div class="card">
                    <div class="card-header">
                        {{ $trip->request->purpose }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">From: {{ $trip->from }} | To: {{ $trip->to }}</h5>
                        <h5 class="card-subtitle">Departure: {{ $trip->from }} | Expected Return: {{ $trip->to }}</h5>
                        <p class="card-text">Instructions: <br> {{ $trip->remarks }}</p>
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary group-item">Start</a>
                            <a href="#" class="btn btn-red group-item">Stop</a>
                            <a href="#" class="btn btn-info group-item">Trip Report</a>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
