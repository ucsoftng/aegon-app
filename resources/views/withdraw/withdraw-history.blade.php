@extends('layouts.mobile-user')
@section('content')

    <div class="card card-style mb-5">
        <div class="content mx-3 mt-3">
            <hr>
            @foreach($withdraw as $p)
                <div class="">
                    <div class="d-flex mt-n2 ms-3">
                                <span class="badge text-uppercase px-2 py-1 @if($p->status == 0) gradient-pink @elseif($p->status == 1) gradient-green @else gradient-red @endif text-black">
                                    @if($p->status == 0) Pending  @elseif($p->status == 1) Completed @else
                                        Refunded @endif
                                </span>
                        <span class="align-self-center ms-auto">
                                    {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                                </span>
                    </div>
                    <div class="content">
                        <div class="d-flex">
                            <div>
                                <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->withdraw_number }}</h6>
                                <h5>
                                    <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-arrow-up"></i> {{ $p->wallets->wallets->name }}
                                </h5>
                            </div>
                            <div class="align-self-center ms-auto">
                                <h5>{{ $basic->currency }}{{ $p->amount }}</h5>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="align-self-center ms-auto">
                                @if($p->made_date == null)
                                    <span class="badge gradient-highlight text-black"><i class="bi bi-x"></i> Not Seen Yet.</span>
                                @else
                                    {{ \Carbon\Carbon::parse($p->made_date)->format('d F Y h:i:s A') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    {{--    <div class="row">--}}
    {{--        <div class="col-12">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="table-responsive mt-40">--}}
    {{--                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th>Sl No</th>--}}
    {{--                                <th>Date</th>--}}
    {{--                                <th>Withdraw Number</th>--}}
    {{--                                <th>Amount</th>--}}
    {{--                                <th>Method</th>--}}
    {{--                                <th>Success Date</th>--}}
    {{--                                <th>Status</th>--}}
    {{--                                <th>Action</th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            @php $i = 0;@endphp--}}
    {{--                            @foreach($withdraw as $p)--}}
    {{--                                @php $i++;@endphp--}}

    {{--                                <tr>--}}
    {{--                                    <td>{{ $i }}</td>--}}
    {{--                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d m Y h:i: A') }}</td>--}}
    {{--                                    <td>{{ $p->withdraw_number }}</td>--}}
    {{--                                    <td width="12%"><strong>{{ $basic->symbol }} {{ $p->amount }}</strong></td>--}}
    {{--                                    <td width="13%"><span class="aaaa">{{ $p->wallets->wallets->name }}</span>--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        @if($p->made_date == null)--}}
    {{--                                            <span class="label label-warning"><i class="fa fa-times"></i> Not Seen Yet.</span>--}}
    {{--                                        @else--}}
    {{--                                            {{ \Carbon\Carbon::parse($p->made_date)->format('d F Y h:i:s A') }}--}}
    {{--                                        @endif--}}
    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        @if($p->status == 0)--}}
    {{--                                            <span class="label label-warning"><i--}}
    {{--                                                        class="fa fa-spinner"></i> Pending</span>--}}
    {{--                                        @elseif($p->status == 1)--}}
    {{--                                            <span class="label label-success"><i class="fa fa-check"--}}
    {{--                                                                                 aria-hidden="true"></i> Completed</span>--}}
    {{--                                        @else--}}
    {{--                                            <span class="label label-danger"><i--}}
    {{--                                                        class="fa fa-exclamation-triangle"--}}
    {{--                                                        aria-hidden="true"></i> Refunded</span>--}}
    {{--                                        @endif--}}

    {{--                                    </td>--}}
    {{--                                    <td>--}}
    {{--                                        <button data-toggle="modal" data-target="#view-modal"--}}
    {{--                                                data-id="{{ $p->id }}"--}}
    {{--                                                id="getUser" class="btn btn-sm btn-info btn-icon icon-left">--}}
    {{--                                            <i class="fa fa-eye"></i> Details--}}
    {{--                                        </button>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <meta name="_token" content="{!! csrf_token() !!}"/>--}}

    {{--    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
    {{--         aria-hidden="true" style="display: none;">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}

    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title">--}}
    {{--                        <i class="glyphicon glyphicon-user"></i> User Withdraw Details View--}}
    {{--                    </h4>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
    {{--                </div>--}}

    {{--                <div class="modal-body">--}}
    {{--                    <div id="modal-loader" style="display: none; text-align: center;">--}}
    {{--                        <!-- ajax loader -->--}}
    {{--                        <img src="{{ asset('assets/images/ajax-loader.gif') }}">--}}
    {{--                    </div>--}}

    {{--                    <!-- mysql data will be load here -->--}}
    {{--                    <div id="dynamic-content"></div>--}}
    {{--                </div>--}}

    {{--                <div class="modal-footer">--}}
    {{--                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close--}}
    {{--                    </button>--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


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
                    url: '{{ url('/withdraw-details') }}',
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
    <!-- This is data table -->
    <script src="{{asset('adminz/assetz/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="//cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });

        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
@endsection