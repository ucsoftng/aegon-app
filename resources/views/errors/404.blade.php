<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <!-- Title of The Page -->
    <title>{{$site_title}} | {{$page_title}}</title>
    <!-- Meta Informations -->
    <meta charset="utf-8">
    <meta name="description" content="Hallilwell Investment Limited ">
    <meta name="keywords" content="BNA Multipurpose HTML Template , template, bootstrap 4, ui template kit, envato templates, BNA html templates, html, css">
    <meta name="author" content="BNA Multipurpose HTML Template ">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('front/img/favicon.png')}}">
    <!-- Web Font -->
    <link rel="stylesheet" href="{{asset('front/css/webfont.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- Bootstrap-Theme CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap-theme.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('front/css/fontawesome.min.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('front/css/slicknav.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('front/css/animate.min.css')}}">
    <!-- Magnific-Popup CSS-->
    <link rel="stylesheet" href="{{asset('front/css/magnific-popup.css')}}">
    <!-- Animate-Text CSS -->
    <link rel="stylesheet" href="{{asset('front/css/animate-text.css')}}">
    <!-- Carousel CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <!-- Them Default CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('front/css/normalize.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">

    <style type="text/css">
        .goog-te-combo{
            background-color: transparent;
            text-transform: uppercase;
            padding: 5px 10px;
            color: #fff;
            position: relative;
            top: 10px;
            border-color: rgba(255,255,255,0.4);
            text-align: right;
        }
        .goog-logo-link,.goog-te-gadget{
            color: transparent!important;
        }
        .goog-te-gadget img{
            display: none;
        }
        .goog-logo-link{
            display: none !important;
        }
        #google_translate_element img{
            position: absolute;
            top: 17px;
            padding-left: 5px;
        }

        @media (max-width: 500px) {

            #google_translate_element img {
                position: absolute;
                top: 60px;
                padding-left: 5px;
            }
        }
        .text-white {
            color: #fff !important;
        }
    </style>
</head>

<body>
<!-- Error Page -->
<section class="error-page overlay">
    <div id="particles-js"><canvas class="particles-js-canvas-el" width="1474" height="880" style="width: 100%; height: 100%;"></canvas></div>
    <div class="table">
        <div class="table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                        <!-- Error Inner -->
                        <div class="error-inner">
                            <h2><i class="fas fa-exclamation-triangle spen"></i><span>Page Not Found</span></h2>
                            <p>Oops! The page you are looking for does not exist. It might have been moved or deleted.</p>
                            <div class="button">
                                <a href="index.html" class="btn">Go Homepage</a>
                                <a href="contact.html" class="btn primary">Contact Us</a>
                            </div>
                        </div>
                        <!--/ End Error Inner -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!--/ End Error Page -->
<!-- Jquery JS -->
<script src="{{asset('front/js/jquery.min.js')}}"></script>
<!-- Bootstrap Js -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<!-- Slicknav Js  -->
<script src="{{asset('front/js/jquery.slicknav.min.js')}}"></script>
<!-- ScrollUp Js -->
<script src="{{asset('front/js/jquery.scrollUp.min.js')}}"></script>
<!-- Carousel Js -->
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<!-- Waypoints Js -->
<script src="{{asset('front/js/waypoints.min.js')}}"></script>
<!--Counterup Js  -->
<script src="{{asset('front/js/jquery.counterup.min.js')}}"></script>
<!-- Stellar Js  -->
<script src="{{asset('front/js/jquery.stellar.min.js')}}"></script>
<!-- Min Js -->
<script src="{{asset('front/js/wow.min.js')}}"></script>
<!-- Animate-Text Js -->
<script src="{{asset('front/js/animate-text.js')}}"></script>
<!-- Easing Js -->
<script src="{{asset('front/js/easing.min.js')}}"></script>
<!-- Magnific Js -->
<script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Particales Js -->
<script src="{{asset('front/js/particles.min.js')}}"></script>
<!-- Particales-Code Js -->
<script src="{{asset('front/js/particle-code.js')}}"></script>
<!-- Main Js -->
<script src="{{asset('front/js/main.js')}}"></script>
<!-- Custom Js -->

<style>
    .mgm {
        border-radius: 7px;
        position: fixed;
        z-index: 90;
        bottom: 45%;
        right: 50px;
        background: #fff;
        padding: 10px 27px;
        box-shadow: 0px 5px 13px 0px rgba(0, 0, 0, .3);
    }

    .mgm a {
        font-weight: 700;
        display: block;
        color: #2962FF;
    }

    .mgm a,
    .mgm a:active {
        transition: all .2s ease;
        color: #2962FF;
    }
</style>
<div class="mgm" style="display: none;">
    <div class="txt" style="color:black;"></div>
    <script src="{{asset('front/js/custom.js')}}"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        var listCountries = ['South Africa', 'USA', 'Germany', 'France', 'Italy', 'South Africa', 'Australia', 'South Africa', 'Canada', 'Argentina', 'Saudi Arabia', 'Mexico', 'South Africa', 'South Africa', 'Venezuela', 'South Africa', 'Sweden', 'South Africa', 'South Africa', 'Italy', 'South Africa', 'United Kingdom', 'South Africa', 'Greece', 'Cuba', 'South Africa', 'Portugal', 'Austria', 'South Africa', 'Panama', 'South Africa', 'South Africa', 'Netherlands', 'Switzerland', 'Belgium', 'Israel', 'Cyprus'];
        var listPlans = ['$500','$1,500','$1,000','$10,000','$2,000','$3,000','$4,000', '$600', '$700', '$2,500'];
        var transarray = ['just <b>invested</b>', 'has <b>withdrawn</b>', 'is <b>trading with</b>'];
        interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
        var run = setInterval(request, interval);

        function request() {
            clearInterval(run);
            interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
            var country = listCountries[Math.floor(Math.random() * listCountries.length)];
            var transtype = transarray[Math.floor(Math.random() * transarray.length)];
            var plan = listPlans[Math.floor(Math.random() * listPlans.length)];
            var msg = 'Someone from <b>' + country + '</b> ' + transtype + ' <a href="javascript:void(0);" onclick="javascript:void(0);">' + plan + '</a>';
            $(".mgm .txt").html(msg);
            $(".mgm").stop(true).fadeIn(300);
            window.setTimeout(function() {
                $(".mgm").stop(true).fadeOut(300);
            }, 10000);
            run = setInterval(request, interval);
        }
    </script>
</body>
</html>