@extends('layouts.new-user')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3>Current Balance : <strong>{{ Auth::user()->amount }} - {{ $basic->currency }}</strong>
                            </h3>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-6 control-label">Select Wallet to Trade From : </label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <select type="text" name="wallet" id="wallet" class="form-control" required>
                                        <option value="">Select Wallet</option>
                                        @foreach($wallets as $w)
                                            <option value="{{$w->id}}">{{$w->wallets->name}} ${{$w->amount_in_usd}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Amount : </label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="number" value="" name="amount" id="amount" class="form-control"
                                           placeholder="Enter Trade Amount" required>
                                    <span class="input-group-addon">&nbsp;<strong>{{ $basic->currency }}</strong></span>
                                    <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12 text-center">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 style="font-size: 28px;"><b>{{ $plan->name }}</b></h3>
                            </div>
                            <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                <p><strong>{{ $plan->minimum }} {{ $basic->currency }}
                                        - {{ $plan->maximum }} {{ $basic->currency }}</strong></p>
                            </div>
                            <ul style='font-size: 15px;' class="list-group text-center bold">
                                <li class="list-group-item"><i class="fa fa-check"></i> Commission
                                    - {{ $plan->percent }} <i class="fa fa-percent"></i></li>
                                <li class="list-group-item"><i class="fa fa-check"></i> Time - {{ $plan->time }} times
                                </li>
                                <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span
                                            class="aaaa">{{ $plan->compound->name }}</span></li>
                            </ul>
                            <div class="card-footer" style="overflow: hidden">
                                <div class="col-sm-12">
                                    <a href="{{ route('deposit-new') }}"
                                       class="btn btn-info btn-block">
                                        <i class="fa fa-arrow-left"></i> Go Back Package Page
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <strong>Proceed with Investment?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('deposit-submit') }}" class="form-inline" id="ffdep">
                        @csrf
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="wallet_id" value="" id="wallet_id">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 5px;"><i data-feather="x"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-success" id="subdep"><i data-feather="check"></i> Yes I'm Sure..!
                        </button>
                        <button type="button" class="btn btn-success disabled" id="subdep2" style="display: none;"><i data-feather="loader"></i> Please Wait...
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $("#ffdep").submit(function () {
                // $(".submitBtn").attr("disabled", true);
                // return true;
                $("#subdep").hide();
                $("#subdep2").show();
            });
        });
    </script>
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount').add('#wallet').on('input', function () {
                var amount = $("#amount").val();
                var plan = $("#plan").val();
                var wallet = $("#wallet").val();
                $("#wallet_id").val(wallet);
                $.post(
                    '{{ url('/deposit-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        plan: plan,
                        wallet: wallet
                    },
                    function (data) {
                        $("#result").html(data);
                    }
                );
            });
        });
    </script>

@endsection

