
@extends('layouts.admin')
@section('title', 'Change password')
@section('content')

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <form class="form-horizontal" action="{{ route('update-profile') }}" enctype="multipart/form-data" method="post" role="form">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>Name</strong></label>

                                <div class="col-md-12">
                                    <input value="{{ $admin->name }}" class="form-control input-lg" name="name"
                                           placeholder="Admin Name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>Admin Email</strong></label>

                                <div class="col-md-12">
                                    <input value="{{ $admin->email }}" class="form-control input-lg" name="email"
                                           placeholder="Admin Email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>Admin Image</strong></label>

                                <div class="col-md-12">
                                    <img style="width: 25%;" src="{{ asset('assets/images') }}/{{ $admin->image }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label"><strong>Change Admin Image</strong></label>

                                <div class="col-md-12">
                                    <input class="form-control input-lg" name="image" type="file">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-offset-3 col-md-12">
                                    <button type="submit" class="btn btn-success btn-block"><i class="entypo-direction"></i> Update Profile</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->

@endsection

