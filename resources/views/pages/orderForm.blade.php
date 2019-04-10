@extends('layouts.default') 
@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Place an Order</div>

                <div class="card-body">
                    <form method="POST" action="/cart">
                        @csrf

                        <div class="form-group row">
                            <label for="delivery_name" class="col-md-4 col-form-label text-md-right">Delivery Name</label>
                            <div class="col-md-6">
                                <input id="delivery_name" type="text" class="form-control" name="delivery_name" value="{{ old('delivery_name') }}" required
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street1" class="col-md-4 col-form-label text-md-right">Street 1</label>
                            <div class="col-md-6">
                                <input id="street1" type="text" class="form-control" name="street1" value="{{ old('street1') }}" required autofocus>
                            </div>
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
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <select id="state" type="type" class="form-control" name="state" value="{{ old('state') }}" required>
    @include('layouts.partials.states')
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-right">Zip Code</label>
                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_comments" class="col-md-4 col-form-label text-md-right">Comment</label>
                            <div class="col-md-6">
                                <textarea id="delivery_comments" type="text" class="form-control" name="delivery_comments" rows="3" value="{{ old('delivery_comments') }}"
                                    autofocus></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </div>
                        </div>

                        @if($errors->any())
                        <div class='notification is-danger'>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection