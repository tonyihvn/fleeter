@extends('layouts.template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Persons on this Trip</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Persons</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">
        <p style="padding: 20px;">Trip Information: </p>
        <p style="padding: 20px;">From {{ $trip->from . ' To ' . $trip->to }} <br> Departure
            {{ date('F d, Y @ H:m', strtotime($trip->expdeparture_timedate)) . ' Return ' . date('F d, Y @ H:m', strtotime($trip->expdeparture_timedate)) }}
        </p>
        <div class="card-body" style="overflow: auto;">
            <a href="{{ url('new-requests') }}" class="btn btn-primary" style="float: right;">Add New</a>
            <br>
            <table class="table responsive-table" id="products" style="font-weight:normal !important; font-size: 0.9em;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department/Facility</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trip_persons as $trip)
                        <tr>
                            <td>{{ $trip->person->name ?? '' }}</td>
                            <td>{{ $trip->person->department->department_name ?? '' }}
                                {{ $trip->person->facility->facility_name }}
                            </td>
                            <td width="90">

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="req{{ $trip->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                            <a href="{{ url('/delete-person/' . $trip->id) }}" class="dropdown-item"
                                                onclick="if (! confirm('Are you sure you want to delete this person??')) { return false; }">Cancel
                                                / Delete</a>
                                        @endif

                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
