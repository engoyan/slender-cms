@extends('slender-cms::layouts.default')


@section('content')
<h2>Edit {{ ucfirst(str_singular($package)) }}</h2>

<form method="{{ $method }}" action="" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    @foreach ($options->fields as $field => $option)
        @if(is_array($option) && is_string($field) && is_string($user->$field) &&  $field!='password' )
            <div class="control-group {{ $errors->has($field) ? 'error' : '' }}">
                <label class="control-label" for="{{ $field }}">{{ $field }}</label>
                <div class="controls">
                    <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ Input::old($field, $user->$field) }}" />
                    {{{ $errors->first($field) }}}
                </div>
            </div>
        @else

        @endif
    @endforeach
            <div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" name="password" id="password" value=""  />
                    {{{ $errors->first('password') }}}
                </div>
            </div>
            <div class="control-group {{ $errors->has('password_confirmation') ? 'error' : '' }}">
                <label class="control-label" for="password_confirmation">Re-enter Password</label>
                <div class="controls">
                    <input type="password" name="password_confirmation" id="password_confirmation" value=""  />
                    {{{ $errors->first('password_confirmation') }}}
                </div>
            </div>
            <div class="control-group {{ $errors->has('roles') ? 'error' : '' }}">
                <label class="control-label" for="roles">Roles</label>
                <div class="controls">
                    <select name='roles[]' multiple="multiple">
                        @foreach($roles as $role)
                            <option value="{{ $role->_id }}" {{ in_array($role->_id, $user->roles) ? 'selected' : '' }} >{{ $role->name }}</option>
                        @endforeach
                    </select>

                    {{{ $errors->first('roles') }}}
                </div>
            </div>
            

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
