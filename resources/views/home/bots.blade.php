@extends('layouts.front')
@section('content')

    <section class="pricing-one">
        <div class="auto-container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="pricing-card">
                        <div class="pricing-card__icon">
                            <img src="{{asset('front/images/ai4.jpeg')}}" alt="" style=" width: 130px; height: 130px; border-radius: 50% !important;">
                        </div><!-- /.pricing-card__icon -->
                        <p class="pricing-card__name"></p>
                        <h3 class="pricing-card__amount">Maxon’s stash</h3><!-- /.pricing-card__amount -->
                        <div class="pricing-card__bottom" style="text-align: justify;">
                            The maxons stash trading software is the best choice for beginners or newbies in the trading world and also for traders who Have very small funds to start trading with.
                            It is also very suitable for traders who wish to grow their funds through long term compounding.
                            Using the stash you can fund your trading account with a minimum  amount of $100 in deposits using any crypto currency of your choice.

                            The stash has a very good win rate.

                            The stash can take a maximum amount of $1999

                            The stash has an auto stop loss feature too.

                            Each stash user can’t earn less than 0.9% daily in profits due to the auto stop loss feature  it comes with.

                            The profit margin on the stash is within a rage of 0.9% to 1.2% daily in profits.

                            Trading fees are not applicable using the stash
                        </div><!-- /.pricing-card__bottom -->
                    </div><!-- /.pricing-card -->
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="pricing-card">
                        <div class="pricing-card__icon">
                            <img src="{{asset('front/images/ai3.jpeg')}}" alt="" style=" width: 130px; height: 130px; border-radius: 50% !important;">
                        </div><!-- /.pricing-card__icon -->
                        <p class="pricing-card__name"></p>
                        <h3 class="pricing-card__amount">Maxon’s schrodinger</h3><!-- /.pricing-card__amount -->
                        <div class="pricing-card__bottom" style="text-align: justify;">
                            Using Maxon’s schrodinger you can fund your trading account using any crypto currency of your choice.

                            The minimum amount for funding  the schrodinger is $2000 and it can take a maximum amount of $9999

                            Using the schrodinger you can’t earn below 1.25% because of the auto stop
                            Loss feature that the schrodinger has.

                            The profit margin of the schrodinger is between 1.25% and 1.45% daily.

                            The schrodinger has a wonderful win rate.

                            Trading fees are not applicable using the schrodinger.
                        </div><!-- /.pricing-card__bottom -->
                    </div><!-- /.pricing-card -->
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="pricing-card">
                        <div class="pricing-card__icon">
                            <img src="{{asset('front/images/ai2.jpeg')}}" alt="" style=" width: 130px; height: 130px; border-radius: 50% !important;">
                        </div><!-- /.pricing-card__icon -->
                        <p class="pricing-card__name"></p>
                        <h3 class="pricing-card__amount">Maxon’s Trade-bull</h3><!-- /.pricing-card__amount -->
                        <div class="pricing-card__bottom" style="text-align: justify;">
                            The trad- bull is a unique trading bot.

                            It also has the ability to switch trades intermittently.

                            This allows for dynamism.
                            For instance, if a trade isn’t going well or isn’t producing the expected results the trade bull has the ability to switch to another crypto pair. It does this using its own self indicator.

                            The Trade-bull is Maxon’s best seller yet.

                            The trade-bull is unique because of its win rate.

                            It gives traders the ability make back their initial deposit from trading within a short period of time.

                            The trade bull has a minimum deposit amount of $10000 and maximum deposit of $39999.

                            You can’t earn below 1.46% using the trade-bull because of the auto stop loss feature it comes with.

                            The profit margin of the Trade-bull is between 1.46% and 1.65%

                            Trading fees are not applicable using the Trade-bull.
                        </div><!-- /.pricing-card__bottom -->
                    </div><!-- /.pricing-card -->
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="pricing-card">
                        <div class="pricing-card__icon">
                            <img src="{{asset('front/images/ai.jpeg')}}" alt="" style=" width: 130px; height: 130px; border-radius: 50% !important;">
                        </div><!-- /.pricing-card__icon -->
                        <p class="pricing-card__name"></p>
                        <h3 class="pricing-card__amount">Maxon’s Titan</h3><!-- /.pricing-card__amount -->
                        <div class="pricing-card__bottom" style="text-align: justify;">
                            The Titan is One or Maxon’s biggest softwares yet.

                            It’s win rate and trade pattern is quite unique.

                            The minimum deposit for the Titan is $40000, the maximum amount the Titan can take is infinity  ♾.

                            Using the titan, you can’t earn below 1.66% daily in profits due to the auto stop
                            Loss feature it comes with.

                            The profit margin of the Titan is between 1.66% and 1.98% daily.

                            Trading fees aren’t applicable when using the Titan
                        </div><!-- /.pricing-card__bottom -->
                    </div><!-- /.pricing-card -->
                </div>
            </div><!-- /.row -->
            <div class="row" style="text-align: center">
                <a class="theme-btn btn-style-one" href="{{route('choose-bots')}}">
                    <i class="btn-curve"></i>
                    <span class="btn-title">Choose Bot</span>
                </a>
            </div>
        </div><!-- /.container -->
    </section>

@endsection