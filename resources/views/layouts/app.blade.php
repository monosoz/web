<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="NNe2MBgqK8T4UN2b1KA-Xc3UNnao_jp7W646odYM-vI" />

    <title>monosoz - Online Food Delivery</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="{{ url('st_m.css') }}" rel="stylesheet">
    <link href="{{ url('st01.css') }}" rel="stylesheet">
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
                    <img class="nav-logo" src="{{ url('/img/monolv002.png') }}" alt="mono" />
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

    @yield('content')

    <footer class="footer cs-footer">
        <div class="">
            <ul class="footer-list">
                <li class="footer-li">
                    <a href="">About Us</a>
                </li>
                <li class="footer-li">
                    <a href="">Contact Us</a>
                </li>
                <li class="footer-li">
                    <a href="{{ url('/policy') }}">Policies</a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- JavaScripts >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    @yield('scripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <noscript> &lt;div id="no-script"&gt; &lt;div class="no-script-message"&gt; &lt;div&gt; When you have eliminated the &lt;strong&gt;JavaScript&lt;/strong&gt;, whatever remains must be an empty page. &lt;/div&gt; &lt;a class="no-script-help-link" href="//support.google.com/maps/?hl=en&amp;amp;authuser=0&amp;amp;p=no_javascript" target="_blank"&gt; Enable JavaScript to see Google Maps. &lt;/a&gt; &lt;/div&gt; &lt;/div&gt; </noscript>
</body>
</html>
