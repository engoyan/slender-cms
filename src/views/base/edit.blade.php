@extends('slender-cms::layouts.default')


@section('content')
<h2>Edit {{ ucfirst(str_singular($package)) }}</h2>

<form method="{{ $method }}" action="" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    @foreach ($options->fields as $field => $option)
        @if(is_array($option))
            <div class="control-group {{ $errors->has($field) ? 'error' : '' }}">
                <label class="control-label" for="{{ $field }}">{{ $field }}</label>
                <div class="controls">
                    <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ Input::old($field, $data->$field) }}" />
                    {{{ $errors->first($field) }}}
                </div>
            </div>
        @else
            Missing nested fields display
        @endif
    @endforeach

    <!-- Create button -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" onclick="document.location='/{{ Config::get('slender-cms::cms.admin-url') }}/{{ $package }}'" class="btn">Cancel</button>
        </div>
    </div>
    <!-- ./ Create button -->
</form>
@stop
