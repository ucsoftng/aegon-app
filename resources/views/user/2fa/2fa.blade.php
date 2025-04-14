@extends('layouts.mobile-user')

@section('content')
    <div class="card card-style">
        <div class="card-header">
            Set up 2 Factor Authenticator
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                @csrf
                <div class="form-group">
                    <p style="text-align: center;">
                        Please enter the  <strong>OTP</strong> generated on your Authenticator App.
                        <br> Ensure you submit the current one because it refreshes every 30 seconds.
                    </p>
                    {{--                    <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>--}}
                    {{--                    <div class="col-md-12">--}}
                    {{--                        <div class="input-group" style="margin-bottom: 15px;">--}}
                    {{--                            <input type="number" value="" id="one_time_password" name="one_time_password" class="form-control"--}}
                    {{--                                   required/>--}}
                    {{--                        </div>--}}
                    {{--                        <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>--}}
                    {{--                    </div>--}}
                    <div class="form-custom form-label form-icon mb-3 bg-transparent">
                        <i class="bi bi-lock font-13"></i>
                        <input type="number" class="form-control rounded-xs" name="one_time_password" id="one_time_password" placeholder="One Time Password" required />
                        <label for="c1" class="color-theme">One Time Password</label>
                        <span>(required)</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4 mt-3">
                        <button type="submit" class="btn btn-primary">
                            Activate
                        </button>
                    </div>
                </div>
            </form>


            {{--            @if($user->two_fa == 0)--}}
            {{--            <p>Enter Authenticator Code Sent to Your Mail and Proceed.</p>--}}
            {{--            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">--}}
            {{--                @csrf--}}
            {{--                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">--}}
            {{--                    <label for="verify-code" class="col-md-4 control-label">Authenticator Code</label>--}}

            {{--                    <div class="form-custom form-label form-icon mb-3">--}}
            {{--                        <i class="bi bi-lock-fill font-14"></i>--}}
            {{--                        <input id="verify-code" type="password" class="form-control rounded-xs" name="verify-code" required>--}}
            {{--                        <label for="c1" class="color-theme">Authenticator Code</label>--}}
            {{--                        @if ($errors->has('verify-code'))--}}
            {{--                            <span class="help-block">--}}
            {{--                                            <strong>{{ $errors->first('verify-code') }}</strong>--}}
            {{--                                        </span>--}}
            {{--                        @endif--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="text-center">--}}
            {{--                    <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100">Enable 2FA</button>--}}
            {{--                </div>--}}
            {{--            </form>--}}
            {{--            @elseif($user->two_fa == 1)--}}
            {{--                <div class="alert alert-success">--}}
            {{--                    2FA is Currently <strong>Enabled</strong> for your account.--}}
            {{--                </div>--}}
            {{--                <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>--}}
            {{--                <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">--}}
            {{--                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">--}}
            {{--                        <label for="change-password" class="col-md-4 control-label">Current Password</label>--}}

            {{--                        <div class="form-custom form-label form-icon mb-3">--}}
            {{--                            <i class="bi bi-lock-fill font-14"></i>--}}
            {{--                            <input id="current-password" type="password" class="form-control rounded-xs" name="current-password" required>--}}

            {{--                            @if ($errors->has('current-password'))--}}
            {{--                                <span class="help-block">--}}
            {{--                                        <strong>{{ $errors->first('current-password') }}</strong>--}}
            {{--                                    </span>--}}
            {{--                            @endif--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="text-center">--}}
            {{--                        @csrf--}}
            {{--                        <button type="submit" class="btn btn-full gradient-red shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100">Disable 2FA</button>--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--            @endif--}}
        </div>
    </div>
@endsection