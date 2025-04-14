@extends('layouts.mobile-user')
@section('content')
    <div class="card card-style">
        <div class="card-header text-center">
            <h5>Profit for Trading {{$dep->deposit_number}} : ${{$repeatamount}}</h5>
        </div>
        <div class="divider divider-m mx-auto bg-fade-green"></div>
        @php $i = 0;@endphp
        @foreach($repeat as $p)
            @php $i++;@endphp
            <div class="">
                <div class="d-flex mt-n2 ms-3">
                    <span class="badge text-uppercase px-2 py-1 gradient-green text-black">
                        Completed
                    </span>
                    <span class="align-self-center ms-auto px-2">
                        {{ date('d-m-Y h:s A',strtotime($p->made_time)) }}
                    </span>
                </div>
                <div class="content">
                    <div class="d-flex">
                        <div>
                            <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->deposit->deposit_number }}</h6>
                            <h5>{{ $p->deposit->plan->name }}</h5>
                        </div>
                        <div class="align-self-center ms-auto">
                            <h5>{{ $basic->currency }}{{ $p->balance }} <span>{{ $p->deposit->compound->name }}</span></h5>
                        </div>
                    </div>
{{--                    <div class="d-flex">--}}
{{--                        <div class="align-self-center ms-auto">--}}
{{--                            <p>--}}
{{--                                {{ $p->deposit->compound->name }}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="divider"></div>
        @endforeach

    </div>

@endsection
@section('scripts')


@endsection