@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)

@php
    $pagetype = 'Table';
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Items</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Items</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">
        <div class="card-body" style="overflow: auto;">
            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                <a href="/addproduct" class="btn btn-primary" style="float: right;">Add New</a>
            @endif

            <table class="table responsive-table" id="products">
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th>Item Name</th>
                        <th>Supplier</th>
                        <th>Availability</th>
                        <th>Subsription</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pr)
                        <tr @if ($pr->status == 'Open') style="background-color: azure !important;" @endif
                            @if ($pr->status == 'Closed') style="background-color: #FFF8B0 !important;" @endif>
                            <td>{{ $pr->id }}</td>
                            <td>{{ $pr->title }}</td>
                            <td>{{ $pr->supplier->company_name ?? '' }}</td>
                            <td>{{ $pr->start_date . ' - ' . $pr->end_date }}</td>
                            <td>{{ $pr->status }}</td>
                            <td width="90">



                                <div class="btn-group">
                                    @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                        <a href="{{ url('/edit-product/' . $pr->id) }}" class="btn btn-default btn-xs">Edit
                                        </a>
                                        <a href="{{ url('/product-dashboard/' . $pr->id) }}"
                                            class="btn btn-primary btn-sm">Dashboard</a>
                                        <a href="{{ url('/item-payments/' . $pr->id) }}"
                                            class="btn btn-info btn-sm">Payments</a>
                                    @else
                                        <a href="{{ url('/product-dashboard/' . $pr->id) }}"
                                            class="btn btn-primary btn-sm">More Info</a>
                                    @endif


                                </div>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
