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
        </ul>
    </div>
                
</section>
@endsection


@section('content')

@endsection
