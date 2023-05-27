@extends('layout.admin')

@section('content')
    <h1>All users roles</h1>
    <table class="table table-bordered">
        <tr>
            <th width="30%">User</th>
            <th width="30%">Roles</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href="{{ route('admin.user.show', ['user' => $user->id]) }}"
                   style="font-weight: normal">
                    {{ $user->name }}
                </a>
            </td>
            <td>
                @if(count($user->getRoleNames()))
                    {{ implode(",", $user->getRoleNames()->toArray()) }}
                @else
                    {{ __('The user has no roles')}}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endsection
