@extends('layouts.mobile-user')

@section('content')
    <div class="content">
        <div class="d-flex">
            <div>
                <h4>Downliners</h4>
            </div>
            <div class="align-self-center ms-auto">
                <a class="badge text-uppercase px-2 py-1 gradient-blue text-white" href="#" style="font-size: 10px;"
                   data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">
                    Transfer
                </a>
            </div>
        </div>
    </div>
    @foreach($user as $p)
        <div class="card card-style mb-2">
            <div class="content mx-3 mt-3">
                <div class="d-flex mt-n2 ms-3">
                <span class="align-self-center ms-auto">
                    {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                </span>
                </div>
                <div class="d-flex">
                    <div>
                        <h6>{{ $p->name }}</h6>
                        <h6>{{ $p->email }}</h6>
                    </div>
                    <div class="align-self-center ms-auto">
                        <h6>{{ $p->reference }}</h6>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <form method="post" action="{{route('transfer-referral')}}">
                @csrf
                <h3 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1 text-center">Referral Balance: ${{$bonus - $balance}}</h3>
                <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Enter Amount</h5>
                <br>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-14"></i>
                    <input type="number" class="form-control rounded-xs" name="amount" id="c1" placeholder="Amount" oninput="checkAmount()" required />
                    <label for="c1" class="color-theme">Amount</label>
                    <div class="feedback" id="feedback"></div>
                    <span>(required)</span>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-check-circle font-13"></i>
                    <select class="form-select rounded-xs" id="c6" aria-label="Floating label select example" name="wallet_2" required>
                        <option value="">Select Wallet To Transfer To</option>
                        @foreach($pay as $w)
                            <option value="{{$w->id}}">{{$w->wallets->name}}</option>
                        @endforeach
                    </select>
                    <label for="c1" class="color-theme">Wallet To Transfer To</label>
                </div>
                <input type="hidden" name="method_id" id="method_id" value="">
                <div class="row" id="bb">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script>
        function checkAmount()
        {
            var x = document.getElementById("c1");
            var amount = x.value;
            getCheck(amount);
            async function getCheck(amount)
            {
                var amt = amount;
                const response= await fetch('/ref-trf-check?amount='+amt)
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