@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
<style>
    .bootstrap-datetimepicker-widget {
        width: 100% !important;
    }
</style>
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add a New Vehicle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('requests') }}">Vehicle</a></li>
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">New Vehicle Form</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('saveVehicle') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="reg_no">Registration Number</label>
                        <input type="text" class="form-control" name="reg_no" id="reg_no"
                            placeholder="Vehicle Reg. Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="brand">Brand</label>
                        <input type="text" value="Toyota" class="form-control" name="brand" id="brand"
                            placeholder="e.g. Toyota">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" name="model" id="model" placeholder="e.g. Hilux">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="chasis_no">Chasis Number</label>
                        <input type="text" class="form-control" name="chasis_no" id="chasis_no"
                            placeholder="Chasis Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" id="color" placeholder="e.g. White">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="picture">Upload Picture</label>
                        <input type="file" class="form-control" name="picture" id="picture">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="odometer">Odometer Reading</label>
                        <input type="text" class="form-control" name="odometer" id="odometer"
                            placeholder="Current Speedometer Reading">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fuel_level">Fuel Level</label>
                        <input type="text" class="form-control" name="fuel_level" id="fuel_level" placeholder="e.g. 20%">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Date of Purchase:</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" name="purchase_date" class="form-control datetimepicker-input"
                                data-target="#datetimepicker1">
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="facility">State and Facility</label>
                        <input type="text" list="facilities" class="form-control" name="facility" id="facility"
                            placeholder="Destination">
                        <input type="hidden" name="facility_id" id="facility_id">
                        <datalist id="facilities">
                            @foreach ($facilities as $faci)
                                <option value="{{ $faci->facility_name }} - {{ $faci->state }} State"
                                    data-fid="{{ $faci->id }}">
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="condition">Condition</label>
                        <select name="condition" id="condition" class="form-control">
                            <option value="Operational" selected>Operational</option>
                            <option value="Decommisioned">Decommisioned</option>
                            <option value="Damaged">Damaged</option>
                            <option value="At Mechanic">At Mechanic</option>
                            <option value="Stolen">Stolen</option>
                            <option value="New">New</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="On Trip" selected>On Trip</option>
                            <option value="Available">Available</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">Save Vehicle <i class="fa fa-paper-plane"
                            aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
