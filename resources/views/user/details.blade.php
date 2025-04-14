@extends('layouts.mobile-user')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <style>
        .btn{
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-5">
            <div class="card card-style">
                <div class="card-header">
                    User Details
                </div>
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="panel-body">

                        <div class="well well-lg">
                            <div class="profile-header-container">
                                <div class="profile-header-img text-center">
                                    <img class="img-circle" src="{{ asset('assets/images') }}/{{ $member->image }}" style="border-radius: 50% !important; height: 100px; width: 100px;"/>
                                    <!-- badge -->
                                    <div class="rank-label-container">
                                        <span class="badge badge-info rank-label">Balance: {{ $member->amount }} - {{ $basic->currency }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-body text-center">
                                <h3>{{ $member->name }}</h3>
                                <div class="divider"></div>
                                <h5> E-Mail : {{ $member->email }}</h5>
                                <div class="divider"></div>
                                <h5> Phone : {{ $member->phone }}</h5>
                                <div class="divider"></div>
                                <h5> Address : {{ $member->address }}</h5>
{{--                                <hr>--}}
{{--                                <h5> Referral Link : https://{{$site_title}}/register?ref={{ $member->reference }}</h5>--}}
                                <div class="divider"></div>
                                <h5> Referral Code : <span class="badge gradient-blue">{{ $member->reference }}</span></h5>
                                <div class="divider"></div>
                                <h5> Referred Accounts : {{ $total_reference_user }} - Account</h5>
                                <div class="divider"></div>
{{--                                <button style="margin-top: 10px;" class="btn has btn-info btn-block" data-clipboard-text="https://{{$site_title}}/register?ref={{ $member->reference }}">--}}
{{--                                    <i class="fa fa-clipboard" aria-hidden="true"></i>  Copy Referral Link--}}
{{--                                </button>--}}
{{--                                <hr>--}}
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('user-edit') }}" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('user-password') }}" class="btn btn-full gradient-yellow shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100"><i class="fa fa-bolt"></i> Password</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" class="btn btn-danger  icon-left btn-block"><i class="fa fa-sign-out"></i> User Log Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="col-lg-7">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    Last Deposit Status--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive pt-3">--}}
{{--                    <table class="table table-bordered">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Date Time</th>--}}
{{--                            <th>Plan</th>--}}
{{--                            <th>Amount</th>--}}
{{--                            <th>Profit Status</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @php $i = 0;@endphp--}}
{{--                        @foreach($last_deposit as $p)--}}
{{--                            @php $i++;@endphp--}}
{{--                            <tr>--}}
{{--                                <td>{{ date('d M y - H:s A',strtotime($p->created_at)) }}</td>--}}
{{--                                <td><span class="aaaa"><strong>{{ $p->plan->name }}</strong></span></td>--}}
{{--                                <td>{{ $p->amount }} - USD</td>--}}
{{--                                <td>--}}
{{--                                    <div class="row">--}}
{{--                                        @php $rep = \App\Repeat::whereDeposit_id($p->id)->first() @endphp--}}
{{--                                        @php $wid = (100*$rep->rebeat) /$p->time  @endphp--}}
{{--                                        <div class="col-xs-12 col-sm-10 col-sm-offset-1 progress-container">--}}
{{--                                            @if($wid == 0)--}}
{{--                                                <div class="progress" style="height: 15px;">--}}
{{--                                                    <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">--}}
{{--                                                        <span style="color: green"><strong>Running</strong></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                <div class="progress progress-striped active">--}}
{{--                                                    <div class="progress-bar progress-bar-striped bar{{ $i }} bg-success" style="width:0%"><span>{{ round($wid) }}% Complete</span></div>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <script>--}}
{{--                                            $('.bar{{ $i }}').animate({--}}
{{--                                                width: '{{ $wid }}%'--}}
{{--                                            }, 2500);--}}
{{--                                        </script>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 col-sm-12">--}}
{{--                            <a style="margin-bottom: 0px;" href="{{ route('deposit-history') }}" class="btn btn-info btn-sm btn-block  icon-left">--}}
{{--                                <i class="fa fa-cloud-upload"></i> All Deposit History--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 col-sm-12">--}}
{{--                            <a style="margin-bottom: 0px;" href="{{ route('repeat-history') }}" class="btn btn-info btn-sm btn-block  icon-left">--}}
{{--                                <i class="fa fa-reply-all"></i> All Profit History--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
@endsection