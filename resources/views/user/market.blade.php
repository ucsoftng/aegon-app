@extends('layouts.mobile-user')

@section('content')

    <div class="container" style="padding-right: 0; padding-left: 0;">
        <div class="tabs tabs-pill" id="tab-group-2" style="margin: 0px 0px 0px 0px;">
            <div class="tab-controls rounded-m p-1">
                <a class="font-12 rounded-m" data-bs-toggle="collapse" href="#tab-13" aria-expanded="true">Trading Pair</a>
                <a class="font-12 rounded-m" data-bs-toggle="collapse" href="#tab-14" aria-expanded="false">Top Gainers</a>
                <a class="font-12 rounded-m" data-bs-toggle="collapse" href="#tab-15" aria-expanded="false">Top Losers</a>
            </div>
            <div class="card card-style" id="roek">
                <div class="collapse show" id="tab-13" data-bs-parent="#tab-group-2">
                    <div class="content mb-0">
                        <h3 class="font-18 mb-1">Live Trading Pairs</h3>
                        <div class="row">
                            <div class="col-6">
                                <p>Pair Name</p>
                            </div>
                            <div class="col-6">
                                <p>Min Order Price</p>
                            </div>
                        </div>
                        <hr>
                        <div id="tradingp">
                            <div id="loading" style="text-align: center !important;">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
{{--                            @foreach($trading_pairs as $t)--}}
{{--                                <div class="content" style="margin-right: 0; margin-left: 0; margin-top: 0; margin-bottom: 0;">--}}
{{--                                    <a href="{{route('pair-detail',$t->url_symbol)}}">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <div>--}}
{{--                                                <h6 class="mb-n1 opacity-80 color-highlight">{{$t->url_symbol}}</h6>--}}
{{--                                                <h4 class="mb-n1">{{$t->name}}</h4>--}}
{{--                                                <p>{{$t->description}}</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="align-self-center ms-auto">--}}
{{--                                                <h4 class="mb-n1">{{$t->minimum_order}}</h4>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <hr>--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
                <div class="collapse" id="tab-14" data-bs-parent="#tab-group-2">
                    <div class="content mb-0">
                        <h3 class="font-18 mb-1">Top Gainers</h3>
                        <div class="table-responsive">
                            <table class="table color-theme mb-2" id="topg">
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Pair</th>--}}
{{--                                    <th scope="col">Last Price</th>--}}
{{--                                    <th scope="col">24hr Change</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($gainers as $tr)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$tr->symbol}}</td>--}}
{{--                                        <td>{{number_format((float)$tr->lastPrice,4, '.','')}}</td>--}}
{{--                                        <td><span class="badge bg-success">+{{number_format((float)$tr->priceChangePercent,4, '.','')}}%</span></td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="tab-15" data-bs-parent="#tab-group-2">
                    <div class="content mb-0">
                        <h3 class="font-18 mb-1">Top Losers</h3>
                        <div class="table-responsive">
                            <table class="table color-theme mb-2" id="topl">
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Pair</th>--}}
{{--                                    <th scope="col">Last Price</th>--}}
{{--                                    <th scope="col">24hr Change</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($losers as $tr)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$tr->symbol}}</td>--}}
{{--                                        <td>{{number_format((float)$tr->lastPrice,4, '.','')}}</td>--}}
{{--                                        <td><span class="badge bg-danger">-{{number_format((float)$tr->priceChangePercent,4, '.','')}}%</span></td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-style">
{{--            <iframe src="https://www.widgets.investing.com/crypto-currency-rates?theme=darkTheme&pairs=945629,997650,1001803,1010773,1010776" width="100%" height="300" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>--}}
{{--            <hr>--}}
{{--            <div class="">--}}
{{--                <div id="tradingview_31516"></div>--}}
{{--                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>--}}
{{--                <script type="text/javascript">--}}
{{--                    new TradingView.widget(--}}
{{--                        {--}}
{{--                            "width": "350",--}}
{{--                            "height": "700",--}}
{{--                            "symbol": "BINANCE:BTCUSDT",--}}
{{--                            "interval": "1",--}}
{{--                            "timezone": "Etc/UTC",--}}
{{--                            "theme": "dark",--}}
{{--                            "style": "1",--}}
{{--                            "locale": "en",--}}
{{--                            "toolbar_bg": "#f1f3f6",--}}
{{--                            "enable_publishing": false,--}}
{{--                            "withdateranges": true,--}}
{{--                            "hide_side_toolbar": false,--}}
{{--                            "allow_symbol_change": true,--}}
{{--                            "details": true,--}}
{{--                            "hotlist": true,--}}
{{--                            "calendar": true,--}}
{{--                            "container_id": "tradingview_31516"--}}
{{--                        }--}}
{{--                    );--}}
{{--                </script>--}}
{{--            </div>--}}

        </div>
    </div>
@endsection
@section('scripts')
<script>
    const trading_pairs_url = "https://www.bitstamp.net/api/v2/trading-pairs-info";
    const tickers_url = "https://api.binance.com/api/v3/ticker/24hr";
    async function getapi(url) {
        // Storing response
        const response = await fetch(url);
        // Storing data in form of JSON
        var data = await response.json();
        if (response) {
            hideloader();
        }
        show(data);
    }
    async function getapig(url) {
        // Storing response
        const response = await fetch(url);
        // Storing data in form of JSON
        var data = await response.json();
        let sortedData = data.sort(function(a, b) {
            return  b.priceChangePercent - a.priceChangePercent;
        })
        let tsortedData = sortedData.length = 20;
        // console.log(tsortedData);
        showg(data);
    }
    async function getapiu(url) {
        // Storing response
        const response = await fetch(url);
        // Storing data in form of JSON
        var data = await response.json();
        let sortedData = data.sort(function(a, b) {
            return a.priceChangePercent - b.priceChangePercent;
        })
        let tsortedData = sortedData.length = 20;
        // console.log(tsortedData);
        showu(data);
    }
    // Calling that async function
    getapi(trading_pairs_url);
    getapig(tickers_url);
    getapiu(tickers_url);

    function hideloader() {
        document.getElementById('loading').style.display = 'none';
    }
    function show(data) {
        let tab = ``;
        var url = '{{ route("pair-detail", ":id") }}';
        // Loop to access all rows
        for (let r of data) {
            var sy = `${r.url_symbol}`;
            url = url.replace(':id', sy);
            tab +=
                `<div class="content" style="margin-right: 0; margin-left: 0; margin-top: 0; margin-bottom: 0;">
                    <a href="${url}">
                        <div class="d-flex">
                            <div>
                                <h6 class="mb-n1 opacity-80 color-highlight">${r.url_symbol}</h6>
                                <h4 class="mb-n1">${r.name}</h4>
                                <p>${r.description}</p>
                            </div>
                            <div class="align-self-center ms-auto">
                                <h4 class="mb-n1">${r.minimum_order}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>`;
             };
        // Setting innerHTML as tab variable
        document.getElementById("tradingp").innerHTML = tab;
    }
    function showu(data) {
        let tab = `<thead>
                    <tr>
                        <th scope="col">Pair</th>
                        <th scope="col">Last Price</th>
                        <th scope="col">24hr Change</th>
                    </tr>
                    </thead>
                    <tbody>`;
        // Loop to access all rows
        for (let r of data) {
            tab +=
                `<tr>
                    <td>${r.symbol}</td>
                    <td>${r.lastPrice}</td>
                    <td><span class="badge bg-danger">${r.priceChangePercent}%</span></td>
                </tr>`;
        };
        // Setting innerHTML as tab variable
        document.getElementById("topl").innerHTML = tab;
    }
    function showg(data) {
        let tab = `<thead>
                    <tr>
                        <th scope="col">Pair</th>
                        <th scope="col">Last Price</th>
                        <th scope="col">24hr Change</th>
                    </tr>
                    </thead>
                    <tbody>`;
        // Loop to access all rows
        for (let r of data) {
            tab +=
                `<tr>
                    <td>${r.symbol}</td>
                    <td>${r.lastPrice}</td>
                    <td><span class="badge bg-success">${r.priceChangePercent}%</span></td>
                </tr>`;
        };
        // Setting innerHTML as tab variable
        document.getElementById("topg").innerHTML = tab;
    }
</script>
{{--    <script type="text/javascript">--}}

{{--        function refresh_handler() {--}}
{{--            function refresh() {--}}
{{--                $.get('/user/markets', function(result) {--}}
{{--                    // $(".roek").innerHtml = result;--}}
{{--                    console.log(result);--}}
{{--                });--}}
{{--            }--}}
{{--            setInterval(refresh, 3000); //every 3 second for 30 second replace it with 30000--}}
{{--        }--}}

{{--        $(document).ready(refresh_handler);--}}

{{--    </script>--}}
@endsection