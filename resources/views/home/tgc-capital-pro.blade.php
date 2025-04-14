@extends('layouts.front')
@section('content')
    <!--================Hero Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="container">
            <div class="banner_content">
                <h2 class="br_title">TGC Capital Pro</h2>
                <ul class="bread_cumb list_style">
                    <li><a href="/">Home</a></li>
                    <li>TGC Capital Pro</li>
                </ul>
            </div>
        </div>
    </section>
    <!--================Hero banner Area =================-->

    <!--================ Exchange Area =================-->
    <section class="exchange_area">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="mb_0 title_h2">$3000 (Min) - $100,000 (max)</h2>
                {{--                <p class="mb_0 title_p">Attract Global Payments Volume</p>--}}
                <span class="bottom_line"></span>
            </div>
            <h5 class="text-center mb_60 pt_30">
                TGC Capital pro is a fully managed portfolio product offered by SAFE Management that capitalizes on opportunities in the US and Global Equities Market. Using a variety of options including long calls, long puts, vertical spreads, butterflies, and iron condors, TGC Capital pro aims to provide uncorrelated returns while minimizing the incidence of losing months.</h5>

            <h5>
                TGC Capital pro is available to level 5 Members of The Growth Club and also includes:
            </h5>
            <div class="row">
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Legacy Plans</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Retirement Plans</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">TGC Platinum card</h3>
                    </div>
                </div>
            </div>
            <span class="bottom_line"></span>
            <div class="row">
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">1-on-1 Consultations</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Loans</h3>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon1.png')}}" alt="icon">
                        <h3 class="title_color">The Round Table Room Access</h3>
                    </div>
                </div>
            </div>
            <span class="bottom_line"></span>
            <div class="row">
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon2.png')}}" alt="icon">
                        <h3 class="title_color">Percentages in Ecommerce products, Forex, Stocks and Cryptocurrency</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection