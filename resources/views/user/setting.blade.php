@extends('layouts.mobile-user')

@section('content')

    <div class="card card-style">
        <div class="content mb-3">
            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="profile" style="width: 50px; border-radius: 100px;">
                </div>
                <div class="col-6">
                    <p style="margin-top: 10px !important;">{{Auth::user()->name}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-style">
        <div class="content mb-0">
            <h6 class="text-uppercase mt-n2">Settings</h6>
            <div class="list-group list-custom list-group-m list-group-flush rounded-xs check-visited">
                <a href="{{ route('user-details') }}" class="list-group-item"><i class="has-bg rounded-s bi bg-red-dark bi-person"></i><div>Profile</div><i class="bi bi-chevron-right"></i></a>
                @if(Auth::user()->two_fa == 0)
                    <a href="{{route('start-2fa')}}" class="list-group-item"><i class="has-bg rounded-s bi bg-green-dark bi-columns-gap"></i><div>2FA</div>
                @else
                    <a href="{{route('initialize-2fa')}}" class="list-group-item"><i class="has-bg rounded-s bi bg-green-dark bi-columns-gap"></i><div>2FA</div>
                @endif
                @if(Auth::user()->two_fa == 0)
                    <em class="badge badge-text bg-red-dark">Inactive</em>
                @else
                    <em class="badge badge-text bg-green-dark">Active</em>
                @endif
                    <i class="bi bi-chevron-right"></i></a>
                <a href="{{ route('user-password') }}" class="list-group-item"><i class="has-bg rounded-s bi bg-blue-dark bi-view-list"></i><div>Change Password</div><i class="bi bi-chevron-right"></i></a>
                <a href="{{ route('user-kyc') }}" class="list-group-item"><i class="has-bg rounded-s bi bg-yellow-dark bi-collection"></i>
                    <div>User KYC</div>
                    @if(Auth::user()->passport_image == null)
                        <em class="badge badge-text bg-red-dark">Unverified</em>
                    @else
                        <em class="badge badge-text bg-green-dark">Verified</em>
                    @endif
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="{{ route('user-activity') }}" class="list-group-item"><i class="has-bg rounded-s bi bg-magenta-dark bi-lightning"></i><div>User activity</div><i class="bi bi-chevron-right"></i></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="list-group-item"><i class="has-bg rounded-s bi bg-orange-light bi-segmented-nav"></i><div>Sign out</div><i class="bi bi-chevron-right"></i></a>
                <a href="#" class="list-group-item" data-toggle-theme data-trigger-switch="switch-1">
                    <i class="has-bg rounded-s gradient-dark shadow-bg shadow-bg-xs bi bi-moon-fill font-13"></i>
                    <div>Dark Mode</div>
                    <div class="form-switch ios-switch switch-green switch-s me-2">
                        <input type="checkbox" data-toggle-theme class="ios-input" id="switch-1">
                        <label class="custom-control-label" for="switch-1"></label>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection