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
                    <h1 class="m-0">Units</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Units</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card" style="padding: 10px;">
        <form method="POST" action="{{ route('units.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6"><label for="unit_name">Unit Name</label>
                    <input id="unit_name" type="text" class="form-control" name="unit_name" required autofocus>

                </div>

                <div class="form-group col-md-6"><label for="facility">Facility</label>
                    <select name="facility" id="facility" class="form-control" materialize="material_select">
                        <option value="" selected>Select Facility</option>
                        @foreach ($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">


                <div class="form-group col-md-6"><label for="department">Department</label>
                    <select name="department" id="department" class="form-control" materialize="material_select">
                        <option value="" selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group col-md-6"><label for="internal_location">Internal Location</label>
                    <input id="internal_location" type="text" class="form-control" name="internal_location" required>

                </div>
            </div>
            <div class="row">


                <div class="form-group col-md-12"><label for="description">Notes / Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5"></textarea>

                </div>
            </div>
            <div class="form-group col-md-12 float-right">

                <button type="submit" class="btn btn-primary float-right">
                    Add Unit
                </button>

            </div>
        </form>


    </div>
@endsection
