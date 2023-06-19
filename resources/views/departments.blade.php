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

    <div class="card" style="padding: 10px;">
        @if ($departments != null)
            <div>
                <a href="{{ url('/add_department') }}" class="btn btn-sm btn-primary float-right"> Add New <i
                        class="fa fa-plus"></i></a>
            </div>
            <table id="products" class="table responsive-table">
                <thead>
                    <tr>

                        <th>Department Name</th>
                        <th>Facility Name</th>
                        <th>Internal Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $dept)
                        <tr>

                            <td>{{ $dept->department_name }}</td>
                            <td>{{ $dept->facility->facility_name ?? '' }}</td>
                            <td>{{ $dept->internal_location }}</td>
                            <td>
                                <a href="{{ url('/delete-department/' . $dept->id) }}" class="btn-btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="col m6 offset-m3">{{ $departments->links() }}</div>
        @else
            <blockquote>No Department found in the database.</blockquote>
        @endif

    </div>
@endsection
