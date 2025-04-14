@extends('layouts.mobile-user')
@section('style')

@endsection
@section('content')
    <div class="card card-style">
        <div class="card-body">
            @foreach($activity as $p)
                <div class="">
                    <div class="d-flex mt-n2 ms-3">
                        <span class="badge text-uppercase px-2 py-1 @if($p->balance_type == 4) gradient-red @elseif($p->balance_type == 2) gradient-red @else gradient-green @endif text-black" style="line-height: normal;">
                                    @if($p->balance_type == 1)
                                        Fund Add
                                    @elseif($p->balance_type == 2)
                                        Bot Trade
                                    @elseif($p->balance_type == 3)
                                        Profit
                                    @elseif($p->balance_type == 4)
                                        Withdraw
                                    @elseif($p->balance_type == 5)
                                        Referral
                                    @elseif($p->balance_type == 7)
                                        Refund
                                    @elseif($p->balance_type == 8)
                                        Deposit
                                    @elseif($p->balance_type == 10)
                                        Deposit Top Up
                                    @elseif($p->balance_type == 11)
                                        Live Trade
                                    @endif
                                </span>
                        <h6 class="align-self-center ms-auto">
                            {{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}
                        </h6>
                    </div>
                    <div class="content">
                        <div class="d-flex">
                            <div>
                                @if($p->balance_type == 1)
                                    <img src="{{asset('mobile/images/wallet.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 2)
                                    <img src="{{asset('mobile/images/trade.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 3)
                                    <img src="{{asset('mobile/images/profit.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 4)
                                    <img src="{{asset('mobile/images/withdraw.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 5)
                                    <img src="{{asset('mobile/images/refer.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 7)
                                    <img src="{{asset('mobile/images/refund.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 8)
                                    <img src="{{asset('mobile/images/wallet.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 10)
                                    <img src="{{asset('mobile/images/trade.png')}}" style="width: 40px;">
                                @elseif($p->balance_type == 11)
                                    <img src="{{asset('mobile/images/dept.png')}}" style="width: 40px;">
                                @endif
                            </div>
                            <div class="align-self-center ms-auto">
                                <h5>{{ $basic->currency }}{{ $p->balance }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @if($loop->last)
                @else
                    <div class="divider"></div>
                @endif


{{--                        <tr>--}}
{{--                            <td width="10%">{{ $p->balance }} - {{ $basic->currency }}</td>--}}
{{--                            <td width="9%">--}}
{{--                                @if($p->charge == null)--}}
{{--                                    <i>Null</i>--}}
{{--                                @else--}}
{{--                                    {{ $p->charge }} - {{ $basic->currency }}--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>{{ $p->details }}</td>--}}
{{--                            <td width="12%">{{ round($p->old_balance,3) }} - {{ $basic->currency }}</td>--}}
{{--                            <td width="12%">{{ round($p->new_balance,3) }} - {{ $basic->currency }}</td>--}}
{{--                        </tr>--}}
                    @endforeach

        </div>
    </div>

@endsection
@section('scripts')


@endsection