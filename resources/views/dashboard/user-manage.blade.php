@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <div class="table-responsive mt-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Current Amount</th>
                                <th>Reference</th>
                                <th>status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0;@endphp
                            @foreach($user as $p)
                                @php $i++;@endphp

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                                    <td>{{ $p->reference }} </td>
                                    <td>
                                        @if($p->status == 0)
                                            <button type="button" class="btn btn-danger btn-sm">
                                                Inactive
                                            </button>
                                        @elseif($p->status == 1)
                                            <button type="button" class="btn btn-success btn-sm">
                                                    Active
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}</td>
                                    <td width="30%">
                                        <button data-toggle="modal" data-target="#view-modal"
                                                data-id="{{ $p->id }}"
                                                id="getUser" class="btn btn-info btn-sm btn-icon icon-left">
                                            <i class="fa fa-eye"></i> Details
                                        </button>
                                        {{--                    <button type="button" class="btn btn-primary btn-icon icon-left" data-toggle="popover-x" data-target="#myPopover{{ $p->id }}" data-placement="top">--}}
                                        <button type="button" data-toggle="modal" data-target="#activity-modal"
                                                data-id="{{ $p->id }}"
                                                id="" class="btn btn-success btn-sm btn-icon icon-left activity">
                                            <i class="fa fa-list"></i> Activity
                                        </button>

                                        {{--                    <div id="myPopover{{ $p->id }}" class="popover popover-success popover-md">--}}
                                        {{--                        <div class="arrow"></div>--}}
                                        {{--                        <div class="popover-title"><span class="close" data-dismiss="popover-x">&times;</span><strong><i class="fa fa-indent"></i> Activity</strong></div>--}}
                                        {{--                        <div class="popover-content">--}}
{{--                                                                    <a href="{{ route('user-transaction',$p->id) }}" class="btn btn-info btn-icon icon-left"><i class="fa fa-cloud-upload"></i> Transaction</a>--}}
{{--                                                                    <a href="{{ route('user-deposit',$p->id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-cloud-download"></i> Deposit</a>--}}
{{--                                                                    <a href="{{ route('user-withdraw',$p->id) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-reply-all"></i> Withdraw</a>--}}
{{--                                                                    <a href="{{ route('manual-admin-fund',$p->id) }}" class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> Fund Add</a>--}}
{{--                                                                    <a href="{{ route('manual-admin-deposit',$p->id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-bar-chart"></i> Invest</a>--}}
{{--                                                                    <a href="{{ route('tweak-funds',$p->id) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-spinner"></i> Fund Tweak</a>--}}
                                        {{--                        </div>--}}
                                        {{--                    </div>--}}
                                        @if($p->block_status == 1)
                                            <button type="button"
                                                    class="btn btn-danger btn-icon btn-sm icon-left unblock_button"
                                                    data-toggle="modal" data-target="#unblocklModal"
                                                    data-id="{{ $p->id }}">
                                                <i class="fa fa-user-plus"></i> UnBlock
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm btn-icon icon-left block_button"
                                                    data-toggle="modal" data-target="#blockModal"
                                                    data-id="{{ $p->id }}">
                                                <i class="fa fa-user-times"></i> Block
                                            </button>
                                        @endif
                                        @if($p->status == 0)
                                            <button type="button"
                                                    class="btn btn-success btn-icon btn-sm icon-left activate_button"
                                                    data-toggle="modal" data-target="#activateModal"
                                                    data-id="{{ $p->id }}">
                                                <i class="fa fa-check"></i> Activate
                                            </button>
                                        @endif
                                        @if(\App\UserCompounding::whereuser_id($p->id)->exists())
                                            <a class="btn btn-success btn-icon btn-sm icon-left activate_button"
                                                href="{{route('uncompound-account',$p->id)}}">
                                                <i class="fa fa-check"></i> Uncompound
                                            </a>
                                            @else
                                            <a class="btn btn-warning btn-icon btn-sm icon-left activate_button"
                                               href="{{route('compound-account',$p->id)}}">
                                                <i class="fa fa-check"></i> Compound
                                            </a>
                                        @endif
                                        <button type="button"
                                                class="btn btn-danger btn-icon btn-sm icon-left delete_user"
                                                data-toggle="modal" data-target="#deleteUserModal"
                                                data-id="{{ $p->id }}">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
{{--                            <nav class="tg-pagination">--}}
{{--                                {{ $user->links() }}--}}
{{--                            </nav>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>Block</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-block') }}" class="form-inline">
                        {!! csrf_field() !!}
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

                    <strong>Are you sure you want to <strong>UnBlock</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-unblock') }}" class="form-inline">
                        {!! csrf_field() !!}
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
    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>Activate</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-activate') }}" class="form-inline">
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
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-user"></i> User Details
                    </h4>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div id="activity-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-user"></i> Select Activity to Perform
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div id="activity-content"></div>
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('user-transaction',$p->id) }}" class="btn btn-info btn-icon icon-left act"><i class="fa fa-cloud-upload"></i> Transactions</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('user-deposit',$p->id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-cloud-download"></i> Users Deposit</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('user-withdraw',$p->id) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-reply-all"></i> Withdrawals</a>--}}
{{--                        </div>--}}
{{--                        <br/><br/>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('manual-admin-fund',$p->id) }}" class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> Add Fund</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('manual-admin-deposit',$p->id) }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-bar-chart"></i> User Deposit</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href="{{ route('tweak-funds',$p->id) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-spinner"></i> Tweak Funds</a>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                    </button>
                </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <strong>Are you sure you want to <strong>Delete</strong> This User.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete-user') }}" class="form-inline">
                        {!! csrf_field() !!}
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
                    url: '{{ url('/user-details') }}',
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

    <script>
        $(document).ready(function () {
            $(document).on("click", '.block_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on("click", '.unblock_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on("click", '.activate_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_user', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on("click", '.activity', function (e) {
                var uid = $(this).data('id');
                $('#activity-content').html(
                    '<div class="row">' +
                        '<div class="col-md-4"><a href="user-transaction/'+uid+'" class="btn btn-info btn-icon icon-left act"><i class="fa fa-cloud-upload"></i> Transactions</a></div>' +
                        '<div class="col-md-4"><a href="user-deposit/'+uid+'" class="btn btn-success btn-icon icon-left"><i class="fa fa-cloud-download"></i> All Deposits</a></div>' +
                        '<div class="col-md-4"><a href="user-withdraw/'+uid+'" class="btn btn-danger btn-icon icon-left"><i class="fa fa-reply-all"></i> Withdrawals</a></div>' +
                    '</div>'+
                    '<br>'+
                    '<div class="row">' +
                        '<div class="col-md-4"><a href="manual-admin-fund/'+uid+'" class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> Add Fund</a> </div>' +
                        '<div class="col-md-4"><a href="manual-admin-deposit/'+uid+'" class="btn btn-success btn-icon icon-left"><i class="fa fa-bar-chart"></i> User Deposit</a> </div> ' +
                        '<div class="col-md-4"><a href="tweak-funds/'+uid+'" class="btn btn-danger btn-icon icon-left"><i class="fa fa-spinner"></i> Tweak Funds</a></div></div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">' +
                        '<div class="col-md-4"><a href="referrals-v/'+uid+'" class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> Referrals</a> </div>' +
                        '<div class="col-md-4"><a href="user-wallets/'+uid+'" class="btn btn-info btn-icon icon-left"><i class="fa fa-money"></i> User Wallets</a> </div>' +
                    '</div>'
                );
            });

        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on("click", '.ref_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

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