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
    <div class="card" style="padding:10px">

        @if ($units != null)
            <div>
                <a href="{{ url('/add_unit') }}" class="btn btn-primary float-right"><i class="fa fa-add"></i>
                    Add
                    New</a>
            </div>
            <table id="products" class="table responsive-table">
                <thead>
                    <tr>

                        <th>Unit Name</th>
                        <th>Department</th>
                        <th>Facility Name</th>
                        <th>Internal Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $un)
                        <tr>

                            <td>{{ $un->unit_name }}</td>
                            <td>{{ $un->department->department_name ?? '' }}</td>
                            <td>{{ $un->facility->facility_name ?? '' }}</td>
                            <td>{{ $un->internal_location }}</td>
                            <td>
                                <a href="{{ url('/delete-unit/' . $un->id) }}" class="btn-btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="col m6 offset-m3">{{ $units->links() }}</div>
        @else
            <blockquote>No unit found in the database.</blockquote>
        @endif

    </div>
@endsection
