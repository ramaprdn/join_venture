<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Signika:400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <style>
        .buttonRounded {
            border-radius: 25px;
        }
    </style>
    @yield('css')
</head>
<body>

	<nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light" style=" box-shadow: 0 2px 2px -2px rgba(0,0,0,.2);">
        <a class="navbar-brand ml-3 mr-5 navFont" href="/"><b style="color: #5c8e2f">JOINVENTURE</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-5 mr-auto">
                <input class="form-control mr-sm-2 buttonRounded" type="search" placeholder="Search for adventure" aria-label="Search">
            </ul>

            <div class="navFont">
                <ul class="navbar-nav form-inline my-2 my-lg-0 mx-3">
                    <li class="nav-item active mx-2">
                        <a class="nav-link" href="#">Story</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Adventure Browser</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Create Adventure</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hai, {{ Auth::user()->first_name }}!</a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                          <a href="" class="dropdown-toggle" data-toggle="dropdown" style="color: #000;">
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('section')

	
    @yield('script')
</body>
</html>