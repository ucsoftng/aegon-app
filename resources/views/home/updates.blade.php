<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <!-- Title of The Page -->
    <title>{{$site_title}} | {{$page_title}}</title>
    <!-- Meta Informations -->
    <meta charset="utf-8">
    <meta name="description" content="Halliwell Investment Limited | PORTFOLIO AND DEVELOPMENT MANAGEMENT LTD">
    <meta name="keywords" content="Halliwell Limited, Management consultancy activities other than financial management, Architectural activities, Financial management">
    <meta name="author" content="Halliwell ">
    <meta name="viewport" content="width=1024">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
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


<!-- Preloader -->

<!-- End Preloader -->

<!-- Start Navbar Area -->

<div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-left">
                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="logo" style="width: 150px; height: 100px;">
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><b></b></h6>
                        </div>
                        <div class="col-md-6">
{{--                            <h6 class="text-right"><b>Balance: {{$trad->balance}}</b></h6>--}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6><b>Daily Trading Result</b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-right"><b>{{ \Carbon\Carbon::parse($trad->date)->format('d F Y') }}</b></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive mt-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>Member Code</th>
                                <th>Initial Deposit</th>
                                <th>Trader Commission</th>
                                <th>Available To Deal</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($trading as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{$p->member_code}}</td>
                                    <td>{{ $p->initial_deposit }}</td>
                                    <td>{{ $p->commission }}</td>
                                    <td>{{ $p->available }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- ROW-->
    </div>
<!-- Start Footer Area -->


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
</body>
</html>