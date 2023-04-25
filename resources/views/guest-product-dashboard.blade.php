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
                                    Available Period:
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    {{ $product->start_date }} To: {{ $product->end_date }}
                                </li>

                            </ul>

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
                                    <div class="form-group col-md-6">
                                        <label>Client Name</label>
                                        <select name="client_id" class="form-control select2" id="client_id" readonly>

                                            <option value="{{ $login_user->id }}" data-name="{{ $login_user->name }}">

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Choose Subscription Plan</label>
                                        <select name="subscription_plan" class="form-control" id="subscription_plan"
                                            readonly>
                                            @foreach ($business->subplans->where('product_id', $product->id) as $psp)
                                                <option value="{{ $psp->id }}" data-price="{{ $psp->amount_per }}">
                                                    {{ $psp->title }} ({{ $psp->amount_per }} per
                                                    {{ $psp->frequency }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>



                                <input type="hidden" name="penalties" class="form-control">
                                <input type="hidden" name="date_subscribed" value="{{ date('Y-m-d') }}">
                                <input type="hidden" name="status" value="Subscribed">





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
