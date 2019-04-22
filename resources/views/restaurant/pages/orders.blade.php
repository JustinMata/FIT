@extends('restaurant.default') 
@section('header')
<div class="container text-muted">
    <div class="row">
        <h1>Restaurant Orders</h1>
    </div>
</div>
@endsection
 
@section('content')

<div class="container text-muted">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer First Name</th>
                    <th scope="col">Customer Last Name</th>
                    <th scope="col">Customer Comments</th>
                    <th scope="col">Delivery Price</th>
                    <th scope="col">Driver Name</th>
                </tr>
            </thead>
            <tbody>
                @php $row = 1; 
@endphp @foreach ($orders as $order)
                <tr>
                    <th scope="{{ $row }}">{{ $row }}</th>
                    <td>{{ explode(" ", $order->delivery_name)[0] }}</td>
                    <td>{{ explode(" ", $order->delivery_name)[1] }}</td>
                    <td>{{ $order->delivery_comments }}</td>
                    <td>${{ $order->delivery_price }}</td>
                    <td>{{ $users[$drivers[$order->driver_id - 1]->user_id - 1]->first_name }} {{ $users[$drivers[$order->driver_id
                        - 1]->user_id - 1]->last_name }}</td>
                </tr>

                @php $row++; 
@endphp @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
</P>
@endsection