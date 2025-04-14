@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-12 mt-30">
            <h2 class="mb-0">{{ $page_title }}</h2>
        </div>
        @foreach($plan as $p)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">{{ $p->name }}</h3>
                        <h5 class="card-text text-center">
                            <strong>{{ $basic->currency }} {{ number_format($p->minimum) }}
                                - {{ $basic->currency }} {{ number_format($p->maximum) }}</strong></h5>
                        <ul style='font-size: 15px;' class="list-group text-center bold">
                            <li class="list-group-item"><i class="fa fa-check"></i> Running Percent - {{ $p->percent }} <i
                                        class="fa fa-percent"></i></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Total Percent - {{ $p->total_percent }} <i
                            class="fa fa-percent"></i></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Time - {{ $p->time }} times</li>
                            <li class="list-group-item"><i class="fa fa-check"></i> Compound - <span
                                        class="aaaa">{{ $p->compound->name }}</span></li>
                            <li class="list-group-item"><span
                                        class="aaaa">{{ $p->status == 1 ? "Active" : 'DeActive' }}</span></li>
                        </ul>
                        {{--                    <a href="#" class="btn btn-info">Custom Link</a>--}}
                    </div>
                    <div class="card-footer">
                        <div class="row col-12">
                            <div class="col-6">
                                <a class="btn btn-block btn-sm btn-success" href="{{ route('plan-edit',$p->id) }}"><i
                                            class="fa fa-edit"></i> Edit</a>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger btn-sm btn-block delete_button"
                                        data-toggle="modal" data-target="#DelModal"
                                        data-id="{{ $p->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!---ROW-->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete-plan') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <div class=" row col-12">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i
                                            class="fa fa-times"></i> Close
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-check"></i> Yes I'm
                                    Sure..!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection

