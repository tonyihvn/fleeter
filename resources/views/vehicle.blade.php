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
                        <li class="breadcrumb-item"><a href="#">Vehicle</a></li>
                        <li class="breadcrumb-item active">Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <a href="#" onclick="printDiv('printableArea')" class="btn btn-primary float-right">Print Report <i
            class="fa fa-print"></i></a>
    <div class="card" style="font-weight: normal !important; padding: 10px; overflow: auto;" id="printableArea">
        <h4>VEHICLE REG. NO: {{ $vehicle->reg_no }}</h4>
        <hr>
        <img src="{{asset('/vehicles/'.$vehicle->picture)}}" alt="No Image" width="auto" height="500">
        <form action="{{ route('updateVehicle') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="vid" value="{{ $vehicle->id }}">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="odometer">Current Odometer Reading</label>
                    <input type="text" class="form-control" value="{{ $vehicle->odometer }}" name="odometer" id="odometer"
                        placeholder="Update Mileage">
                </div>
                <div class="form-group col-md-3">
                    <label for="fuel_level">Current Fuel Level</label>
                    <input type="text" class="form-control" value="{{ $vehicle->fuel_level }}" name="fuel_level" id="fuel_level"
                        placeholder="Update Fuel Level">
                </div>

                <div class="form-group col-md-3">
                    <label for="condition">Condition</label>
                    <select name="condition" id="condition" class="form-control">
                        <option value="{{ $vehicle->condition }}" selected>{{ $vehicle->condition }}</option>
                        <option value="Operational">Operational</option>
                        <option value="Decommisioned">Decommisioned</option>
                        <option value="Damaged">Damaged</option>
                        <option value="At Mechanic">At Mechanic</option>
                        <option value="Stolen">Stolen</option>
                        <option value="New">New</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="save"><small>Please, follow full level guide</small></label>
                    <button type="submit" id="save" class="btn btn-primary">Update Vehicle <i class="fa fa-save"
                            aria-hidden="true"></i></button>
                </div>
            </div>
        </form>

        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <td><b>{{ $vehicle->brand }} {{ $vehicle->model }}</b></td>
                    <td>Chasis No: <b>{{ $vehicle->chasis_no }}</b></td>
                    <td>Odometer Reading: <b>{{ $vehicle->odometer }}</b></td>
                    <td>Fuel Level: <b>{{ $vehicle->fuel_level }}</b></td>
                </tr>
                <tr>
                    <td>Purchase Date:<b>{{ $vehicle->purchase_date }}</b></td>
                    <td>Color: <b>{{ $vehicle->color }}</b></td>
                    <td>Status: <b>{{ $vehicle->status }} </b></td>
                    <td>Condition: <b>{{ $vehicle->condition }}</b></td>
                </tr>
                <tr>

                    <td colspan="4"><b>Facility: </b>{{ $vehicle->facility->facility_name??'' }}</td>
                </tr>
            </tbody>
        </table>
        <div class="card-body">
            <div>
                <h4>TRIPS</h4>
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
                        @foreach ($vehicle->trips as $tr)
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
    </div>

@endsection
