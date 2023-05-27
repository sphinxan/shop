@extends('layout.site')

@section('content')
    <h1>Personal account</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>This is the personal account of a regular customer of our SuperShop.</p>
    <a href="{{ route('home.orders', ['user' => auth()->user()->id ]) }}" >View the list of orders</a>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">LogOut</button>
    </form>
@endsection
