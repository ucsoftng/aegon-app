<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/fonts/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="{{asset('mobile/_manifest.json')}}">
    <meta id="theme-check" name="theme-color" content="#FFFFFF">
    <link rel="icon" href="{{asset('dash/assets/images/apg.png')}}">
    <link rel="apple-touch-icon" href="{{asset('dash/assets/images/apg.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('dash/assets/images/apg.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('dash/assets/images/apg.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('dash/assets/images/apg.png')}}">
    <style>
        .tns-ovh{
            border-radius: 10px !important;
        }
        .coinPriceBlock-signature{
            display: none !important;
        }
        .ss{
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>
</head>

<body class="theme-light" id="ss">

{{--<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>--}}

<div id="page">
@if(request()->is('home','user/dashboard','user/settings','user/trade','user/wallets','user/markets','user/deposit-history'))
    <!-- Header -->
    <div class="header-bar header-fixed header-app header-bar-detached">
        <a data-bs-toggle="offcanvas" data-bs-target="#menu-main" href="#"><i class="bi bi-list color-theme"></i></a>
        <a href="#" class="header-title color-theme">{{$page_title}}</a>
{{--        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-bell"><em class="badge bg-highlight ms-1">3</em><i class="font-14 bi bi-bell-fill"></i></a>--}}
{{--        <a href="#" class="show-on-theme-light" data-toggle-theme><i class="bi bi-moon-fill font-13"></i></a>--}}
{{--        <a href="#" class="show-on-theme-dark" data-toggle-theme ><i class="bi bi-lightbulb-fill color-yellow-dark font-13"></i></a>--}}
    </div>
    @else
        <div class="header-bar header-fixed header-app header-bar-detached">
            <a data-back-button href="#"><i class="bi bi-caret-left-fill font-11 color-theme ps-2"></i></a>
            <a href="#" class="header-title color-theme font-13">Back</a>
            {{--            <a href="#" class="header-title color-theme font-15">{{$page_title}}</a>--}}
            {{--            <a href="#" class="show-on-theme-light" data-toggle-theme><i class="bi bi-moon-fill font-13"></i></a>--}}
            {{--            <a href="#" class="show-on-theme-dark" data-toggle-theme ><i class="bi bi-lightbulb-fill color-yellow-dark font-13"></i></a>--}}
        </div>
    @endif

    <!-- Footer Bar-->
    <div id="footer-bar" class="footer-bar footer-bar-detached">
        <a href="{{route('user-dashboard')}}" class="{{ Request::is('user/dashboard') || Request::is('home')? "active-nav" : "" }}"><i class="bi bi-house-fill font-16"></i><span>Home</span></a>
        <a href="{{ route('markets') }}" class="{{ Request::is('user/markets') ? "active-nav" : "" }}"><i class="bi bi-bar-chart-fill font-17"></i><span>Markets</span></a>
        <a href="{{ route('wallets') }}" class="{{ Request::is('user/wallets') ? "active-nav" : "" }}"><i class="bi bi-wallet-fill font-15"></i><span>Wallets</span></a>
        <a href="{{ route('trade') }}" class="{{ Request::is('user/trade') ? "active-nav" : "" }}"><i class="bi bi-folder-fill font-16"></i><span>Trade</span></a>
        <a href="{{ route('settings') }}" class="{{ Request::is('user/settings') ? "active-nav" : "" }}"><i class="bi bi-gear-fill"></i><span>Setting</span></a>
    </div>


    <!-- Menu Highlights-->
    <div id="menu-color" style="height:340px" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
{{--        @include('layouts.partials.menu-high')--}}
    </div>

    <!-- Main Bell-->
    <div id="menu-bell" style="height:400px;" class="offcanvas offcanvas-top offcanvas-detached rounded-m">
{{--        @include('layouts.partials.menu-bell')--}}
    </div>

    <!-- Your Page Content Goes Here-->
    <div class="page-content header-clear-medium">

        @yield('content')

    </div>
    <!-- Main Sidebar-->
    <div id="menu-main" data-menu-active="nav-homes" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m">
        @include('layouts.partials.user-menu')
    </div>

    <!-- End of Page Content-->
    @yield('sheets')

    @if (session()->has('message'))
    <div id="notification-bar-1" class="notification-bar detached @if(session()->get('type') == 'success') gradient-green @elseif(session()->get('type') == 'danger') gradient-red @endif rounded-s shadow-l" data-bs-delay="10000">
        <div class="toast-header px-3 py-3">
            @if(session()->get('title') == 'success')
            <i class="bi bi-check-circle-fill pe-2 color-white"></i>
            @elseif(session()->get('type') == 'danger')
                <i class="bi bi-exclamation-triangle color-white font-16"></i>
            @endif
            <strong class="me-auto color-white">{!! session()->get('title')  !!}</strong>
            <small>a second ago</small>
            <button type="button" class="btn-close font-10 pe-2" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body px-3 py-3">
            <p class="mb-0 font-13 color-white">
                {!! session()->get('message')  !!}
            </p>
        </div>
    </div>
    @endif

</div>
<!--End of Page ID-->

<script src="{{asset('mobile/scripts/bootstrap.min.js')}}"></script>
<script src="{{asset('mobile/scripts/custom.js')}}"></script>
@yield('scripts')
@if(session()->has('message'))
    <script>
        var notificationToas = document.getElementById('notification-bar-1');
        var notificationToast = new bootstrap.Toast(notificationToas);
        notificationToast.show();
    </script>
@endif
</body>
</html>

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="description" content="Affan - PWA Mobile HTML Template">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="theme-color" content="#0134d4">--}}
{{--    <meta name="apple-mobile-web-app-capable" content="yes">--}}
{{--    <meta name="apple-mobile-web-app-status-bar-style" content="black">--}}
{{--    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->--}}
{{--    <!-- Title -->--}}
{{--    <title>{{ $site_title }} | {{ $page_title }}</title>--}}
{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com/">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">--}}
{{--    <!-- Favicon -->--}}
{{--    <link rel="icon" href="{{asset('mobapp/img/core-img/favicon.ico')}}">--}}
{{--    <link rel="apple-touch-icon" href="{{asset('mobapp/img/icons/icon-96x96.png')}}">--}}
{{--    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('mobapp/img/icons/icon-152x152.png')}}">--}}
{{--    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('mobapp/img/icons/icon-167x167.png')}}">--}}
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('mobapp/img/icons/icon-180x180.png')}}">--}}
{{--    <!-- CSS Libraries -->--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/bootstrap.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/bootstrap-icons.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/tiny-slider.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/baguetteBox.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/rangeslider.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/vanilla-dataTables.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/css/apexcharts.css')}}">--}}
{{--    <!-- Core Stylesheet -->--}}
{{--    <link rel="stylesheet" href="{{asset('mobapp/style.css')}}">--}}
{{--    <!-- Web App Manifest -->--}}
{{--    <link rel="manifest" href="{{asset('mobapp/manifest.json')}}">--}}
{{--    <style>--}}
{{--        .tns-ovh{--}}
{{--            border-radius: 10px !important;--}}
{{--        }--}}
{{--        .coinPriceBlock-signature{--}}
{{--            display: none !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<!-- Preloader -->--}}
{{--<div id="preloader">--}}
{{--    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>--}}
{{--</div>--}}
{{--<!-- Internet Connection Status -->--}}
{{--<!-- # This code for showing internet connection status -->--}}
{{--<div class="internet-connection-status" id="internetStatus"></div>--}}
{{--<!-- Header Area -->--}}
{{--<div class="header-demo-bg shadow-sm" id="headerArea">--}}
{{--    <div class="container">--}}
{{--        <!-- # Header Four Layout -->--}}
{{--        <!-- # Copy the code from here ... -->--}}
{{--        <!-- Header Content -->--}}
{{--        <div class="header-content header-style-four position-relative d-flex align-items-center justify-content-between">--}}
{{--            <!-- Navbar Toggler -->--}}
{{--            <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>--}}
{{--            <!-- Logo Wrapper -->--}}
{{--            <div class="logo-wrapper">--}}
{{--                <a href="page-home.html"><img src="{{asset('mobapp/img/core-img/logo.png')}}" alt=""></a>--}}
{{--            </div>--}}
{{--            <!-- User Profile -->--}}
{{--            <div class="user-profile-wrapper">--}}
{{--                <a class="user-profile-trigger-btn" href="#">--}}
{{--                    <img src="{{asset('mobapp/img/bg-img/20.jpg')}}" alt="">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- # Header Four Layout End -->--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- # Sidenav Left -->--}}
{{--<!-- Offcanvas -->--}}
{{--<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">--}}
{{--    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>--}}
{{--    <div class="offcanvas-body p-0">--}}
{{--        <!-- Side Nav Wrapper -->--}}
{{--        <div class="sidenav-wrapper">--}}
{{--            <!-- Sidenav Profile -->--}}
{{--            <div class="sidenav-profile bg-gradient">--}}
{{--                <div class="sidenav-style1"></div>--}}
{{--                <!-- User Thumbnail -->--}}
{{--                <div class="user-profile"><img src="img/bg-img/2.jpg')}}" alt=""></div>--}}
{{--                <!-- User Info -->--}}
{{--                <div class="user-info">--}}
{{--                    <h6 class="user-name mb-0">Affan Islam</h6><span>CEO, Designing World</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Sidenav Nav -->--}}
{{--            <ul class="sidenav-nav ps-0">--}}
{{--                <li><a href="page-home.html"><i class="bi bi-house-door"></i>Home</a></li>--}}
{{--                <li><a href="elements.html"><i class="bi bi-folder2-open"></i>Elements<span class="badge bg-danger rounded-pill ms-2">220+</span></a></li>--}}
{{--                <li><a href="pages.html"><i class="bi bi-collection"></i>Pages<span class="badge bg-success rounded-pill ms-2">100+</span></a></li>--}}
{{--                <li><a href="#"><i class="bi bi-cart-check"></i>Shop</a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="page-shop-grid.html">Shop Grid</a></li>--}}
{{--                        <li><a href="page-shop-list.html">Shop List</a></li>--}}
{{--                        <li><a href="page-shop-details.html">Shop Details</a></li>--}}
{{--                        <li><a href="page-cart.html">Cart</a></li>--}}
{{--                        <li><a href="page-checkout.html">Checkout</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li><a href="settings.html"><i class="bi bi-gear"></i>Settings</a></li>--}}
{{--                <li>--}}
{{--                    <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode--}}
{{--                        <div class="form-check form-switch">--}}
{{--                            <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li><a href="page-login.html"><i class="bi bi-box-arrow-right"></i>Logout</a></li>--}}
{{--            </ul>--}}
{{--            <!-- Social Info -->--}}
{{--            <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div>--}}
{{--            <!-- Copyright Info -->--}}
{{--            <div class="copyright-info">--}}
{{--                <p>2022 &copy; Made by<a href="#">Designing World</a></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="page-content-wrapper" style="margin-top: 20px;">--}}
{{--    --}}
{{--</div>--}}
{{--<!-- Footer Nav -->--}}
{{--<div class="footer-nav-area" id="footerNav">--}}
{{--    <div class="container px-0">--}}
{{--        <!-- =================================== -->--}}
{{--        <!-- Paste your Footer Content from here -->--}}
{{--        <!-- =================================== -->--}}
{{--        <!-- Footer Content -->--}}
{{--        <div class="footer-nav position-relative shadow-sm footer-style-four">--}}
{{--            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">--}}
{{--                <li class="{{ Request::is('user/dashboard') || Request::is('home')? "active" : "" }}">--}}
{{--                    <a href="{{route('home')}}">--}}
{{--                        <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="../../external.html?link=http://www.w3.org/2000/svg">--}}
{{--                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>--}}
{{--                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Home</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ Request::is('user/markets') ? "active" : "" }}">--}}
{{--                    <a href="{{route('markets')}}">--}}
{{--                        <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="../../external.html?link=http://www.w3.org/2000/svg">--}}
{{--                            <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Market</span>--}}
{{--                    </a></li>--}}
{{--                <li class="{{ Request::is('user/wallets') ? "active" : "" }}">--}}
{{--                    <a href="{{ route('wallets') }}">--}}
{{--                        <svg class="bi bi-folder2-open" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="../../external.html?link=http://www.w3.org/2000/svg">--}}
{{--                            <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Wallets</span>--}}
{{--                    </a></li>--}}
{{--                <li><a href="page-chat-users.html">--}}
{{--                        <svg class="bi bi-chat-dots" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">--}}
{{--                            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>--}}
{{--                            <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Trade</span>--}}
{{--                    </a></li>--}}
{{--                <li>--}}
{{--                    <a href="settings.html">--}}
{{--                        <svg class="bi bi-gear" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="../../external.html?link=http://www.w3.org/2000/svg">--}}
{{--                            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>--}}
{{--                            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>--}}
{{--                        </svg>--}}
{{--                        <span>Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- All JavaScript Files -->--}}
{{--<script src="{{asset('mobapp/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/slideToggle.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/internet-status.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/tiny-slider.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/baguetteBox.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/countdown.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/rangeslider.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/vanilla-dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/index.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/imagesloaded.pkgd.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/isotope.pkgd.min.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/dark-rtl.js')}}"></script>--}}
{{--<script src="{{asset('mobapp/js/active.js')}}"></script>--}}
{{--<!-- PWA -->--}}
{{--<script src="{{asset('mobapp/js/pwa.js')}}"></script>--}}
{{--@yield('scripts')--}}
{{--</body>--}}
{{--</html>--}}