<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Mindoro Bikers Community</title>
    <link rel="icon" href="images/bikers.jpg" type="image/jpg" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('dist/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">

</head>

<body>
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">

        <div class="responsive-header">
            <div class="mh-head first Sticky">

                <span class="mh-text">
                    <a href="{{ route('home') }}" title="" style="font-size: 1em">
                        Mindoro Bikers Community
                    </a>
                </span>

            </div>
            <div class="mh-head second">
                <form class="mh-form">
                    <input placeholder="search" />
                    <a href="#/" class="fa fa-search"></a>
                </form>
                
                 @guest
                    <div class="login-form mb-2">

                        <div class="btn-group" style="margin-top: 10px">
                            <a href="{{ route('login') }}" class="btn btn-success">Login</a> &nbsp
                            <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                        </div>

                    </div>
                @endguest

            </div>
            <nav id="menu" class="res-menu">

            </nav>

        </div><!-- responsive header -->

        <div class="topbar stick"
            style="background-image: linear-gradient(to right, rgb(75, 80, 78), white);border-bottom: 3px solid #28babf; border-color:#28babf; ">
            <div class="logo">

                <a title="" href="{{ route('home') }}"
                    style="font-size: 1.2em; font-family:Palatino Linotype; color: white; text-shadow: 2px 1px 1px lightseagreen;">

                    <b> Mindoro Bikers </b> Community
                </a>

            </div>

            <div class="top-area">
                <span style="color:red; font-weight:bold;">
<a href="https://mbcbikers.site">News Feed</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../profile">Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../tournaments">Bike Tournament</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../market">Marketplace</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../groups">Groups</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../messages">Message</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../map">Map</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../clients/logout">Logout</a></span>
                <div class="top-search">
               
                </div>
             
              
                 @guest
                    <div class="login-form mb-2">

                        <div class="btn-group" style="margin-top: 10px">
                            <a href="{{ route('login') }}" class="btn btn-success">Login</a> &nbsp
                            <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                        </div>

                    </div>
                @endguest
                
                @auth
                    <div class="user-img">
                        <img src="{{ asset(auth()->user()->avatar) }}" alt="" class="img-fluid" width="60">
                        <span class="f-online"></span>
                        {{ auth()->user()->fname }} {{ auth()->user()->lname }}

                        <!--
                                                <div class="user-setting">
                                                    <a href="{{ route('profile') }}" title="">
                                                        <i class="ti-pencil-alt"></i>edit profile
                                                    </a>
                                                    <a href="/logout" title="">
                                                        <i class="ti-power-off"></i>log out
                                                    </a>
                                                </div> -->
                    </div>
                @endauth


            </div>
            <img src="{{ asset('images/bikericon.png') }}"
                style="height:90px; margin-left:120px; position:relative; margin-top:-82px;" type="image/jpg"
                sizes="5x5">
        </div><!-- topbar -->



        <section>
            <div class="gap" style=" background-image: linear-gradient(to left, #99ffcc, white)" ;>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <div class="col-lg-3">
                                    <aside class="sidebar static">
                                        <div class="widget"
                                            style="border-right:7px outset; border-bottom:10px outset;  border-radius: 10px; border-color:#0af5dd">
                                            <img src="{{ asset('images/bikers.jpg') }}"
                                                style="height:200px; margin-left:20px; margin-top:20px;"
                                                type="image/jpg" sizes="5x5">
                                            <h4 class="widget-title">MBC Shortcut

                                            </h4>
                                            <ul class="naves">
                                                <li class="hovs">
                                                    <i class="fa fa-globe" style="color: #28babf;"></i>
                                                    <a href="{{ route('home') }}" title="">News feed</a>
                                                </li>
                                                <li class="hovs">
                                                    <i class="fa fa-address-book" style="color: #28babf;"></i>
                                                    <a href="{{ route('profile') }}" title="">Profile</a>
                                                </li>
                                                <li class="hovs">
                                                    <i class="fa fa-trophy" style="color: #28babf;"></i>
                                                    <a href="{{ route('tournaments') }}" title="">Bike Tournament</a>
                                                </li>

                                                <li class="hovs">
                                                    <i class="fa fa-shopping-basket" style="color: #28babf;"></i>
                                                    <a href="{{ route('market') }}" title="">marketplace</a>
                                                </li>
                                                <li class="hovs">
                                                    <i class="fa fa-users" style="color: #28babf;"></i>
                                                    <a href="{{ route('groups') }}" title="">Groups</a>
                                                </li>

                                                <li class="hovs">
                                                    <i class="fa fa-comment" style="color: #28babf;"></i>
                                                    <a href="{{ route('messages') }}" title="">Message</a>
                                                </li>

                                                <li class="hovs">
                                                    <i class="fa fa-map-marker" style="color: #28babf;"></i>
                                                    <a href="{{ route('map') }}" title="">Map</a>
                                                </li>

                                                <li class="hovs">
                                                    <i class="ti-power-off" style="color: #28babf;"></i>
                                                    <a href="{{ route('client.logout') }}" title="">Logout</a>
                                                </li>
                                            </ul>
                                        </div><!-- Shortcuts -->



                                    </aside>



                                </div>


                                @yield('body')


                                <div class="col-lg-3
      @if (Request::is('market/add-product')) d-block @endif
                                    @if (Request::is('market/*') || Request::is('market')) d-none @endif">
                                    <aside class="sidebar static">
                                        <div class="widget"
                                            style="border-right:7px outset; border-bottom:10px outset; width:320px; border-radius: 10px; border-color:#0af5dd">
                                            <h4 class="widget-title">Feature Photos</h4>

                                            <img src="{{ asset('images/biker1.jpg') }}"
                                                style="height:200px; margin-left:20px; margin-top:20px;"
                                                type="image/jpg" sizes="5x5">
                                            <h4 style="font-size:12px; color:gray; margin-top:10px; margin-left:20px;">
                                                <b>"All time favorite the Longest Bridge Abaton Located in Barangay
                                                    Parang
                                                    "
                                            </h4>

                                            <img src="{{ asset('images/biker2.jpg') }}"
                                                style="height:190px; width: 265px; margin-left:20px; margin-top:20px;"
                                                type="image/jpg" sizes="5x5">
                                            <h4 style="font-size:12px; color:gray; margin-top:10px; margin-left:20px;">
                                                <b>"Barangay Wawa Port, where you can enjoy the Sunset"

                                            </h4>

                                            <img src="{{ asset('images/biker3.jpg') }}"
                                                style="height:200px; margin-left:20px; margin-top:20px;"
                                                type="image/jpg" sizes="5x5">
                                            <h4 style="font-size:12px; color:gray; margin-top:10px; margin-left:20px;">
                                                <b>

                                                    "The all time favorite Cyclist Tambayan Place at night where you can
                                                    enjoy the wind breeze, sunset and milktea shop is all available,
                                                    located at Xevera Neo Front of Clubhouse"
                                            </h4>
                                            <img src="{{ asset('images/biker4.jpg') }}"
                                                style="height:200px; width:270px; margin-left:20px; margin-top:20px;"
                                                type="image/jpg" sizes="5x5">
                                            <h4 style="font-size:12px; color:gray; margin-top:10px; margin-left:20px;">
                                                <b>

                                                    "After long ahon enjoy the food and instagramable place in Camp Wagi
                                                    or Camp Jameaaf's alsi called Mt. Arayat, located at Barangay Bondo
                                                    Calapan City"
                                            </h4>

                                        </div><!-- Shortcuts -->




                                    </aside>



                                </div>



                            </div>
                        </div>
                    </div>
                </div>


            </div>

    </div>
    </div>
    </div>
    </div>
    </section>

    </div><!-- sidebar -->









    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                </div>

            </div>
        </div>
    </footer><!-- footer -->



    <script src="{{ asset('dist/js/main.min.js') }}"></script>
    <script src="{{ asset('dist/js/script.js') }}"></script>
    <script src="https://use.fontawesome.com/f95035c2cc.js"></script>
    @stack('custom-scripts')



    </div>

</body>

</html>
