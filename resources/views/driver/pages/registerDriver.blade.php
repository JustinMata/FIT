@extends('driver.default')

@section('header')
<div class="container text-muted">
    <div class="row">
        <h1>Registered Driver</h1>
    </div>
</div>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registerDriver') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

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
                                <input id="account_routing" type="text" class="form-control{{ $errors->has('account_routing') ? ' is-invalid' : '' }}" name="account_routing" value="{{ old('account_routing') }}" required autofocus>

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

