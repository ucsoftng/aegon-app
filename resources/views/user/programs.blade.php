@extends('layouts.mobile-user')

@section('content')
    <div class="mb-5">
        <div class="content mt-1">
            <div class="tabs tabs-borders" id="tab-group-4">
                <div class="tab-controls">
                    <a class="font-13" data-bs-toggle="collapse" href="#tab-10" aria-expanded="true">Crypto Bots</a>
                    <a class="font-13" data-bs-toggle="collapse" href="#tab-11" aria-expanded="false">Forex Bots</a>
                </div>
                <div class="mt-3"></div>
                <div class="collapse show" id="tab-10" data-bs-parent="#tab-group-4">
                    @foreach($plan as $p)
                        <div class="col-md-4" style="padding-bottom: 10px;">
                            <div class="card card-style">
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $p->name }}</h3>
                                    <h5 class="card-text text-center">
                                        <strong>{{ $basic->currency }} {{ number_format($p->minimum) }}
                                            - {{ $basic->currency }} @if($p->maximum >= 1000000) Unlimited @else{{ number_format($p->maximum) }}@endif</strong></h5>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item">ROI - {{ $p->percent }}% - {{ $p->end_percent }}% {{ $p->compound->name }}</li>
                                        <li class="list-group-item">
                                            Total ROI - {{ $p->total_percent }}%
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="collapse" id="tab-11" data-bs-parent="#tab-group-4">
                    @foreach($forex as $p)
                        <div class="col-md-4" style="padding-bottom: 10px;">
                            <div class="card card-style">
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $p->name }}</h3>
                                    <h5 class="card-text text-center">
                                        <strong>{{ $basic->currency }} {{ number_format($p->minimum) }}
                                            - {{ $basic->currency }} @if($p->maximum >= 1000000) Unlimited @else{{ number_format($p->maximum) }}@endif</strong></h5>
                                    <ul style='font-size: 15px;' class="list-group text-center bold">
                                        <li class="list-group-item">ROI - {{ $p->percent }}% - {{ $p->end_percent }}% {{ $p->compound->name }}</li>
                                        <li class="list-group-item">
                                            Total ROI - {{ $p->total_percent }}%
                                        </li>
                                        <li class="list-group-item">Stop Loss - {{$p->stop_loss}}</li>
                                        <li class="list-group-item">Risk Factor - {{$p->risk_factor}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection

