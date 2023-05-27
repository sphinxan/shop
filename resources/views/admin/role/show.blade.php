@extends('layout.admin')

@section('content')
    <h1>View a role</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Title:</strong> {{ $role->name }}</p>
        </div>
    </div>
    <form method="post"
          action="{{ route('admin.role.destroy', ['role' => $role->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete role
        </button>
    </form>
@endsection
