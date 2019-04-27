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
                    <th scope="col">{{ __('#') }}</th>
                    <th scope="col">{{ __('Customer Name') }}</th>
                    <th scope="col">{{ __('Customer Comments') }}</th>
                    <th scope="col">{{ __('Delivery Price') }}</th>
                    <th scope="col">{{ __('Driver Name') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $row = $orders->firstItem();
                @endphp @foreach ($orders as $order)
                <tr>
                    <th scope="{{ $row }}">{{ $row }}</th>
                    <td>{{ $order->delivery_name }}</td>
                    <td>{{ $order->delivery_comments }}</td>
                    <td>${{ $order->delivery_price }}</td>
                    <td>{{ $users[$drivers[$order->driver_id - 1]->user_id - 1]->first_name }} {{ $users[$drivers[$order->driver_id - 1]->user_id - 1]->last_name }}</td>
                    <td>{{ ucfirst(strtolower($order->status)) }}</td>
                    <td>
                        @if ($order->status == "cancelled")
                        <form action="{{route('orderArchive')}}" method="POST">
                            @csrf
                            <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{$order->id}}">
                            <button type="submit" class="btn btn-secondary btn-sm">{{ __('Archive') }}</button>
                        </form>
                        @elseif ($order->status == "archived")
                        <form action="{{route('orderDelete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{$order->id}}">
                            <button type="submit" class="btn btn-secondary btn-sm">{{ __('Delete') }}</button>
                        </form>
                        @else
                        <form action="{{route('orderCancel')}}" method="POST">
                                @csrf
                                <input type="hidden" name="order-id" class="form-control" id="order-id" value="{{$order->id}}">
                                <button type="submit" class="btn btn-secondary btn-sm">{{ __('Cancel') }}</button>
                            </form>
                        @endif

                    </td>

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
