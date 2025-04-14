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
                                <th>Date Time</th>
                                <th>Invest Plan</th>
                                <th>Invest Amount</th>
                                <th>Invest Commission</th>
                                <th>Repeat Time</th>
                                <th>Repeat Compound</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0;@endphp
                            @foreach($deposit as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-F-Y H:s:i A',strtotime($p->created_at)) }}</td>
                                    <td><span class="aaaa"><strong>{{ $p->plan->name }}</strong></span></td>
                                    <td>{{ $p->amount }} - {{ $basic->currency }}</td>
                                    <td width="13%">{{ $p->percent }} %</td>
                                    <td>{{ $p->time }} - times</td>
                                    <td><span class="aaaa"><strong>{{ $p->compound->name }}</strong></span></td>
                                    <td>
                                        @if($p->status == 0)
                                            <span class="label label-warning"><i
                                                        class="fa fa-spinner"></i> Running</span>
                                        @else
                                            <span class="label label-success">
                                                <i class="fa fa-check"
                                                                                 aria-hidden="true"></i> Completed</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($p->status == 0)
                                        <button type="button" data-toggle="modal" data-target="#activity-modal"
                                                data-id="{{ $p->id }}"
                                                id="" class="btn btn-success btn-sm btn-icon icon-left activity">
                                            <i class="fa fa-list"></i> Top Up
                                        </button>
                                        <button type="button" data-toggle="modal" data-target="#DelModal"
                                                data-id="{{ $p->id }}"
                                                id="" class="btn btn-info btn-sm btn-icon icon-left delete_button">
                                            <i class="fa fa-list"></i> Close Deposit
                                        </button>
                                        @else
                                            <span class="label label-success">
                                                <i class="fa fa-check"
                                                   aria-hidden="true"></i> Completed</span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Close this Deposit.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('complete-deposit') }}" class="form-inline">
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
    <div id="activity-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('top-up') }}" class="form-horizontal">
                @csrf
                    <div class="col-md-12">
                        <div class="modal-header">
                            <h4 class="modal-title" id="title">
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Amount: </label>
                                <input class="form-control" name="amount" type="text" placeholder="Amount: eg 5000" required>
                                <input type="hidden" name="deposit_id" value="" id="deposit_id">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Top Up
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

            $(document).on("click", '.activity', function (e) {
                var uid = $(this).data('id');
                $('#title').html('<i class="glyphicon glyphicon-user"></i> Top Up Deposit ' + uid);
                $('#deposit_id').val(uid);
                // document.getElementById("deposit_id").val = uid;
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
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