@extends('layout.site')

@section('content')
    <h1>Personal account</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>This is the personal account of a regular customer of our SuperShop.</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">LogOut</button>
    </form>
@endsection
