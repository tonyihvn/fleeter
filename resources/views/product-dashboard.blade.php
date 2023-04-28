@extends('layouts.template')
<style>
    .list-group {
        font-size: 0.9em !important;
    }
</style>
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        @php
            $featured_img = $product->product_files->where('featured', 'Yes')->first();
        @endphp
        <div class="widget-user-header text-white"
            style="background: @if ($featured_img) url({{ asset('public/files/' . $featured_img->product_id . '/' . $featured_img->file_name) }}); @endif background-size: cover; background-position: top; height: 250px !important; text-shadow: 2px 2px #000; background-color: grey;">
            <h1 class="text-right">{{ $product->title }}</h1>
            <h5 class="widget-user-desc text-right">Vendor: {{ $product->supplier->company_name ?? '' }}
            </h5>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-sm-3 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ isset($product->subplans[0]) ? $product->subplans->count() : '' }}
                        </h5>
                        <span class="description-text">SUBSCRIPTION PLANS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                    <div class="description-block">
                        <h5 class="description-header">
                            {{ isset($product->subscribers[0]) ? $product->subscribers->where('status', 'Completed')->count() : '' }}
                        </h5>
                        <span class="description-text">TOTAL SUBSCRIBERS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                    <div class="description-block">
                        <h5 class="description-header">
                            {{ isset($product->subscribers[0]) ? $product->subscribers->where('status', 'Completed')->count() : '' }}
                        </h5>
                        <span class="description-text">COMPLETED PAYMENT</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                    <div class="description-block">
                        <h5 class="description-header">
                            New
                        </h5>
                        <a href="#subscribe" class="description-text btn btn-success">SUBSCRIBE</a>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">

                    <div class="card">
                        <div id="carouselId" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">

                                @foreach ($product->product_files as $key => $fit)
                                    @php
                                        $file_ext = pathinfo(asset('public/files/' . $fit->product_id . '/' . $fit->file_name))['extension'];
                                        if ($file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg') {
                                            echo '<li data-target="#carouselId" data-slide-to="' . $key++ . '" class="active"></li>';
                                        }
                                    @endphp
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach ($product->product_files as $key => $fit)
                                    @php
                                        $file_ext = pathinfo(asset('public/files/' . $fit->product_id . '/' . $fit->file_name))['extension'];
                                        if ($file_ext == 'png' || $file_ext == 'jpg' || $file_ext == 'jpeg') {
                                            if ($key == 0) {
                                                $active = 'active';
                                            } else {
                                                $active = '';
                                            }
                                            echo '<div class="carousel-item ' .
                                                $active .
                                                '">
                                                    <img src="' .
                                                asset('public/files/' . $fit->product_id . '/' . $fit->file_name) .
                                                '"alt="' .
                                                $fit->file_title .
                                                '" height="300" width="100%">
                                                    <div class="carousel-caption d-none d-md-block"  style="background-color: black !important; opacity: 0.5;">
                                                        <h3>' .
                                                $fit->file_title .
                                                '</h3>
                                                        <p>' .
                                                $fit->details .
                                                '</p>
                                                    </div>
                                                </div>';
                                        }
                                    @endphp
                                @endforeach


                            </div>
                            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <span class="badge badge-warning badge-pill" style="margin: 10px;">STATUS:
                            {{ $product->status }}</span>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center active small">
                                    Price:
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->price }}
                                </li>

                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center active small">
                                    Vendor Contact:
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->supplier->name ?? '' }}
                                </li>

                            </ul>

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center active small">
                                    Available Period:
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    {{ $product->start_date }} To: {{ $product->end_date }}
                                </li>

                            </ul>

                            <hr>

                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active">Menu
                                </a>

                                <a href="/item-payments/{{ $product->id }}"
                                    class="list-group-item list-group-item-action">Payments</a>
                            </div>

                            <div class="list-group">
                                <a href="{{ url('addp-file/' . $product->id) }}"
                                    class="list-group-item list-group-item-action active">Images/Files <span
                                        class="btn btn-default" style="float: right;">Add</span></a>

                                @foreach ($product->product_files as $ft)
                                    @php
                                        $file_ext = pathinfo(asset('public/files/' . $ft->product_id . '/' . $ft->file_name))['extension'];
                                    @endphp
                                    <li class="list-group-item list-group-item-action">
                                        <a target="_blank"
                                            href="{{ URL::to('public/files/' . $ft->product_id . '/' . $ft->file_name) }}">{{ $ft->file_title }}
                                            <span class="badge badge-info">{{ $file_ext }}</span></a>
                                        <a href="/delete-file/{{ $ft->id }}"
                                            class="btn btn-inline btn-xs btn-danger float-right">Del</a>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="row" style="color:dodgerblue;">
                        <h5>Product Description: </h5>
                    </div>
                    <div class="row">
                        <p style="text-align: left;">{!! $product->detail !!}</p>
                    </div>
                    <hr>
                    <div class="row" style="color:dodgerblue;">
                        <h5>Terms and Conditions: </h5>
                    </div>
                    <div class="row">
                        <p style="text-align: left;">{!! $product->terms !!}</p>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12 card" style="border: blue 2px solid">
                            <div class="card-head">
                                <a href="{{ url('subplans') }}" class="btn btn-primary float-right"
                                    style="margin: 10px;">Add New</a>
                            </div>
                            <h4>Available Offers</h4>

                            <table class="table  responsive-table" id="products">
                                <thead>
                                    <tr style="color: ">
                                        <th>Title</th>
                                        <th># of Repayments</th>
                                        <th>Monthly Contribution</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->subplans as $sub)
                                        <tr>
                                            <td>{{ $sub->title }}</td>
                                            <td>{{ $sub->duration }}</td>
                                            <td>{{ number_format(ceil($sub->monthly_contribution), 2) }}</td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="row">


                        <div class="col-md-12 card" id="subscribe">
                            <h3 style="text-align:center !important; color:tomato;">New Subscription</h3>
                            <hr>
                            <form method="POST" action="{{ route('addsubscription') }}">
                                @csrf

                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Client Name</label>
                                        <select name="client_id" class="form-control select2" id="client_id">
                                            @foreach ($clients->where('role', 'Client') as $cl)
                                                <option value="{{ $cl->id }}" data-name="{{ $cl->name }}">
                                                    {{ $cl->name }} ({{ $cl->company_name }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Choose Subscription Plan</label>
                                        <select name="subscription_plan" class="form-control" id="subscription_plan">
                                            @foreach ($business->subplans->where('product_id', $product->id) as $psp)
                                                <option value="{{ $psp->id }}" data-price="{{ $psp->amount_per }}">
                                                    {{ $psp->title }} ========
                                                    ({{ number_format($psp->monthly_contribution, 2) }} Naira Per
                                                    month
                                                    for
                                                    {{ $psp->duration }} months)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penalties">Total Penalty</label>
                                            <input type="number" name="penalties" id="penalties" class="form-control"
                                                placeholder="e.g. Accrued Penalty">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Start Date:</label>
                                        <div class="input-group date" id="date_subscribed_activator"
                                            data-target-input="nearest">
                                            <input type="text" name="date_subscribed"
                                                class="form-control datetimepicker-input"
                                                data-target="#date_subscribed_activator"
                                                value="{{ isset($project->start_date) ? $project->start_date : '' }}">
                                            <div class="input-group-append" data-target="#date_subscribed_activator"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="Open">Open</option>
                                            <option value="Defaulted">Defaulted</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Paused">Paused</option>
                                            <option value="Terminated">Terminated</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right" id="catbutton">
                                        {{ __('Subscribe') }}
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
