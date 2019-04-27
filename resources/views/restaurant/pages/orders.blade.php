@extends('restaurant.default') 
@section('header')
<div class="container text-muted">
    <div class="d-flex justify-content-between my-4">
        <div>
            <h1>Restaurant Orders</h1>
        </div>
        <div>
            <h3>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{$orders->total()}} total orders</h3>
        </div>
    </div>
</div>
@endsection
 
@section('content')

<div class="container text-muted">
    <div class="row  my-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer First Name</th>
                    <th scope="col">Customer Last Name</th>
                    <th scope="col">Customer Comments</th>
                    <th scope="col">Delivery Price</th>
                    <th scope="col">Driver Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $row = $orders->firstItem(); 
@endphp @foreach ($orders as $order)
                <tr>
                    <th scope="{{ $row }}">{{ $row }}</th>
                    <td>{{ explode(" ", $order->delivery_name)[0] }}</td>
                    <td>{{ explode(" ", $order->delivery_name)[1] }}</td>
                    <td>{{ $order->delivery_comments }}</td>
                    <td>${{ $order->delivery_price }}</td>
                    <td>{{ $users[$drivers[$order->driver_id - 1]->user_id - 1]->first_name }} {{ $users[$drivers[$order->driver_id
                        - 1]->user_id - 1]->last_name }}</td>
                    <td>{{ $order->is_archived == '0'? 'In-Progress' : 'Delivered' }}</td>
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