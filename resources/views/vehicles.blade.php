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
                    <h1 class="m-0">All Vehicles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vehicles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">

        <div class="card-body" style="overflow: auto;">
            <div>
                <a href="{{ url('new-vehicle') }}" class="btn btn-sm btn-primary float-right"> Add New <i
                        class="fa fa-plus"></i></a>
            </div>

            <table class="table responsive-table" id="products" style="font-weight:normal !important; font-size: 0.9em;">
                <thead>
                    <tr>
                        <th>Vehicle Brand/Model</th>
                        <th>Reg. No</th>
                        <th>Odometer Reading</th>
                        <th class="d-none d-md-table-cell">Fuel Level</th>
                        <th class="d-none d-md-table-cell">Condition</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $veh)
                        <tr @if ($veh->status == 'Available') style="background-color: azure !important;" @elseif($veh->condition != 'Operational')  style="background-color: orange !important;" @endif>
                            <td>{{ $veh->band }} <small><i>{{ $veh->model }}</i></small>
                            </td>
                            <td>{{ $veh->reg_no }}</td>
                            <td>{{ $veh->odometer }}</td>
                            <td class="d-none d-md-table-cell">{{ $veh->fuel_level }}</td>
                            <td class="d-none d-md-table-cell">{{ $veh->condition }}</td>
                            <td class="d-none d-md-table-cell">{{ $veh->status }}</td>
                            <td>

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="req{{ $veh->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <a href="{{ url('/vehicle/' . $veh->id) }}" class="dropdown-item">Vehicle Info</a>

                                        @if (auth()->user()->role == 'Super')
                                            <a href="{{ url('/delete-vehicle/' . $veh->id) }}" class="dropdown-item">Delete Vehicle</a>
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
