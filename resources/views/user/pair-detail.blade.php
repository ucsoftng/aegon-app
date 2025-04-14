@extends('layouts.mobile-user')

@section('content')

    <div class="container" style="padding-right: 0; padding-left: 0;">
        <div class="card" style="padding-left: 15px; padding-right: 15px;">
            <div class="row">
                <div class="col-8">
                    <h4>{{$trading_pairs->last}} USD</h4>
                </div>
                <div class="col-4">
                    <h4>{{$page_title}}</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-4">
                    <h6><span class="text-success">High {{$trading_pairs->high}} <i class="bi bi-arrow-up"></i> </span></h6>
                </div>
                <div class="col-4">
                    <h6><span class="text-danger">Low {{$trading_pairs->low}} <i class="bi bi-arrow-down"></i></span></h6>
                </div>
                <div class="col-4">
                    <h6>Vol {{number_format((float)$trading_pairs->volume,2, '.','')}} B</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table color-theme mb-2">
                            <thead>
                            <tr>
                                <th scope="col">Buy</th>
                                <th scope="col">Volume</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $tr)
                                <tr>
                                    @if($tr->type == 0)
                                        <td>{{number_format((float)$tr->amount,4, '.','')}}</td>
                                        <td>{{number_format((float)$tr->price,4, '.','')}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table color-theme mb-2">
                            <thead>
                            <tr>
                                <th scope="col">Sell</th>
                                <th scope="col">Volume</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $tr)
                                <tr>
                                    @if($tr->type == 1)
                                        <td>{{number_format((float)$tr->amount,4, '.','')}}</td>
                                        <td>{{number_format((float)$tr->price,4, '.','')}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection