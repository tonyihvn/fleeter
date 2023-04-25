@extends('layouts.guest_template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone_number"
                            class="col-md-4 col-form-label text-md-end">{{ __('Whatsapp  Number') }}</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="phone_number"
                                value="{{ old('phone_number') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Membership Category</label>
                        <div class="col-md-6">
                            <select name="role" id="memberrole" class="form-control" required>
                                <option value="Client"selected>Select Category</option>
                                <option value="Client">Hire Purchase/ Pay Later</option>
                                <option value="Contributor">Daily Contributions</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3" id="client">
                        <label for="category" class="col-md-4 col-form-label text-md-end">Category Type</label>
                        <div class="col-md-6">
                            <select name="category" id="category" class="form-control">
                                @foreach ($clientcategories as $cats)
                                    <option value="{{ $cats->title }}">
                                        {{ $cats->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3" id="contributor">
                        <label for="category" class="col-md-4 col-form-label text-md-end">Category Type</label>
                        <div class="col-md-6">
                            <select name="category" id="category" class="form-control">

                                @foreach ($contributorcat as $cats)
                                    <option value="{{ $cats->title }}">
                                        {{ $cats->title }}
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
