@extends('layouts.mobile-user')
@section('content')

    <div class="row">
        @php $i = 0; @endphp
        @foreach($wallets as $w)
            @php $i++; @endphp
            <div class="col-md-4" style="padding-bottom: 10px;">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h5><img style="width: 30px; height: 30px;" class="image-responsive"
                                 src="{{ asset('assets/images') }}/{{ $w->image }}" alt="">
                            <strong>{{ $w->name }}</strong></h5>
                        </div>
                        <div class="float-right">
                            <h5>{{$basic->currency}}{{\App\UserWallet::whereuser_id(Auth::user()->id)->where('wallet_id',$w->id)->first()->amount_in_usd ?? '0.00'}}</h5>
                            <p>{{  \App\UserWallet::whereuser_id(Auth::user()->id)->where('wallet_id',$w->id)->first()->amount_in_crypto ?? '0.00'}} {{$w->short}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">

                        </div>
                        <div class="text-right">
                            <a href="javascript:;" onclick="jQuery('#modal-{{$i}}').modal('show');"
                               class="btn btn-info btn-sm"><i class="fa fa-money"></i> DEPOSIT</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

{{--    <div class="row">--}}
{{--        @if($payment->paypal_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->paypal_image }}" alt=""> <strong>{{ $payment->paypal_name }}</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-1').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if($payment->perfect_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->perfect_image }}" alt=""--}}
{{--                                 style="width: 30px; height: 30px;">--}}
{{--                            <strong>{{ strtoupper($payment->perfect_name) }}</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-2').modal('show');"--}}
{{--                           class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if($payment->btc_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->btc_image }}" alt=""> <strong>{{ strtoupper($payment->btc_name) }}</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-3').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if($payment->stripe_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->stripe_image }}" alt=""> <strong>{{ strtoupper($payment->stripe_name) }}</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-4').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if($payment->eth_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->eth_image }}" alt=""> <strong>ETHEREUM</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-6').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}
{{--        @if($payment->usdt_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->usdt_image }}" alt=""> <strong>TRON</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-7').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if($payment->doge_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->doge_image }}" alt=""> <strong>DOGE</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-9').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}
{{--        @if($payment->btcash_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->btcash_image }}" alt=""> <strong>BITCOIN CASH</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-5').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if($payment->usdd_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->usdd_image }}" alt=""> <strong>XRP</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-8').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}

{{--        @if($payment->stellar_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->stellar_image }}" alt=""> <strong>STELLAR COIN</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-10').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}
{{--        @if($payment->busd_status == 1)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h3 class="card-title text-center">--}}
{{--                            <img style="width: 30px; height: 30px;" class="image-responsive"--}}
{{--                                 src="{{ asset('assets/images') }}/{{ $payment->busd_image }}" alt=""> <strong>LITE COIN</strong>--}}
{{--                        </h3>--}}
{{--                        <div class="text-center">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="javascript:;" onclick="jQuery('#modal-11').modal('show');"--}}
{{--                           class="btn btn-info btn-block btn-icon icon-left"><i class="fa fa-money"></i> DEPOSIT</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}

{{--    </div>--}}
    <!-- Modal 1 (Basic)-->
    @php $t = 0; @endphp
    @foreach($wallets as $w)
        @php $t++; @endphp
    <div class="modal fade" id="modal-{{$t}}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-money"></i> Deposit into {{$w->name}} Wallet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-6 col-sm-offset-2 control-label">Amount : </label>
                                    <div class="col-md-12">
                                        <span style="color: green;margin-left: 10px;"><strong>{{ $basic->currency }}. Charge ({{ $w->fix }} + {{ $w->percent }}) {{ $basic->currency }}</strong></span>
                                        <div class="input-group" style="margin-bottom: 15px;">
                                            <input type="number" value="" id="amount" name="amount" class="form-control"
                                                   required/>
                                            <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                            <input type="hidden" name="payment_type" id="payment_type" value="{{$w->id}}">
                                            <input type="hidden" name="rate" value="{{ $w->rate }}">
                                            <input type="hidden" name="fix" value="{{ $w->fix }}">
                                            <input type="hidden" name="percent" value="{{ $w->percent }}">
                                            <input type="hidden" name="wallet_id" value="{{ $w->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
{{--                                    <div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">--}}
{{--                                        <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                        <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


@endsection
@section('scripts')
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount').on('input', function () {
                var amount = $("#amount").val();
                var payment_type = $("#payment_type").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount2').on('input', function () {
                var amount = $("#amount2").val();
                var payment_type = $("#payment_type2").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result2").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount3').on('input', function () {
                var amount = $("#amount3").val();
                var payment_type = $("#payment_type3").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result3").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount4').on('input', function () {
                var amount = $("#amount4").val();
                var payment_type = $("#payment_type4").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result4").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount5').on('input', function () {
                var amount = $("#amount5").val();
                var payment_type = $("#payment_type5").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result5").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount6').on('input', function () {
                var amount = $("#amount6").val();
                var payment_type = $("#payment_type6").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result6").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount7').on('input', function () {
                var amount = $("#amount7").val();
                var payment_type = $("#payment_type7").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result7").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount8').on('input', function () {
                var amount = $("#amount8").val();
                var payment_type = $("#payment_type8").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result8").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount9').on('input', function () {
                var amount = $("#amount9").val();
                var payment_type = $("#payment_type9").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result9").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount10').on('input', function () {
                var amount = $("#amount10").val();
                var payment_type = $("#payment_type10").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result10").html(data);
                    }
                );
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount11').on('input', function () {
                var amount = $("#amount11").val();
                var payment_type = $("#payment_type11").val();
                $.post(
                    '{{ url('/paypal-check-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        payment_type: payment_type
                    },
                    function (data) {
                        $("#result11").html(data);
                    }
                );
            });
        });
    </script>
@endsection

