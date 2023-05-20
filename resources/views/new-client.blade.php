@if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
    @php $layout = 'layouts.template' @endphp
@else
    @php $layout = 'layouts.member-template' @endphp
@endif
@extends($layout)
@php
    
    if (isset($staff->id)) {
        $type = 'Edit';
        $password_action = 'Change';
        $button = 'Save Changes';
        $status = $staff->status;
    } else {
        $cid = 0;
        // $staff = (object) [];
    
        $type = 'New';
        $password_action = '';
        $button = 'Save New ' . $object;
        $status = '';
    }
@endphp
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $type }} {{ $object }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('clients') }}">{{ $object }}</a></li>
                        <li class="breadcrumb-item active">{{ $type }} {{ $object }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">{{ $type }} {{ $object }} Form</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('saveClient') }}" method="post">
                @csrf
                <input type="hidden" name="cid" value="{{ isset($staff->id) ? $staff->id : 0 }}">
                <input type="hidden" name="object" value="{{ $object }}">
                <input type="hidden" name="oldpassword" value="{{ isset($staff->password) ? $staff->password : '' }}">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter a Full Name" value="{{ isset($staff->name) ? $staff->name : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">Staff ID Number</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter a Full Name" value="{{ isset($staff->name) ? $staff->name : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" name="designation" id="designation"
                            placeholder="e.g Program Officer, etc"
                            value="{{ isset($staff->designation) ? $staff->designation : '' }}">
                    </div>


                </div>


                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number"
                            placeholder="Phone Number"
                            value="{{ isset($staff->phone_number) ? $staff->phone_number : '' }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address"
                            value="{{ isset($staff->email) ? $staff->email : '' }}"
                            {{ isset($staff->role) && $staff->role == 'Client' ? 'readonly' : '' }}>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password">{{ $password_action }} Password</label>
                        <input type="text" class="form-control" name="password" id="password"
                            placeholder="{{ $type }} Password for the  {{ $object }}">
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="{{ isset($staff->category) ? $staff->category : '' }}" selected>
                                {{ isset($staff->category) ? $staff->category : 'Select Category' }}</option>

                            @foreach ($categories as $cats)
                                <option value="{{ $cats->title }}">
                                    {{ $cats->title }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="{{ isset($staff->status) ? $staff->status : '' }}" selected>
                                {{ isset($staff->status) ? $staff->status : 'Select Status' }}</option>

                            @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                <option value="Active">Active</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Terminated">Terminated</option>
                                <option value="Awaiting Approval">Awaiting Approval</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="role">System Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="{{ isset($staff->role) ? $staff->role : '' }}" selected>
                                {{ isset($staff->role) ? $staff->role : 'Select Role' }}</option>

                            @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super')
                                <option value="Client">Client User</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                                <option value="Contributor">Contributor</option>
                            @endif

                            @if (auth()->user()->role == 'Super')
                                <option value="Super">Super</option>
                            @endif


                        </select>
                    </div>
                </div>
                @if ($object == 'Client')
                    <div style="font-size: 0.7em">

                        <b>Terms and Conditions:</b>
                        <hr>
                        <p><b>Terms and Conditions</b><br>
                            1. This document shall be interpreted as the governing document of the transaction where in all
                            the
                            fundamental terms binding both parties are contained and referenced to this form shall be
                            reference
                            to the contractual agreement upon which said transaction is formed. <br>
                            2. Items requested for, shall be picked up at designated places and date upon the commencement
                            of
                            deduction of the cost of the item requested. items delivered on the agreed time and not
                            collected by
                            the customer shall attract additional transport cos t of N5,000 only.<br>
                            3. Where the company fails to supply the requested item after the number of deduction agreed by
                            the
                            customer either by reason of availability of the product, delay in shipping, clearing or
                            otherwise;
                            the customer will be duly noticed on the state of the item.<br>
                            4. Where the circumstance in 3(above) occur, the customer is at liberty to enter fresh
                            negotiation
                            for a further extension of time.<br>
                            5. All item will supply upon completion at current market prevailing price (inflation)<br>
                            6. Item requested for when tested certified to be in good working condition shall no longer be
                            accepted once same is delivered to the customer, through the company may at its discretion
                            consider
                            genuine complaints from customers and proffer any remedy it might deem expedient<br>
                            7. No cancelation of transaction when deduction has commenced. The company may allow
                            cancellation in
                            some special circumstances provided that; the applicant will forfeit 30% of the total deduction
                            made.<br>
                            8. Cancellation of transaction by applicant after 5(five) working days of registration attracts
                            a
                            contingency/administrative fee of N7,000 only<br>

                            I hereby declare that I fully understand the legal consequences, economic and commercial
                            obligation
                            incurred by virtue of my subscription to the scheme as offered by Accessmade Limited and
                            therefore
                            authorize Accesmade Limited to effect a monthly deduction of the amount against my name from my
                            monthly salary for the purpose of defraying the cost of the asset I am obtaining through
                            Accessmade
                            Limited. I sincerely and expressly agree to be bound by the terms and condition herein contained
                            and
                            declared that I shall abide by said terms and agree to be held accountable wherever I am in
                            default.
                            The authority shall Subsist for the period as indicated and cannot be revoked, cancelled or set
                            aside until the entire sum is fully defrayed. Service Charges Applied. <br>
                        </p>
                        <input type="checkbox" name="Agree" id="Agree" required> I Agree
                    </div>
                @endif

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">{{ $button }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
