@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
@php
    $pagetype = 'Table';
    
    if (stripos($_SERVER['REQUEST_URI'], 'client') !== false) {
        $cli = 'for ' . $subscriptions[0]->client->name;
    } else {
        $cli = '';
    }
    
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CONTRIBUTIONS {{ $cli ?? '' }}</h1>
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
                            <th>Saving Plan</th>
                            <th>Account Head</th>
                            <th>Amount</th>
                            <th>Credit Officer</th>
                            <th>Status</th>
                            <th>Date Paid</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributions as $sub)
                            <tr @if ($sub->status == 'Completed') style="background-color: azure !important;" @endif>
                                <td>{{ $sub->client->name }}</td>
                                <td>{{ $sub->saving_plan }}</td>
                                <td>{{ $sub->account_head }}</td>
                                <td>{{ $sub->amount }}</td>
                                <td>{{ $sub->credit_officer }}</td>

                                <td>{{ $sub->status }}</td>
                                <td>{{ $sub->payment_date }}</td>


                                <td style="width:20% !important">


                                    <a href="{{ url('/delete-csubs/' . $sub->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete Subscription Plan?')">Delete</a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
