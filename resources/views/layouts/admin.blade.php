<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <meta name="viewport" content="width=1024">--}}
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images') }}/{{ $general->favicon }}">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <link href="{{ asset('adminz/assetz/vendors/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <!--c3 CSS -->
    <link href="{{ asset('adminz/assetz/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{ asset('adminz/assetz/vendors/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('adminz/assetz/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('adminz/assetz/vendors/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('adminz/css/master-stylesheet.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('adminz/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('adminz/css/pages/bootstrap-switch.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminz/assetz/vendors/dropify/dist/css/dropify.min.css')}}">

    @yield('styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->


</head>

<body class="fix-header fix-sidebar card-no-border">
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
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <!-- Logo icon -->
{{--                    <b>--}}
{{--                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->--}}
{{--                        <!-- Dark Logo icon -->--}}
{{--                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="homepage" class="dark-logo" />--}}
{{--                        <!-- Light Logo icon -->--}}
{{--                        <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="homepage" class="light-logo" />--}}
{{--                    </b>--}}
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span>
                         <!-- dark Logo text -->
                         <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->    
{{--                         <img src="{{ asset('assets/images') }}/{{ $general->logo }}" class="light-logo" alt="homepage" />--}}
                    </span>
                </a>
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
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                    <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="icon-Magnifi-Glass2"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">

                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images') }}/{{ Auth::guard('admin')->user()->image }}" alt="user" class="" />
                            <span class="hidden-md-down">{{ Auth::guard('admin')->user()->name }}<i class="fa fa-angle-down"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated fadeIn">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="{{ asset('assets/images') }}/{{ Auth::guard('admin')->user()->image }}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{ Auth::guard('admin')->user()->name }}</h4>
                                            <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p>
                                            <a href="{{ route('edit-profile') }}" class="btn btn-rounded btn-danger btn-sm">Edit Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('edit-profile') }}"><i class="ti-user"></i> My Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('change-pass') }}"><i class="ti-settings"></i> Account Setting</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">MAIN</li>
                    <li class="{{ Request::is('dashboard') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="mdi mdi-home mr-10"></i>
                            <span class="hide-menu">Dashboard </span></a>
                    </li>
                    <li class="{{ Request::is('admin-activity') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('admin-activity') }}" aria-expanded="false">
                            <i class="mdi mdi-apps mr-10"></i>
                            <span class="hide-menu">Activity Log </span></a>
                    </li>
                    <li class="{{ Request::is('trading-activity') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-window-minimize mr-10"></i><span class="hide-menu">Manage Trading Updates</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('trading-activity') }}">Trading Activity</a></li>
                            <li><a href="{{route('updates')}}">Get Updates</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('btc-payment-request') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('btc-payment-request') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet mr-10"></i>
                            <span class="hide-menu">Wallet Funding Requests </span></a>
                    </li>
                    <li class="{{ Request::is('admin-deposit') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('admin-deposit') }}" aria-expanded="false">
                            <i class="mdi mdi-currency-btc mr-10"></i>
                            <span class="hide-menu">Deposit History </span></a>
                    </li>
                    <li class="{{ Request::is('admin-rebeat') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('admin-rebeat') }}" aria-expanded="false">
                            <i class="mdi mdi-chart-bar mr-10"></i>
                            <span class="hide-menu">Profit History </span></a>
                    </li>
                    <li class="{{ Request::is('withdraw-pending') || Request::is('withdraw-success') || Request::is('withdraw-refund') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-window-minimize mr-10"></i><span class="hide-menu">Manage Withdrawal</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('withdraw-pending')}}">Pending Withdrawal</a></li>
                            <li><a href="{{route('withdraw-success')}}">Confirmed Withdrawals</a></li>
                            <li><a href="{{route('withdraw-refund')}}">Refunded Withdrawals</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('user-manage') || Request::is('block-user') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Manage Users</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('user-manage')}}">Manage Users</a></li>
                            <li><a href="{{route('block-user')}}">Block User</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('plan-create') || Request::is('plan-show') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Manage Bots</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('plan-create')}}">Create New Bot</a></li>
                            <li><a href="{{route('plan-show')}}">View All Bots</a></li>
                        </ul>
                    </li>
{{--                    <li class="{{ Request::is('payment-manage') ? "active" : "" }}">--}}
{{--                        <a class="waves-effect waves-dark" href="{{ route('payment-manage') }}" aria-expanded="false">--}}
{{--                            <i class="mdi mdi-chart-bar mr-10"></i>--}}
{{--                            <span class="hide-menu">Payment Methods</span></a>--}}
{{--                    </li>--}}
                    <li class="{{ Request::is('payment-wallets') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('payment-wallets') }}" aria-expanded="false">
                            <i class="mdi mdi-wallet mr-10"></i>
                            <span class="hide-menu">Payment Wallets </span></a>
                    </li>
                    <li class="{{ Request::is('wallet-phrases') ? " opened active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('wallet-phrases') }}">
                            <i class="mdi mdi-wallet mr-10"></i>
                            <span class="hide-menu">Wallet Phrases</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('trade-setting') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('trade-setting') }}" aria-expanded="false">
                            <i class="mdi mdi-chart-bar mr-10"></i>
                            <span class="hide-menu">Trading Setting </span></a>
                    </li>
                    <li class="{{ Request::is('withdraw-payment') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('withdraw-payment') }}" aria-expanded="false">
                            <i class="mdi mdi-chart-bar mr-10"></i>
                            <span class="hide-menu">Withdrawal Methods </span></a>
                    </li>
                    <li class="{{ Request::is('manage-compound') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('manage-compound') }}" aria-expanded="false">
                            <i class="mdi mdi-clock mr-10"></i>
                            <span class="hide-menu">Manage Compound </span></a>
                    </li>
                    <li class="{{ Request::is('latter-create') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('latter-create') }}" aria-expanded="false">
                            <i class="mdi mdi-email mr-10"></i>
                            <span class="hide-menu">Send Mail </span></a>
                    </li>

                    <li class="{{ Request::is('admin-support-pending') || Request::is('admin-support') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-email mr-10"></i><span class="hide-menu">Support Tickets</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin-support')}}">All Tickets</a></li>
                            <li><a href="{{route('admin-support-pending')}}">Pending Tickets</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('basic-setting') || Request::is('general-setting') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Web Control</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('basic-setting')}}">Basic Setting</a></li>
                            <li><a href="{{route('general-setting')}}">General Setting</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('announcement_create') || Request::is('announcement_show') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Manage Announcements</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('announcement_create')}}">Create New </a></li>
                            <li><a href="{{route('announcement_show')}}">View All</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('manage-testimonial') ? "active" : "" }}">
                        <a class="waves-effect waves-dark" href="{{ route('manage-testimonial') }}" aria-expanded="false">
                            <i class="mdi mdi-clock mr-10"></i>
                            <span class="hide-menu">Manage Testimonial </span></a>
                    </li>
                    <li class="{{ Request::is('news-create') || Request::is('news-show') || Request::is('news-category') ? "active" : "" }}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-newspaper mr-10"></i><span class="hide-menu">Manage News</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('news-category') }}">News Category</a></li>
                            <li><a href="{{ route('news-create') }}">Create News</a></li>
                            <li><a href="{{ route('news-show') }}">View All News</a></li>
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

            <div class="row">
                <div class="col-md-12">
                    <!--  ==================================VALIDATION ERRORS==================================  -->
                    @if($errors->any())
                        @foreach ($errors->all() as $error)

                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!!  $error !!}
                            </div>

                    @endforeach
                @endif
                <!--  ==================================SESSION MESSAGES==================================  -->
                </div>
            </div>

            @yield('content')

        </div>

        <footer class="footer"> &copy; @php echo date('Y'); @endphp <strong>All Copyright Reserved.</strong> </footer>

    </div>

</div>

<script src="{{ asset('adminz/assetz/vendors/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('adminz/assetz/vendors/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('adminz/assetz/vendors/bootstrap/js/bootstrap.min.js')}}"></script>


<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('adminz/assetz/vendors/ps/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('adminz/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('adminz/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('adminz/js/custom.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--c3 JavaScript -->
<script src="{{ asset('adminz/assetz/vendors/d3/d3.min.js')}}"></script>
<script src="{{ asset('adminz/assetz/vendors/c3-master/c3.min.js')}}"></script>
<!-- Popup message jquery -->
<script src="{{ asset('adminz/assetz/vendors/toast-master/js/jquery.toast.js')}}"></script>
<!--Sparkline JavaScript -->
<script src="{{ asset('adminz/assetz/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Chart JS -->
<script src="{{ asset('adminz/js/dashboard1.js')}}"></script>
<!-- ============================================================== -->
<!-- Sweet-Alert  -->
<script src="{{ asset('adminz/assetz/vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('adminz/assetz/vendors/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
<!-- ============================================================== -->
@yield('scripts')
<script>
    $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
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
</body>
</html>
