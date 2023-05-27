@extends('layout.admin')

@section('content')
    <h1>Edit a role</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.role.update', ['role' => $role->id]) }}">
        @method('PUT')
        @include('admin.role.part.form')
    </form>
@endsection
