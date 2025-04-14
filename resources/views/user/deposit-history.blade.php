@extends('layouts.mobile-user')

@section('content')
    <div class="card card-style mb-5">
        <div class="content mt-1">
            <div class="tabs tabs-borders" id="tab-group-4">
                <div class="tab-controls">
                    <a class="font-13" data-bs-toggle="collapse" href="#tab-10" aria-expanded="true">Bots</a>
                    <a class="font-13" data-bs-toggle="collapse" href="#tab-11" aria-expanded="false">Live</a>
                </div>
                <div class="mt-3"></div>
                <div class="collapse show" id="tab-10" data-bs-parent="#tab-group-4">
                    @php $i = 0 @endphp
                    @foreach($deposit as $p)
                        @php $i++ @endphp
                        @php
                            $rep = \App\Repeat::whereDeposit_id($p->id)->first()
                        @endphp
                        <a href="{{ route('repeat-table',$p->id) }}">
                            <div class="">
                                <div class="d-flex">
                                    <span class="badge text-uppercase px-2 py-1 @if($p->status == 0) gradient-yellow @else gradient-green @endif text-black" style="line-height: 1.5;">
                                        @if($p->status == 0) Running @else Completed @endif
                                    </span>
                                    <span class="align-self-center ms-auto" style="color: grey;">
                                        {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                                    </span>
                                </div>
                                <div class="content">
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->deposit_number }}</h6>
                                            <h5>{{ $p->plan->name }}</h5>
                                        </div>
                                        <div class="align-self-center ms-auto">
                                            <h6 class="mb-n1">{{$p->wallets->wallets->name}}</h6>
                                            <h5>{{ $basic->currency }}{{ $p->amount }}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <p>
                                                {{ $p->percent }}% {{ $p->compound->name }}
                                            </p>
                                        </div>
                                        <div class="align-self-center ms-auto">
                                            <p>
                                                <a href="#" onclick="add({{ $p->id }});" data-bs-toggle="offcanvas" data-bs-target="#menu-deposit" class="badge text-uppercase px-2 py-1 gradient-yellow text-black">Top Up</a>
                                            </p>
                                        </div>
                                    </div>
                                    @php $wid = (100*$rep->rebeat) /$p->time  @endphp

                                        <div class="col-md-12" style="margin-top: 10px;">
                                            @if($wid == 0)
                                                <div class="progress m-b-30 " style="height: 12px !important;">
                                                    <div class="progress-bar bg-warning progress-bar-striped"
                                                         role="progressbar" style="width: 100%; ">
                                                        <span style="color: green; font-size: 10px;"><strong>Running</strong></span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="progress m-b-30" style="height: 12px !important;">
                                                    <div class="progress-bar bg-success progress-bar-striped bar{{ $i }}"
                                                         style="width:{{$wid}}%">
                                                        <span style="font-size: 10px;">{{ round($wid) }}% Complete</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    <script>
                                        $('.bar{{ $i }}').animate({
                                            width: '{{ $wid }}%'
                                        }, 2500);
                                    </script>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
                <div class="collapse" id="tab-11" data-bs-parent="#tab-group-4">
                    @foreach($live as $p)
                        <div class="">
                            <div class="d-flex mt-n2 ms-3">
                                <span class="badge text-uppercase px-2 py-1 @if($p->status == 0) gradient-yellow @else gradient-green @endif text-black">
                                    @if($p->status == 0) Running @else Completed @endif
                                </span>
                                <span class="align-self-center ms-auto">
                                    {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                                </span>
                            </div>
                            <div class="content">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="mb-n1 opacity-80 color-highlight">{{ $p->symbol }}</h6>
                                        <h5>{{ $p->currency }}</h5>
                                    </div>
                                    <div class="align-self-center ms-auto">
                                        <h5>{{ $basic->currency }}{{ $p->amount }}</h5>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <p>
                                            @if($p->result == 'Pending')
                                                <span class="badge text-uppercase px-2 py-1 gradient-orange text-black">{{ $p->result }}</span>
                                            @elseif($p->result == 'Win')
                                                <span class="badge text-uppercase px-2 py-1 gradient-green text-black">{{ $p->result }}</span>
                                            @elseif($p->result == 'Lose')
                                                <span class="badge text-uppercase px-2 py-1 gradient-red text-black">{{ $p->result }}</span>
                                            @elseif($p->result == 'Draw')
                                                <span class="badge text-uppercase px-2 py-1 gradient-yellow text-black">{{ $p->result }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="align-self-center ms-auto">
                                        <p>
                                            @if($p->high_low == 1)
                                                <span class="badge text-uppercase px-2 py-1 gradient-red text-black">Low</span>
                                            @elseif($p->high_low == 2)
                                                <span class="badge text-uppercase px-2 py-1 gradient-green text-black">High</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <form method="POST" action="{{ route('user-top-up') }}" id="top-up">
                @csrf
                <h5 class="mb-n1 font-12 color-highlight font-700 text-uppercase pt-1">Top Up Amount</h5>
                <br>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash font-13"></i>
                    <input class="form-control rounded-xs" id="c6" aria-label="Floating label select example" name="amount" required>
                    <label for="c1" class="color-theme">Top Up Amount</label>
                </div>
                <input type="hidden" name="deposit_id" class="abir_id" id="deposit_id" value="">
                <div class="row">
                    <input type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4" id="proceed" value="Proceed">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script>
        function add(id)
        {
            document.getElementById("deposit_id").value = id;
        }

        $(document).ready(function () {
            $("#proceed").click(function (event) {
                $('#proceed').val('Processing …');
                $('#top-up').submit();
            });
        });

    </script>
@endsection