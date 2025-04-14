<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/fonts/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="{{asset('mobile/_manifest.json')}}">
    <meta id="theme-check" name="theme-color" content="#FFFFFF">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('mobile/app/icons/icon-192x192.png')}}">
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

<body class="theme-dark" id="ss">

{{--<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>--}}

<div id="page">

    <!-- Header -->
    <div class="header-bar header-fixed header-app header-bar-detached">
        <a data-back-button href="#"><i class="bi bi-caret-left-fill font-11 color-theme ps-2"></i></a>
        <a href="#" class="header-title color-theme font-13">Back</a>
        <a href="#" class="header-title color-theme font-15">{{$page_title}}</a>
        <a href="#" class="show-on-theme-light" data-toggle-theme><i class="bi bi-moon-fill font-13"></i></a>
        <a href="#" class="show-on-theme-dark" data-toggle-theme ><i class="bi bi-lightbulb-fill color-yellow-dark font-13"></i></a>
    </div>

    <!-- Footer Bar-->
    <div id="footer-bar" class="footer-bar footer-bar-detached">
        <a href="{{route('user-dashboard')}}" class="{{ Request::is('user/dashboard') || Request::is('home')? "active-nav" : "" }}"><i class="bi bi-house-fill font-16"></i><span>Home</span></a>
        <a href="{{ route('markets') }}" class="{{ Request::is('user/markets') ? "active-nav" : "" }}"><i class="bi bi-bar-chart-fill font-17"></i><span>Markets</span></a>
        <a href="{{ route('wallets') }}" class="{{ Request::is('user/wallets') ? "active-nav" : "" }}"><i class="bi bi-wallet-fill font-15"></i><span>Wallets</span></a>
        <a href="{{ route('trade') }}"><i class="bi bi-folder-fill font-16"></i><span>Trade</span></a>
        <a href="{{ route('settings') }}"><i class="bi bi-gear-fill"></i><span>Setting</span></a>
    </div>
    <div id="menu-main" data-menu-active="nav-homes" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m">
        @include('layouts.partials.user-menu')
    </div>
    <!-- Your Page Content Goes Here-->
    <div class="page-content header-clear-medium">

        @yield('content')

    </div>
    <!-- End of Page Content-->
    @yield('sheets')

    @if (session()->has('message'))
        <div id="notification-bar-1" class="notification-bar detached @if(session()->get('title') == 'success') gradient-green @elseif(session()->get('title') == 'danger') gradient-red @endif rounded-s shadow-l" data-bs-delay="10000">
            <div class="toast-header px-3 py-3">
                @if(session()->get('title') == 'success')
                    <i class="bi bi-check-circle-fill pe-2 color-white"></i>
                @elseif(session()->get('title') == 'danger')
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