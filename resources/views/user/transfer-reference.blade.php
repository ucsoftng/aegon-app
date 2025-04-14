@extends('layouts.mobile-user-2')
@section('content')
    <div class="card card-style">
        <div class="card-body">
            <div class="panel-body">
                <div class="text-center">
                    <h4>{{$page_title}}</h4>
                </div>
                <hr>
                <form method="post" action="{{route('transfer-referral')}}" class="form-group">
                    @csrf
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h5>Referral Balance: ${{$bonus - $balance}}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Amount To Transfer in <strong>USD</strong></label>
                                <input class="form-control" type="text" name="amount" id="amount"
                                       placeholder="Amount To Transfer in USD" required>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <img src="{{asset('img/arr.png')}}" alt="" style="width: 80px;">
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Select Wallet To Transfer To</label>
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
                        </div>
                    </div>
                    <div class="row">
                        <div id="result"></div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#amount').on('input', function () {

                var amount = $("#amount").val();
                $('#modal-loader').show();

                // $('#wallet_2').find('option').not(':first').remove();
                $.post(
                    '{{ url('/ref-trf-check') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                    },
                    function (data) {
                        $('#modal-loader').hide();
                        $("#result").html(data);
                    }
                );
            });
        });
    </script>
@endsection