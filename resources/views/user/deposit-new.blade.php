@extends('layouts.mobile-user')

@section('content')

        @foreach($plan as $p)
            <div class="card card-style py-3">
                <div class="content px-2 text-center">
                    <h3 class="card-title text-center">
                        {{ $p->name }}
                    </h3>
                    <h5 class="card-text text-center">
                        <strong>{{ $basic->currency }} {{ number_format($p->minimum) }}
                            - {{ $basic->currency }} @if($p->maximum >= 1000000) Unlimited @else{{ number_format($p->maximum) }}@endif
                        </strong>
                    </h5>
                    <ul style='font-size: 15px;' class="list-group text-center bold">
                        <li class="list-group-item">ROI - {{ $p->percent }}% - {{ $p->end_percent }}% {{ $p->compound->name }}</li>
                        <li class="list-group-item">
                            Total ROI - {{ $p->total_percent }}%
                        </li>
                        @if($type == 'Forex')
                            <li class="list-group-item">Stop Loss - {{$p->stop_loss}}</li>
                            <li class="list-group-item">Risk Factor - {{$p->risk_factor}}</li>
                        @endif

                    </ul>
                    <button type="button" class="default-link btn btn-m rounded-s gradient-highlight shadow-bg shadow-bg-s px-5 mb-0 mt-2"
                            data-bs-toggle="offcanvas" data-bs-target="#menu-deposit"
                            onclick="add({{ $p->id }});">
                        <i class="fa fa-send"></i> Trade
                    </button>
                </div>
            </div>
        @endforeach

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <strong>Proceed With Investment?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('deposit-post') }}" class="form-inline">
                        @csrf
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 5px;"><i class="fa fa-times"></i> No</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <form method="post" action="{{route('deposit-submit')}}" id="dep-sub">
                @csrf
                <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Enter Amount</h5>
                <br>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-14"></i>
                    <input type="number" class="form-control rounded-xs" name="id" id="c1" placeholder="Amount" oninput="checkAmount()" required />
                    <label for="c1" class="color-theme">Amount</label>
                    <div class="feedback" id="feedback"></div>
                    <span>(required)</span>
                </div>
                <input type="hidden" name="wallet_id" id="wallet_id" value="{{$_GET["payment_type"]}}">
                <input type="hidden" value="" name="plan_id" id="plan_id">
                <div class="row" id="bb">
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
            document.getElementById("plan_id").value = id;
        }
        function checkAmount()
        {
            var x = document.getElementById("c1");
            var pl = document.getElementById("plan_id");
            var wa = document.getElementById("wallet_id");
            var amount = x.value;
            var plan = pl.value;
            var wallet = wa.value;
            getCheck(amount,plan,wallet);
            async function getCheck(amount,plan,wallet)
            {
                var amt = amount;
                var pla = plan;
                var wal = wallet;
                const response= await fetch('/deposit-amount?amount='+amt+'&plan='+pla+'&wallet='+wal)
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

