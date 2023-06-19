@extends('layouts.template')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Audit Trails</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Audits</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card" style="padding:10px">

        @if ($audits != null)
            <table id="audits" class="table responsive-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Date & Time</th>
                        <th>Event/Action</th>
                        <th>Description</th>
                        <th>User</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($audits as $au)
                        <tr>
                            <td>{{ $au->created_at }}</td>
                            <td>{{ $au->action }}</td>
                            <td>{{ $au->description }}</td>
                            <td>{{ $au->doneby }}</td>


                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="col m6 offset-m3">{{ $audits->links() }}</div>
        @else
            <blockquote>No Audit trails found in the database.</blockquote>
        @endif

    </div>
@endsection
