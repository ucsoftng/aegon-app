@extends('layouts.mobile-user')

@section('content')
    <div class="card card-style">
        <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>

        <div class="card-body" style="text-align: center;">
            <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code <strong>{{ $secret }}</strong></p>
            <div>
                {!! $QR_Image !!}
            </div>
            <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
            <div>
                <a href="{{ route('complete-2fa') }}" class="btn btn-primary">Complete Registration</a>
            </div>
        </div>
        {{--        <div class="card-header">--}}
        {{--            Set up 2 Factor Authenticator--}}
        {{--        </div>--}}
        {{--        <div class="card-body">--}}
        {{--            @if($user->two_fa == 0)--}}
        {{--            <form class="form-horizontal" method="get" action="{{ route('initialize-2fa') }}">--}}
        {{--                @csrf--}}
        {{--                <div class="form-group">--}}
        {{--                    <div class="text-center">--}}
        {{--                        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100">--}}
        {{--                            Generate Secret Key to Enable 2FA--}}
        {{--                        </button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--            @endif--}}
        {{--        </div>--}}
    </div>
@endsection