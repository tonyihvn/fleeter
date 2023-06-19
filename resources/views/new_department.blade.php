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
                    <h1 class="m-0">Departments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Departments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card" style="padding:15px">
        <form method="POST" action="{{ route('departments.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <input id="department_name" type="text" class="form-control" name="department_name" required
                        autofocus>
                    <label for="department_name">Department Name</label>
                </div>

                <div class="form-group col-md-6">
                    <select name="facility" id="facility" class="form-control">
                        <option value="" selected>Select Facility</option>
                        @foreach ($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                        @endforeach
                    </select>
                    <label for="facility">Facility</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <input id="internal_location" type="text" class="form-control" name="internal_location" required>
                    <label for="internal_location">Internal Location</label>
                </div>

                <div class="form-group col-md-12">
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    <label for="description">Notes / Description</label>
                </div>
            </div>


            <div class="form-group">

                <button type="submit" class="btn btn-primary float-right">
                    Add Department
                </button>

            </div>
        </form>


    </div>
@endsection
