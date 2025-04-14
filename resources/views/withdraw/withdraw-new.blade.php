@extends('layouts.mobile-user')

@section('content')
        @foreach($method as $p)
            <div class="card card-style">
                <div class="content mx-3 mt-3">
                    <div class="d-flex">
                        <div>
                            <h4>
                                <img style="width: 30px; height: 30px;" class="image-responsive"
                                     src="{{ asset('assets/images') }}/{{ $p->wallets->image }}" alt="">
                                <strong>{{ $p->wallets->name }}</strong>
                            </h4>
                        </div>
                        <div class="ms-auto">
                            <h5>{{$basic->currency}}{{$p->amount_in_usd ?? '0.00'}}</h5>
                            <p>{{  $p->amount_in_crypto ?? '0.00'}} </p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-full btn-s gradient-highlight shadow-bg shadow-bg-xs"
                       data-bs-toggle="offcanvas" data-bs-target="#menu-deposit" onclick="add({{ $p->id }});">
                        Withdraw
                    </a>
                </div>
            </div>
        @endforeach

    @foreach($method as $p)
        <div class="modal fade" id="modal-{{ $p->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title"> Withdraw via <strong>{{ $p->wallets->name }}</strong>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form method="post" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Amount : </label>
                                        <div class="col-md-12">
                                            <span style="color: green;margin-left: 10px;"><strong>Charge ({{ $basic->symbol }}{{ $p->wallets->fix }} + {{ $p->wallets->percent }}%)</strong></span>
                                            <div class="input-group" style="margin-bottom: 15px;">
                                                <input type="text" value="" id="amount{{ $p->id }}" name="amount" class="form-control" placeholder="Enter Amount" required>
                                                <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                                <input type="hidden" name="method_id" id="method_id{{ $p->id }}" value="{{ $p->id }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div id="result{{ $p->id }}" class="col-md-12"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <form method="post" action="">
                @csrf
                <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Enter Amount</h5>
                <br>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-14"></i>
                    <input type="number" class="form-control rounded-xs" name="amount" id="c1" placeholder="Amount" oninput="checkAmount()" required />
                    <label for="c1" class="color-theme">Amount</label>
                    <div class="feedback" id="feedback"></div>
                    <span>(required)</span>
                </div>
                <input type="hidden" name="method_id" id="method_id" value="">
                <div class="row" id="bb">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        function add(id)
        {
            document.getElementById("method_id").value = id;
        }
        function checkAmount()
        {
            var x = document.getElementById("c1");
            var wa = document.getElementById("method_id");
            var amount = x.value;
            var wallet = wa.value;
            getCheck(amount,wallet);
            async function getCheck(amount,wallet)
            {
                var amt = amount;
                var wal = wallet;
                const response= await fetch('/withdraw-check-amount?amount='+amt+'&method_id='+wal)
                const data= await response.json();
                if(data.status == "200")
                {
                    document.getElementById("feedback").innerHTML= '<p style="color: green;">'+data.data+'</p>';
                    document.getElementById('bb').innerHTML =
                        '<button type="submit" id="ssbtn" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4">Proceed</button>';
                }else
                {
                    document.getElementById("feedback").innerHTML= '<p style="color: red;">'+data.data+'</p>';
                    document.getElementById('bb').innerHTML = '';
                }
            }

        }
    </script>

{{--    @foreach($method as $p)--}}
{{--        <script type='text/javascript'>--}}

{{--            jQuery(document).ready(function () {--}}

{{--                $('#amount{{ $p->id }}').on('input', function () {--}}
{{--                    var amount = $("#amount{{ $p->id }}").val();--}}
{{--                    var method_id = $("#method_id{{ $p->id }}").val();--}}
{{--                    $.post(--}}
{{--                        '{{ url('/withdraw-check-amount') }}',--}}
{{--                        {--}}
{{--                            _token: '{{ csrf_token() }}',--}}
{{--                            amount: amount,--}}
{{--                            method_id: method_id--}}
{{--                        },--}}
{{--                        function (data) {--}}
{{--                            $("#result{{ $p->id }}").html(data);--}}
{{--                        }--}}
{{--                    );--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endforeach--}}
@endsection

