@extends('layouts.mobile-user')
@section('content')
    <div class="card card-style mb-5">
        <div class="content mx-3 mt-3">
            @foreach($fund as $p)
                <div class="pt-3">
                    <div class="d-flex mt-n2 ms-3">
                                <span class="badge text-uppercase px-2 py-1 @if($p->status == 0) gradient-pink @elseif($p->status == 1) gradient-green @else gradient-red @endif text-black">
                                    @if($p->status == 0) Pending  @elseif($p->status == 1) Completed @else
                                        Inconclusive @endif
                                </span>
                        <span class="align-self-center ms-auto">
                                    {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                                </span>
                    </div>
                    <div class="content">
                        <div class="d-flex">
                            <div>
                                <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->transaction_id }}</h6>
                                <h5>
                                    <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-arrow-up"></i> {{ $p->wallet->name }}
                                </h5>
                            </div>
                            <div class="align-self-center ms-auto">
                                <h5>{{ $basic->currency }} {{ number_format($p->amount) }}</h5>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="align-self-center ms-auto">
                                    <span class="badge gradient-highlight text-black">{{$p->crypto_amount}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

@endsection