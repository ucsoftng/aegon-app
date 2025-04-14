@extends('layouts.admin')

@section('content')

    <div class="row" style="padding: 25px;">
        <div class="col-12 mt-30">
            <h2 class="mb-0">{{ $page_title }}</h2>
        </div>
        <form method="post" action="{{route('payment-manage-update',$payment->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-cc-paypal"></i> <b>PayPal Payment</b>
                        </div>
                        <div class="card-body">
                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="paypal_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->paypal_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="paypal_name"
                                                   value="{{ $payment->paypal_name }}" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">
                                            <strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon text-left">1 USD =</span>
                                                <input class="form-control" name="paypal_rate"
                                                       value="{{ $payment->paypal_rate }}" type="text" required>
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Limit Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="paypal_min"
                                                               value="{{ $payment->paypal_min }}" required type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="paypal_max"
                                                               value="{{ $payment->paypal_max }}" required type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="paypal_fix"
                                                               value="{{ $payment->paypal_fix }}" required type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="paypal_percent"
                                                               value="{{ $payment->paypal_percent }}" required
                                                               type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group" >
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">PayPal
                                                Business Email</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="paypal_email"
                                                       value="{{ $payment->paypal_email }}" required type="text">
                                                <span class="input-group-addon"><b>@</b></span>
                                            </div>

                                        </div>
                                    </div><br/><br/><br/>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->paypal_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="20%" type="checkbox"
                                                   name="onoffswitch2">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-credit-card-alt"></i> Perfect Money
                        </div>
                        <div class="card-body">
                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="perfect_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->perfect_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="perfect_name"
                                                   value="{{ $payment->perfect_name }}" required type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="perfect_rate"
                                                       value="{{ $payment->perfect_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Limit Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_min"
                                                               value="{{ $payment->perfect_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_max"
                                                               value="{{ $payment->perfect_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_fix"
                                                               value="{{ $payment->perfect_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="perfect_percent"
                                                               value="{{ $payment->perfect_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect
                                                Money USD Account</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="perfect_account"
                                                       value="{{ $payment->perfect_account }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-vcard"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect
                                                Money Alternate Passphrase </strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="perfect_alternate"
                                                       value="{{ $payment->perfect_alternate }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-bolt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">

                                            <input {{ $payment->perfect_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch3">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                {{--                <div class="col-md-6">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <i class="fa fa-btc"></i> Blockchain - (BITCOIN)--}}
                {{--                        </div>--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div class="panel panel-info">--}}
                {{--                                <div class="panel-body">--}}

                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display--}}
                {{--                                                Image</strong></label>--}}
                {{--                                        <div class="col-md-9">--}}
                {{--                                            <input name="btc_image" class="form-control" type="file">--}}
                {{--                                            <br>--}}
                {{--                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>--}}
                {{--                                            <br>--}}
                {{--                                            <br>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-md-3">--}}
                {{--                                            <img src="{{ asset('assets/images') }}/{{ $payment->btc_image }}"--}}
                {{--                                                 alt="Display Image" style="width: 100%;">--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display--}}
                {{--                                                Name</strong></label>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <input class="form-control" name="btc_name" value="{{ $payment->btc_name }}"--}}
                {{--                                                   type="text">--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion--}}
                {{--                                                Rate</strong></label>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="input-group mb15">--}}
                {{--                                                <span class="input-group-addon">1 USD = </span>--}}
                {{--                                                <input class="form-control" name="btc_rate"--}}
                {{--                                                       value="{{ $payment->btc_rate }}" type="text">--}}
                {{--                                                <span class="input-group-addon">{{ $basic->currency }}</span>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="panel panel-success">--}}
                {{--                                <div class="panel-heading">--}}
                {{--                                    <div class="col-md-12">--}}
                {{--                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">--}}
                {{--                                            Limit Per Transaction</h4>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="panel-body">--}}
                {{--                                    <div class="row">--}}

                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="form-group">--}}
                {{--                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>--}}
                {{--                                                <div class="col-md-12">--}}
                {{--                                                    <div class="input-group mb15">--}}
                {{--                                                        <input class="form-control" name="btc_min"--}}
                {{--                                                               value="{{ $payment->btc_min }}" type="text">--}}
                {{--                                                        <span class="input-group-addon">{{ $basic->currency }}</span>--}}
                {{--                                                    </div>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="form-group">--}}
                {{--                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>--}}
                {{--                                                <div class="col-md-12">--}}
                {{--                                                    <div class="input-group mb15">--}}
                {{--                                                        <input class="form-control" name="btc_max"--}}
                {{--                                                               value="{{ $payment->btc_max }}" type="text">--}}
                {{--                                                        <span class="input-group-addon">{{ $basic->currency }}</span>--}}
                {{--                                                    </div>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}

                {{--                                    </div><!-- row 2nd   -->--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="panel panel-warning">--}}
                {{--                                <div class="panel-heading">--}}
                {{--                                    <div class="col-md-12">--}}
                {{--                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">--}}
                {{--                                            Charge Per Transaction</h4>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="panel-body">--}}
                {{--                                    <div class="row">--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="form-group">--}}
                {{--                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>--}}
                {{--                                                <div class="col-md-12">--}}
                {{--                                                    <div class="input-group mb15">--}}
                {{--                                                        <input class="form-control" name="btc_fix"--}}
                {{--                                                               value="{{ $payment->btc_fix }}" type="text">--}}
                {{--                                                        <span class="input-group-addon">{{ $basic->currency }}</span>--}}
                {{--                                                    </div>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="form-group">--}}
                {{--                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>--}}
                {{--                                                <div class="col-md-12">--}}
                {{--                                                    <div class="input-group mb15">--}}
                {{--                                                        <input class="form-control" name="btc_percent"--}}
                {{--                                                               value="{{ $payment->btc_percent }}" type="text">--}}
                {{--                                                        <span class="input-group-addon"><i--}}
                {{--                                                                    class="fa fa-percent"></i></span>--}}
                {{--                                                    </div>--}}
                {{--                                                </div>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}

                {{--                                    </div><!-- row 2nd   -->--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="panel panel-info">--}}
                {{--                                <div class="panel-heading">--}}
                {{--                                    <div class="col-md-12">--}}
                {{--                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">--}}
                {{--                                            Payment Description</h4>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="panel-body">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin API--}}
                {{--                                                Key</strong></label>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="input-group mb15">--}}
                {{--                                                <input class="form-control" name="btc_api"--}}
                {{--                                                       value="{{ $payment->btc_api }}" type="text">--}}
                {{--                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin XPUB--}}
                {{--                                                Code </strong></label>--}}
                {{--                                        <div class="col-md-12">--}}
                {{--                                            <div class="input-group mb15">--}}
                {{--                                                <input class="form-control" name="btc_xpub"--}}
                {{--                                                       value="{{ $payment->btc_xpub }}" type="text">--}}
                {{--                                                <span class="input-group-addon"><i class="fa fa-code"></i></span>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label class="col-md-12"><strong--}}
                {{--                                                    style="text-transform: uppercase;">STATUS</strong></label>--}}
                {{--                                        <div class="col-md-12 bt-switch">--}}

                {{--                                            <input {{ $payment->btc_status == 1 ? 'checked' : '' }} data-on-color="success"--}}
                {{--                                                   data-off-color="danger" data-width="100%" type="checkbox"--}}
                {{--                                                   name="onoffswitch4">--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> BITCOIN
                        </div>
                        <div class="card-body">
                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="btc_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->btc_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="btc_name" value="{{ $payment->btc_name }}"
                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="btc_rate"
                                                       value="{{ $payment->btc_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Limit Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_min"
                                                               value="{{ $payment->btc_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_max"
                                                               value="{{ $payment->btc_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_fix"
                                                               value="{{ $payment->btc_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btc_percent"
                                                               value="{{ $payment->btc_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin Wallet</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="btc_wallet"
                                                       value="{{ $payment->btc_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="form-control" name="btc_api"
                                           value="{{ $payment->btc_api }}" type="hidden">
                                    <input class="form-control" name="btc_xpub" value="{{ $payment->btc_xpub }}" type="hidden">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">

                                            <input {{ $payment->btc_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-cc-stripe"></i> Stripe (CARD)
                        </div>
                        <div class="card-body">
                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="stripe_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->stripe_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="stripe_name"
                                                   value="{{ $payment->stripe_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="stripe_rate"
                                                       value="{{ $payment->stripe_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Limit Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_min"
                                                               value="{{ $payment->stripe_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_max"
                                                               value="{{ $payment->stripe_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_fix"
                                                               value="{{ $payment->stripe_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_percent"
                                                               value="{{ $payment->stripe_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SECRET
                                                KEY</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="stripe_secret"
                                                       value="{{ $payment->stripe_secret }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">PUBLISHER
                                                KEY</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="stripe_publisher"
                                                       value="{{ $payment->stripe_publisher }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">

                                            <input {{ $payment->stripe_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> Ethereum - (ETH)
                        </div>
                        <div class="card-body">
                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="eth_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->eth_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="eth_name" value="{{ $payment->eth_name }}"
                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="eth_rate"
                                                       value="{{ $payment->eth_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Limit Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="eth_min"
                                                               value="{{ $payment->eth_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="eth_max"
                                                               value="{{ $payment->eth_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="eth_fix"
                                                               value="{{ $payment->eth_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="eth_percent"
                                                               value="{{ $payment->eth_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">ETHEREUM
                                                WALLET ADDRESS</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="eth_wallet"
                                                       value="{{ $payment->eth_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">

                                            <input {{ $payment->eth_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch7">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> Bitcoin Cash - (BTCASH)
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="btcash_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->btcash_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="btcash_name"
                                                   value="{{ $payment->btcash_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="btcash_rate"
                                                       value="{{ $payment->btcash_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btcash_min"
                                                               value="{{ $payment->btcash_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btcash_max"
                                                               value="{{ $payment->btcash_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btcash_fix"
                                                               value="{{ $payment->btcash_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btcash_percent"
                                                               value="{{ $payment->btcash_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">BITCOIN CASH
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="btcash_wallet"
                                                       value="{{ $payment->btcash_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PUBLISHER KEY</strong></label>--}}
                                    {{--                                            <div class="col-md-12">--}}
                                    {{--                                                <div class="input-group mb15">--}}
                                    {{--                                                    <input class="form-control" name="stripe_publisher" value="{{ $payment->stripe_publisher }}" type="text">--}}
                                    {{--                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->btcash_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch8">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> XRP
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="usdd_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->usdd_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="usdd_name"
                                                   value="{{ $payment->usdd_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="usdd_rate"
                                                       value="{{ $payment->usdd_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdd_min"
                                                               value="{{ $payment->usdd_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="btcash_max"
                                                               value="{{ $payment->usdd_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdd_fix"
                                                               value="{{ $payment->usdd_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdd_percent"
                                                               value="{{ $payment->usdd_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">XRP
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="usdd_wallet"
                                                       value="{{ $payment->usdd_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->usdd_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch9">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> TRON
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="usdt_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->usdt_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="usdt_name"
                                                   value="{{ $payment->usdt_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="usdt_rate"
                                                       value="{{ $payment->usdt_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdt_min"
                                                               value="{{ $payment->usdt_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdt_max"
                                                               value="{{ $payment->usdt_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdt_fix"
                                                               value="{{ $payment->usdt_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="usdt_percent"
                                                               value="{{ $payment->usdt_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">TRON
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="usdt_wallet"
                                                       value="{{ $payment->usdt_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->usdt_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> DOGE
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="doge_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->doge_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="doge_name"
                                                   value="{{ $payment->doge_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="doge_rate"
                                                       value="{{ $payment->doge_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="doge_min"
                                                               value="{{ $payment->doge_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="doge_max"
                                                               value="{{ $payment->doge_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="doge_fix"
                                                               value="{{ $payment->doge_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="doge_percent"
                                                               value="{{ $payment->doge_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">DOGE
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="doge_wallet"
                                                       value="{{ $payment->doge_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->doge_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch11">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> STELLAR
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="stellar_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->stellar_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="stellar_name"
                                                   value="{{ $payment->stellar_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="stellar_rate"
                                                       value="{{ $payment->stellar_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stellar_min"
                                                               value="{{ $payment->stellar_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stellar_max"
                                                               value="{{ $payment->stellar_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stellar_fix"
                                                               value="{{ $payment->stellar_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stellar_percent"
                                                               value="{{ $payment->stellar_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STELLAR
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="stellar_wallet"
                                                       value="{{ $payment->stellar_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->stellar_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-btc"></i> LITE COIN
                        </div>
                        <div class="card-body">

                            <div class="panel panel-info">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Image</strong></label>
                                        <div class="col-md-9">
                                            <input name="busd_image" class="form-control" type="file">
                                            <br>
                                            <b style="color: red;">Square Size(800X800) JPG image Recommended</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/images') }}/{{ $payment->busd_image }}"
                                                 alt="Display Image" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display
                                                Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="busd_name"
                                                   value="{{ $payment->busd_name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion
                                                Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon">1 USD = </span>
                                                <input class="form-control" name="busd_rate"
                                                       value="{{ $payment->busd_rate }}" type="text">
                                                <span class="input-group-addon">{{ $basic->currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase;">Limit Per
                                            Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="busd_min"
                                                               value="{{ $payment->busd_min }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="busd_max"
                                                               value="{{ $payment->busd_max }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Charge Per Transaction</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="busd_fix"
                                                               value="{{ $payment->busd_fix }}" type="text">
                                                        <span class="input-group-addon">{{ $basic->currency }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="busd_percent"
                                                               value="{{ $payment->busd_percent }}" type="text">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="col-md-12">
                                        <h4 class="panel-title" style="text-transform: uppercase; font-weight: bold;">
                                            Payment Description</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">TRON
                                                WALLET</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="busd_wallet"
                                                       value="{{ $payment->busd_wallet }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong
                                                    style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12 bt-switch">
                                            <input {{ $payment->busd_status == 1 ? 'checked' : '' }} data-on-color="success"
                                                   data-off-color="danger" data-width="100%" type="checkbox"
                                                   name="onoffswitch13">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-info btn-block"><i class="fa fa-send"></i> <strong>Save Changes</strong>
                    </button>
                </div>
            </div>

        </form>

    </div>

@endsection
@section('scripts')
    <script src="{{ asset('adminz/assetz/vendors/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
    <script type="text/javascript">
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function () {
            var bt = function () {
                $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function () {
                    bt()
                }
            }
        }();
        $(function () {
            radioswitch.init()
        });
    </script>
@endsection