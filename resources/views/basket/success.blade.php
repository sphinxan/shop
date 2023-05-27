@extends('layout.site')

@section('content')
    <h1>The order has been placed</h1>

    <p>Your order has been successfully placed. Our manager will contact you soon to clarify the details.</p>

    <h2>Your order</h2>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>Name</th>
            <th>Price</th>
            <th>Count</th>
            <th>Cost</th>
        </tr>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ number_format($item->price, 2, '.', '') }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->cost, 2, '.', '') }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Total</th>
            <th>{{ number_format($order->amount, 2, '.', '') }}</th>
        </tr>
    </table>

    <h2>Your personal data</h2>
    <p>Full name: {{ $order->name }}</p>
    <p>Email address: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Phone number: {{ $order->phone }}</p>
    <p>Delivery address: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Comment: {{ $order->comment }}</p>
    @endisset
@endsection
