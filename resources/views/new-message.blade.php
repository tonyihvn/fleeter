@extends('layouts.member-template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Send Message to Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Message</a></li>
                        <li class="breadcrumb-item active">Send Message</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">New Message</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('saveTask') }}" method="post">
                @csrf
                <input type="hidden" name="tid" value="">
                <input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="end_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="assigned_to" value="{{ auth()->user()->supervisor }}">
                <input type="hidden" name="status" value="Upcoming">
                <input type="hidden" name="category" value="Message">

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="title">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" aria-describedby="subject"
                            placeholder="Enter a Subject">
                        <small id="subject" class="form-text text-muted">The subject or title of the message</small>
                    </div>

                </div>
                <div class="form-group col-md-12">
                    <label for="details">Body</label>
                    <textarea name="details" id="details" class="wyswygeditor" placeholder="Write Here">

                    </textarea>

                    <small id="task_details" class="form-text text-muted">Message body
                    </small>
                </div>





                <div class="row float-right">
                    <div class="col-md-4" style="text-align: right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
