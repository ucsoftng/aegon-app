@if(Request::is('/'))
    <!-- Start Cryptocurrency Banner Area -->
    <div class="cryptocurrency-banner-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="cryptocurrency-banner-content">
                        <span class="sub-title">INVEST IN CRYPTOCURRENCIES</span>
                        <h1>Trade and Invest <span>Cryptocurrencies</span></h1>
                        <p>On the heels of a meteoric bull run, the crypto markets now are on all time high. Our job is to identify early stage cryptocurrencies with a high probability for success before there is any retail hype around them.</p>

                        <ul class="banner-btn">
                            <li>
                                <a href="{{route('register')}}" class="default-btn">
                                    Get Started <span></span>
                                </a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="{{asset('front/affinity.mp4')}}" class="video-btn popup-youtube">--}}
{{--                                    <i class="flaticon-play-button"></i>--}}
{{--                                    Play Video--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="cryptocurrency-banner-image">
                        <img src="{{asset('front/img/cryptocurrency-home/banner/main.png')}}" alt="image">

                        <div class="cart1">
                            <img src="{{asset('front/img/cryptocurrency-home/banner/cart1.png')}}" alt="cart1">
                        </div>
                        <div class="cart2">
                            <img src="{{asset('front/img/cryptocurrency-home/banner/cart2.png')}}" alt="cart2">
                        </div>
                        <div class="graph">
                            <img src="{{asset('front/img/cryptocurrency-home/banner/graph.png')}}" alt="graph">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cryptocurrency-shape-1">
            <img src="{{asset('front/img/cryptocurrency-home/banner/icon1.png')}}" alt="image">
        </div>
        <div class="cryptocurrency-shape-2">
            <img src="{{asset('front/img/cryptocurrency-home/banner/icon2.png')}}" alt="image">
        </div>
        <div class="cryptocurrency-shape-3">
            <img src="{{asset('front/img/cryptocurrency-home/banner/icon3.png')}}" alt="image">
        </div>
        <div class="cryptocurrency-shape-4">
            <img src="{{asset('front/img/cryptocurrency-home/banner/icon4.png')}}" alt="image">
        </div>
    </div>
    <!-- End Cryptocurrency Banner Area -->

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
@else
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>{{$page_title}}</h2>

                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>{{$page_title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape-img2"><img src="{{asset('front/img/shape/2.svg')}}" alt="image"></div>
        <div class="shape-img3"><img src="{{asset('front/img/shape/3.svg')}}" alt="image"></div>
        <div class="shape-img4"><img src="{{asset('front/img/shape/4.png')}}" alt="image"></div>
        <div class="shape-img5"><img src="{{asset('front/img/shape/5.png')}}" alt="image"></div>
        <div class="shape-img7"><img src="{{asset('front/img/shape/7.png')}}" alt="image"></div>
        <div class="shape-img8"><img src="{{asset('front/img/shape/8.png')}}" alt="image"></div>
        <div class="shape-img9"><img src="{{asset('front/img/shape/9.png')}}" alt="image"></div>
        <div class="shape-img10"><img src="{{asset('front/img/shape/10.png')}}" alt="image"></div>
    </div>
@endif