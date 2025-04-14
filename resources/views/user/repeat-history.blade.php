@extends('layouts.mobile-user')

@section('content')

        @php $i = 0 @endphp
        @foreach($deposit as $p)
            @php $i++ @endphp
            @php

                $rep = \App\Repeat::whereDeposit_id($p->id)->first()
            @endphp
            <div class="card card-style py-3">
                <div class="content px-2 text-center">
                    <div class="panel panel-{{ $p->status == 1 ? 'success' : 'info' }} panel-pricing">
{{--                        <div class="card-header bg-{{ $p->status == 1 ? 'success' : 'info' }}">--}}
                        <div class="card-header">
                            <h4><b>{{ $p->plan->name }}</b></h4>
                        </div>
                        <div style="font-size: 18px;padding: 18px;" class="card-body text-center">
                            <h5><strong>Trading - {{ $basic->currency }} {{ $p->amount }} </strong></h5>

                            <ul style='font-size: 15px;' class="list-group text-center bold">
                                <li class="list-group-item"> Commission - {{ $p->percent }}%</li>
                            </ul>
                        </div>
                        @php $wid = (100*$rep->rebeat) /$p->time  @endphp
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            @if($wid == 0)
                                <div class="progress m-b-30 " style="height: 20px !important;">
                                    <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 100%; ">
                                        <span style="color: green; font-size: medium;"><strong>Running</strong></span>
                                    </div>
                                </div>
                            @else
                                <div class="progress m-b-30" style="height: 20px !important;">
                                    <div class="progress-bar bg-success progress-bar-striped bar{{ $i }}" style="width:{{$wid}}%">
                                        <span>{{ round($wid) }}% Complete</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <script>
                            $('.bar{{ $i }}').animate({
                                width: '{{ $wid }}%'
                            }, 2500);
                        </script>

                        <div class="card-footer" style="overflow: hidden">
                            <div class="col-md-12">
                                <a href="{{ route('repeat-table',$p->id) }}"
                                   class="default-link btn btn-m rounded-s gradient-highlight shadow-bg shadow-bg-s px-5 mb-0 mt-2">
                                    <i class="fa fa-mail-forward"></i> View Profit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
            
{{--            <hr>--}}
{{--            <div class="text-center">--}}
{{--                {{ $deposit->links() }}--}}
{{--            </div>--}}



@endsection
@section('scripts')



@endsection

