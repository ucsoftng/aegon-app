@extends('layouts.user')

@section('content')
    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="panel-body">
                        <div class="text-center">
                            <h2>XRP</h2>
                            <h3>Current Balance : <strong>{{ Auth::user()->amount }}
                                    - {{ $basic->currency }}</strong></h3>
                        </div>
                        <hr>

                            <h4 style="text-align: center;"> SEND EXACTLY
                                <strong> {{ $btc }} XRP</strong> TO<br><br>
                                <div class="input-group text-center">
                                    <input class="form-control" value="{{ $add }}" readonly>
                                    <span class="input-group-addon red has" onClick='copyText(this)' data-clipboard-text="{{ $add }}">&nbsp;
                                        <i class="mdi mdi-content-copy"> </i>
                                    </span>
                                </div>
{{--                                <strong> <span onClick='copyText(this)'>{{ $add }}</span></strong><br>--}}
                                {!! $code !!} <br>
                                <strong>SCAN TO SEND</strong> <br><br>
                                <strong>Tap the Address above to copy</strong><br><br>
                                <strong style="color: red;">NB: 3 Confirmations required
                                    to credit your Account</strong>
                            </h4>

                        <hr>
                        <div class="panel-footer">
                            <a href="{{ route('verify-payment',$transaction_id) }}"
                               class="btn btn-info btn-block btn-icon icon-left"><i
                                        class="fa fa-check"></i> Click Here If you have made payment successfully</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="col-md-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="col-sm-12 text-center">--}}
{{--                        <div class="panel panel-info">--}}
{{--                            <div class="panel-heading">--}}
{{--                                <h3 style="font-size: 28px;"><b>--}}
{{--                                        @if($fund->payment_type == 1)--}}
{{--                                            Paypal--}}
{{--                                        @elseif($fund->payment_type == 2)--}}
{{--                                            Perfect Money--}}
{{--                                        @elseif($fund->payment_type == 3)--}}
{{--                                            BTC - ( BlockChain )--}}
{{--                                        @elseif($fund->payment_type == 4)--}}
{{--                                            Credit Card--}}
{{--                                        @elseif($fund->payment_type == 5)--}}
{{--                                            Bitcoin Cash--}}
{{--                                        @elseif($fund->payment_type == 6)--}}
{{--                                            Ethereum--}}
{{--                                        @elseif($fund->payment_type == 7)--}}
{{--                                            USDT--}}
{{--                                        @elseif($fund->payment_type == 8)--}}
{{--                                            USDC--}}
{{--                                        @elseif($fund->payment_type == 9)--}}
{{--                                            DOGE--}}
{{--                                        @elseif($fund->payment_type == 10)--}}
{{--                                            Stellar--}}
{{--                                        @endif--}}
{{--                                    </b></h3>--}}
{{--                            </div>--}}
{{--                            <div style="font-size: 18px;padding: 18px;"--}}
{{--                                 class="panel-body text-center">--}}
{{--                                @if($fund->payment_type == 1)--}}
{{--                                    @php $img = $payment->paypal_image @endphp--}}
{{--                                @elseif($fund->payment_type == 2)--}}
{{--                                    @php $img = $payment->perfect_image @endphp--}}
{{--                                @elseif($fund->payment_type == 3)--}}
{{--                                    @php $img = $payment->btc_image @endphp--}}
{{--                                @elseif($fund->payment_type == 4)--}}
{{--                                    @php $img = $payment->stripe_image @endphp--}}
{{--                                @elseif($fund->payment_type == 5)--}}
{{--                                    @php $img = $payment->btcash_image @endphp--}}
{{--                                @elseif($fund->payment_type == 6)--}}
{{--                                    @php $img = $payment->eth_image @endphp--}}
{{--                                @elseif($fund->payment_type == 7)--}}
{{--                                    @php $img = $payment->usdt_image @endphp--}}
{{--                                @elseif($fund->payment_type == 8)--}}
{{--                                    @php $img = $payment->usdd_image @endphp--}}
{{--                                @elseif($fund->payment_type == 9)--}}
{{--                                    @php $img = $payment->doge_image @endphp--}}
{{--                                @elseif($fund->payment_type == 10)--}}
{{--                                    @php $img = $payment->stellar_image @endphp--}}
{{--                                @endif--}}
{{--                                <img width="100%" class="image-responsive"--}}
{{--                                     src="{{ asset('assets/images') }}/{{ $img }}" alt="">--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="panel-footer">--}}
{{--                                <a href="{{ url('user/fund-add') }}"--}}
{{--                                   class="btn btn-info btn-block btn-icon icon-left"><i--}}
{{--                                            class="fa fa-arrow-left"></i> Back to Payment--}}
{{--                                    Method Page</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
    <script>
        function copyText(element) {
            var range, selection, worked;

            if (document.body.createTextRange) {
                range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
            } else if (window.getSelection) {
                selection = window.getSelection();
                range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }

            try {
                document.execCommand('copy');
                alert('Address Copied');
            } catch (err) {
                alert('Unable to copy Address');
            }
        }
    </script>
@endsection

