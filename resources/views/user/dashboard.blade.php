@extends('layouts.mobile-user')

@section('content')
    <style>
        .coinPriceBlock__title {
            color: #747474 !important;
        }
    </style>
    <div class="container" style="padding-right: 10px; padding-left: 10px; padding-top: 0;">
        <div class="card mb-3" style="background-color: #1879be; border-radius: 30px;">
            <div class="card-body direction-rtl p-4">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="profile"
                             style="width: 50px; border-radius: 100px;">
                    </div>
                    <div class="col-6">
                        <span id="lblGreetings" class="text-white"></span> <span
                                class="text-white">{{Auth::user()->name}}</span>
                    </div>
                </div>
                <hr style="color: white !important;">
                <p class="mb-1 text-white text-center">My Portfolio Balance</p>
                <h2 class="text-white text-center"><b>$ {{ number_format( $member->amount,2 ) }}</b></h2>
                <hr>
                <div class="d-flex">
{{--                    <div>--}}
{{--                        <p class="mb-1 text-dark text-center">Deposit</p>--}}
{{--                        <h4 class="mb-n1 text-dark">${{number_format($fund)}}</h4>--}}
{{--                    </div>--}}
                    <div>
                        <p class="mb-1 text-white text-center">Trade</p>
                        <h4 class="mb-n1 text-white">$ {{number_format($current_deposit)}}</h4>
                    </div>
{{--                    <div class="align-self-center ms-auto">--}}
{{--                        <p class="mb-1 text-dark text-center">Trade</p>--}}
{{--                        <h4 class="mb-n1 text-dark">$ {{number_format($current_deposit)}}</h4>--}}
{{--                    </div>--}}
                    <div class="align-self-center ms-auto">
                        <p class="mb-1 text-white text-center">Profit</p>
                        <h4 class="mb-n1 text-white">$ {{number_format($total_rebeat)}}</h4>
                    </div>
                    <div class="align-self-center ms-auto">
                        <p class="mb-1 text-white text-center">Withdrawals</p>
                        <h4 class="mb-n1 text-white">$ {{number_format($total_withdraw)}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container direction-rtl">
        <div class="card card-style mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-3">
                        <a href="{{ route('wallets') }}">
                            <div class="feature-card mx-auto text-center">
                                {{--                                    <div class="card mx-auto" style="border: 0!important;">--}}
                                <i class="bi bi-wallet2 font-32" style="color: #1879be;"></i>
                                {{--                                    </div>--}}
                                <h6 class="mb-0">Wallet</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('trade') }}">
                            <div class="feature-card mx-auto text-center">
                                <i class="bi bi-bar-chart-line font-32" style="color: #1879be;"></i>
                                <h6 class="mb-0">Trade</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('repeat-history') }}">
                            <div class="feature-card mx-auto text-center">
                                <i class="bi bi-folder-plus font-32" style="color: #1879be;"></i>
                                <h6 class="mb-0">Profit</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('reference-user') }}">
                            <div class="feature-card mx-auto text-center">
                                <i class="bi bi-person-plus font-32" style="color: #1879be;"></i>
                                <h6 class="mb-0">Referral</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3">
        <div class="card card-style">
            <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinPriceBlock.js"></script><div id="coinmarketcap-widget-coin-price-block" coins="1,1027,825" currency="USD" theme="light" transparent="true" show-symbol-logo="true"></div>
            {{--            <script src="https://widgets.coingecko.com/coingecko-coin-market-ticker-list-widget.js"></script>--}}
            {{--            <coingecko-coin-market-ticker-list-widget  coin-id="bitcoin" currency="usd" locale="en"></coingecko-coin-market-ticker-list-widget>--}}
        </div>
    </div>
    {{--        <div class="spinner-border"--}}
    {{--             role="status" id="loading">--}}
    {{--            <span class="sr-only"></span>--}}
    {{--        </div>--}}

    <style>
        a.cg-showmore {
            display: none !important;
        }
    </style>
    <div class="pb-3"></div>
    <div class="card card-style">
        <div class="card-header">
            <h4>Recent Transactions</h4>
        </div>
        <div class="card-body">
            @foreach($activity as $p)
                <div class="">
                    <div class="d-flex mt-n2 ms-3">
                            <span class="badge text-uppercase px-2 py-1 @if($p->balance_type == 4) gradient-red @elseif($p->balance_type == 2) gradient-red @else gradient-green @endif text-black"
                                  style="line-height: normal; padding-top: 6px !important;">
                                @if($p->balance_type == 1)
                                    Wallet Add
                                @elseif($p->balance_type == 2)
                                    Bot Trade
                                @elseif($p->balance_type == 3)
                                    Profit
                                @elseif($p->balance_type == 4)
                                    Withdraw
                                @elseif($p->balance_type == 5)
                                    Referral
                                @elseif($p->balance_type == 7)
                                    Refund
                                @elseif($p->balance_type == 8)
                                    Deposit
                                @elseif($p->balance_type == 10)
                                    Live Trade
                                @elseif($p->balance_type == 11)
                                    Bot Trading Top Up
                                @endif
                            </span>
                        <h6 class="align-self-center ms-auto">
                            {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y h:i A') }}
                        </h6>
                    </div>
                    <div class="content" style="margin: 10px;">
                        <div class="d-flex">
                            <div>
                                @if($p->balance_type == 1)
                                    <img src="{{asset('mobile/images/wallet.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 2)
                                    <img src="{{asset('mobile/images/trade.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 3)
                                    <img src="{{asset('mobile/images/profit.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 4)
                                    <img src="{{asset('mobile/images/withdraw.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 5)
                                    <img src="{{asset('mobile/images/refer.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 7)
                                    <img src="{{asset('mobile/images/refund.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 8)
                                    <img src="{{asset('mobile/images/wallet.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 10)
                                    <img src="{{asset('mobile/images/trade.png')}}" style="width: 25px;">
                                @elseif($p->balance_type == 11)
                                    <img src="{{asset('mobile/images/dept.png')}}" style="width: 25px;">
                                @endif
                            </div>
                            <div class="align-self-center ms-auto">
                                <h5>{{ $basic->currency }}{{ $p->balance }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @if($loop->last)
                @else
                    <div class="divider"></div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
    <script>
        var myDate = new Date();
        var hrs = myDate.getHours();

        var greet;

        if (hrs < 12)
            greet = 'Good Morning';
        else if (hrs >= 12 && hrs <= 17)
            greet = 'Good Afternoon';
        else if (hrs >= 17 && hrs <= 24)
            greet = 'Good Evening';

        document.getElementById('lblGreetings').innerHTML =
            '<b>' + greet + '</b>';
    </script>
    {{--    <script>--}}
    {{--        const news_url = "https://newsapi.org/v2/everything?q=btc&apiKey=dc47f2d8143a4a24b6935f7ea7413c63&pageSize=1";--}}
    {{--        async function getapi(url) {--}}

    {{--            // Storing response--}}
    {{--            const response = await fetch(url);--}}
    {{--            // Storing data in form of JSON--}}
    {{--            var data = await response.json();--}}
    {{--            console.log(data.articles);--}}
    {{--            if (response) {--}}
    {{--                hideloader();--}}
    {{--            }--}}
    {{--            show(data);--}}
    {{--        }--}}
    {{--        // Calling that async function--}}
    {{--        getapi(news_url);--}}

    {{--        function hideloader() {--}}
    {{--            document.getElementById('loading').style.display = 'none';--}}
    {{--        }--}}
    {{--        function show(data) {--}}
    {{--            let tab = ``;--}}
    {{--            // Loop to access all rows--}}
    {{--            for (let r of data.articles) {--}}
    {{--                tab +=--}}
    {{--                    `<div class="splide__slide">--}}
    {{--                        <div class="card card-style mx-0 shadow-card shadow-card-m bg-14" data-card-height="230">--}}
    {{--                            <div class="card-bottom pb-3 px-3">--}}
    {{--                                <h3 class="color-white mb-1">${r.title}</h3>--}}
    {{--                            </div>--}}
    {{--                            <div class="card-overlay" style="background-image: url('${r.urlToImage}')"></div>--}}
    {{--                        </div>--}}
    {{--                    </div>`;--}}
    {{--                 };--}}
    {{--            // Setting innerHTML as tab variable--}}
    {{--            document.getElementById("splide1").innerHTML = tab;--}}
    {{--        }--}}
    {{--    </script>--}}

    {{--    <script>--}}
    {{--        const baseCurrencys = ['EUR', 'USD', 'GBP'];--}}
    {{--        const baseCur = Math.floor(Math.random() * baseCurrencys.length);--}}
    {{--        const bbCur = (baseCur, baseCurrencys[baseCur]);--}}
    {{--        console.log(bbCur);--}}
    {{--        const settings = {--}}
    {{--            "async": true,--}}
    {{--            "crossDomain": true,--}}
    {{--            "url": "https://twelve-data1.p.rapidapi.com/forex_pairs?currency_base="+bbCur+"&format=json",--}}
    {{--            "method": "GET",--}}
    {{--            "headers": {--}}
    {{--                "X-RapidAPI-Key": "799c39329fmsh368ea968648e42dp10d1b1jsna79098000e92",--}}
    {{--                "X-RapidAPI-Host": "twelve-data1.p.rapidapi.com"--}}
    {{--            }--}}
    {{--        };--}}

    {{--        $.ajax(settings).done(function (response) {--}}
    {{--            console.log(response);--}}
    {{--        });--}}
    {{--    </script>--}}
    <script>

    </script>
@endsection