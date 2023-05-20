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
            <a href="{{ url('new-client') }}" class="btn btn-primary" style="float: right;">Add New</a>
            <br>
            <table class="table responsive-table" id="products">
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th>Name</th>
                        <th>Facility</th>
                        <th>State</th>
                        <th>From</th>
                        <th>Destination</th>
                        <th>Date /Time</th>
                        <th># of People</th>
                        <th>Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allclients as $cl)
                        <tr @if ($cl->status == 'Active') style="background-color: azure !important;" @endif>
                            <td>{{ $cl->id }}</td>
                            <td>{{ $cl->company_name }}</td>
                            <td>{{ $cl->category }}</td>
                            <td>{{ $cl->name }}</td>
                            <td>{{ $cl->phone_number }}</td>
                            <td>{{ $cl->subscriptions->count() }}</td>
                            <td>{{ isset($cl->subscriptions->where('status', 'Open')->first()->title) ?? 'None' }}
                            </td>
                            <td width="90">
                                <div class="btn-group">
                                    <a href="{{ url('/edit-client/' . $cl->id) }}" class="btn btn-default btn-xs">Edit</a>

                                    <a href="{{ url('/client-subscriptions/' . $cl->id) }}"
                                        class="btn btn-success btn-xs">Subcriptions</a>

                                    <a href="{{ url('/delete-client/' . $cl->id) }}" class="btn btn-danger btn-xs"
                                        onclick="if (! confirm('Are you sure you want to delete this user??')) { return false; }">Del</a>



                                </div>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
