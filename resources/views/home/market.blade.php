@extends('layouts.front')
@section('content')

    <section class="aabout-us p_100">
        <div class="container">
            <div class="aabout-us-details">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Crypto currency <span class="text-theme">live prices</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="price-dv wow fadeInUp" data-wow-delay=".3s">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22COINBASE%3AETHUSD%22%2C%22width%22%3A%22285%22%2C%22height%22%3A%22200%22%2C%22dateRange%22%3A%2212m%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22www.affinityassurance.ltd%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box; height: 200px; width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="price-dv clr2 wow fadeInUp" data-wow-delay=".4s">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22COINBASE%3ABTCUSD%22%2C%22width%22%3A%22285%22%2C%22height%22%3A%22200%22%2C%22dateRange%22%3A%2212m%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22www.affinityassurance.ltd%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box; height: 200px; width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="price-dv clr3 wow fadeInUp" data-wow-delay=".5s">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22KRAKEN%3ALTCUSD%22%2C%22width%22%3A350%2C%22height%22%3A220%2C%22dateRange%22%3A%2212M%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22127.0.0.1%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box;height: 200px;width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="price-dv clr4 wow fadeInUp" data-wow-delay=".5s">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22FTX%3ATRXUSD%22%2C%22width%22%3A350%2C%22height%22%3A220%2C%22dateRange%22%3A%2212M%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22127.0.0.1%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box; height: 200px; width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Advanced <span class="text-theme">real-time</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="tradingview-widget-container">
                            <div id="tradingview_9764a"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/symbols/BTCUSD/?exchange=BITBAY" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                            <script type="text/javascript">
                                new TradingView.widget(
                                    {
                                        "width": "100%",
                                        "height": 500,
                                        "symbol": "BITSTAMP:BTCUSD",
                                        "interval": "D",
                                        "timezone": "Etc/UTC",
                                        "theme": "dark",
                                        "style": "1",
                                        "locale": "in",
                                        "toolbar_bg": "#f1f3f6",
                                        "enable_publishing": false,
                                        "withdateranges": true,
                                        "allow_symbol_change": true,
                                        "details": true,
                                        "hotlist": true,
                                        "calendar": true,
                                        "container_id": "tradingview_9764a"
                                    }
                                );
                            </script>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Technical <span class="text-theme">analysis</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/symbols/NASDAQ-AAPL/technicals/" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                                {
                                    "interval": "1D",
                                    "width": "100%",
                                    "isTransparent": false,
                                    "height": "450",
                                    "symbol": "NASDAQ:AAPL",
                                    "showIntervalTabs": true,
                                    "locale": "in",
                                    "colorTheme": "dark"
                                }
                            </script>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                                {
                                    "colorTheme": "dark",
                                    "dateRange": "12M",
                                    "showChart": true,
                                    "locale": "in",
                                    "width": "100%",
                                    "height": "100%",
                                    "largeChartUrl": "",
                                    "isTransparent": false,
                                    "showSymbolLogo": true,
                                    "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
                                    "plotLineColorFalling": "rgba(33, 150, 243, 1)",
                                    "gridLineColor": "rgba(240, 243, 250, 1)",
                                    "scaleFontColor": "rgba(120, 123, 134, 1)",
                                    "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
                                    "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
                                    "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
                                    "tabs": [
                                    {
                                        "title": "Indices",
                                        "symbols": [
                                            {
                                                "s": "BITBAY:BTCUSD",
                                                "d": "BTC/USD"
                                            },
                                            {
                                                "s": "KRAKEN:BCHUSD",
                                                "d": "BCH/USD"
                                            },
                                            {
                                                "s": "KRAKEN:LTCUSD",
                                                "d": "LTC/USD"
                                            },
                                            {
                                                "s": "KRAKEN:ETHUSD",
                                                "d": "ETH/USD"
                                            },
                                            {
                                                "s": "FTX:TRXUSD",
                                                "d": "Tron/USD"
                                            },
                                            {
                                                "s": "BITKUB:USDTTHB",
                                                "d": "Tether"
                                            }
                                        ],
                                        "originalTitle": "Indices"
                                    },
                                    {
                                        "title": "Commodities",
                                        "symbols": [
                                            {
                                                "s": "CME_MINI:ES1!",
                                                "d": "S&P 500"
                                            },
                                            {
                                                "s": "CME:6E1!",
                                                "d": "Euro"
                                            },
                                            {
                                                "s": "COMEX:GC1!",
                                                "d": "Gold"
                                            },
                                            {
                                                "s": "NYMEX:CL1!",
                                                "d": "Crude Oil"
                                            },
                                            {
                                                "s": "NYMEX:NG1!",
                                                "d": "Natural Gas"
                                            },
                                            {
                                                "s": "CBOT:ZC1!",
                                                "d": "Corn"
                                            }
                                        ],
                                        "originalTitle": "Commodities"
                                    },
                                    {
                                        "title": "Bonds",
                                        "symbols": [
                                            {
                                                "s": "CME:GE1!",
                                                "d": "Eurodollar"
                                            },
                                            {
                                                "s": "CBOT:ZB1!",
                                                "d": "T-Bond"
                                            },
                                            {
                                                "s": "CBOT:UB1!",
                                                "d": "Ultra T-Bond"
                                            },
                                            {
                                                "s": "EUREX:FGBL1!",
                                                "d": "Euro Bund"
                                            },
                                            {
                                                "s": "EUREX:FBTP1!",
                                                "d": "Euro BTP"
                                            },
                                            {
                                                "s": "EUREX:FGBM1!",
                                                "d": "Euro BOBL"
                                            }
                                        ],
                                        "originalTitle": "Bonds"
                                    },
                                    {
                                        "title": "Forex",
                                        "symbols": [
                                            {
                                                "s": "FX:EURUSD"
                                            },
                                            {
                                                "s": "FX:GBPUSD"
                                            },
                                            {
                                                "s": "FX:USDJPY"
                                            },
                                            {
                                                "s": "FX:USDCHF"
                                            },
                                            {
                                                "s": "FX:AUDUSD"
                                            },
                                            {
                                                "s": "FX:USDCAD"
                                            }
                                        ],
                                        "originalTitle": "Forex"
                                    }
                                ]
                                }
                            </script>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Cryptocurrency <span class="text-theme">market</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/cryptocurrencies/prices-all/" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                                {
                                    "width": "100%",
                                    "height": "500",
                                    "defaultColumn": "overview",
                                    "screener_type": "crypto_mkt",
                                    "displayCurrency": "USD",
                                    "colorTheme": "dark",
                                    "locale": "in"
                                }
                            </script>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Forex <span class="text-theme">cross rates</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/currencies/forex-cross-rates/" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
                                {
                                    "width": "100%",
                                    "height": 500,
                                    "currencies": [
                                    "EUR",
                                    "USD",
                                    "JPY",
                                    "GBP",
                                    "CHF",
                                    "AUD",
                                    "CAD",
                                    "NZD",
                                    "CNY"
                                ],
                                    "isTransparent": false,
                                    "colorTheme": "dark",
                                    "locale": "in"
                                }
                            </script>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="row my-5">
                    <div class="col-md-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Crypto currency <span class="text-theme">screener</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="tradingview-widget-container" style="margin: 0 auto;">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/crypto-screener/" rel="noopener" target="_blank"></a></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
                                {
                                    "width": "100%",
                                    "height": "500",
                                    "defaultColumn": "overview",
                                    "defaultScreen": "ath",
                                    "market": "crypto",
                                    "showToolbar": true,
                                    "colorTheme": "dark",
                                    "locale": "in"
                                }
                            </script>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection