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

    <div class="container text-left">
        <h4 class="jumbotron-heading">Availability</h4>
        @if($driver->is_available)
        @if(count($orders) == 0)
        <p>Currently Available</p>
        <form action="{{ route('driverAvailability') }}" method="POST">
            @csrf
            <input type="hidden" name="driver-id" class="form-control" id="driver-id" value="{{ $driver->id }}">
            <button type="submit" class="btn btn-danger btn-sm">{{ __('Not Available') }}</button>
        </form>
        @else
        <p>Must complete order(s) before toggling availability</p>
        @endif
        @else
        <p>Currently Unavailable</p>
        <form action="{{ route('driverAvailability') }}" method="POST">
            @csrf
            <input type="hidden" name="driver-id" class="form-control" id="driver-id" value="{{ $driver->id }}">
            <button type="submit" class="btn btn-success btn-sm">{{ __('Available') }}</button>
        </form>
        @endif
    </div>

    @if(count($orders) > 0)
    <div class="container text-left">
        <h4 class="jumbotron-heading">Order(s) in Progress</h4>
    </div>
    @foreach($orders as $order)
    <div class="container text-left">
        <ul>
            <h5 class="jumbotron-heading">Order for {{ $order->delivery_name }}</h5>
            @if($loop->first)
            <li>Customer Address: {{ $firstCustomerAddress->street1 . ', ' . $firstCustomerAddress->city . ', ' . $firstCustomerAddress->state
                    . ' ' . $firstCustomerAddress->postal }}</li>
            @else
            <li>Customer Address: {{ $secondCustomerAddress->street1 . ', ' . $secondCustomerAddress->city . ', ' . $secondCustomerAddress->state
                . ' ' . $secondCustomerAddress->postal }}</li>
            @endif
            <li>Customer Comments: {{ $order->delivery_comments }}</li>
            <li>Mileage Trip: {{ $order->mileage_trip }}</li>
            <li>Earnings: {{ number_format((float)$order->delivery_price / 2, 2, '.', '') }}</li>
        </ul>
        <div class='btn-toolbar'>
            <form action="{{ route('driverOrderDeliver') }}" method="POST">
                @csrf
                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-success btn-sm mr-2">{{ __('Delivered') }}</button>
            </form>
            <form action="{{ route('driverOrderCancel') }}" method="POST">
                @csrf
                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-danger btn-sm mb-3">{{ __('Cancel') }}</button>
            </form>
        </div>
    </div>
    @endforEach
    @endif

</section>
@endsection

@section('content')
@endsection