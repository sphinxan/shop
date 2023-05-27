@extends('layout.site')

@section('content')
    <h1>Personal account</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>This is the personal account of a regular customer of our SuperShop.</p>
    @if(count($orders))
        <table class="table table-bordered">
            <tr>
                <th width="18%">Date and time</th>
                <th width="5%">Status</th>
                <th width="18%">Buyer</th>
                <th width="18%">Email address</th>
                <th width="18%">Phone number</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    @if ($order->status == 0)
                        <span class="text-danger">{{ $statuses[$order->status] }}</span>
                    @elseif (in_array($order->status, [1,2,3]))
                        <span class="text-success">{{ $statuses[$order->status] }}</span>
                    @else
                        {{ $statuses[$order->status] }}
                    @endif
                </td>
                <td>{{ $order->name }}</td>
                <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                <td>{{ $order->phone }}</td>
            </tr>
            @endforeach
        </table>
    @else
            {{ __('You have no order' )}}
    @endif
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">LogOut</button>
    </form>
@endsection
