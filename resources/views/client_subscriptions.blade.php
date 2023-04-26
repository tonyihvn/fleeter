@extends('layouts.member-template')
@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Subscriptions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Subscriptions</li>
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
                            <th>Date Subscribed</th>
                            <th>Subscription-Plan</th>
                            <th>Payments-Made</th>
                            <th>Penalty</th>
                            <th>My Payments</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $sub)
                            <tr @if ($sub->status == 'Completed') style="background-color: azure !important;" @endif>
                                <td>{{ $sub->client->name }}</td>
                                <td>{{ $sub->product->title }}</td>
                                <td>{{ $sub->date_subscribed }}</td>
                                <td>{{ $sub->subplan->title }}</td>
                                <td>{{ $sub->payments->count() }} times (Total: {{ $sub->payments->sum('amount_paid') }} )
                                    @if ($sub->subplan->duration <= $sub->payments->count())
                                        <div class="badge badge-success">Completed</div>
                                    @else
                                        <div class="badge badge-warning">Not Completed</div>
                                    @endif
                                </td>
                                <td>{{ $sub->penalties }}</td>
                                <td><a href="{{ url('/item-payments/' . $sub->product->id) }}"
                                        class="btn btn-info btn-xs">My-Payments</a></td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
