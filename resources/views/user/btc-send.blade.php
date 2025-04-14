@extends('layouts.mobile-user')
@section('content')

    <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-9">
                <div class="card card-style">
                    <div class="card-body">
                        <div class="panel-body">
{{--                            <div class="text-center">--}}
{{--                                <h3>{{$fund->wallet->name}}</h3>--}}
{{--                                <hr>--}}
{{--                                <h4>Current Balance : <br><strong>{{ Auth::user()->amount }} - {{ $basic->currency }}</strong>--}}
{{--                                </h4>--}}
{{--                            </div>--}}
                            <hr>
                                <h4 style="text-align: center;"> SEND EXACTLY <strong>{{ $btc }} {{$fund->wallet->short}} </strong> TO
                                    <hr>
                                    <div class="input-group text-center">
                                        <input class="form-control rounded-xs" value="{{ $add }}" readonly>
                                        <span class="badge badge-primary red has" onClick='copyText(this)' data-clipboard-text="{{ $add }}">&nbsp;
                                        <i class="bi bi-clipboard"></i>
                                        </span>
                                    </div>
                                    <hr>
{{--                                    <strong><span onClick='copyText(this)'>{{ $add }}</span></strong><br>--}}
                                    {!! $code !!} <br>
                                    <strong>SCAN CODE TO SEND</strong> <br><br>
                                    <small style="color: red;"><i>NB: 3 Confirmations required to credit your account</i></small>
                                </h4>

                            <hr>
                            @if($fund->wallet->tag != null)
                                <h4 style="text-align: center;">Tag: {{$fund->wallet->tag}}</h4>
                            @endif
                            <hr>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-6" style="padding-bottom: 5px;">
                                        <a target="_top" href="{{$fund->wallet->name}}:{{$add}}?amount={{$btc}}"
                                           class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4">
                                            <i class="fa fa-check"></i> Pay With In App Wallet
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('verify-payment',$transaction_id) }}"
                                           class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4"><i
                                                    class="fa fa-check"></i>
                                            Click to Verify Payment
                                        </a>
                                    </div>
                                </div>
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
{{--                                        @else--}}
{{--                                            Credit Card--}}
{{--                                        @endif--}}
{{--                                    </b></h3>--}}
{{--                            </div>--}}
{{--                            <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">--}}
{{--                                @if($fund->payment_type == 1)--}}
{{--                                    @php $img = $payment->paypal_image @endphp--}}
{{--                                @elseif($fund->payment_type == 2)--}}
{{--                                    @php $img = $payment->perfect_image @endphp--}}
{{--                                @elseif($fund->payment_type == 3)--}}
{{--                                    @php $img = $payment->btc_image @endphp--}}
{{--                                @else--}}
{{--                                    @php $img = $payment->stripe_image @endphp--}}
{{--                                @endif--}}

{{--                                <img width="100%" class="image-responsive" src="{{ asset('assets/images') }}/{{ $img }}"--}}
{{--                                     alt="">--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="panel-footer">--}}
{{--                                <a href="{{ url('user/fund-add') }}"--}}
{{--                                   class="btn btn-info btn-block btn-icon icon-left"><i--}}
{{--                                            class="fa fa-arrow-left"></i> Back to Payment Method Page</a>--}}
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
            }
            catch (err) {
                alert('Unable to copy Address');
            }
        }
    </script>
@endsection

