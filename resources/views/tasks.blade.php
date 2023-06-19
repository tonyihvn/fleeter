@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
@section('content')
    @php $pagetype="Table"; @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tasks</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tasks</a></li>
                        <li class="breadcrumb-item active">My Tasks</li>
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
                            <th class="d-none d-md-table-cell">Details</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Set Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mytasks as $task)
                            <tr @if ($task->status == 'Completed') style="background-color: azure !important;" @endif
                                @if ($task->status == 'In Progress') style="background-color: #FFF8B0 !important;" @endif>
                                <td><b>{{ $task->subject }}</b> <br> <small>Category: <i>{{ $task->category }}</i></small>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    {!! $task->details !!}</td>
                                <td>{{ $task->start_date . ' ' . $task->end_date }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ is_numeric($task->assigned_to) ? $task->assignedTo->name : '' }}
                                </td>

                                <td>

                                    <a href="{{ url('/inprogresstask/' . $task->id) }}/{{ $task->member }}"
                                        class="badge badge-warning">In Progress</a>
                                    <a href="{{ url('/completetask/' . $task->id) }}/{{ $task->member }}"
                                        class="badge badge-success">Completed</a><br>
                                    <a href="{{ url('/new-task-report/' . $task->id) }}/{{ $task->member }}"
                                        class="badge badge-info">Add Report</a>

                                    <a href="{{ url('/del-task/' . $task->id) }}" class="badge badge-danger"
                                        onclick="return confirm('Are you sure you want to delete this task? {{ $task->title }}?')">Delete</a>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
