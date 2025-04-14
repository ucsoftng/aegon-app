@extends('layouts.mobile-user')

@section('style')
@endsection
@section('content')
    <div class="card card-style">
        <div class="content">
            <div class="d-flex">
                <div>
                    <h6 class="mb-n1 opacity-80 color-highlight">#{{ $support->ticket_number }}</h6>
                    <h4>
                        {{ $support->subject }}
                    </h4>
                </div>
                <div class="align-self-center ms-auto">
                     <span class="badge text-uppercase px-2 py-2 @if($support->status == 1) gradient-yellow @elseif($support->status == 2) gradient-green @elseif($support->status == 3) gradient-blue @elseif($support->status == 9) gradient-green @else gradient-red @endif text-black">
                            @if($support->status == 1) Open  @elseif($support->status == 2) Answer @elseif($support->status == 3) Customer Reply @elseif($support->status == 9) Closed @else
                         Inconclusive @endif
                    </span>
                </div>
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
                                            <div class="d-flex">
                                                <div>
                                                    <span class="comment-avatar clearfix">
                                                        <img alt=""
                                                             src="@if($m->support->user->image == 'user-default.png') {{ asset('assets/images/user-default.png') }}@else {{ asset('assets/images') }}/{{ $m->support->user->image }}@endif"
                                                             class="img-circle" style="width: 50px; height: 50px;"> <span style="font-size: 16px;">Me at</span>
                                                    </span>
                                                </div>
                                                <div class="align-self-center ms-auto">
                                                    <span style="font-size: 12px !important;">{{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span>
                                                </div>

                                            </div>
                                        </div>
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
                                            <div class="d-flex">
                                                <div>
                                                    <span class="comment-avatar clearfix">
                                                         <img alt="" src="{{ asset('assets/images') }}/{{ $general->logo }}"
                                                              class="img-circle" style="width: 50px; height: 50px;"><span style="font-size: 16px;">Admin</span>
                                                    </span>
                                                </div>
                                                <div class="align-self-center ms-auto">
                                                    <span style="font-size: 12px !important;"> at {{ \Carbon\Carbon::parse($m->created_at)->format('F dS, Y - h:i A') }}</span>
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


                <form action="{{ route('user-support-message') }}" method="post"
                      @if($support->status == 9) style="display: none !important;" @endif>
                    @csrf
                    <input type="hidden" name="support_id" value="{{ $support->id }}">
                    <div class="col-md-12 product-service md-margin-bottom-30">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-custom form-label form-icon mb-3">
                                    <textarea name="message" class="form-control rounded-xs"
                                              placeholder="Your Reply" required="" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100"> SUBMIT
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <button type="button"
                                            class="btn btn-full gradient-red shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100 delete_button"
                                            data-bs-toggle="offcanvas" data-bs-target="#menu-deposit">
                                        <i class="fa fa-times"></i> Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                        <form action="{{ route('user-support-close') }}" method="post" id="formSubmit">
                            @csrf
                            <input type="hidden" name="support_id" value="{{ $support->id }}">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i>
                                Close
                            </button>
                            <button type="submit" id="btnYes" class="btn btn-primary"><i class="fa fa-check"></i> Yes
                                I'm
                                Sure..!
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-deposit">
        <div class="content">
            <h5><strong>Are you sure you want to Close This Support Ticket..?</strong></h5>
            <form method="post" action="{{ route('user-support-close') }}" id="dep-sub">
                @csrf
                <input type="hidden" name="support_id" value="{{ $support->id }}">
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Close Ticket</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script type='text/javascript'>
        $('#btnYes').click(function () {
            $('#formSubmit').submit();
        });
    </script>

@endsection