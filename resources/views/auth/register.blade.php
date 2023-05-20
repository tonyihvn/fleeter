@extends('layouts.guest_template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter a Full Name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="staff_id">Staff ID Number</label>
                            <input type="text" class="form-control" name="staff_id" id="staff_id"
                                placeholder="Number on ID CArd">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation"
                                placeholder="e.g Program Officer, etc">
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="phone_number">{{ __('Phone  Number') }}</label>


                            <input id="phone_number" type="text" class="form-control" name="phone_number"
                                value="{{ old('phone_number') }}" required>


                        </div>
                        <div class="form-group col-md-6">

                            <label for="email">{{ __('Email Address') }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>




                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="facility_id">Facility</label>
                            <select name="facility_id" id="facility_id" class="form-control">

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
                            <label for="password">{{ __('Password') }}</label>


                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group col-md-4">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">

                        </div>

                        <div class="form-group col-md-4">
                            <label for="supervisor">Supervisor</label>
                            <select name="supervisor" id="supervisor" class="form-control">
                                <option value="1">NA</option>

                                @foreach ($users->where('role', 'Supervisor') as $sups)
                                    <option value="{{ $sups->id }}">
                                        {{ $sups->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>



                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
