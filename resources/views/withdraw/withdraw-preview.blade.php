@extends('layouts.mobile-user-2')
@section('content')
    <div class="card card-style">
        <div class="content mx-3 mt-3">
            <div class="card-body">

                <div class="text-center">
                    <h3>Wallet Balance : <strong>{{ $basic->currency }} {{ $method->amount_in_usd }}</strong></h3>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Request
                        Amount : </label>

                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" value="{{ $amount }}"
                                   readonly name="amount" id="amount"
                                   class="form-control"
                                   placeholder="Enter Deposit Amount"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Withdrawal Charge : </label>

                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text"
                                   value="{{ $method->wallets->fix + (($amount * $method->wallets->percent) /100) }}"
                                   readonly name="charge" id="charge"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="form-group">
                <label class="col-sm-6 control-label">Total Charge : </label>

                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text"
                               value="{{ $amount + $method->wallets->fix + (($amount * $method->wallets->percent) /100) }}"
                               readonly name="charge" id="charge"
                               class="form-control"
                               placeholder="Enter Deposit Amount"
                               required>
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                <label class="col-sm-6 control-label">Available Balance : </label>
                <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text"
                               value="{{ $method->amount_in_usd - ($amount + $method->wallets->fix + (($amount * $method->wallets->percent) /100)) }}"
                               readonly name="charge" id="charge"
                               class="form-control"
                               placeholder="Enter Deposit Amount"
                               required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-style">
        <div class="content mx-3 mt-3">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-send"></i> <strong>Payment
                        Send Details</strong></div>
            </div>
            <!-- panel body -->
            <div class="card-body">
                <form method="post" action="{{route('withdraw-submit')}}">
                    @csrf
                    <input type="hidden" name="amount"
                           value="{{ $amount }}">
                    <input type="hidden" name="method_id"
                           value="{{ $method->id }}">


                    <div class="form-group">
                        <label class="col-sm-6 control-label">Method : </label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text"
                                       value="{{ $method->wallets->name }}"
                                       readonly name="method_name"
                                       id="charge" class="form-control"
                                       placeholder=""
                                       required>
                                <span class="input-group-addon red">&nbsp;<strong> <i
                                                class="fa fa-bank"></i></strong></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Wallet Address : </label>

                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" value=""
                                       name="acc_number" id=""
                                       class="form-control"
                                       placeholder="Enter Wallet Address"
                                       required>
                                <span class="input-group-addon red">&nbsp;<strong> <i
                                                class="fa fa-sort-numeric-asc"></i></strong></span>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Message : </label>

                        <div class="col-md-12">
                                <textarea name="message" id="" cols="30" rows="3"
                                          class="form-control"
                                          placeholder="Message ( If Any )"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">

                        <div class="col-sm-12 col-sm-offset-4">
                            <button class="btn btn-danger btn-icon icon-left btn-block">
                                <i class="fa fa-send"></i> Submit
                                Withdraw Request
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection


