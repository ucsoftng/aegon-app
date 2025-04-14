@extends('layouts.mobile-user')

@section('content')
    <div class="card card-style mb-5">
        <div class="content mx-3 mt-3">
            <hr>
            @php $i = 0;@endphp
            @foreach($support as $p)
            @php $i++;@endphp
            <div class="pt-3">
                <div class="d-flex mt-n2 ms-3">
                            <span class="badge text-uppercase px-2 py-2 @if($p->status == 1) gradient-yellow @elseif($p->status == 2) gradient-green @elseif($p->status == 3) gradient-blue @elseif($p->status == 9) gradient-green @else gradient-red @endif text-black">
                                @if($p->status == 1) Open  @elseif($p->status == 2) Answer @elseif($p->status == 3) Customer Reply @elseif($p->status == 9) Closed @else
                                    Inconclusive @endif
                            </span>
                    <span class="align-self-center ms-auto">
                                {{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}
                            </span>
                </div>
                <div class="content">
                    <div class="d-flex">
                        <div>
                            <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->ticket_number }}</h6>
                            <h5>
                                 {{ $p->subject }}
                            </h5>
                        </div>
{{--                            <div class="align-self-center ms-auto">--}}
{{--                                <h5>{{ $basic->currency }} {{ number_format($p->amount) }}</h5>--}}
{{--                            </div>--}}
                    </div>
                    <div class="d-flex">
                        <div class="align-self-center ms-auto">
                            <a href="{{ route('support-message',$p->ticket_number) }}" class="btn text-uppercase px-2 py-1 gradient-yellow text-black"><i class="bi bi-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>


@endsection
