@extends('layouts.template')
<style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }

    td {
        padding: 1px !important;
    }
</style>

@php
    
    if (isset($product->id)) {
        $type = 'Edit';
        $button = 'Save Changes to';
        $product_id = $product->id;
    } else {
        $cid = 0;
        // $client = (object) [];
        $type = 'New';
        $button = 'Save New ';
        $product_id = '';
    }
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $type }} Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ $type }} Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">{{ $type }} Product Form</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-product') }}" method="post">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product_id }}">




                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="title">Product Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="project_title" placeholder="Enter a Title"
                            value="{{ isset($product->title) ? $product->title : '' }}">
                        <small id="project_title" class="form-text text-muted">A descriptive name of the project</small>
                    </div>

                    <div class="form-group col-md-5">
                        <label>Select Supplier</label>
                        <select name="supplier_id" class="form-control select2">
                            <option value="{{ $product->supplier_id ?? '' }}" selected>
                                {{ $product->supplier_name ?? 'Select Supplier' }}</option>
                            @foreach ($suppliers as $cl)
                                <option data-select2-id="{{ $cl->id }}" value="{{ $cl->id }}">
                                    {{ $cl->supplier_name }} ({{ $cl->company_name }})</option>
                            @endforeach

                        </select>
                    </div>
                </div>




                <div class="form-group col-md-12">
                    <label for="detail">Details</label>
                    <textarea name="detail" id="detail" class="wyswygeditor">
              {{ isset($product->detail) ? $product->detail : 'Place <em>some</em> <u>text</u> <strong>here</strong>' }}
            </textarea>

                    <small id="task_details" class="form-text text-muted">A Detailed infomation about the product
                        entered</small>
                </div>

                <div class="form-group row">

                    <div class="form-group col-md-3">
                        <label>Product Category</label>
                        <select name="category" class="form-control select2">
                            <option value="{{ isset($product->category) ? $product->category : '' }}" selected>
                                {{ isset($product->category) ? $product->category : 'Select Category' }}</option>
                            @foreach ($pcategories as $pr)
                                <option value="{{ $pr->title }}">
                                    {{ $pr->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Available From:</label>
                        <div class="input-group date" id="start_date_activator" data-target-input="nearest">
                            <input type="text" name="start_date" class="form-control datetimepicker-input"
                                data-target="#start_date_activator"
                                value="{{ isset($product->start_date) ? $product->start_date : '' }}">
                            <div class="input-group-append" data-target="#start_date_activator"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>To:</label>
                        <div class="input-group date" id="end_date_activator" data-target-input="nearest">
                            <input type="text" name="end_date" class="form-control datetimepicker-input"
                                data-target="#end_date_activator"
                                value="{{ isset($product->end_date) ? $product->end_date : '' }}">
                            <div class="input-group-append" data-target="#end_date_activator" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <label>Status:</label>
                        <select name="status" class="form-control">
                            <option value="{{ isset($product->status) ? $product->status : '' }}" selected>
                                {{ isset($product->status) ? $product->status : 'Select Status' }}</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                            <option value="Paused">Paused</option>
                            <option value="Terminated">Terminated</option>
                        </select>
                    </div>


                </div>

                <div class="form-group col-md-12">
                    <label for="terms">Terms and Conditions</label>
                    <textarea name="terms" id="terms" class="wyswygeditor">
                        {{ isset($product->terms) ? $product->terms : 'Place <em>some</em> <u>text</u> <strong>here</strong>' }}
                    </textarea>

                    <small id="task_details" class="form-text text-muted">Explain the terms and conditions</small>
                </div>

                <div class="row">
                    <table class="table" id="productmodels" style="font-size: 0.8em;">
                        <thead>
                            <tr class="spechead">
                                <th class="form-group" style="width:15% !important">Model</th>
                                <th class="form-group" style="width:10% !important;">Price</th>
                                <th class="form-group">3 Mnths %</th>
                                <th class="form-group">6 Mnths %</th>
                                <th class="form-group">9 Mnths %</th>
                                <th class="form-group">12 Mnths %</th>
                                <th class="form-group">15 Mnths %</th>
                                <th class="form-group">18 Mnths %</th>
                                <th class="form-group">21 Mnths %</th>
                                <th class="form-group">24 Mnths %</th>
                                <th class="form-group">.</th>
                            </tr>
                        </thead>
                        <tbody id="item_list">

                            <tr id="1">
                                <td>
                                    <input type="text" name="model[]" class="form-control"
                                        value="{{ $product->model ?? '' }}" placeholder="model">
                                </td>
                                <td>
                                    <input type="number" name="price[]" class="form-control"
                                        value="{{ $product->price ?? '' }}" step="0.01">
                                </td>
                                <td>
                                    <input type="number" name="m3[]"
                                        value="{{ $product->subplans[0]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m6[]"
                                        value="{{ $product->subplans[1]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m9[]"
                                        value="{{ $product->subplans[2]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m12[]"
                                        value="{{ $product->subplans[3]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">percentage_increase
                                </td>
                                <td>
                                    <input type="number" name="m15[]"
                                        value="{{ $product->subplans[4]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m18[]"
                                        value="{{ $product->subplans[5]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m21[]"
                                        value="{{ $product->subplans[6]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>
                                <td>
                                    <input type="number" name="m24[]"
                                        value="{{ $product->subplans[7]->percentage_increase ?? '' }}"
                                        class="form-control" step="0.01" placeholder="%">
                                </td>

                                <td>
                                    <a href="#item_list" class="btn btn-sm btn-danger removeitem" id="re1">Remove<i
                                            class="lnr lnr-remove"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <a class="btn btn-sm btn-success add_item" href="#item_list" id="1">
                        Add New Model
                        <i class="lnr lnr-add"></i>
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12" style="text-align: right">
                        <button type="submit" class="btn btn-primary">{{ $button }} Product</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
