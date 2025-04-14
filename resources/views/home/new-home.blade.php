@extends('layouts.front')
@section('content')
    <!-- Start Stats Area -->
    <div class="stats-area pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="stats-fun-fact-box text-center">
                        <div class="stats-image">
                            <img src="{{asset('front/img/cryptocurrency-home/stats/stats-1.png')}}" alt="image">
                        </div>
                        <h3>$500m</h3>
                        <span>Yearly Volume Traded</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="stats-fun-fact-box text-center">
                        <div class="stats-image">
                            <img src="{{asset('front/img/cryptocurrency-home/stats/stats-2.png')}}" alt="image">
                        </div>
                        <h3>15K+</h3>
                        <span>Increased Verified Users</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="stats-fun-fact-box text-center">
                        <div class="stats-image">
                            <img src="{{asset('front/img/cryptocurrency-home/stats/stats-3.png')}}" alt="image">
                        </div>
                        <h3>95%</h3>
                        <span>Our Conversion Rate</span>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="stats-fun-fact-box text-center">
                        <div class="stats-image">
                            <img src="{{asset('front/img/cryptocurrency-home/stats/stats-4.png')}}" alt="image">
                        </div>
                        <h3>400 K+</h3>
                        <span>Daily Transactions</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Stats Area -->

    <!-- Start Crypto About Area -->
    <div class="crypto-about-area pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="crypto-about-image">
                        <img src="{{asset('front/img/cryptocurrency-home/about.png')}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="crypto-about-content">
                        <span class="sub-title">ABOUT OUR COMPANY</span>
                        <h3>Welcome to <span>Trading Advanced Platform Systems</span> Limited</h3>
                        <p class="text-justify">
                            We understand that decentralized cryptocurrencies like Bitcoin and Ethereum will change the way the world views and uses money so, we are spearheading a new financial system being built in real-time, and we believe this new worldwide crypto financial system will accelerate humanity for a long time into the future.
                        </p>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i> Weekly Payouts To Your Wallet</li>
                            <li><i class="fa-solid fa-check"></i> Deposit And Withdraw Anytime</li>
                            <li><i class="fa-solid fa-check"></i> No Lock-in Periods Or Minimum Deposits</li>
                            <li><i class="fa-solid fa-check"></i> Standard <span> and Secured Trading Servers</span></li>
                        </ul>
                        <div class="about-btn">
                            <a href="{{route('register')}}" class="default-btn">
                                Get Started <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Crypto About Area -->

    <!-- Start Earning Platform Area -->
    <div class="earning-platform-area pt-100 pb-70">
        <div class="container">
            <div class="section-title with-linear-gradient-text">
                <span class="sub-title">CRYPTO EARNING PLATFORM</span>
                <h2>APY Rates And Custody <span>Cover Puts</span> Your Crypto To Work</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="earning-platform-card text-center">
                        <div class="earning-image">
                            <img src="{{asset('front/img/cryptocurrency-home/earning/earning-1.png')}}" alt="image">
                        </div>
                        <h3>Easy To Transact</h3>
                        <p>We take the power of trading with you from any location, on any device, at any time you wish.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="earning-platform-card text-center">
                        <div class="earning-image">
                            <img src="{{asset('front/img/cryptocurrency-home/earning/earning-2.png')}}" alt="image">
                        </div>
                        <h3>Trusted Security</h3>
                        <p>We take security seriously with a range of fraud protection involving a lower level of risks.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="earning-platform-card text-center">
                        <div class="earning-image">
                            <img src="{{asset('front/img/cryptocurrency-home/earning/earning-3.png')}}" alt="image">
                        </div>
                        <h3>Credibility</h3>
                        <p>A key barrier to adoption of trading is concerns about the trustworthiness of the system.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="earning-platform-card text-center">
                        <div class="earning-image">
                            <img src="{{asset('front/img/cryptocurrency-home/earning/earning-4.png')}}" alt="image">
                        </div>
                        <h3>No Expensive Software</h3>
                        <p>Customer satisfaction is a top priority for our dedicated technical support team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Earning Platform Area -->

    <!-- Start Crypto Get Strated Area -->
    <div class="crypto-get-strated-area">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="crypto-get-strated-image">
{{--                        <iframe class="responsive-iframe" src="{{asset('front/affinity.mp4')}}" style="width: 350px;"></iframe>--}}
                                                <img src="{{asset('front/img/cryptocurrency-home/get-strated/get-strated.png')}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="crypto-get-strated-content">
                        <div class="content">
                            <span>GET STARTED IN MINUTES</span>
                            <h3>Get Started In A Few Minutes With Our Crypto Platform</h3>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-sm-6">
                                <div class="crypto-get-strated-card">
                                    <div class="get-image">
                                        <img src="{{asset('front/img/cryptocurrency-home/get-strated/icon1.png')}}" alt="image">
                                    </div>
                                    <h3>Create Account</h3>
                                    <p>Click <a href="{{route('register')}}">here</a> to register or <a href="{{route('login')}}"> Login</a> to access account. Please make sure to verify your email. </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="crypto-get-strated-card">
                                    <div class="get-image">
                                        <img src="{{asset('front/img/cryptocurrency-home/get-strated/icon2.png')}}" alt="image">
                                    </div>
                                    <h3>Deposit and Invest</h3>
                                    <p>Deposit Into your account, Select an Investment Plan of Your Choice and Invest. Then Sit back and Relax.</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="crypto-get-strated-card">
                                    <div class="get-image">
                                        <img src="{{asset('front/img/cryptocurrency-home/get-strated/icon3.png')}}" alt="image">
                                    </div>
                                    <h3>Withdrawal</h3>
                                    <p>At Plan runtime completion, You can make a withdrawal or recompound/ reinvest your earnings.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="crypto-get-strated-shape">
            <img src="{{asset('front/img/cryptocurrency-home/get-strated/shape.png')}}" alt="image">
        </div>
    </div>
    <!-- End Crypto Get Strated Area -->

    <!-- Start Key Features Area -->
    <div class="key-features-area pt-100 pb-70">
        <div class="container">
            <div class="section-title with-linear-gradient-text">
                <span class="sub-title">KEY FEATURES</span>
                <h2>Simple & Secure Access To <span>Invest</span> And Trade Cryptocurrency</h2>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="key-features-card">
                        <div class="key-content">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon1.png')}}" alt="icon">
                            </div>
                            <h3>SAFE AND SECURE</h3>
                            <p>We offer equity guarantee and full capital insurance for each members funds.</p>
                        </div>

                        <div class="key-content right-gap">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon2.png')}}" alt="icon">
                            </div>
                            <h3>INSTANT TRADING</h3>
                            <p>Accurate trading and accountability</p>
                        </div>

                        <div class="key-content">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon3.png')}}" alt="icon">
                            </div>
                            <h3>CONSISTENT RETURNS</h3>
                            <p>Our fully diversified investment portfolio makes it possible to maintain consistency in investor's ROI.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="key-features-card">
                        <div class="key-image">
                            <img src="{{asset('front/img/cryptocurrency-home/key-image.png')}}" alt="image">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="key-features-card">
                        <div class="key-content">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon4.png')}}" alt="icon">
                            </div>
                            <h3>REFERRAL BONUS</h3>
                            <p>Earn a referral bonus of 6% on the investment sum of each person you refer. We have several affiliate plans too.</p>
                        </div>

                        <div class="key-content left-gap">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon5.png')}}" alt="icon">
                            </div>
                            <h3>24/7 SUPPORT</h3>
                            <p>We provide 24/7 friendly support. We're always responsible to take care.</p>
                        </div>

                        <div class="key-content">
                            <div class="icon-image">
                                <img src="{{asset('front/img/cryptocurrency-home/key-features/icon6.png')}}" alt="icon">
                            </div>
                            <h3>GET INSTANT WITHDRAWALS</h3>
                            <p>Get your payment instantly upon making your withdrawal request.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Key Features Area -->

    <!-- Start Mining Area -->
    <div class="mining-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="btcwdgt-chart" bw-theme="dark">
                        <script>
                            (function(b,i,t,C,O,I,N) {
                                window.addEventListener('load',function() {
                                    if(b.getElementById(C))return;
                                    I=b.createElement(i),N=b.getElementsByTagName(i)[0];
                                    I.src=t;I.id=C;N.parentNode.insertBefore(I, N);
                                },false)
                            })(document,'script','//widgets.bitcoin.com/widget.js','btcwdgt');
                        </script>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="mining-content">
                        <span class="sub-title">Cryptocurrency Investments</span>
                        <h3>Bitcoin</h3>
                        <p>Bitcoin is a cryptocurrency and worldwide payment system. It is the first decentralized digital currency, as the system works without a central bank or single administrator. The network is peer-to-peer and transactions take place between users directly.</p>

                        <ul class="mining-btn">
                            <li>
                                <a href="{{route('login')}}" class="default-btn">
                                    Get Started <span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mining Area -->

    <!-- Start Trade Over Area -->
    <div class="trade-over-area pb-100">
        <div class="container">
            <div class="section-title with-linear-gradient-text">
                <span class="sub-title">TRADE AND INVEST CRYPTO</span>
                <h2>Start Trading & Earning <span>Interests On</span> Any Amount Of Crypto</h2>
            </div>

            <div class="trade-over-inner-box pt-100 pb-70">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="trade-over-card">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22COINBASE%3AETHUSD%22%2C%22width%22%3A%22285%22%2C%22height%22%3A%22200%22%2C%22dateRange%22%3A%2212m%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22www.affinityassurance.ltd%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box; height: 200px; width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="trade-over-card">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22COINBASE%3ABTCUSD%22%2C%22width%22%3A%22285%22%2C%22height%22%3A%22200%22%2C%22dateRange%22%3A%2212m%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22www.affinityassurance.ltd%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box; height: 200px; width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="trade-over-card">
                            <div class="price-info">
                                <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://s.tradingview.com/embed-widget/mini-symbol-overview/?locale=in#%7B%22symbol%22%3A%22KRAKEN%3ALTCUSD%22%2C%22width%22%3A350%2C%22height%22%3A220%2C%22dateRange%22%3A%2212M%22%2C%22colorTheme%22%3A%22dark%22%2C%22trendLineColor%22%3A%22%2337a6ef%22%2C%22underLineColor%22%3A%22rgba(55%2C%20166%2C%20239%2C%200.15)%22%2C%22isTransparent%22%3Afalse%2C%22autosize%22%3Afalse%2C%22largeChartUrl%22%3A%22%22%2C%22utm_source%22%3A%22127.0.0.1%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22mini-symbol-overview%22%7D" style="box-sizing: border-box;height: 200px;width: 100%;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Trade Over Area -->

    <!-- Start Why Choose Us Area -->
    <div class="why-choose-us-area pt-100 pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-content">
                        {{--                        <h3>Invest Your Crypto And <span>Start Earning</span> Immediately</h3>--}}
                        <p class="text-justify">
                            It is difficult to imagine a successful investment company without additional advantages for partners in the form of a reward for attracting investment capital into trust management. Currently, this is the most common type of promotion of services, which allows not only to reduce advertising costs for the company, but also provides an opportunity for additional earnings to customers. We want to connect exceptional talent and technology with the people who can benefit from it the most.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="row choose-with-box-style">
                        <div class="currency-calculator sp-one">
                            <crypto-converter-widget shadow symbol live background-color="#383a59" border-radius="0.60rem" fiat="united-states-dollar" crypto="bitcoin" amount="1" decimal-places="2"></crypto-converter-widget>
                            <a href="https://currencyrate.today/" target="_blank" rel="noopener">CurrencyRate.Today</a>
                            <script async src="https://cdn.jsdelivr.net/gh/dejurin/crypto-converter-widget@1.5.2/dist/latest.min.js"></script>
                            <!-- /Crypto Converter ⚡ Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Area -->

    <!-- Start Unique Feedback Area -->
    <div class="unique-feedback-area pt-100">
        <div class="container">
            <div class="section-title with-linear-gradient-text">
                <span class="sub-title">CREATING FEEDBACK</span>
                <h2>These People Have Already Invested In Our Platform</h2>
            </div>

            <div class="unique-feedback-slides owl-carousel owl-theme">
                @foreach($testimonial as $t)
                    <div class="unique-single-feedback">
                        <ul class="rating">
                            <li><i class='bx bxs-star'></i></li>
                            <li><i class='bx bxs-star'></i></li>
                            <li><i class='bx bxs-star'></i></li>
                            <li><i class='bx bxs-star'></i></li>
                            <li><i class='bx bxs-star'></i></li>
                        </ul>
                        <p>“{{$t->description}}”</p>
                        <div class="client-info">
                            <img src="{{asset('assets/images')}}/{{$t->image}}" alt="image">

                            <h3>{{$t->name}}</h3>
                            <span>{{$t->position}}</span>
                        </div>
                        <div class="quote">
                            <img src="{{asset('front/img/cryptocurrency-home/quote.png')}}" alt="image">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Unique Feedback Area -->


@endsection
@section('scripts')

@endsection