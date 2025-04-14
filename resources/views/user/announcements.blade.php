@extends('layouts.mobile-user-2')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @forelse($announcements as $m)
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
                                <div class="col-md-12">
                                    <button type="button"
                                            class="btn btn-info btn-block btn-sm unblock_button margin-top-20"
                                            data-toggle="modal" data-target="#unblocklModal" id="getUser"
                                            data-id="{{ $m->id }}">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <h4>No Announcements Yet</h4>
            @endforelse
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <div class="modal fade" id="unblocklModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Announcement Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div id="modal-loader" style="display: none; text-align: center;">
                        <!-- ajax loader -->
                        <img src="{{ asset('assets/images/ajax-loader.gif') }}">
                    </div>

                    <!-- mysql data will be load here -->
                    <div id="dynamic-content"></div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $(document).on('click', '#getUser', function (e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                e.preventDefault();

                var uid = $(this).data('id'); // get id of clicked row

                $('#dynamic-content').html(''); // leave this div blank
                $('#modal-loader').show();      // load ajax loader on button click

                $.ajax({
                    url: '{{ url('/see-announcement') }}',
                    type: 'POST',
                    data: 'id=' + uid,
                    dataType: 'html'
                })
                    .done(function (data) {
                        console.log(data);
                        $('#dynamic-content').html(''); // blank before load.
                        $('#dynamic-content').html(data); // load here
                        $('#modal-loader').hide(); // hide loader
                    })
                    .fail(function () {
                        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                        $('#modal-loader').hide();
                    });

            });
        });
    </script>
@endsection