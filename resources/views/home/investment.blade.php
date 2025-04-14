@extends('layouts.front')
@section('content')
    <style>
        .col-md-12
        {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .containerz {
            width: 100%;
            padding-right: 0px;
            padding-left: 0px;
            margin-right: auto;
            margin-left: auto;
        }
        .text-justify{
            text-align: justify;
        }
    </style>
    <link rel="stylesheet" href="{{asset('front/css/custom.css')}}">

    <section class="pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="title pd-left mb-4 mt-4">
                        <h5 class="wow fadeInUp" data-wow-delay=".2s">Returns <span class="text-theme">on Investment</span></h5>
                    </div>
                    <p class="mb-2 text-justify">The profit from an activity for a particular period compared with the amount invested in it and paid on Daily basis.</p>
                    <p class="text-justify">ROI is a popular metric because of its versatility and simplicity. Essentially, ROI can be used as a rudimentary gauge of an investment’s profitability. This could be the ROI on a stock investment, the ROI a company expects on expanding to the next level, and the ROIs are generated in real term transactions. The calculation itself is not too complicated, and it is relatively easy to interpret for its wide range of applications. If an investment’s ROI is net positive, it is probably worthwhile. But if other opportunities with higher ROIs are available, these signals can help investors eliminate or select the best options. Likewise, investors should avoid negative ROIs, those platforms that corrupt the markets, and also imply a net loss to all their investors. Study and grow with Trading Advanced Platform Systems Limited and explore to control and earn your financial status.</p>
                    <p class="mb-2">Trading Advanced Platform Systems Limited prices you the smart and four various investment packages for you to earn fixed daily ROIs on your investment. Please review our investment packages which are stated below.</p>
                </div>
                <div class="col-md-5">
                    <div class="investment calculator d-sm-flex">
                        {{--                        <img src="{{asset('front/images/boex.png')}}">--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-100">
        <div class="container">
            <div class="row">
                @foreach($plan as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-pricing-box red">
                            <div class="pricing-header">
                                <h3>{{$p->name}}</h3>
                            </div>

                            <div class="price">
                                <sub>$</sub>
                                {{number_format($p->minimum)}}
                                <sub>/min</sub>
                            </div>
                            <hr>
                            @if($p->maximum >= 1000000)
                                <div class="price">
                                    Unlimited
                                </div>
                            @else
                                <div class="price">
                                    <sub>$</sub>
                                    {{number_format($p->maximum)}}
                                    <sub>/min</sub>
                                </div>
                            @endif

                            <ul class="price-features-list">
                                @php $desc = explode(",", $p->description); @endphp
                                @foreach($desc as $d)
                                    <li><i class="flaticon-tick"></i> {{$d}}</li>
                                @endforeach
                                <li><i class="flaticon-tick"></i> Duration: {{$p->time}} @if($p->compound->name == 'Hourly')
                                        Hours
                                    @elseif($p->compound->name == 'Daily')
                                        Days
                                    @elseif($p->compound->name == 'Weekly')
                                        weeks
                                    @elseif($p->compound->name == 'Yearly')
                                        Years
                                    @endif </li>
                                {{--                            <li><i class="flaticon-tick"></i> Daily Profit: {{$p->percent}} %</li>--}}
                                <li><i class="flaticon-tick"></i> Profit Percentage: {{$p->total_percent}}% Monthly</li>
                                <li><i class="flaticon-tick"></i> Referral: {{$basic->reference}} %</li>
                            </ul>

                            @auth()
                                <a href="{{route('deposit-new')}}" class="get-started-btn">Start Investing</a>
                            @else
                                <a href="{{route('register')}}" class="get-started-btn">Get Started</a>
                            @endauth
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="shape-img2"><img src="{{asset('front/img/shape/2.svg')}}" alt="image"></div>
        <div class="shape-img3"><img src="{{asset('front/img/shape/3.svg')}}" alt="image"></div>
        <div class="shape-img4"><img src="{{asset('front/img/shape/4.png')}}" alt="image"></div>
        <div class="shape-img5"><img src="{{asset('front/img/shape/5.png')}}" alt="image"></div>
        <div class="shape-img6"><img src="{{asset('front/img/shape/6.png')}}" alt="image"></div>
        <div class="shape-img9"><img src="{{asset('front/img/shape/9.png')}}" alt="image"></div>
        <div class="shape-img10"><img src="{{asset('front/img/shape/10.png')}}" alt="image"></div>
    </section>
    <!-- End Pricing Area -->

@endsection