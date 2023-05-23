@extends('layouts.template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Vehicle Requests</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vehicle Requests</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">

        <div class="card-body" style="overflow: auto;">
            <a href="{{ url('new-requests') }}" class="btn btn-primary" style="float: right;">Add New</a>
            <br>
            <table class="table responsive-table" id="products" style="font-weight:normal !important; font-size: 0.9em;">
                <thead>
                    <tr>
                        <th>Name of Sender</th>
                        <th style="width: 12%;">From</th>
                        <th style="width: 12%;">Destination</th>
                        <th>Take-off Date/Time</th>
                        <th>Return Date/Time</th>
                        <th># of People</th>
                        <th>Approval</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allrequests as $req)
                        <tr @if ($req->status == 'In Progress' || $req->approved_by != '') style="background-color: azure !important;" @endif
                            @if ($req->status == 'Not Approved') style="background-color: #FCE772 !important;" @endif>
                            <td>{{ $req->requestedBy->name }} <br>
                                <small><i>{{ $req->requestedBy->facility->facility_name }}</i></small>
                            </td>

                            <td>{{ $req->from }}</td>
                            <td>{{ $req->to }}</td>
                            <td>{{ date('F d, Y @ H:m', strtotime($req->expdeparture_timedate)) }}</td>
                            <td>{{ date('F d, Y @ H:m', strtotime($req->exparrival_timedate)) }}</td>
                            <td>{{ $req->noPeople->count() }}</td>
                            <td>{{ $req->approvedBy->name ?? 'Not Approved' }}</td>
                            <td>{{ $req->status }}
                            </td>
                            <td width="90">

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="req{{ $req->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        @if (auth()->user()->role == 'Supervisor' || auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                            <a href="{{ url('/approve-request/' . $req->id) }}"
                                                class="dropdown-item">Approve</a>

                                            <a href="{{ url('/disapprove-request/' . $req->id) }}"
                                                class="dropdown-item">Disapprove</a>
                                        @endif

                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                            <a href="{{ url('/assign-driver/' . $req->id) }}"
                                                onclick="assignDriver({{ $req->id }})" class="dropdown-item"
                                                data-toggle="modal" data-target="#assigndriver">Assign
                                                Vehicle/Driver</a>

                                            <a href="{{ url('/edit-request/' . $req->id) }}" class="dropdown-item">Edit</a>
                                        @endif
                                        <a href="{{ url('/request-persons/' . $req->id) }}" class="dropdown-item">
                                            Person on this trip</a>
                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                            <a href="{{ url('/delete-request/' . $req->id) }}" class="dropdown-item"
                                                onclick="if (! confirm('Are you sure you want to delete this request??')) { return false; }">Cancel
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

    <!-- The Settings Modal -->
    <div class="modal" id="assigndriver">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Assign Driver and Vehicle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form method="POST" action="{{ route('assignDriver') }}" id="assigndriverform">
                        @csrf


                        <input type="hidden" name="request_id" id="request_id">

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <select class="form-control" name="driver_id" required>
                                    <option value="1">Assign Driver</option>
                                    @foreach ($users->where('role', 'Driver') as $driver)
                                        <option value="{{ $driver->id }}">
                                            {{ $driver->name }} -
                                            <small>{{ $driver->facility->facility_name }}</small>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <select class="form-control" name="vehicle_id" style="font-size: 0.9em" required>
                                    <option value="1">Assign Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">
                                            <i>{{ $vehicle->brand }} {{ $vehicle->model }} - Reg No:
                                                {{ $vehicle->reg_no }}
                                                ({{ $vehicle->status }} / {{ $vehicle->condition }})
                                                <small>{{ $vehicle->facility->facility_name ?? '' }}</small>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <select class="form-control" name="type" required>
                                    <option value="1">Choose Trip Type</option>

                                    <option value="Drop-Off">
                                        Drop-Off
                                    </option>
                                    <option value="Round Trip">
                                        Round Trip
                                    </option>
                                    <option value="Multiple Route">
                                        Multiple Route
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="text" name="remarks" id="remarks" class="form-control">
                                <small>Note: The Driver and Staff will see this</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">
                                {{ __('Assign') }}
                            </button>
                        </div>


                    </form>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
