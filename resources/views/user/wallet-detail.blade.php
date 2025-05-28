@extends('layouts.mobile-user')
@section('content')
    <style>
        #container {
            height: 400px;
            min-width: 310px;
        }
        p{
            margin-bottom: 10px !important;
        }
    </style>
    <div class="container">
        <div class="row">
            <h2><img src="{{$logo ?? ""}}" alt="" style="width: 30px; height: 30px;"> {{ $basic->currency }}{{number_format((float)$rate,2)}}</h2>
        </div>

        <div class="card p-2">
{{--            <div id="container"></div>--}}
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container" style="height:100%;width:100%">
                <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "width": "100%",
                        "height": 450,
                        "symbol": "BINANCE:{{strtoupper($wallet->short)}}USDT",
                        "interval": "D",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "allow_symbol_change": true,
                        "support_host": "https://www.tradingview.com"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <hr>
        <div class="card card-style">
            <div class="row">
                <div class="col-12">
                    @if($check == true)
                        <a href="#" class="btn btn-full gradient-highlight" data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">Deposit @if($wallet->network != null)({{$wallet->network}}) @endif</a>
                    @else
                        <a href="#" class="btn btn-full gradient-red ">Unavailable</a>
                    @endif
                </div>
            </div>
            {{--            <div class="col-12">--}}
            {{--                <p>{{$wallet->tag ?? ""}}</p>--}}
            {{--            </div>--}}
        </div>
        <hr>
        <div class="tabs tabs-cards" id="tab-group-5" style="margin: 0px 0px 0px 0px;">
            <div class="tab-controls">
                <a class="font-13" data-bs-toggle="collapse" href="#tab-13" aria-expanded="true">1d</a>
                {{--                <a class="font-13" data-bs-toggle="collapse" href="#tab-14" aria-expanded="false">30d</a>--}}
            </div>
            <div class="card card-style" id="roek">
                <div class="collapse show" id="tab-13" data-bs-parent="#tab-group-5">
                    <div class="content mb-0">
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <p>High 24h</p>
                                <h6>{{$detail->high_24h ?? $wallet->crypto_rate}}</h6>
                            </div>
                            <div class="col-6" style="text-align: center;">
                                <p>Low 24h</p>
                                <h6>{{$detail->low_24h ?? ($wallet->crypto_rate - 0.2) }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <p>Price Change</p>
                                <h6>{{$detail->price_change_24h ?? "1.00"}}</h6>
                            </div>
                            <div class="col-6" style="text-align: center;">
                                <p>Price Change %</p>
                                <h6>{{$detail->price_change_percent_24h ?? "1.00"}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" style="text-align: center;">
                                <p>Market Cap Change</p>
                                <h6>{{$detail->market_cap_change_24h}}</h6>
                            </div>
                            <div class="col-6" style="text-align: center;">
                                <p>Market Cap Change %</p>
                                <h6>{{$detail->market_cap_change_percentage_24h}}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="collapse" id="tab-14" data-bs-parent="#tab-group-5">--}}
                {{--                    <div class="content mb-0">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Volume</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->volume}}</h6>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Volume Change %</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->volume_change_pct}}</h6>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Price Change</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->price_change}}</h6>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Price Change %</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->price_change_pct}}</h6>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Market Cap Change</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->market_cap_change}}</h6>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-6" style="text-align: center;">--}}
                {{--                                <p>Market Cap Change %</p>--}}
                {{--                                <h6>{{$detail[0]->$dd->market_cap_change_pct}}</h6>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
@section('sheets')
    @if($check == true)
        <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
            <div class="content">
                <form method="post" action="{{route('add-fund')}}">
                    @csrf
                    <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Enter Amount to Deposit($)</h5>
                    <br>
                    <div class="form-custom form-label form-icon mb-3 bg-transparent">
                        <i class="bi bi-cash font-13"></i>
                        <input type="number" class="form-control rounded-xs" name="amount" placeholder="Amount" required />
                        <label for="c1" class="color-theme">Amount</label>
                        <span>(required)</span>
                    </div>
                    <input type="hidden" name="payment_type" id="payment_type" value="{{$wallet->id}}">
                    <input type="hidden" name="rate" value="{{ $wallet->rate }}">
                    <input type="hidden" name="fix" value="{{ $wallet->fix }}">
                    <input type="hidden" name="percent" value="{{ $wallet->percent }}">
                    <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                    <div class="row">
                        <input type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4" value="Proceed" id="proceed">
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/data.js"></script>
    <script src="https://code.highcharts.com/stock/modules/drag-panes.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
    <script>
        Highcharts.getJSON('https://api.binance.com/api/v3/klines?symbol={{strtoupper($wallet->short)}}USDT&interval=1m&limit=1000', function (data) {

            // split the data set into ohlc and volume
            var ohlc = [],
                volume = [],
                dataLength = data.length,
                // set the allowed units for data grouping
                groupingUnits = [[
                    'week',             // unit name
                    [1]               // allowed multiples
                ], [
                    'month',
                    [1, 2, 3, 4, 6]
                ]],

                i = 0;

            for (i; i < dataLength; i += 1) {
                ohlc.push([
                    parseInt(data[i][0]), // the date
                    parseInt(data[i][1]), // open
                    parseInt(data[i][2]), // high
                    parseInt(data[i][3]), // low
                    parseInt(data[i][4]) // close
                ]);

                volume.push([
                    parseInt(data[i][0]), // the date
                    parseInt(data[i][5]) // the volume
                ]);
            }


            // create the chart
            Highcharts.stockChart('container', {

                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: '{{$wallet->name}}'
                },

                yAxis: [{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'OHLC'
                    },
                    height: '60%',
                    lineWidth: 2,
                    resize: {
                        enabled: true
                    }
                }, {
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Volume'
                    },
                    top: '65%',
                    height: '35%',
                    offset: 0,
                    lineWidth: 2
                }],

                tooltip: {
                    split: true
                },

                series: [{
                    type: 'candlestick',
                    name: '{{$wallet->name}}',
                    data: ohlc,
                    dataGrouping: {
                        units: groupingUnits
                    }
                }, {
                    type: 'column',
                    name: 'Volume',
                    data: volume,
                    yAxis: 1,
                    dataGrouping: {
                        units: groupingUnits
                    }
                }]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#proceed").click(function (event) {
                $('#proceed').val('Processing …');
                $('#submit').submit();
            });
        });
    </script>
@endsection