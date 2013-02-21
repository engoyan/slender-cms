@extends('slender-cms::layouts.single')

@section('content')


<form method="post" action="" class="form-horizontal form-signin">
  <h2 class="form-signin-heading">Please sign in</h2>
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

  <!-- Password -->
  <div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input type="password" name="password" id="password" value="" />
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




