@extends('layouts.admin')
@section('style')

    <script type="text/javascript" src="{{ asset('assets/dashboard/js/nicEdit.js') }}">

    </script>
    <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        //]]>
    </script>

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <h3>Current Balance : <strong>{{ $useramount->amount }} - {{ $basic->currency }}</strong></h3>
                    <form method="post" action="{{route('store-manual-admin-deposit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label>Select Plan</label>
                                <select class="form-control" name="plan_id">
                                    @foreach($plan as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Wallet to deposit From</label>
                                <select class="form-control" name="wallet_id">
                                    @foreach($payment as $p)
                                        <option value="{{$p->id}}">{{$p->wallets->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Amount</label>
                                <span style="color: green;margin-left: 10px;"><strong>{{ $basic->currency }}</strong></span>
                                <input class="form-control" name="id" required>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $id }}">
                        </div>
                        <div class="row" style="text-align: center; padding-top: 40px !important;">
                            <button type="submit" class="btn-primary btn-lg">Invest For User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->
@endsection
