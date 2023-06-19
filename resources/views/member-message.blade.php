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
                        <li class="breadcrumb-item active">Messages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="card">

            <div class="card-body">
                <a href="{{ url('new-task') }}" class="btn btn-primary float-right" style="float: right;"><i
                        class="fa fa-paper-plane"></i> Send Message to Supervisor</a>
                <br><br>
                <table class="table responsive-table" style="font-size: 0.8em !important;">
                    <thead>
                        <tr style="color: ">
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mytasks as $task)
                            <tr @if ($task->status == 'Upcoming') style="background-color: azure !important;" @endif>
                                <td><b><a
                                            href="{{ url('/task/' . $task->id) }}/{{ $task->member }}">{{ $task->subject }}</a></b>
                                    <br>
                                    @if ($task->sender_id == auth()->user()->id)
                                        <small><i class="badge badge-info">Sent Message</i></small>
                                    @else
                                        <small><i class="badge badge-info">From: {{ $task->sentBy->name }}</i></small>
                                    @endif
                                    <small>{{ $task->start_date . ' ' . $task->end_date }}</small>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
