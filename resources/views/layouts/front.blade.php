<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('front/favicon.png')}}" type="image/png">
    <link rel="icon" type="image/x-icon" href="{{asset('front/favicon.png')}}" />
    <meta content="financial markets, future, future trade, financial investment, trading, financial trading" name="keywords">
    <meta content="Trading Advanced Platform Systems Limited" name="author">
    <meta content="We believe that everybody ought to have access to the financial markets, so we have constructed future conglomerate starting from the earliest stage to make contributing receptive and reasonable for newcomers and specialists alike." name="description">
    <meta property="og:title" content="Trading Advanced Platform Systems Limited | Focused trading and investments" />
    <meta property="og:description" content="We believe that everybody ought to have access to the financial markets, so we have constructed future conglomerate starting from the earliest stage to make contributing receptive and reasonable for newcomers and specialists alike." />
    <meta property="og:url" content="https://www.traapsltd.org/" />
    <meta property="og:site_name" content="Trading Advanced Platform Systems Limited" />
    <meta property="og:image" content="{{asset('front/favicon.png')}}" />
    <meta property="og:locale" content="en_us" />
    <meta property="og:type" content="Website" />
    <meta name="twitter:card" content="Summary">
    <meta name="twitter:site" content="https://traapsltd.org/" />
    <meta name="twitter:title" content="Trading Advanced Platform Systems Limited | Focused trading and investments" />
    <meta name="twitter:description" content="We believe that everybody ought to have access to the financial markets, so we have constructed future conglomerate starting from the earliest stage to make contributing receptive and reasonable for newcomers and specialists alike." />
    <meta name="robots" content="index, follow" />
    <meta name="contact_addr" content="help@traapsltd.org" />
    <meta name="language" content="en-us" />
    <meta name="owner" content="Trading Advanced Platform Systems Limited" />
    <meta name="distribution" content="GLOBAL" />
    <meta name="rating" content="general" />
    <meta name="copyright" content="THE Trading Advanced Platform Systems Limited copyright © 2019-2020" />
    <meta name="DC.Publisher" content="Trading Advanced Platform Systems Limited" />
    <link rel="canonical" href="https://www.traapsltd.org/" />
    <link rel="alternate" href="https://www.traapsltd.org/" hreflang="en-us" />
    <title>{{$site_title}} | {{$page_title}}</title>
    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/animate.min.css')}}">
    <!-- FlatIcon CSS -->
    <link rel="stylesheet" href="{{asset('front/css/flaticon.css')}}">
    <!-- Odometer Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/odometer.min.css')}}">
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{asset('front/css/meanmenu.min.css')}}">
    <!-- Magnific Popup Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/magnific-popup.min.css')}}">
    <!-- Nice Select Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/nice-select.min.css')}}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">
    <!-- Font Awesome Min CSS -->
    <link rel="stylesheet" href="{{asset('front/css/fontawesome.min.css')}}">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{asset('front/css/boxicons.min.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">

    <style type="text/css">
        body{
            position: inherit !important;
            font-family: Montserrat, system-ui !important;
        }
        .goog-te-combo{
            /*background-color: transparent;*/
            text-transform: uppercase;
            padding: 5px 10px;
            color: black;
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
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:15px;
            left:10px;
            background-color:#4CAF50;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }

        .my-float{
            margin-top:17px;
        }
        .text-justify{
            text-align: justify;
        }
    </style>
</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="shadow"></div>
        <div class="box"></div>
    </div>
</div>
<!-- End Preloader -->

<!-- Start Value Trade Area -->
<div class="value-trade-area">
    <div class="container-fluid">
        <!-- MARQUEE SCROLL -->
        <div class="bg-black marquee">
            <div class="TickerNews" id="T1">
                <div class="ti_wrapper">
                    <div class="ti_slide">
                        <div class="ti_content">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                                    {
                                        "symbols": [
                                        {
                                            "proName": "FOREXCOM:SPXUSD",
                                            "title": "S&P 500"
                                        },
                                        {
                                            "proName": "FOREXCOM:NSXUSD",
                                            "title": "Nasdaq 100"
                                        },
                                        {
                                            "proName": "FX_IDC:EURUSD",
                                            "title": "EUR/USD"
                                        },
                                        {
                                            "proName": "BITSTAMP:BTCUSD",
                                            "title": "BTC/USD"
                                        },
                                        {
                                            "proName": "BITSTAMP:ETHUSD",
                                            "title": "ETH/USD"
                                        },
                                        {
                                            "description": "BTC/EUR",
                                            "proName": "COINBASE:BTCEUR"
                                        },
                                        {
                                            "description": "ETH/BTC",
                                            "proName": "BITBAY:ETHBTC"
                                        }
                                    ],
                                        "showSymbolLogo": true,
                                        "colorTheme": "dark",
                                        "isTransparent": false,
                                        "displayMode": "adaptive",
                                        "locale": "en"
                                    }
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MARQUEE SCROLL SECTION  END -->
    </div>
</div>
<!-- End Value Trade Area -->

<!-- Start Navbar Area -->
<div class="navbar-area navbar-area-with-position-relative">
    <div class="aronix-responsive-nav">
        <div class="container">
            <div class="aronix-responsive-menu">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="logo" style="width: 100px !important; height: 30px !important;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="aronix-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="logo" style="width: 100px !important; height: 60px !important;">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ Request::is('/') ? "active" : "" }}">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Company <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('about-us')}}" class="nav-link {{ Request::is('about-us') ? "active" : "" }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('services')}}" class="nav-link {{ Request::is('services') ? "active" : "" }}">Services</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pricing')}}" class="nav-link {{ Request::is('pricing') ? "active" : "" }}">
                                Investment Plans
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('market')}}" class="nav-link {{ Request::is('market') ? "active" : "" }}">
                                Trading
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('affiliate')}}" class="nav-link {{ Request::is('affiliate') ? "active" : "" }}">
                                Affiliate
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link {{ Request::is('contact') ? "active" : "" }}">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Account <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link {{ Request::is('register') ? "active" : "" }}">Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="nav-link {{ Request::is('login') ? "active" : "" }}">Sign In</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="others-options">
                        <div class="cart-items" id="google_translate_element">

                        </div>

                        {{--                        <div class="burger-menu">--}}
                        {{--                            <span></span>--}}
                        {{--                            <span></span>--}}
                        {{--                            <span></span>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->

@include('includes.slider')

@yield('content')

<!-- Start Footer Wrap Area -->
<section class="footer-wrap-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-card">
                    <a href="/" class="logo">
                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="logo" style="width: 100px; height: 60px;">
                    </a>
                    <p class="text-justify">{{$general->about_text}}</p>
                    <ul class="social-links">
                        <li><a href="{{$general->facebook}}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                        <li><a href="{{$general->twitter}}" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                        <li><a href="{{$general->linkedin}}" target="_blank"><i class='bx bxl-linkedin'></i></a></li>
                        <li><a href="{{$general->google_plus}}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-card ps-5">
                    <h3>Resources</h3>

                    <ul class="footer-quick-links">
                        <li><a href="{{route('security')}}"><i class="fa-solid fa-angles-right"></i> Security</a></li>
                        {{--                        <li><a href="{{route('faq')}}"><i class="fa-solid fa-angles-right"></i> FAQ</a></li>--}}
                        <li><a href="{{route('terms')}}"><i class="fa-solid fa-angles-right"></i> Terms</a></li>
                        <li><a href="{{route('privacy')}}"><i class="fa-solid fa-angles-right"></i> Privacy Policy</a></li>
                        <li><a href="{{route('contact')}}"><i class="fa-solid fa-angles-right"></i> Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-card">
                    <h3>Contact Info</h3>

                    <ul class="contact-links">
                        <li><span>Address:</span> {{$general->address}}. </li>
                        <li><span>Website:</span> <a href="{{$general->title}}" target="_blank">{{$general->title}}</a></li>
                        <li><span>Email:</span> <a href="mailto:{{$general->email}}"><span>{{$general->email}}</span></a></li>
                        <li><span>Phone:</span> <a href="tel:{{$general->number}}">{{$general->number}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-card ps-5">
                    <h3>Certification</h3>
                    <a href="#" target="_blank">
                        <img src="{{asset('front/images/CAC.png')}}" alt="certification" style="width: 150px;">
                    </a>

                    {{--                    <ul class="footer-quick-links">--}}
                    {{--                        <li><a href="https://coinbase.com" target="_blank"><i class="fa-solid fa-angles-right"></i> Buy Bitcoin</a></li>--}}
                    {{--                        <li><a href="https://binance.com" target="_blank"><i class="fa-solid fa-angles-right"></i> Buy BNB</a></li>--}}
                    {{--                        <li><a href="https://coinbase.com" target="_blank"><i class="fa-solid fa-angles-right"></i> Buy Ethereum</a></li>--}}
                    {{--                        <li><a href="https://coinbase.com" target="_blank"><i class="fa-solid fa-angles-right"></i> Buy USDT</a></li>--}}
                    {{--                        <li><a href="https://coinbase.com" target="_blank"><i class="fa-solid fa-angles-right"></i> Buy Litecoin</a></li>--}}
                    {{--                    </ul>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="footer-wrap-line">
        <img src="{{asset('front/img/cryptocurrency-home/footer/wrap-line.png')}}" alt="image">
    </div>
    <div class="footer-wrap-shape">
        <img src="{{asset('front/img/cryptocurrency-home/footer/shape-1.png')}}" alt="image">
    </div>
    <div class="footer-wrap-shape-2">
        <img src="{{asset('front/img/cryptocurrency-home/footer/shape-2.png')}}" alt="image">
    </div>
</section>
<!-- End Footer Wrap Area -->

<!-- Start Copyright Wrap Area -->
<div class="copyright-wrap-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6 col-md-6">
                <p>Copyright @ <script>document.write(new Date().getFullYear())</script> Trading Advanced Platform Systems. All rights reserved.</p>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6">
                <ul class="list">
                    <li><a href="{{route('terms')}}">Terms & Conditions</a></li>
                    <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Copyright Wrap Area -->

<div class="go-top"><i class="fas fa-chevron-up"></i></div>

<!-- jQuery Min JS -->
<script src="{{asset('front/js/jquery.min.js')}}"></script>
<!-- Bootstrap Min JS -->
<script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
<!-- MeanMenu JS  -->
<script src="{{asset('front/js/jquery.meanmenu.js')}}"></script>
<!-- Appear Min JS -->
<script src="{{asset('front/js/jquery.appear.min.js')}}"></script>
<!-- Odometer Min JS -->
<script src="{{asset('front/js/odometer.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<!-- Magnific Popup Min JS -->
<script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Parallax Min JS -->
<script src="{{asset('front/js/parallax.min.js')}}"></script>
<!-- Nice Select Min JS -->
<script src="{{asset('front/js/jquery.nice-select.min.js')}}"></script>
<!-- WOW Min JS -->
<script src="{{asset('front/js/wow.min.js')}}"></script>
<!-- AjaxChimp Min JS -->
<script src="{{asset('front/js/jquery.ajaxchimp.min.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('front/js/form-validator.min.js')}}"></script>
<!-- Contact Form Min JS -->
<script src="{{asset('front/js/contact-form-script.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('front/js/main.js')}}"></script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Begin of Chaport Live Chat code -->
{{--<script type="text/javascript">--}}
{{--    (function(w,d,v3){--}}
{{--        w.chaportConfig = {--}}
{{--            appId : '62b87bbfae84592f3096f647'--}}
{{--        };--}}

{{--        if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);--}}
{{--</script>--}}
<!-- End of Chaport Live Chat code -->
{{--<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c04fe743-61a1-468b-ad22-707711622f15";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>--}}
<!-- Smartsupp Live Chat script -->
</body>
</html>