@extends('layout.admin')

@section('content')
    <h1>Control Panel</h1>
    <p>Welcome! {{ auth()->user()->name }}</p>
    <p>This is a control panel for the administrator of an SuperShop.</p>
    <form action="{{ route('admin.role.index') }}" class="text-left">
            <button class="btn btn-success mb-4 mt-0">
                    Roles
            </button>
    </form>
    <form action="{{ route('admin.user.index') }}" class="text-left">
            <button class="btn btn-success mb-4 mt-0">
                    Users roles
            </button>
    </form>
    <form action="{{ route('admin.order.index') }}" class="text-left">
            <button class="btn btn-success mb-4 mt-0">
                    Orders
            </button>
    </form>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">LogOut</button>
    </form>
@endsection
