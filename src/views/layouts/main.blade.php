<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8" />
        <title>
            @section('title')
            Slender CMS
            @show
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">



        <!-- Le styles -->
        <link href="/packages/dws/slender-cms/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
          body {
            padding-top: 60px;
            padding-bottom: 40px;
          }
          .sidebar-nav {
            padding: 9px 0;
          }

          @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
              float: none;
              padding-left: 5px;
              padding-right: 5px;
            }
          }
        </style>
        <link href="/packages/dws/slender-cms/assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="/packages/dws/slender-cms/assets/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="/packages/dws/slender-cms/assets/css/style.css" rel="stylesheet">

        @section('css')
        @show
        <style>
            @section('styles')
            @show
        </style>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="/packages/dws/slender-cms/assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/packages/dws/slender-cms/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/packages/dws/slender-cms/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/packages/dws/slender-cms/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/packages/dws/slender-cms/assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="/packages/dws/slender-cms/assets/ico/favicon.png">
    </head>

    <body>

        <!-- Navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="brand" href="/">Slender</a>
              <div class="nav-collapse collapse">
                @if (Auth::check())
                <p class="navbar-text pull-right">
                  Logged in as <a href="#" class="navbar-link">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>

                  <a href="/{{ Config::get('slender-cms::cms.admin-url').'/login/logout' }}">Logout</a>
                </p>
                @endif
                <ul class="nav">
                  <li class="active"><a href="/">Home</a></li>
                  <li><a href="/{{ Config::get('slender-cms::cms.admin-url') }}/sites">Sites</a></li>
                  <li><a href="/{{ Config::get('slender-cms::cms.admin-url') }}/roles">Roles</a></li>
                  <li><a href="/{{ Config::get('slender-cms::cms.admin-url') }}/users">Users</a></li>
                  <li><a href="#about">About</a></li>
                  <li><a href="#contact">Contact</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <!-- ./ navbar -->

 

        <!-- container -->
        @yield('container')
        <!-- ./ container -->



      <hr>

      <footer>
        <p>&copy; Slender {{ date('Y') }}</p>
      </footer>

    </div><!--/.fluid-container-->


        <!-- Javascripts
        ================================================== -->
        <script src="/packages/dws/slender-cms/assets/js/jquery.v1.8.3.min.js"></script>
        <script src="/packages/dws/slender-cms/assets/js/bootstrap.min.js"></script>
        <script src="/packages/dws/slender-cms/assets/js/bootstrap-select.min.js"></script>
        @section('js')
        @show
    </body>
</html>
