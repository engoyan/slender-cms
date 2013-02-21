@extends('slender-cms::layouts.main')

@section('container')
    <div class="container">

      <!-- Notifications -->
      @include('slender-cms::notifications')
      <!-- ./ notifications -->

      <!-- Content -->
      @yield('content')
      <!-- ./ content -->

    </div> <!-- /container -->
@stop
