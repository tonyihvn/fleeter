@extends('layouts.member-template')

@section('content')
    @php $pagetype="Table"; @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Messages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Messages</a></li>
                        <li class="breadcrumb-item active">Member Messages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="card">

            <div class="card-body">
                <a href="{{ url('new-task') }}" class="btn btn-primary float-right" style="float: right;"><i
                        class="fa fa-plus"></i> Add
                    New</a>
                <br><br>
                <table class="table responsive-table" id="products" style="font-size: 0.8em !important;">
                    <thead>
                        <tr style="color: ">
                            <th>Title</th>
                            <th>Details</th>
                            <th>Date</th>
                            <th>Set Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mytasks as $task)
                            <tr @if ($task->status == 'Completed') style="background-color: azure !important;" @endif
                                @if ($task->status == 'In Progress') style="background-color: #FFF8B0 !important;" @endif>
                                <td><b>{{ $task->subject }}</b> <br> <small>Category: <i>{{ $task->category }}</i></small>
                                </td>
                                <td>{!! isset($task->project) ? '<i>Project: </i>' . $task->project->title . '<br><hr>' : '' !!}
                                    {!! $task->details !!}</td>
                                <td>{{ $task->start_date . ' ' . $task->end_date }}</td>
                                </td>

                                <td>


                                    <a href="{{ url('/completetask/' . $task->id) }}/{{ $task->member }}"
                                        class="badge badge-success">Read</a><br>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
