<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>{{$site_title}} | {{$page_title}}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
          rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('mobapp/img/core-img/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{asset('mobapp/img/icons/icon-96x96.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('mobapp/img/icons/icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('mobapp/img/icons/icon-167x167.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('mobapp/img/icons/icon-180x180.png')}}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('mobapp/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/baguetteBox.min.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/rangeslider.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/vanilla-dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('mobapp/css/apexcharts.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('mobapp/style.css')}}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{asset('mobapp/manifest.json')}}">
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
</div>
<!-- Internet Connection Status -->
<!-- # This code for showing internet connection status -->
<div class="internet-connection-status" id="internetStatus"></div>
<!-- Back Button -->
<div class="login-back-button">
    <a href="{{ url()->previous() }}">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg>
    </a>
</div>
<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
        <div class="text-center px-4">
            <img class="login-intro-img" src="{{asset('dash/assets/images/apg.png')}}" alt="">
            <h3>Reset Password</h3>
            <p class="mb-4">Enter your email</p>
        </div>
        <!-- Register Form -->
        <div class="register-form mt-4">
            @if (session()->has('message'))
                <div class="alert custom-alert-1 alert-{{ session()->get('type') }} alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i>
                    {{ session()->get('message') }}
                    <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('status'))
                <div class="alert custom-alert-1 alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i>
                    {{ session()->get('status') }}
                    <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert custom-alert-1 alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-x-circle"></i>
                        {!!  $error !!}
                        <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ route('password.email') }}" method="post" accept-charset="utf-8" id="otpsubmit">
                @csrf
                <div class="form-group text-start mb-3">
                    <input class="form-control" type="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                </div>
                <button class="btn btn-primary w-100 save-form-btn" type="submit" id="logsub" value="Reset Password">
                    <span class="btn-text">Reset Password</span>
                    <span class="loader" style="display:none">
                        <div class="spinner-border spinner-border-sm text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </button>
            </form>

        </div>
    </div>
</div>
<!-- All JavaScript Files -->
<script src="{{asset('mobapp/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('mobapp/js/slideToggle.min.js')}}"></script>
<script src="{{asset('mobapp/js/internet-status.js')}}"></script>
<script src="{{asset('mobapp/js/tiny-slider.js')}}"></script>
<script src="{{asset('mobapp/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('mobapp/js/rangeslider.min.js')}}"></script>
<script src="{{asset('mobapp/js/vanilla-dataTables.min.js')}}"></script>
<script src="{{asset('mobapp/js/index.js')}}"></script>
<script src="{{asset('mobapp/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('mobapp/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('mobapp/js/dark-rtl.js')}}"></script>
<script src="{{asset('mobapp/js/active.js')}}"></script>
<!-- PWA -->
<script src="{{asset('mobapp/js/pwa.js')}}"></script>
<script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#logsub").click(function (event) {
            $('#logsub').prop('disabled', true);
            $('#logsub').children('.btn-text').hide()
            $('#logsub').children('.loader').show()
            $('#otpsubmit').submit();
        });
    });
</script>
</body>
</html>