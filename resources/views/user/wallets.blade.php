@extends('layouts.mobile-user')
@section('content')
    <style>
        hr {
            margin: 10px !important;
        }
    </style>
    <div class="container">
        <div class="d-flex">
            <div>
                <h4>Wallets</h4>
            </div>
            <div class="align-self-center ms-auto">
                <a class="badge text-uppercase px-2 py-1 gradient-blue text-white" href="#" style="font-size: 10px;"
                   data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">
                    Swap
                </a>
            </div>
        </div>
        {{--        <div class="card" style="border-radius: 15px;">--}}
        @php $i = 0; @endphp
        @if($responsew)
            @foreach($responsew as $w)
                @php $i++; @endphp
                <a href="{{route('wallet',['id'=>$w->id,'short'=>$w->symbol])}}">
                    <div class="card card-style">
                        <div class="content">
                            <div class="d-flex">
                                <img style="width: 30px; height: 30px; border-radius: 100px;" class="image-responsive" src="{{$w->image ?? ""}}" alt="">
                                <h5 style="padding-top: 5px !important; padding-left: 2px;"> {{$w->name}}</h5>
                                <p>{{$w->symbol}}</p>
                                <div class="align-self-center ms-auto">
                                    <h4>${{number_format((float)$w->rate,2)}}</h4>
                                    <p> Av Bal:
                                        @if(\App\UserWallet::whereuser_id(\Illuminate\Support\Facades\Auth::user()->id)->wherewallet_short($w->symbol)->exists())
                                            {{ $basic->currency }}{{number_format((float)\App\UserWallet::whereuser_id(\Illuminate\Support\Facades\Auth::user()->id)->wherewallet_short($w->symbol)->first()->amount_in_usd,2)}}
                                        @else
                                            {{ $basic->currency }}0.00
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="content mb-0">
                <div class="row">
                    <h5>No Wallets Found!</h5>
                </div>
            </div>
        @endif
        {{--        </div>--}}
    </div>
@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <form method="post" action="{{route('sswap-coin')}}">
                @csrf
                <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Swap Coin</h5>
                <br>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-check-circle font-13"></i>
                    <select class="form-select rounded-xs" id="wallet_1" aria-label="Floating label select example" name="wallet_1" required>
                        <option value="">Select Wallet To Swap From</option>
                        @foreach($u_wallets as $w)
                            <option value="{{$w->id}}">{{$w->wallets->name}}</option>
                        @endforeach
                    </select>
                    <label for="c1" class="color-theme">Wallet To Swap From</label>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-14"></i>
                    <input type="number" class="form-control rounded-xs" name="amount" id="amount" placeholder="Amount" required />
                    <label for="c1" class="color-theme">Amount</label>
                    <div class="feedback" id="feedback"></div>
                    <span>(required)</span>
                </div>
                <div class="col-md-2 text-center" style="padding-top: 20px; padding-bottom: 20px;">
                    <img src="{{asset('img/arr.png')}}" alt="" style="width: 30px;">
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-check-circle font-13"></i>
                    <select class="form-select rounded-xs" id="wallet_2" aria-label="Floating label select example" name="wallet_2" required>
                        <option value="">Select Coin To Swap To</option>
                        @foreach($wallets as $w)
                            <option value="{{$w->id}}">{{$w->name}}</option>
                        @endforeach
                    </select>
                    <label for="c1" class="color-theme">Coin To Swap To</label>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-14"></i>
                    <input type="number" class="form-control rounded-xs" name="amount" id="amount_2" placeholder="Amount" readonly />
                    <label for="c1" class="color-theme">Amount to receive</label>
                    <div class="feedback" id="feedback2"></div>
                    <span>(required)</span>
                </div>

                <div class="row" id="bb">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script>
        $('#amount').add('#wallet_1').on('input', function ()  {

            var amount = $("#amount").val();
            var wallet = $("#wallet_1").val();

            // $('#wallet_2').find('option').not(':first').remove();
            $.post(
                '{{ url('/swap-details') }}',
                {
                    _token: '{{ csrf_token() }}',
                    amount: amount,
                    wallet: wallet
                },
                function (data) {
                    if(data.status == "200")
                    {
                        document.getElementById("feedback").innerHTML= '<p style="color: green;">'+data.data+'</p>';
                    }else
                    {
                        document.getElementById("feedback").innerHTML= '<p style="color: red;">'+data.data+'</p>';
                    }
                    // $("#result").html(data);
                }
            );
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#wallet_2').on('input', function ()  {

                var amount = $("#amount").val();
                var wallet2 = $("#wallet_2").val();
                // $('#modal-loader').show();

                // $('#wallet_2').find('option').not(':first').remove();
                $.post(
                    '{{ url('/swap-check') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        wallet2: wallet2
                    },
                    function (data) {
                        if(data.status == "200")
                        {
                            $("#amount_2").val(data.data);
                            document.getElementById("feedback2").innerHTML= '<p style="color: green;">Success</p>';
                            document.getElementById('bb').innerHTML =
                                '<input type="submit" id="ssbtn" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4" value="Proceed">';
                        }else
                        {
                            document.getElementById("feedback").innerHTML= '<p style="color: red;">Error Occurred</p>';
                            document.getElementById('bb').innerHTML = '';
                        }
                        // $("#result").html(data);
                        // $('#modal-loader').hide();
                        // $("#result").html("<div class='col-md-12 col-sm-offset-4'><button type='submit' class='btn btn-info bt2'><i class='fa fa-send'></i> Swap</button></div>");
                    }
                );
            });
        });
    </script>
    <script>
        function checkAmount()
        {
            var x = document.getElementById("c1");
            var amount = x.value;
            getCheck(amount);
            async function getCheck(amount)
            {
                var amt = amount;
                const response= await fetch('/swap-details?amount='+amt)
                const data= await response.json();
                console.log(data.status);
                if(data.status == "200")
                {
                    document.getElementById("feedback").innerHTML= '<p style="color: green;">'+data.data+'</p>';
                    document.getElementById('bb').innerHTML =
                        '<input type="submit" id="ssbtn" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4" value="Proceed">';
                }else
                {
                    document.getElementById("feedback").innerHTML= '<p style="color: red;">'+data.data+'</p>';
                    document.getElementById('bb').innerHTML = '';
                }
            }

        }

        $(document).ready(function () {
            $("#ssbtn").click(function (event) {
                $('#ssbtn').val('Processing…');
                $('#dep-sub').submit();
            });
        });
    </script>
@endsection