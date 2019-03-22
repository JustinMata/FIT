@extends('layouts.default')

@section('content')
<h1 class='title'>Place an Order</h1>
<form method="POST" action="/cart">
    @csrf
    <div class='field'>
        <label class='label' for='delivery_name'>Delivery Name</label>

        <div class='control'>
            <input class='input' type='text' name='delivery_name' placeholder='Name for Delivery' value='{{ old('delivery_name') }}' required>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='street1'>Street 1</label>

        <div class='control'>
            <input class='input' type='text' name='street1' placeholder='Street 1' value='{{ old('street1') }}' required>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='street2'>Street 2</label>

        <div class='control'>
            <input class='input' type='text' name='street2' placeholder='Street 2' value='{{ old('street2') }}'>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='city'>City</label>

        <div class='control'>
            <input class='input' type='text' name='city' placeholder='City' value='{{ old('city') }}' required>
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

    <div class='field'>
        <label class='label' for='zip'>Zip Code</label>

        <div class='control'>
            <input class='input' type='text' name='zip' placeholder='Zip Code' value='{{ old('zip') }}' required>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='delivery_comments'>Comment</label>

        <div class='control'>
            <textarea class='textarea' name='delivery_comments' placeholder='Comment for Delivery'>{{ old('delivery_comments') }}</textarea>
        </div>
    </div>

    <div class='field'>
        <div class='control'>
            <button type='submit' class='button is-link'>Place Order</button>
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
@endsection