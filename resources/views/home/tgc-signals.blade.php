@extends('layouts.front')
@section('content')
    <!--================Hero Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="container">
            <div class="banner_content">
                <h2 class="br_title">TGC Signals</h2>
                <ul class="bread_cumb list_style">
                    <li><a href="/">Home</a></li>
                    <li>TGC Signals</li>
                </ul>
            </div>
        </div>
    </section>
    <!--================Hero banner Area =================-->
    <!--================ Exchange Area =================-->
    <section class="exchange_area">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="mb_0 title_h2">$300 (Monthly Fee)</h2>
                {{--                <p class="mb_0 title_p">Attract Global Payments Volume</p>--}}
                <span class="bottom_line"></span>
            </div>
            <h5 class="text-center mb_60 pt_30">
                Forex, Cryptocurrency, Stocks and Options signals delivered straight from our Trading Academy.<br/>
                our record is impeccable – consistent month-on-month returns.<br/>
                Every time we execute a trade we message you instantly so you can copy exactly what we do. we make money. you make money.</h5>
            <h5>
                it couldn’t be easier and you also get:
            </h5>
            <div class="row">
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Real-time access to our trading orders</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Lessons on technical analysis, margin trading and other strategies</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Exclusive streams and posts so you can understand how we consistently beat the market</h3>
                    </div>
                </div>
            </div>
            <h5 class="text-center mb_60 pt_30">
                It’s not unusual for members to pay off the costs in less than a day.
            </h5>
        </div>
    </section>
    @endsection