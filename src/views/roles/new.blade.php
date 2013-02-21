@extends('slender-cms::layouts.default')

{{-- Content --}}
@section('content')
<h2>New {{ ucfirst(str_singular($package)) }}</h2>
<form method="{{ $method }}" action="/{{ $package }}" class="form-horizontal">
    @foreach ($options->fields as $field => $option)
        {{-- var_dump($option) --}}
        @if(is_array($option))
        <div class="control-group {{ $errors->has($field) ? 'error' : '' }}">
            <label class="control-label" for="{{ $field }}">{{ $field }}</label>
            <div class="controls">
                <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ Input::old($field) }}" />
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
                                <input type="checkbox" value="1" name="permissions[global][sites][read]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][sites][write]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][sites][delete]" />
                            </label>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>Roles</td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][read]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][write]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][roles][delete]" />
                            </label>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>Users</td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][read]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][write]" />
                            </label>
                        </td>
                        <td>
                            <label class="checkbox inline">
                                <input type="checkbox" value="1" name="permissions[global][users][delete]"  />
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
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][read]" />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][write]" />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][sites][delete]" />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][read]" />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][write]"  />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][roles][delete]" />
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][read]" />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][write]" />
                                </label>
                            </td>
                            <td>
                                <label class="checkbox inline">
                                    <input type="checkbox" value="1" name="permissions[{{ $site->slug }}][users][delete]" />
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
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" onclick="document.location='/{{ Config::get('slender-cms::cms.admin-url') }}/{{ $package }}'" class="btn">Cancel</button>
        </div>
    </div>
    <!-- ./ Create button -->
</form>
@stop
