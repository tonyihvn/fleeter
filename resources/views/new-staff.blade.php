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
            <form action="{{ route('saveStaff') }}" method="post">
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
                        <label for="staff_id">Staff ID Number</label>
                        <input type="text" class="form-control" name="staff_id" id="staff_id"
                            placeholder="Number on ID Card" value="{{ isset($staff->staff_id) ? $staff->staff_id : '' }}">
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
                        <label for="facility_id">Facility</label>
                        <select name="facility_id" id="facility_id" class="form-control">
                            <option value="{{ isset($staff->facility_id) ? $staff->facility_id : '' }}" selected>
                                {{ isset($staff->facility_id) ? $staff->facility_id : 'Select Facility' }}</option>
                            <option value="1">NA</option>
                            @foreach ($facilities as $fac)
                                <option value="{{ $fac->id }}">
                                    {{ $fac->facility_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="department_id">Department</label>
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="{{ isset($staff->supervisor) ? $staff->department_id : '' }}" selected>
                                {{ isset($staff->department_id) ? $staff->department_id : 'Select Department' }}</option>
                            <option value="1">NA</option>
                            @foreach ($departments as $dep)
                                <option value="{{ $dep->id }}">
                                    {{ $dep->department_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="unit_id">Unit</label>
                        <select name="unit_id" id="unit_id" class="form-control">
                            <option value="{{ isset($staff->unit_id) ? $staff->unit_id : '' }}" selected>
                                {{ isset($staff->unit_id) ? $staff->unit_id : 'Select Unit' }}</option>

                            <option value="1">NA</option>
                            @foreach ($units as $sups)
                                <option value="{{ $sups->id }}">
                                    {{ $sups->unit_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="supervisor">Supervisor</label>
                        <select name="supervisor" id="supervisor" class="form-control">
                            <option value="{{ isset($staff->supervisor) ? $staff->supervisor : '' }}" selected>
                                {{ isset($staff->supervisor) ? $staff->Supervisor->name : 'Select Category' }}</option>

                            @foreach ($users->where('role', 'Supervisor') as $sups)
                                <option value="{{ $sups->id }}">
                                    {{ $sups->name }}
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
                                <option value="Driver">Driver</option>
                                <option value="Staff">Staff User</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Admin">Admin</option>
                            @endif

                            @if (auth()->user()->role == 'Super')
                                <option value="Super">Super</option>
                            @endif


                        </select>
                    </div>
                </div>


                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary  float-right">{{ $button }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
