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

                    <form method="post" action="{{route('store-manual-admin-fund')}}">
                            @csrf
                            <div class="row">
                            <div class="col-md-3">
                                <label>Select Payment Option</label>
                                <select class="form-control" name="payment_type">
                                    @foreach($payment as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Amount</label>
{{--                                <span style="color: green;margin-left: 10px;"><strong>{{ $basic->currency }} Charge ({{ $payment->fix }} + {{ $payment->percent }}) {{ $basic->currency }}</strong></span>--}}
                                <input class="form-control" name="amount" required>
                            </div>
{{--                            <input type="hidden" name="rate" value="{{ $payment->rate }}">--}}
{{--                            <input type="hidden" name="fix" value="{{ $payment->fix }}">--}}
{{--                            <input type="hidden" name="percent" value="{{ $payment->percent }}">--}}
                            <input type="hidden" name="user_id" value="{{ $id }}">

                                <div class="col-md-3">
                                    <button type="submit" class="btn-primary btn-lg">Create Fund For User</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->
@endsection
