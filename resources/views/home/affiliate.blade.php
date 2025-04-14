@extends('layouts.front')
@section('content')
    <style>
        .wallet-sec.sec1 {
            background: url(../front/images/crypto-bg.jpeg);
            background-color: rgba(0, 0, 0, 0.75);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: overlay;
            background-position: center;
            padding-top: 35px;
            padding-bottom: 15px;
        }
        @media (max-width: 576px){
            .wallet-sec {
                padding: 50px 0;
            }
        }
        .text-justify{
            text-align: justify !important;
        }
    </style>
    <section class="aabout-us m-4">
        <div class="container">
            <div class="aabout-us-details">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title pd-left mb-4">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Affiliate <span class="text-theme">Income Structure</span></h3>
                        </div>
                        <div class="abt-info">
                            <p class="text-justify wow fadeInUp" data-wow-delay=".3s">These are subsidiary incomes to your ROI. Affiliate incomes are a prominent way to build your wealth at a rapid pace. It gives you an exceptional advantage of making funds using your networking skills and utilizing their sources of funds to avail extra benefits.</p>
                            <p class="text-justify wow fadeInUp" data-wow-delay=".4s">Affiliate incomes are an active way to develop your financial skills and perform economically to outcome your budgetary issues and get a taste of financial freedom in this world.</p>
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-7">
                        <div class="abt-info">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s">Referral <span class="text-theme">Income</span></h3>
                            <p class="text-justify wow fadeInUp mb-1" data-wow-delay=".3s">Referral Income refers to that part of income that can be claimed when a user under you invests on one's own account. It is the premium paid for your networking skills and services hosted. Such a premium is paid every time an investment is made by the user referred by you. </p>
                            <p class="text-justify wow fadeInUp mb-1" data-wow-delay=".3s">Your own package is not considered for the calculation of Referral Income. Referral Income is credited instantly as soon as an investment is made through your direct referrals only. Start growing your referrals today and see the magic of earnings happen. Yes, that’s what referrals are for. Get going and start building.</p>
                            <ul class="list-group about">
                                <li class="list-group-item">Activation of your own account is mandatory to withdraw your referral earnings.</li>
                                <li class="list-group-item">Referral earnings can be withdrawn at any time any day with a minimal charge applied to it.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="{{asset('front/images/riex.png')}}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection