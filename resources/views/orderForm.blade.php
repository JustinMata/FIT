@extends('layouts.default')

@section('content')
<h1 class='title'>Place an Order</h1>
<form>
    @csrf
    <div class='field'>
        <label class='label' for='delivery_name'>Delivery Name</label>

        <div class='control'>
            <input class='input' type='text' name='delivery_name' placeholder='Name for Delivery' value='{{ old('delivery_name') }}' required>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='address_id'>Address ID</label>

        <div class='control'>
            <input class='input' type='text' name='address_id' placeholder='Address ID' value='{{ old('address_id') }}' required>
        </div>
    </div>

    <div class='field'>
        <label class='label' for='delivery_comment'>Comment</label>

        <div class='control'>
            <textarea class='textarea' name='delivery_comment' placeholder='Comment for Delivery' required>{{ old('delivery_comment') }}</textarea>
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