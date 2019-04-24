@extends('restaurant.default')

@section('header')
<div class="container text-muted">
    <div class="row">
        <h1>Registered Restaurant</h1>
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
                    <form method="POST" action="{{ route('registerRestaurant') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="provider" class="col-md-4 col-form-label text-md-right">Provider</label>

                            <div class="col-md-6">
                                <select id="provider" type="type" class="form-control{{ $errors->has('provider') ? ' is-invalid' : '' }}" name="provider" value="{{ old('provider') }}" required>
                                    <option value="VISA">VISA</option>
                                    <option value="AMEX">AMEX</option>
                                    <option value="DISCOVERY">DISCOVERY</option>
                                </select>

                                @if ($errors->has('provider'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('provider') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CC_name" class="col-md-4 col-form-label text-md-right">{{ __('CC Name') }}</label>

                            <div class="col-md-6">
                                <input id="CC_name" type="text" class="form-control{{ $errors->has('CC_name') ? ' is-invalid' : '' }}" name="CC_name" value="{{ old('CC_name') }}" required autofocus>

                                @if ($errors->has('CC_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CC_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CC_number" class="col-md-4 col-form-label text-md-right">{{ __('CC Number') }}</label>

                            <div class="col-md-6">
                                <input id="CC_number" type="text" class="form-control{{ $errors->has('CC_number') ? ' is-invalid' : '' }}" name="CC_number" value="{{ old('CC_number') }}" required autofocus>

                                @if ($errors->has('CC_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CC_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CC_expiration" class="col-md-4 col-form-label text-md-right">CC Expiration</label>
                            <div class="col-md-6">
                                <input id="CC_expiration" type="date" class="form-control{{ $errors->has('CC_expiration') ? ' is-invalid' : '' }}" name="CC_expiration" value="{{ old('CC_expiration') }}" required autofocus>

                                @if ($errors->has('CC_expiration'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CC_expiration') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="CC_CVC" class="col-md-4 col-form-label text-md-right">CC CVC</label>
                            <div class="col-md-6">
                                <input id="CC_CVC" type="text" class="form-control{{ $errors->has('CC_CVC') ? ' is-invalid' : '' }}" name="CC_CVC" value="{{ old('CC_CVC') }}" required autofocus>

                                @if ($errors->has('CC_CVC'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CC_CVC') }}</strong>
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

