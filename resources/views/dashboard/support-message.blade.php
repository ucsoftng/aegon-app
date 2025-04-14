@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-9">
            <div class="card">
                <div class="panel panel-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9 text-left">
                                <h3>#{{ $support->ticket_number }}
                                    - {{ $support->subject }}</h3>
                            </div>
                            <div class="col-md-3 text-right">
                    <span class="pull-right"><b class="btn btn-info">
                            @if($support->status == 1)
                                Opened
                            @elseif($support->status == 2)
                                Answered
                            @elseif($support->status == 3)
                                Customer Reply
                            @elseif($support->status == 9)
                                Closed
                            @endif</b>
                        </span>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="col-md-12">
                                <ol class="commentlist noborder nomargin nopadding clearfix">

                                    @foreach($message as $m)
                                        @if($m->type == 1)


                                            <div class="col-md-12">

                                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                                    <div id="comment-1" class="comment-wrap clearfix">
                                                        <div class="comment-meta mb-5">
                                                            <div class="row">
                                                                <div class="col-md-2 text-left">
                                                                <span class="comment-avatar clearfix">
                                                                    <img alt=""
                                                                         src="@if($m->support->user->image == 'user-default.png') {{ asset('assets/images/user-default.png') }}@else {{ asset('assets/images') }}/{{ $m->support->user->image }}@endif"
                                                                         class="img-circle"
                                                                         width="60" height="60"></span>
                                                                </div>
                                                                <div class="col-md-10 text-right">
                                                                    <h4>{{ $m->support->user->name }} at
                                                                        <span>{{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span>
                                                                    </h4>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="comment-content clearfix">
                                                            <p class="text-justify">{!! $m->message !!}</p>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </li>

                                            </div>
                                            <hr>

                                        @elseif($m->type == 2)

                                            <div class="col-md-10 col-md-offset-2">

                                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                                    <div id="comment-1" class="comment-wrap clearfix">
                                                        <div class="comment-meta mb-3">
                                                            <div class="row">
                                                                <div class="col-md-2 text-left">
                                                                <span class="comment-avatar clearfix">
                                                                     <img alt=""
                                                                          src="{{ asset('assets/images/logo.png') }}"
                                                                          class="img-circle"
                                                                          width="60" height="60"></span>
                                                                </div>
                                                                <div class="col-md-10 text-right">
                                                                    <h4>
                                                                        Admin<span> at {{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span>
                                                                    </h4>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="comment-content clearfix">

                                                            <p class="text-justify">{!! $m->message !!}</p>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </li>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach
                                </ol>
                                @if($support->status != 9)

                                    <form action="{{ route('admin-support-message') }}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="support_id" value="{{ $support->id }}">
                                        <div class="col-md-12 product-service md-margin-bottom-30">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                <textarea name="message" class="form-control input-lg"
                                                          placeholder="Your Reply" required=""
                                                          rows="4"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                        SUBMIT
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <button type="button"
                                                                class="btn btn-danger btn-lg btn-block btn-block delete_button"
                                                                data-toggle="modal" data-target="#DelModal">
                                                            <i class="fa fa-times"></i> Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>


                </div>
            </div><!---ROW-->
        </div>

        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you sure you want to Close This Support Ticket..?</strong>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin-support-close') }}" method="post" id="formSubmit">
                            @csrf
                            <input type="hidden" name="support_id" value="{{ $support->id }}">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" id="" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm
                                Sure..!
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')


@endsection