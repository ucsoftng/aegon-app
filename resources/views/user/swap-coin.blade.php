@extends('layouts.mobile-user')
@section('content')
        <div class="card card-style">
            <div class="content mt-1">
                <form method="post" action="{{route('sswap-coin')}}" class="form-group">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Select Coin To Swap From</label>
                            <select class="form-control" name="wallet_1" id="wallet_1" type="text" required>
                                <option value="">Select One Coin</option>
                                @foreach($wallets as $w)
                                    <option value="{{$w->id}}">{{$w->wallets->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount To Swap in <strong>USD</strong></label>
                            <input class="form-control" type="text" name="amount" id="amount" placeholder="Amount To Swap in USD" required>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <img src="{{asset('img/arr.png')}}" alt="" style="width: 80px;">
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Select Coin To Swap To</label>
                            <select class="form-control" name="wallet_2" type="text" id="wallet_2" required>
                                <option value="">Select Coin</option>
                                @foreach($pay as $w)
                                    <option value="{{$w->id}}">{{$w->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="modal-loader" style="display: none; text-align: center;">
                            <!-- ajax loader -->
                            <img src="{{ asset('img/ajax_loader.gif') }}" style="width: 50px; height: 50px;">
                            <p>Please Wait....</p>
                        </div>
                        <div class="form-group">
                            <label>Amount To Receive in Crypto</label>
                            <input class="form-control" type="text" name="amount2" id="amount_2" placeholder="Amount To Receive" readonly required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="result"></div>
                </div>

            </form>
            </div>
        </div>
@endsection
@section('scripts')
<script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function () {

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
                    $("#result").html(data);
                }
            );
        });
    });
</script>
<script>
    $(document).ready(function () {

        $('#wallet_2').on('input', function ()  {

            var amount = $("#amount").val();
            var wallet2 = $("#wallet_2").val();
            $('#modal-loader').show();

            // $('#wallet_2').find('option').not(':first').remove();
            $.post(
                '{{ url('/swap-check') }}',
                {
                    _token: '{{ csrf_token() }}',
                    amount: amount,
                    wallet2: wallet2
                },
                function (data) {
                    // $("#result").html(data);
                    $("#amount_2").val(data);
                    $('#modal-loader').hide();
                    $("#result").html("<div class='col-md-12 col-sm-offset-4'><button type='submit' class='btn btn-info bt2'><i class='fa fa-send'></i> Swap</button></div>");
                }
            );
        });
    });
</script>
@endsection