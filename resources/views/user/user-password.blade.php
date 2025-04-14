@extends('layouts.mobile-user')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/cus.css') }}">
    <style>
        .btn {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')

{{--    <div class="card card-style">--}}
{{--        <div class="card-body">--}}
{{--            <h4 class="card-title"></h4>--}}
{{--            <div class="panel-body">--}}

{{--                <div style="margin-bottom: 0;padding-bottom: 10px;" class="well well-lg">--}}
{{--                    <div class="profile-body">--}}
{{--                        <h5>Profile</h5>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <h6>Account Limits:--}}
{{--                                    <button type="button" class="btn btn-outline-success btn-sm">Approved</button>--}}
{{--                                </h6>--}}
{{--                                <h6>Email : @if(Auth::user()->verifyToken == null)--}}
{{--                                        <span class="label label-success"> <i class="fa fa-check"></i> Verified</span>--}}
{{--                                    @else--}}
{{--                                        <span class="label label-warning"> <i class="fa fa-check"></i> UnVerified</span>--}}
{{--                                    @endif</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <h5>Preferences</h5>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <h6>Email Notifications:--}}
{{--                                    <button type="button" class="btn btn-outline-success btn-sm">Approved</button>--}}
{{--                                </h6>--}}
{{--                                <h6>Local Currency:--}}
{{--                                    <button type="button" class="btn btn-outline-success btn-sm">US Dollar ($)</button>--}}
{{--                                </h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <h5>Security</h5>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12">--}}
{{--                                <h6>KYC Verification: @if(Auth::user()->passport_image == null)--}}
{{--                                        <span class="label label-warning"> <i class="fa fa-times"></i> UnVerified</span>--}}
{{--                                    @else--}}
{{--                                        <span class="label label-success"> <i class="fa fa-check"></i> Verified</span>--}}
{{--                                    @endif--}}
{{--                                </h6>--}}
{{--                                <h6>2-Step Verification:--}}
{{--                                    @if(Auth::user()->two_fa == 0)--}}
{{--                                        <button type="button" class="btn btn-outline-warning btn-sm">InActive</button>--}}
{{--                                    @else--}}
{{--                                        <button type="button" class="btn btn-outline-success btn-sm">Active</button>--}}
{{--                                    @endif--}}
{{--                                </h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="card card-style">
        <div class="card-header">
            Update User Password
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('user-password-update',$member->id) }}"
                  enctype="multipart/form-data" method="post" role="form">
                @csrf
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-asterisk font-12"></i>
                    <label class="col-sm-6 control-label">Current Password : </label>
                    <input type="password" class="form-control rounded-xs" name="current_password" value=""
                           placeholder="Current Password" required>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-asterisk font-12"></i>
                    <label class="col-sm-6 control-label">New Password : </label>
                    <input type="password" class="form-control rounded-xs" name="password" value=""
                           placeholder="New Password" required>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-asterisk font-12"></i>
                    <label class="col-sm-6 control-label">Confirm Password : </label>
                    <input type="password" class="form-control rounded-xs" name="password_confirmation" value=""
                           placeholder="Confirm Password" required>
                </div>

                <button class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100">
                    <i class="fa fa-send"></i> Update User Password
                </button>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/dashboard/js/clipboard.min.js') }}"></script>
    <script>
        new Clipboard('.has');
    </script>
    <script src="{{ asset('assets/dashboard/js/fileinput.js') }}"></script>
@endsection