@extends('layout.admin')

@section('content')
    <h1>Add a role to a user {{$user->name}}</h1>
    <form method="post" action="{{ route('admin.role.store') }}" enctype="multipart/form-data">
        @csrf
        <option value="0">Choose</option>
        @foreach($roles as $role)
            <option value="{{ $role->name }}" @if ($role->id == $role_id) selected @endif>
                {{ $role->name }}
            </option>
        @endforeach
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
