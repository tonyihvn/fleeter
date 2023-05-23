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
                    <h1 class="m-0">Edit Vehicle Request</h1>
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
            <form action="{{ route('updateRequest') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $request->id }}">
                <input type="hidden" name="requested_by" value="{{ $request->requested_by }}">

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="from">From</label>
                        <input type="text" list="facilities" class="form-control" name="from" id="from"
                            value="{{ $request->from ?? '' }}" placeholder="Where are taking off from">
                        <input type="hidden" name="fromid" id="fromid">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="to">Destination</label>
                        <input type="text" list="facilities" class="form-control" name="to" id="to"
                            placeholder="Destination" value="{{ $request->to ?? '' }}">
                        <input type="hidden" name="toid" id="toid">
                        <datalist id="facilities">
                            @foreach ($facilities as $faci)
                                <option value="{{ $faci->facility_name }}" data-fid="{{ $faci->id }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Departure Date/Time:</label>
                        <div class="input-group datetime" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" name="expdeparture_timedate" class="form-control datetimepicker-input"
                                data-target="#datetimepicker1" value="{{ $request->expdeparture_timedate ?? '' }}">
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Expected Return Date and Time:</label>
                        <div class="input-group datetime" id="end_date_activator" data-target-input="nearest">
                            <input type="text" name="exparrival_timedate" class="form-control datetimepicker-input"
                                data-target="#end_date_activator" value="{{ $request->exparrival_timedate ?? '' }}">
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
                            placeholder="e.g Validation and Quality Checks exercise" value="{{ $request->purpose ?? '' }}">
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

                        <tr id="100">
                            <td class="form-group">
                                @foreach ($request->noPeople as $persons)
                                    <select class="form-control" name="persons[]">
                                        <option value="{{ $persons->person_id }}" selected>
                                            {{ auth()->user()->name }}
                                        </option>
                                    </select>
                                @endforeach

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


                            <td class="form-group">
                                <a href="#staff_list" class="btn btn-sm btn-danger removesitem" id="res100">Remove<i
                                        class="lnr lnr-remove"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <a class="btn btn-sm btn-success adds_item" href="#workerslist" id="100">
                    Add Personnel
                    <i class="lnr lnr-add"></i>
                </a>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">Save Updated Request <i
                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
