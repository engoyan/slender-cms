@extends('slender-cms::layouts.default')

{{-- Content --}}
@section('content')
<h2>New {{ ucfirst(str_singular($package)) }}</h2>
<form method="{{ $method }}" action="/{{ $admin_url }}/{{ $package }}" class="form-horizontal">

    @foreach ($options->fields as $field => $option)

        <div class="control-group {{ $errors->has($field) ? 'error' : '' }}">
            <label class="control-label" for="{{ $field }}">{{ $field }}</label>
            <div class="controls">
                <input type="text" name="{{ $field }}" id="{{ $field }}" value="" />
                {{{ $errors->first($field) }}}
            </div>
        </div>

    @endforeach

    <!-- Create button -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" onclick="document.location='/{{ $admin_url }}/{{ $package }}'" class="btn">Cancel</button>
        </div>
    </div>
    <!-- ./ Create button -->
</form>
@stop
