<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
</head>
<body>
    <div id="app" class="container-fluid">

      <nav class="navbar navbar-toggleable-md  navbar-inverse bg-inverse bg-faded container-fluid">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>




            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                <!-- Authentication Links -->
                @if (Auth::guest())
                  <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                  <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                @else

                  <a  class="dropdown-item" href="{{ route('recommendations.recommendation.mine') }}" >My Recommendations</a>

                  <a  class="dropdown-item" href="{{ route('catalogs.catalog.mine') }}" >My Catalogs</a>

                  <a  class="dropdown-item" href="{{ route('logout') }}" >My Teams</a>

                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                @endif










              </div>
            </li>




          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>


        @yield('content')


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
