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
                    <h1 class="m-0">New Trip Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('requests') }}">Trip</a></li>
                        <li class="breadcrumb-item active">New Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h6 class="card-title"> Destination: {{ $trip->to }} @ {{ $trip->arrival_timedate }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('saveTripreport') }}" method="post">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                <div class="form-group col-md-12">
                    <label for="details">Body</label>
                    <textarea name="details" id="details" class="wyswygeditor">
                    Place <em>some</em> <u>text</u> <strong>here</strong>
                    </textarea>

                    <small id="task_details" class="form-text text-muted">Trip Details
                    </small>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">Save Report <i class="fa fa-paper-plane"
                            aria-hidden="true"></i></button>
                </div>
            </form>

            <hr style="clear: both; margin-top: 20px;">
            <h4>Update Vehicle Information</h4>

            <form action="{{ route('updateVehicle') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vid" value="{{ $trip->vehicle_id }}">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="odometer">Current Odometer Reading</label>
                        <input type="text" class="form-control" value="{{ $trip->vehicle->odometer }}" name="odometer" id="odometer"
                            placeholder="Update Mileage">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fuel_level">Current Fuel Level</label>
                        <input type="text" class="form-control" value="{{ $trip->vehicle->fuel_level }}" name="fuel_level" id="fuel_level"
                            placeholder="Update Fuel Level">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="condition">Condition</label>
                        <select name="condition" id="condition" class="form-control">
                            <option value="{{ $trip->vehicle->condition }}" selected>{{ $trip->vehicle->condition }}</option>
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
        </div>
    </div>
@endsection
