@extends('layouts.front')
@section('content')
    <!--================Hero Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="container">
            <div class="banner_content">
                <h2 class="br_title">TGC Capital 1.0</h2>
                <ul class="bread_cumb list_style">
                    <li><a href="/">Home</a></li>
                    <li>TGC Capital 1.0</li>
                </ul>
            </div>
        </div>
    </section>
    <!--================Hero banner Area =================-->
    <!--================ Exchange Area =================-->
    <section class="exchange_area">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="mb_0 title_h2">$500 (min) - $3000</h2>
                {{--                <p class="mb_0 title_p">Attract Global Payments Volume</p>--}}
                <span class="bottom_line"></span>
            </div>
            <h5 class="text-center mb_60 pt_30">
                Designed to generate a sustainable income for TGC level 2 members through Stock trading and Ecommerce using our Expert managed wealth plan and portfolio.
            </h5>
            <h5> You also get
                Free Access to:
            </h5>
            <div class="row">
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon1.png')}}" alt="icon">
                        <h3 class="title_color">Professionally managed Portfolio and assets grouping</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon2.png')}}" alt="icon">
                        <h3 class="title_color">Percentage in Ecommerce products and stores</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="exchange_item">
                        <img src="{{asset('assets/front/image/new/logo/icon3.png')}}" alt="icon">
                        <h3 class="title_color">Access to TGC Networking Room</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection