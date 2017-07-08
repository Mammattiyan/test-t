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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/default.date.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/multiselect.min.css') }}">
        <!-- Scripts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
        </script>
    </head>
    <body>
            <div class="header">
            <div class="container flex-box">
                <a href="{{ url('/') }}" class="header-logo"><img src="{{ URL::to('images/itweetup2.png') }}"/></a>
                <div class="user-thumbnail">
                    <img src="{{ asset('assets/user1.jpg')}}" class="menu-icon">
                    <div class="box pad menu hide">
                        <a href="{{ url('/activity') }}">Home</a>
                        <a href="{{ url('/edit-profile') }}">Edit Profile</a>
                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>     
       @yield('content')

        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/picker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/picker.date.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
