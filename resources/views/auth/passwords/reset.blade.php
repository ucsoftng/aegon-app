@extends('layouts.front')

@section('content')
    <style>
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            padding: 15px;
            margin: 50px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 2px 16px;
        }
    </style>
    <!-- login begin -->
    <div class="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="form-area">
                            <div class="row no-gutters">
                                <div class="col-md-12">

                                    <div class="login-form">
                                        @if (session()->has('message'))
                                            <div style="margin-top: 20px;margin-bottom: -10px;"
                                                 class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">&times;
                                                </button>
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        @if (session()->has('status'))
                                            <div style="margin-top: 20px;margin-bottom: -10px;"
                                                 class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">&times;
                                                </button>
                                                {{ session()->get('status') }}
                                            </div>
                                        @endif

                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div style="margin-top: 20px;margin-bottom: -20px;"
                                                     class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-hidden="true">&times;
                                                    </button>
                                                    {!!  $error !!}
                                                </div>
                                            @endforeach
                                        @endif
                                        <form action="{{ route('password.request') }}" method="post"
                                              accept-charset="utf-8">
                                            @csrf

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group">
                                                <input type="email" name="email" value="{{ old('email') }}" required
                                                       class="form-control" placeholder="Enter Mail id *"
                                                       aria-describedby="basic-addon3">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" autocomplete="new-password"
                                                       required
                                                       class="form-control" placeholder="Enter Password"
                                                       aria-describedby="basic-addon4">

                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password_confirmation"
                                                       autocomplete="new-password"
                                                       required class="form-control" placeholder="Confirm Password"
                                                       aria-describedby="basic-addon4">
                                            </div>

                                            <div class="form-group text-center">
                                                <button class="btn btn-reg"
                                                        style="background-color: #25258e !important; color: white !important;"
                                                        type="submit"><i class="fa fa-send"></i>
                                                    Reset Password
                                                </button>
                                            </div> <!-- /submit_button -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
