@extends('slender-cms::layouts.single')

@section('content')

<form method="post" action="" class="form-horizontal form-signin">
  <h2 class="form-signin-heading">Please enter new password</h2>
  <!-- CSRF Token -->
  <input type="hidden" name="csrf_token" id="csrf_token" value="{{ Session::getToken() }}" />

  <!-- Password -->
  <div class="control-group">
    <label class="control-label" for="password1">Password</label>
    <div class="controls">
      <input type="password" name="password1" id="password1" value="" />
    </div>
  </div>
  <!-- ./ password -->

  <!-- Password -->
  <div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
    <label class="control-label" for="password2">Confirm Password</label>
    <div class="controls">
      <input type="password" name="password2" id="password2" value="" />
      {{{ $errors->first('password') }}}
    </div>
  </div>
  <!-- ./ password -->

  <!-- Login button -->
  <div class="control-group">
    <div class="controls">
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
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




