@extends('driver.default') 
@section('header')
<section class="jumbotron">
    <div class="container text-center">
        <h1 class="jumbotron-heading">Driver Dashboard</h1>
    </div>

    <div class="container text-left">
        <h4 class="jumbotron-heading">Information</h4>
        <ul>
            <li>First Name: {{ $user->first_name }}</li>
            <li>Last Name: {{ $user->last_name }}</li>
            <li>Email: {{ $user->email }}</li>
            <li>Phone Number: {{ $user->phone_number }}</li>
            <li>Address: {{$address->street1}}, {{$address->city}}, {{$address->state}} {{$address->postal}}</li>
            @isset($driver['totalEarnings'])
            <li> {{ ' Total Earnings: $ ' . $driver->totalEarnings }} </li> @endisset
        </ul>
    </div>

    @isset($currentOrder['id'])
    <div class="container text-left">
        <h4 class="jumbotron-heading">Order in Progress</h4>
        <ul>
            <li>Customer Name: {{ $currentOrder->delivery_name }}</li>
            <li>Customer Address: {{ $customerAddress->street1 . ', ' . $customerAddress->city . ', ' . $customerAddress->state
                . ' ' . $customerAddress->postal }}</li>
            <li>Customer Comments: {{ $currentOrder->delivery_comments }}</li>
            <li>Mileage Trip: {{ $currentOrder->mileage_trip }}</li>
            <li>Earnings: {{ number_format((float)$currentOrder->delivery_price / 2, 2, '.', '') }}</li>
        </ul>
        <div class='btn-toolbar'>
            <form action="{{ route('driverOrderDeliver') }}" method="POST">
                @csrf
                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{ $currentOrder->id }}">
                <button type="submit" class="btn btn-success btn-sm mr-2">{{ __('Delivered') }}</button>
            </form>
            <form action="{{ route('driverOrderCancel') }}" method="POST">
                @csrf
                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{ $currentOrder->id }}">
                <button type="submit" class="btn btn-danger btn-sm">{{ __('Cancel') }}</button>
            </form>
        </div>
    </div>
    @endisset

</section>
@endsection
 
@section('content')
@endsection