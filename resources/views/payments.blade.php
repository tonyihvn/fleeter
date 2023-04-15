@extends('layouts.template')
@php
    $pagetype = 'Table';
    
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="card">

            <div class="card-body">
                <table class="table  responsive-table" id="products" style="font-size: 0.9em !important;">
                    <thead>
                        <tr style="color: ">
                            <th>Client</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Subscription-Plan</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $sub)
                            <tr>
                                <td>{{ $sub->client->name }}</td>
                                <td>{{ $sub->product->title }}</td>
                                <td>{{ $sub->payment_date }}</td>
                                <td>{{ $sub->subscription->subplan->title }}</td>
                                <td><a href="{{ url('/delete-payment/' . $sub->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this Payment?')">Delete</a>
                                </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
