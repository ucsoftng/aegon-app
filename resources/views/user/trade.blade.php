@extends('layouts.mobile-user')

@section('content')
    <div class="container">
        @php $i = 0; @endphp
        @if($wallets)
            @foreach($wallets as $w)
                @php $i++; @endphp
                <a href="#" onclick="add({{ $w->id }});" data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">
                    <div class="card card-style">
                        <div class="content">
                            <div class="d-flex">
                                <img style="width: 30px; height: 30px; border-radius: 100px;" class="image-responsive" src="{{asset('assets/images')}}/{{$w->wallets->image ?? ""}}" alt="">
                                <h5 style="padding-top: 5px !important; padding-left: 2px;"> {{$w->wallets->name}}</h5>
                                <p>{{ $w->wallets->short ?? ""}}</p>
                                <div class="align-self-center ms-auto">
                                    <h4>${{number_format((float)$w->wallets->crypto_rate,2)}}</h4>
                                    <p> Av Bal:
                                        {{ $basic->currency }}{{number_format((float)$w->amount_in_usd,2)}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{--                    <div class="content mb-0">--}}
                {{--                        <div class="row">--}}
                {{--                            <a href="#" onclick="add({{ $w->id }});" data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">--}}
                {{--                                <div class="content">--}}
                {{--                                    <div class="d-flex">--}}
                {{--                                        <div>--}}
                {{--                                            <h6>--}}
                {{--                                                <img style="width: 30px; height: 30px; border-radius: 100px;" class="image-responsive"--}}
                {{--                                                     src="{{asset('assets/images')}}/{{$w->wallets->image}}" alt="">--}}
                {{--                                                {{ $w->wallets->short ?? ""}}--}}
                {{--                                                @if($w->status == '1')--}}
                {{--                                                    <span class="badge bg-info ms-1">{{$w->wallets->name}}</span>--}}
                {{--                                                @else--}}
                {{--                                                    <span class="badge bg-danger ms-1">{{$w->wallets->name}}</span>--}}
                {{--                                                @endif--}}
                {{--                                            </h6>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="align-self-center ms-auto">--}}
                {{--                                            <h6 style="font-size: 16px;">{{ $basic->currency }}{{number_format((float)$w->amount_in_usd,2)}}</h6>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
            @endforeach
        @else
            <div class="content mb-0">
                <div class="row">
                    <h5>No Trading Wallets Found!</h5>
                </div>
            </div>
        @endif
    </div>
    {{--    <div class="container">--}}
    {{--        <div class="card card-style">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-6">--}}
    {{--                    <a href="{{ route('deposit-new') }}" class="btn-full btn gradient-green shadow-bg shadow-bg-m">Bot Trade</a>--}}
    {{--                </div>--}}
    {{--                <div class="col-6">--}}
    {{--                    <a href="#" class="btn btn-full gradient-highlight ">Self Trade</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
@endsection
@section('sheets')
<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
    <div class="content">
        <form method="get" action="{{route('start-trade')}}" id="submit">
            @csrf
            <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Select Trading Type</h5>
            <br>
            <div class="form-custom form-label form-icon mb-3">
                <i class="bi bi-check-circle font-13"></i>
                <select class="form-select rounded-xs" id="c6" aria-label="Floating label select example" name="trading_type" required>
                    <option value="">Select Trading</option>
                    <option value="bot">Crypto Bot Trading</option>
                    <option value="forex">Forex Bot Trading</option>
                    <option value="self">Live Trading</option>
                </select>
                <label for="c1" class="color-theme">Trading Option</label>
            </div>
            <input type="hidden" name="payment_type" class="abir_id" id="payment_type" value="">
            <div class="row">
                <input type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4" value="Proceed" id="proceed">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script>
        function add(id)
        {
            document.getElementById("payment_type").value = id;
        }
        $(document).ready(function () {
            $("#proceed").click(function (event) {
                $('#proceed').val('Processing …');
                $('#submit').submit();
            });
        });
    </script>
@endsection