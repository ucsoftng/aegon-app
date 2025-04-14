<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex,nofollow">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <meta name="viewport" content="width=1024">--}}
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image.png')}}" sizes="16x16" href="{{ asset('assets/images') }}/{{ $general->favicon }}">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <link href="{{ asset('dashboard/dash/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/dash/vendors/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <!--c3 CSS -->
    <link href="{{ asset('dashboard/dash/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{ asset('dashboard/dash/vendors/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('dashboard/dash/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/dash/vendors/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dashboard/css/master-stylesheet.css')}}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('dashboard/css/pages/dashboard1.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('dashboard/css/colors/blue-dark.css')}}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminz/assetz/vendors/dropify/dist/css/dropify.min.css')}}">
    <style>
        .card{
            background: black !important;
            box-shadow: 5px 5px 35px #0003 !important;
        }
        #background {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 30%;
            background-color: rgb(252, 213, 53);
            z-index: 0;
        }
        .modal-content{
            background: rgb(30, 35, 41);
        }
    </style>

    @yield('styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body class="card-no-border" style="background-color: rgb(24, 26, 32) !important;">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="lds-roller">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <div id="background"></div>
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="homepage" class="dark-logo" height="100px;" />
                        <!-- Light Logo icon -->
{{--                        <img src="{{ asset('dashboard/dash/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />--}}
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="homepage" class="dark-logo" height="100px;" width="100px;" />
                        <!-- Light Logo text -->
                         <img src="{{ asset('assets/images') }}/{{ $general->logo }}" class="light-logo" alt="homepage" height="100px;" width="150px;"/></span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <li class="nav-item hidden-sm-down"><span></span></li>
                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="user" class="profile-pic" style="height: 50px; width: 50px;"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated fadeIn">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img">
                                            <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="user"></div>
                                        <div class="u-text">
                                            <h4 style="color: #fff;">{{ Auth::user()->name }}</h4>
                                            <p class="text-white">{{ Auth::user()->email }}</p>
                                            <a href="{{ route('user-edit') }}" class="btn btn-rounded btn-primary btn-sm">Edit Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('user-details') }}"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="{{ route('fund-history') }}"><i class="ti-wallet"></i> My Balance: $ {{Auth::user()->amount}} </a></li>
                                <li><a href="{{route('support-all')}}"><i class="ti-email"></i> Inbox : @php $sc = \App\Support::whereuser_id(Auth::user()->id)->count() @endphp {{$sc}} Messages </a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('user-password') }}"><i class="ti-settings"></i> Account Setting</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="nav-small-cap">PERSONAL</li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="{{route('user-dashboard')}}" aria-expanded="false">
                            <i class="mdi mdi-apps mr-10"></i><span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">User Data</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('user-edit') }}">Edit Details</a></li>
                            <li><a href="{{ route('user-details') }}">View Details</a></li>
                            <li><a href="{{ route('user-kyc') }}">KYC Verification</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="{{ route('programs') }}" aria-expanded="false">
                            <i class="mdi mdi-folder mr-10"></i><span class="hide-menu">Bots</span></a>
                    </li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="{{ route('user-activity') }}" aria-expanded="false">
                            <i class="mdi mdi-file-document mr-10"></i><span class="hide-menu">Transactions</span></a>
                    </li>
                    <li class="nav-small-cap">TRANSACTIONS</li>
                    <li>
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-wallet mr-10"></i><span class="hide-menu">Wallets</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('wallets') }}">All Wallets</a></li>
                            <li><a href="{{ route('add-fund') }}">Deposit Funds</a></li>
                            <li><a href="{{ route('fund-history') }}">Deposit History</a></li>
                            <li><a href="{{ route('swap-coins') }}">Swap Coin</a></li>
                        </ul>
                    </li>

                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-wallet-membership mr-10"></i><span class="hide-menu">Trade</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('deposit-new') }}">New Trade</a></li>
                            <li><a href="{{ route('deposit-history') }}">Trade History</a></li>
                            <li><a href="{{ route('repeat-history') }}">Profit</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-border-all mr-10"></i><span class="hide-menu">Withdraw</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('withdraw-new') }}">New Withdraw Request</a></li>
                            <li><a href="{{ route('withdraw-history') }}">Withdrawal History</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-border-all mr-10"></i><span class="hide-menu">Referrals</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('reference-user') }}">Downliners</a></li>
                            <li><a href="{{ route('reference-history') }}">Bonus History</a></li>
                            <li><a href="{{ route('transfer-reference') }}">Transfer Referral Bonus</a></li>
                        </ul>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-border-all mr-10"></i><span class="hide-menu">Support</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('support-open')}}">Create Tickets</a></li>
                            <li><a href="{{route('support-all')}}">All Tickets</a></li>
                            <li><a href="{{route('announcements')}}">Announcements</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="" style="color: #333333 !important;">{{$page_title}}</h4>
                </div>
            </div>

            @yield('content')
        </div>

        <footer class="footer"> © @php echo date('Y') @endphp {{$site_title}} </footer>

    </div>

</div>
<script src="{{ asset('dashboard/dash/vendors/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('dashboard/dash/vendors/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('dashboard/dash/vendors/ps/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('dashboard/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dashboard/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('dashboard/js/custom.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--sparkline JavaScript -->
<!--morris JavaScript -->
<script src="{{ asset('dashboard/dash/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/morrisjs/morris.min.js')}}"></script>
<!--c3 JavaScript -->
<script src="{{ asset('dashboard/dash/vendors/d3/d3.min.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/c3-master/c3.min.js')}}"></script>
<!-- Popup message jquery -->
<script src="{{ asset('dashboard/dash/vendors/toast-master/js/jquery.toast.js')}}"></script>
<!--Sparkline JavaScript -->
<script src="{{ asset('dashboard/dash/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{ asset('dashboard/js/dashboard1.js')}}"></script>
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Sweet-Alert  -->
<script src="{{ asset('dashboard/dash/vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@yield('scripts')
<script>
    @if (session()->has('message'))
    swal({
        title: "{!! session()->get('title')  !!}",
        text: "{!! session()->get('message')  !!}",
        type: "{!! session()->get('type')  !!}",
        confirmButtonText: "OK"
    });
    @endif

</script>
<script src="{{asset('front/js/custom.js')}}"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>