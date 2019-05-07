@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Driver') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>

                                @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                                <div id="type" type="text" class="form-control" name="type" value="driver" required>Driver</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street1" class="col-md-4 col-form-label text-md-right">Street 1</label>
                            <div class="col-md-6">
                                <input id="street1" type="text" class="form-control{{ $errors->has('street1') ? ' is-invalid' : '' }}" name="street1" value="{{ old('street1') }}" required autofocus>
                            </div>

                            @if ($errors->has('street1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('street1') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="street2" class="col-md-4 col-form-label text-md-right">Street 2</label>
                            <div class="col-md-6">
                                <input id="street2" type="text" class="form-control" name="street2" value="{{ old('street2') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus>
                            </div>

                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <select id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" required>
                                    @include('layouts.partials.states')
                                </select>
                            </div>

                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-right">Zip Code</label>
                            <div class="col-md-6">
                                <input id="zip" type="number" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" required autofocus>
                            </div>

                            @if ($errors->has('zip'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('zip') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="number" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                @if ($errors->has('account_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('account_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account_routing" class="col-md-4 col-form-label text-md-right">{{ __('Account Routing') }}</label>

                            <div class="col-md-6">
                                <input id="account_routing" type="number" class="form-control{{ $errors->has('account_routing') ? ' is-invalid' : '' }}" name="account_routing" value="{{ old('account_routing') }}" required autofocus>

                                @if ($errors->has('account_routing'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('account_routing') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="car" class="col-md-4 col-form-label text-md-right">Car</label>
                            <div class="col-md-6">
                                <input id="car" type="text" class="form-control{{ $errors->has('car') ? ' is-invalid' : '' }}" name="car" value="{{ old('car') }}" required autofocus>

                                @if ($errors->has('car'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('car') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="license_plate" class="col-md-4 col-form-label text-md-right">License Plate</label>
                            <div class="col-md-6">
                                <input id="license_plate" type="text" class="form-control{{ $errors->has('license_plate') ? ' is-invalid' : '' }}" name="license_plate" value="{{ old('license_plate') }}" required autofocus>
                                
                                @if ($errors->has('license_plate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('license_plate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="license_number" class="col-md-4 col-form-label text-md-right">License Number</label>
                            <div class="col-md-6">
                                <input id="license_number" type="text" class="form-control{{ $errors->has('license_number') ? ' is-invalid' : '' }}" name="license_number" value="{{ old('license_number') }}" required autofocus>

                                @if ($errors->has('license_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('license_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="license_expiration" class="col-md-4 col-form-label text-md-right">License Expiration</label>
                            <div class="col-md-6">
                                <input id="license_expiration" type="date" class="form-control{{ $errors->has('license_expiration') ? ' is-invalid' : '' }}" name="license_expiration" value="{{ old('license_expiration') }}" required autofocus>

                                @if ($errors->has('license_expiration'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('license_expiration') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="insurance_number" class="col-md-4 col-form-label text-md-right">Insurance Number</label>
                            <div class="col-md-6">
                                <input id="insurance_number" type="text" class="form-control{{ $errors->has('insurance_number') ? ' is-invalid' : '' }}" name="insurance_number" value="{{ old('insurance_number') }}" required autofocus>

                                @if ($errors->has('insurance_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('insurance_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
    </div>
</div>
@endsection

