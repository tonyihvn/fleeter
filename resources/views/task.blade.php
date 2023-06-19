@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>
                        @if ($task->category == 'Message')
                            Message
                        @else
                            Task
                        @endif
                    </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">
                            @if ($task->category == 'Message')
                                Message
                            @else
                                Task
                            @endif
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-widget">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-header" style="padding: 10px;">
            <h4>{{ $task->subject }}</h4>
            <small><b>Sent By: </b>{{ $task->sentBy->name }}</small>


            <div class="row">
                <div class="col-md-2">
                    Status: <span class="badge badge-pill badge-primary">{{ $task->status }}</span>
                </div>

                <div class="col-md-2">
                    <form action="{{ route('change_task_status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <select name="change_status" id="change_status" class="form-control" onchange="this.form.submit()">
                            <option value="" selected>Change Status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Paused">Paused</option>
                            <option value="Terminated">Terminated</option>
                            <option value="Read">Read</option>
                        </select>
                    </form>
                </div>
            </div>


            <hr>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {!! $task->details !!}
                </div>
                <div class="col-md-6">


                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-reports"></i></span>

                        <div class="info-box-content">

                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">

                                @if ($task->category == 'Message')
                                    <b>Date:</b>
                                    {{ $task->start_date }}
                                @else
                                    <b>From:</b> {{ $task->start_date }} <b>To:</b> {{ $task->end_date }}
                                @endif


                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
