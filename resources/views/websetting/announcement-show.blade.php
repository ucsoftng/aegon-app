@extends('layouts.admin')
@section('title', 'Announcement Show')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @foreach($menu as $m)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center"><b>{{ $m->title }}</b></div>
                        </div>
                        <div class="card-body">
                            <p class="text-center">
                                {!! $m->description !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <a href="{{ route('announcement-edit',$m->id) }}"
                                       class="btn btn-primary btn-sm btn-block margin-top-20"><i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                </div>
                                {{--                            <form method="get" action="{{route('announcement-delete',$m->id)}}">--}}
                                <div class="col-md-6">
                                    <button type="button"
                                            class="btn btn-danger btn-block btn-sm unblock_button margin-top-20"
                                            data-toggle="modal" data-target="#unblocklModal"
                                            data-id="{{ $m->id }}">
                                        <i class="fa fa-user-plus"></i> Delete
                                    </button>
                                    {{--                                    <button type="submit" class="btn btn-sm btn-danger btn-block margin-top-20"--}}
                                    {{--                                            onclick="return confirm('Are You Sure..!')"><i class="fa fa-trash"></i> Delete--}}
                                    {{--                                        Announcement--}}
                                    {{--                                    </button>--}}
                                </div>
                                {{--                            </form>--}}
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="unblocklModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>Delete</strong> This Announcement.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{route('announcement-delete')}}" class="form-inline">
                        @csrf
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $(document).on("click", '.unblock_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });

        });
    </script>
@endsection