@extends('layouts.front')
@section('content')
    <!-- Start Services Area -->
    <section class="services-area ptb-100 bg-F4F7FC">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">What We Do</span>
                <h2>Provide Awesome Service</h2>
            </div>
            <div class="row ptb-100">
                <p class="text-justify">
                    Trading Advanced Platform Systems Limited offers comprehensive and innovative Asset Management, Private Wealth Management Advisory Services and Financial Advisory Services. We provide exceptional personal service, valued advice and investment performance driven by expert knowledge in this specialist field. Our goal is to build long-term wealth for our investors by generating the highest possible returns with the least amount of volatility. Trading Advanced Platform Systems Limited leverages its broad and deep product and service offering which includes Forex trading, Stocks & Commodities trading, & Cryptocurrency investments, with leading edge technology and personalized approach to meet the special needs of a wide range of investors.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-digital-marketing"></i>
                        </div>

                        <h3><a href="#">CRYPTO CURRENCY TRADING</a></h3>

                        <p class="text-justify">
                            Cryptocurrencies are encrypted decentralised digital currencies that are transferred between individuals. These currencies are not tangible and exist only in the electronic from, it is a digital asset that exists and remains as data. They allow a person to send money just like sending an email, much lower transaction times compared to using a bank, minimal fees, no credit cards and no middleman.

                            Cryptocurrency trading is the act of speculating on cryptocurrency price movements via a CFD trading account, or buying and selling the underlying coins via an exchange.
                        </p>
                        {{--                        <a href="#" class="read-more-btn">Read More <i class="flaticon-right-arrow"></i></a>--}}
                    </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-00aeff">
                            <i class="flaticon-research"></i>
                        </div>

                        <h3><a href="#">FOREX TRADING</a></h3>

                        <p class="text-justify">
                            Placing a trade in the foreign exchange market is simple. The mechanics of a trade are very similar to those found in other financial markets (like the stock market), so if you have any experience in trading, you should be able to pick it up pretty quickly.

                            Currencies are always quoted in pairs, such as GBP/USD or USD/JPY. The reason they are quoted in pairs is that, in every foreign exchange transaction, you are simultaneously buying one currency and selling another.
                        </p>
                        {{--                        <a href="#" class="read-more-btn">Read More <i class="flaticon-right-arrow"></i></a>--}}
                    </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-f78acb">
                            <i class="flaticon-analytics"></i>
                        </div>

                        <h3><a href="#"> STOCKS & COMMODITIES TRADING</a></h3>

                        <p class="text-justify">
                            Stocks and commodities are two very different types of investments, though both are traded on open exchanges most weekdays. Stock investing involves buying and selling of shares in corporations. Commodities investing involves buying and selling of futures contracts with publicly traded commodities.

                            Individual investors, retail buyers, large mutual funds and even other companies invest in stocks to make money. Major public stock exchanges, including the New York Stock Exchange and Nasdaq, combined with a high volume of traders, make stock investing fairly liquid.
                            Commodities are physical goods produced in large quantities and easily distributed, which allows for stable investment activity. Minerals such as gold and silver, crops such as soybean and wheat, and various livestock are common examples of products traded through commodities exchanges.
                        </p>
                        {{--                        <a href="#" class="read-more-btn">Read More <i class="flaticon-right-arrow"></i></a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->

    <!-- Start Features Area -->
    <section class="features-area ptb-100 pt-0" style="padding-top: 60px !important;">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Features</span>
                <h2>We always try to understand customers expectation</h2>
            </div>

            <div class="tab features-list-tab">
                <ul class="tabs">
                    <li><a href="#" class="bg-fa7070">
                            <i class="flaticon-achievement"></i>
                            <span>SAFE AND SECURE</span>
                        </a></li>

                    <li><a href="#" class="bg-00aeff">
                            <i class="flaticon-architecture"></i>
                            <span>INSTANT TRADING</span>
                        </a></li>

                    <li><a href="#" class="bg-c679e3">
                            <i class="flaticon-digital-marketing"></i>
                            <span>RECURRING PROFITS</span>
                        </a></li>

                    <li><a href="#" class="bg-eb6b3d">
                            <i class="flaticon-analytics"></i>
                            <span>FAST PAYOUTS</span>
                        </a></li>

                    <li><a href="#">
                            <i class="flaticon-data"></i>
                            <span>24/7 SUPPORT</span>
                        </a></li>

                    <li><a href="#" class="bg-f78acb">
                            <i class="flaticon-research"></i>
                            <span>REFERRAL BONUS</span>
                        </a></li>
                </ul>

            </div>
        </div>

        <div class="shape-img7"><img src="{{asset('front/img/shape/7.png')}}" alt="image"></div>
        <div class="shape-img2"><img src="{{asset('front/img/shape/2.svg')}}" alt="image"></div>
        <div class="shape-img3"><img src="{{asset('front/img/shape/3.svg')}}" alt="image"></div>
        <div class="shape-img4"><img src="{{asset('front/img/shape/4.png')}}" alt="image"></div>
    </section>
    <!-- End Features Area -->
@endsection