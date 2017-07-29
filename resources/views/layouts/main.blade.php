<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>



        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/default.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/default.date.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/multiselect.min.css') }}">
        <!--link href="/css/app.css" rel="stylesheet">
        <!-- Scripts -->
        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
    </head>
    <body>
        <div class="header">
            <div class="container flex-box">
                <a href="{{ url('/') }}" class="header-logo"><img src="{{ URL::to('images/itweetup2.png') }}"/></a>
                @if (Auth::guest())
                <a href="{{ url('/login') }}">Login/Register</a>	
                @else
                <div class="user-thumbnail">

                    @if($data['user']['profileimage'])
                    <img src="../users/{{$data['user']['id']}}/profile.jpg" class="menu-icon">

                    @else
                    <img src="../images/blank-profile.png" class="menu-icon">
                    @endif	

                    <div class="box pad menu hide">
                        <a href="home.html">Home</a>
                        <a href="{{ url('/profile/edit') }}">Edit Profile</a>
                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>	
                @endif
            </div>
        </div>
        <div class="main-section">
            <div class="container flex-box fd-col fd-lg-row equisized-lg-items">
                @yield('content')
            </div>
        </div>

        <!-- Scripts -->

        <script type="text/javascript" src="{{ URL::to('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('js/picker.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('js/picker.date.js') }}"></script>

        <script type="text/javascript" src="{{ URL::to('js/script.js') }}"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
