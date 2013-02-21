@extends('slender-cms::layouts.default')

@section('content')
<div class="page-header">
    <h1>Users</h1>

    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $id => $user)
        <tr>
        <td><a href="users/{{ $user->_id }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
        <td>{{ $user->email }}</td>
        <td style="text-align: center;"><button class="btn btn-mini btn-primary" onclick="document.location='/{{ Config::get('slender-cms::cms.admin-url') }}/users/{{ $user->_id }}'" type="button">edit</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
