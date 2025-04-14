@extends('layouts.mobile-user-2')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-style">
                <div class="card-header">
                    <div class="text-center">
                        <h4>Account Balance : <br>
                            <strong>{{ Auth::user()->amount }}
                                - {{ $basic->currency }}</strong></h4>
                    </div>
                </div>
                <div class="card-body">
                        <div class="form-custom form-label form-icon mb-3 bg-transparent">
                            <label class="col-sm-6   control-label">Amount to Deposit
                                : </label>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" value="{{ $fund->amount }}" readonly
                                           name="amount" id="amount" class="form-control rounded-xs"
                                           placeholder="Enter Deposit Amount" required>
                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-custom form-label form-icon mb-3 bg-transparent">
                            <label class="col-sm-6   control-label">Rate: </label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" value="{{ $fund->rate }}" readonly
                                           name="rate" id="amount" class="form-control rounded-xs"
                                           placeholder="Enter Deposit Amount" required>
                                    <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                </div>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label class="col-sm-6   control-label">Sub--}}
{{--                                Total (USD) : </label>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="input-group">--}}
{{--                                    <input type="text"--}}
{{--                                           value="{{ round($fund->amount / $fund->rate , 3) }}"--}}
{{--                                           readonly name="rate" id="amount" class="form-control"--}}
{{--                                           placeholder="Enter Deposit Amount" required>--}}
{{--                                    <span class="input-group-addon red">&nbsp;<strong> USD </strong></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    <div class="form-custom form-label form-icon mb-3 bg-transparent">
                        <label class="col-sm-6 control-label">Charge (USD)
                            : </label>
                        <div class="col-md-12">
                            @php $charge = $payment->fix + (($fund->amount * $payment->percent) / 100) @endphp
                            <div class="input-group">
                                <input type="text" value="{{ $charge }}" readonly
                                       name="rate" id="amount" class="form-control rounded-xs"
                                       placeholder="Enter Deposit Amount" required>
                                <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-custom form-label form-icon mb-3 bg-transparent">
                        <label class="col-sm-6  control-label">Total
                            USD : </label>
                        <div class="col-md-12">
                            @php $total = ($charge + $fund->amount) / $payment->rate @endphp
                            <div class="input-group">
                                <input type="text" value="{{ round(($total),3) }}" readonly
                                       name="rate" id="amount" class="form-control rounded-xs"
                                       placeholder="Enter Deposit Amount" required>
                                <span class="input-group-addon red">&nbsp;<strong> $ </strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <form method="post" action="{{route('btc-preview')}}">
                            @csrf

                            <input type="hidden" name="amount" value="{{ round(($total),3)  }}">
                            <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                            <input type="hidden" name="transaction_id"
                                   value="{{ $fund->transaction_id }}">
                            <input type="hidden" name="charge" value="{{ $charge }}">
                            <div class="row">
                                <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Deposit this Package.?</strong>
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
    <script type='text/javascript'>

        jQuery(document).ready(function () {

            $('#amount').on('input', function () {
                var amount = $("#amount").val();
                var plan = $("#plan").val();
                $.post(
                    '{{ url('/deposit-amount') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        plan: plan
                    },
                    function (data) {
                        $("#result").html(data);
                    }
                );
            });
        });
    </script>

@endsection

