<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('dash/assets/vendors/core/core.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('dash/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('dash/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('dash/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('dash/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- endinject -->
    <!--alerts CSS -->
    <link href="{{ asset('dashboard/dash/vendors/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('dash/assets/css/demo_1/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images') }}/{{ $general->favicon }}" />
</head>
<body class="sidebar-dark" style="font-family: Montserrat, system-ui !important;">
<div class="main-wrapper">

    @include('layouts.partials.user-sidebar')

    <div class="page-wrapper">

        @include('layouts.partials.navbar')
        <div class="page-content">
            @yield('content')
        </div>

        <!-- partial:partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © @php echo date('Y'); @endphp {{$site_title}}. All rights reserved</p>
        </footer>
        <!-- partial -->

    </div>
</div>

<!-- core:js -->
<script src="{{asset('dash/assets/vendors/core/core.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{asset('dash/assets/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('dash/assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{asset('dash/assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('dash/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('dash/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('dash/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('dash/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('dash/assets/js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{asset('dash/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('dash/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<!-- end plugin js for this page -->
<!-- custom js for this page -->
<script src="{{asset('dash/assets/js/dashboard.js')}}"></script>
<script src="{{asset('dash/assets/js/datepicker.js')}}"></script>
<!-- Sweet-Alert  -->
<script src="{{asset('dash/assets/js/data-table.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('dashboard/dash/vendors/sweetalert/jquery.sweet-alert.custom.js')}}"></script>

<!-- end custom js for this page -->
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
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = 'c5b98c4b0b09e3eb097dc4e8d17dcfde32d21d8c';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
</script>
</body>
</html>
