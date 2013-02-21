@extends('slender-cms::layouts.default')

@section('content')
<div class="page-header">
<h2>{{ ucfirst($package) }}</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                @foreach($displayFields as $field => $title)
                    <th>{{ $title }}</th>
                @endforeach
                <th><a href='/{{ Config::get('slender-cms::cms.admin-url') }}   /{{ $package }}/create' class="btn btn-mini btn-success">Create New</a></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $id => $datum)
            <tr>
                @foreach($displayFields as $field => $title)
                    <td>{{ $datum->$field }}</td>
                @endforeach
                <td style='width:100px'>
                    <div class="btn-group">
                      <a href='/{{ Config::get('slender-cms::cms.admin-url') }}/{{ $package }}/{{ $datum->_id }}/delete' class="btn btn-mini btn-danger">Delete</a>
                      <a href='/{{ Config::get('slender-cms::cms.admin-url') }}/{{ $package }}/{{ $datum->_id }}' class="btn btn-mini btn-primary">Edit</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
