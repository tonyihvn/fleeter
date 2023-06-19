@extends('layouts.template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Staffs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Staffs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">

        <div class="card-body" style="overflow: auto;">
            <a href="{{ url('new-staff') }}" class="btn btn-primary" style="float: right;">Add New</a>
            <br>
            <table class="table responsive-table" id="products">
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th>Staff Name</th>
                        <th>Facility</th>
                        <th>Department</th>
                        <th>Unit</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allstaffs as $cl)
                        <tr @if ($cl->status == 'Active') style="background-color: azure !important;" @endif>
                            <td>{{ $cl->id }}</td>
                            <td>{{ $cl->name }}</td>
                            <td>{{ $cl->facility->name }}</td>
                            <td>{{ $cl->department->name ?? '' }}</td>
                            <td>{{ $cl->unit->name ?? '' }}</td>
                            <td>{{ $cl->designation }}</td>
                            <td>{{ $cl->status }}
                            </td>
                            <td width="90">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <li class="dropdown-item"><a href="{{ url('/edit-staff/' . $cl->id) }}"
                                                class="dropdown-item">Edit</a></li>
                                        <li class="dropdown-item"><a href="{{ url('/staff-trips/' . $cl->id) }}"
                                                class="dropdown-item">Trips</a></li>
                                        <li class="dropdown-item"><a href="{{ url('/new-request/' . $cl->id) }}"
                                                class="dropdown-item">New
                                                Request</a></li>

                                        <li class="divider"></li>
                                        <li class="dropdown-item"><a href="{{ url('/delete-staff/' . $cl->id) }}"
                                                class="dropdown-item"
                                                onclick="if (! confirm('Are you sure you want to delete this staff??')) { return false; }">Del</a>
                                        </li>



                                    </ul>
                                </div>


                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
