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
                    <h1 class="m-0">Facilities</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Facilities</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        @if ($facilities != null)
            <div class="card-header">
                <a href="{{ url('/add_facility') }}" class="btn btn-primary float-right"> Add <i class="fa fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table id="products" class="table responsive-table" style="width:100%; font-weight: normal;">
                    <thead>
                        <tr>
                            <th>Facility Name</th>
                            <th>Datim No</th>
                            <th>State</th>
                            <th>LGA</th>
                            <th>Town</th>
                            <th>Phone No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <td>{{ $facility->facility_name }}</td>
                                <td>{{ $facility->facility_no }}</td>
                                <td>{{ $facility->state }}</td>
                                <td>{{ $facility->lga }}</td>
                                <td>{{ $facility->town }}</td>
                                <td>{{ $facility->phone_number }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('/facility/' . $facility->id) }}"
                                            class="btn btn-primary btn-xs">Edit</a>
                                        <a href="{{ url('/delete-facility/' . $facility->id) }}"
                                            class="btn btn-danger btn-xs">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>

                            <th>Facility Name</th>
                            <th>FacilityNo</th>
                            <th>State</th>
                            <th>LGA</th>
                            <th>Town</th>
                            <th>Phone No.</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <blockquote>No Facilities found in the database.</blockquote>
        @endif
    </div>
@endsection
