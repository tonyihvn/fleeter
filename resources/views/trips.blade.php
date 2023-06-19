@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
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

            <table class="table responsive-table" id="products" style="font-weight:normal !important; font-size: 0.9em;">
                <thead>
                    <tr>
                        @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                            <th>Staff Name</th>
                        @endif


                        <th style="width: 12%;" class="d-none d-md-table-cell">From</th>
                        <th>Destination</th>
                        <th>Take-off Date/Time</th>
                        <th class="d-none d-md-table-cell">Return Date/Time</th>
                        <th class="d-none d-md-table-cell">Vehicle No.</th>
                        <th class="d-none d-md-table-cell">Driver</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $tr)
                        <tr @if ($tr->status == 'Completed') style="background-color: azure !important;" @endif>
                            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                                <td>{{ $tr->request->requestedBy->name }} <br>
                                    <small><i>{{ $tr->request->requestedBy->facility->facility_name }}</i></small>
                                </td>
                            @endif

                            <td class="d-none d-md-table-cell">{{ $tr->from }}</td>
                            <td>{{ $tr->to }} <br><small
                                    class="badge badge-success">{{ $tr->request->mtrips->count() > 0 ? ' Multiple Trip ' : '' }}</small>
                            </td>
                            <td>{{ date('F d, Y @ H:m', strtotime($tr->departure_timedate)) }}</td>
                            <td class="d-none d-md-table-cell">{{ date('F d, Y @ H:m', strtotime($tr->arrival_timedate)) }}
                            </td>
                            <td class="d-none d-md-table-cell">{{ $tr->vehicle->reg_no }}</td>
                            <td class="d-none d-md-table-cell">{{ $tr->driver->name }}</td>
                            <td class="d-none d-md-table-cell">{{ $tr->status }}
                            </td>
                            <td width="90">

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="req{{ $tr->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <a href="{{ url('/trip/' . $tr->id) }}" class="dropdown-item">View Trip
                                            Details</a>

                                        @if (auth()->user()->role != 'Staff')
                                            <a href="{{ url('/trip-report/' . $tr->id) }}" class="dropdown-item">Write
                                                Trip Report
                                            </a>
                                        @endif

                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                        <a href="{{ url('/live-tracker/' . $tr->id) }}" class="dropdown-item">Live Map Tracker</a>
                                            <a href="{{ url('/delete-trip/' . $tr->id) }}" class="dropdown-item"
                                                onclick="if (! confirm('Are you sure you want to delete this trip info??')) { return false; }">Cancel
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
