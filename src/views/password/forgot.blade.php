@extends('slender-cms::layouts.single')

@section('content')

<form method="post" action="{{URL::route('sendpassword')}}" class="form-horizontal form-signin">
  <h2 class="form-signin-heading">Please enter email address</h2>
  <!-- CSRF Token -->
  <input type="hidden" name="csrf_token" id="csrf_token" value="{{ Session::getToken() }}" />

  <!-- Email -->
  <div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
      {{{ $errors->first('email') }}}
    </div>
  </div>
  <!-- ./ email -->

  <!-- Login button -->
  <div class="control-group">
    <div class="controls">
        <button class="btn btn-large btn-primary" type="submit">Recover</button>
    </div>
  </div>
  <!-- ./ login button -->

</form>
@stop

@section('styles')
body {
  background-color: #f5f5f5;
}
@stop