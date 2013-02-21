@extends('slender-cms::layouts.default')

{{-- Content --}}
@section('content')
<h2>Edit {{ ucfirst(str_singular($package)) }}</h2>
<form method="{{ $method }}" action="" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">

    @foreach ($options->fields as $field => $option)
        {{-- var_dump($option) --}}
        @if(is_array($option))
        <div class="control-group {{ $errors->has($field) ? 'error' : '' }}">
            <label class="control-label" for="{{ $field }}">{{ $field }}</label>
            <div class="controls">
                <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ Input::old($field, $data->$field) }}" />
                {{{ $errors->first($field) }}}
            </div>
        </div>
        @else
            <!-- Missing nested fields display -->
        @endif

    @endforeach

        <div class="control-group">
            <label class="control-label">Permissions</label>

            <div class="controls span5">
                <table class="table table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th>Global</th>
                      <th>Read</th>
                      <th>Write</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="info">
                        <td>Sites</td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][sites][read]" {{ (isset($data->permissions->global->sites->read) && $data->permissions->global->sites->read) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][sites][write]" {{ (isset($data->permissions->global->sites->write) && $data->permissions->global->sites->write) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][sites][delete]" {{ (isset($data->permissions->global->sites->delete) && $data->permissions->global->sites->delete) ? 'checked' : '' }} />
                            </label>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>Roles</td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][read]" {{ (isset($data->permissions->global->roles->read) && $data->permissions->global->roles->read) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][write]" {{ (isset($data->permissions->global->roles->write) && $data->permissions->global->roles->write) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][delete]" {{ (isset($data->permissions->global->roles->delete) && $data->permissions->global->roles->delete) ? 'checked' : '' }} />
                            </label>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>Users</td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][read]" {{ (isset($data->permissions->global->users->read) && $data->permissions->global->users->read) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][write]" {{ (isset($data->permissions->global->users->write) && $data->permissions->global->users->write) ? 'checked' : '' }} />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][delete]" {{ (isset($data->permissions->global->users->delete) && $data->permissions->global->users->delete) ? 'checked' : '' }} />
                            </label>
                        </td>
                    </tr>
                    </tbody>

                @foreach ($sites as $site)
                    <thead>
                        <tr>
                          <th>{{ $site->title }}</th>
                          <th>Read</th>
                          <th>Write</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>Sites</td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][read]" {{ (isset($data->permissions->{$site->slug}->sites->read) && $data->permissions->{$site->slug}->sites->read) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][write]" {{ (isset($data->permissions->{$site->slug}->sites->write) && $data->permissions->{$site->slug}->sites->write) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][delete]" {{ (isset($data->permissions->{$site->slug}->sites->delete) && $data->permissions->{$site->slug}->sites->delete) ? 'checked' : '' }} />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][read]" {{ (isset($data->permissions->{$site->slug}->roles->read) && $data->permissions->{$site->slug}->roles->read) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][write]" {{ (isset($data->permissions->{$site->slug}->roles->write) && $data->permissions->{$site->slug}->roles->write) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][delete]" {{ (isset($data->permissions->{$site->slug}->roles->delete) && $data->permissions->{$site->slug}->roles->delete) ? 'checked' : '' }} />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][read]" {{ (isset($data->permissions->{$site->slug}->users->read) && $data->permissions->{$site->slug}->users->read) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][write]" {{ (isset($data->permissions->{$site->slug}->users->write) && $data->permissions->{$site->slug}->users->write) ? 'checked' : '' }} />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][delete]" {{ (isset($data->permissions->{$site->slug}->users->delete) && $data->permissions->{$site->slug}->users->delete) ? 'checked' : '' }} />
                                </label>
                            </td>
                        </tr>
                    </tbody>
                    
                @endforeach  
                                   
                </table>
            </div>
        </div>   
        
    <!-- Create button -->
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" onclick="document.location='/{{ Config::get('slender-cms::cms.admin-url') }}/{{ $package }}'" class="btn">Cancel</button>
        </div>
    </div>
    <!-- ./ Create button -->
</form>
@stop
