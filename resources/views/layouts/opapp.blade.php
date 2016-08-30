<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="NNe2MBgqK8T4UN2b1KA-Xc3UNnao_jp7W646odYM-vI" />
    @yield('meta')

    <title>@yield('title')monosoz - Online Food Delivery</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="{{ url('st_m.css') }}" rel="stylesheet">
    <link href="{{ url('st01.css') }}" rel="stylesheet">
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script type="text/javascript">
    //Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('85af98d3bd88e572165f', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('test_channel');
    channel.bind('new_order', function(data) {
      alert(data.message);
      window.location.reload(true);
    });
</script>
    @yield('stylesheet')
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="home-logo" href="{{ url('/') }}">
                    <img class="nav-logo" src="{{ url('/img/monolv002.png') }}" alt="monosoz" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar>
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fanav fa fa-btn fa-sign-in" aria-hidden="true"></i>Login</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fanav fa fa-btn fa-pencil-square-o" aria-hidden="true"></i>Register</a></li>
                    @else
                        <li><a href="{{ url('/account') }}"><i class="fanav fa fa-btn fa-user" aria-hidden="true"></i>{{ Auth::user()->name }}</i></a></li>
                        <!--li class="dropdown">
                            <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fanav fa fa-btn fa-user" aria-hidden="true"></i>Account <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                
                            </ul>
                        </li-->
                        <li><a href="{{ url('/orders') }}"><i class="fanav fa fa-btn fa-list-ul" aria-hidden="true"></i>Orders</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fanav fa fa-btn fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

<nav class="top-bar" id="top">
<div class="input-group">
    <span class="input-group-btn">
        <a href="?" class="btn btn-default tag-link"><strong style="color:#000;">all</strong></a>
        <a href="?os=in_process" class="btn btn-default tag-link"><strong style="color:#08b;">in_process</strong></a>
        <a href="?os=complete" class="btn btn-default tag-link"><strong style="color:#1c8;">complete</strong></a>
        <a href="?os=cancelled" class="btn btn-default tag-link"><strong style="color:#b11;">cancelled</strong></a>
    </span>
    <span class="form-control"></span>
    <span class="input-group-btn">
        <a href="?fb=1" class="btn btn-primary"><strong style="color:#fff;">Feedback</strong></a>
    </span>
    <!--a href="#top" class="input-group-btn">
      <span class="btn btn-primary"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
    </a-->
</div>
</nav>
<br>
    @yield('content')

    <footer class="footer cs-footer">
        <div class="">
            <ul class="footer-list">
                <li class="footer-li">
                    <a href="{{ url('/about') }}">About Us</a>
                </li>
                <li class="footer-li">
                    <a href="{{ url('/policy') }}">Privacy Policy</a>
                    </li>
                <li class="footer-li">
                    <a href="{{ url('/terms') }}">Terms and Conditions</a>
                </li>
                <li class="footer-li">
                    <a href="{{ url('/contact') }}">Contact Us</a>
                </li>
            </ul>

            <a href="https://www.facebook.com/monosoz" class="pull-right" style="padding: 4px;"><img src="{{ url('/img/fbs.png') }}">&nbsp</a>
        </div>
    </footer>

    <!-- JavaScripts >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    @yield('scripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
