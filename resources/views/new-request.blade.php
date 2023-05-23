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
                    <h1 class="m-0">New Vehicle Request</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('requests') }}">Vehicle</a></li>
                        <li class="breadcrumb-item active">Request</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Vehicle Request Form</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('saveRequest') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="from">From</label>
                        <input type="text" list="facilities" class="form-control" name="from" id="from"
                            value="{{ auth()->user()->facility->facility_name ?? '' }}"
                            placeholder="Where are taking off from">
                        <input type="hidden" name="fromid" id="fromid"
                            value="{{ auth()->user()->facility->id ?? '' }}">
                        <datalist id="facilities">
                            @foreach ($facilities as $faci)
                                <option value="{{ $faci->facility_name }}" data-fid="{{ $faci->id }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div id="destination">
                    <div class="row" id="1000">
                        <div class="form-group col-md-10">
                            <label for="to">Destination</label>
                            <input type="text" list="facilities" class="form-control" name="to" id="to"
                                placeholder="Destination">
                            <input type="hidden" name="toid" id="toid">
                        </div>
                        <div class="form-group col-md-2">
                            <label>.</label>
                            <a href="#destination" class="btn btn-sm btn-danger btn-block removesitem" id="des1000">Remove
                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div style="text-align: center;">
                    <small><i>If this is a multi-location trip, click here to add more
                            destination(s)</i> </small>
                    <hr>

                    <a class="btn btn-sm btn-success adds_des" href="#destination" id="1000">
                        Add More Destination
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Departure Date/Time:</label>
                        <div class="input-group datetime" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" name="expdeparture_timedate" class="form-control datetimepicker-input"
                                data-target="#datetimepicker1">
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Return Date and Time:</label>
                        <div class="input-group datetime" id="end_date_activator" data-target-input="nearest">
                            <input type="text" name="exparrival_timedate" class="form-control datetimepicker-input"
                                data-target="#end_date_activator">
                            <div class="input-group-append" data-target="#end_date_activator" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="purpose">Purpose of trip</label>
                        <input type="text" class="form-control" name="purpose" id="purpose"
                            placeholder="e.g Validation and Quality Checks exercise">
                    </div>
                </div>

                <table class="table" id="workerslist">
                    <thead>
                        <tr class="spechead">
                            <th class="form-group" style="width: 90% !important">Add People to this Trip</th>

                            <th class="form-group">.</th>
                        </tr>
                    </thead>
                    <tbody id="staff_list">

                        <tr id="100" class="row">
                            <td class="form-group col-sm-10">
                                <select class="form-control" name="persons[]" required>
                                    <option value="{{ auth()->user()->id }}" selected>
                                        {{ auth()->user()->name }} -
                                        <small>{{ auth()->user()->facility->facility_name }}</small>
                                    </option>
                                    @foreach ($users as $sta)
                                        <option value="{{ $sta->id }}">
                                            {{ $sta->name }} -
                                            <small>{{ $sta->facility->facility_name }}</small>
                                        </option>
                                    @endforeach
                                </select>
                            </td>


                            <td class="form-group col-sm-2">
                                <a href="#staff_list" class="btn btn-sm btn-danger btn-block removesitem"
                                    id="res100">Remove <i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <a class="btn btn-sm btn-success adds_item" href="#workerslist" id="100">
                    Add Personnel
                    <i class="fa fa-plus"></i>
                </a>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">Send Request <i class="fa fa-paper-plane"
                            aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
