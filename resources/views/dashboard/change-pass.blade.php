@extends('layouts.admin')
@section('title', 'Change password')
@section('content')

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" action="" method="post" role="form">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>Current Password</strong></label>

                                <div class="col-md-12">
                                    <input class="form-control input-lg" name="current_password"
                                           placeholder="Current Password" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>New Password</strong></label>

                                <div class="col-md-12">
                                    <input class="form-control input-lg" name="password" placeholder="New Password"
                                           type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>New Password Again</strong></label>

                                <div class="col-md-12">
                                    <input class="form-control input-lg" name="password_confirmation"
                                           placeholder="New Password Again" type="password">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-danger btn-block"><i class="entypo-direction"></i> Change Password</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->







@endsection