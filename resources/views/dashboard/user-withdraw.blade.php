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
                                <th>Date</th>
                                <th>Withdraw Number</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Send Details</th>
                                <th>Message</th>
                                <th>Success Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0;@endphp
                            @foreach($withdraw as $p)
                                @php $i++;@endphp

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i:s A') }}</td>
                                    <td>{{ $p->withdraw_number }}</td>
                                    <td width="10%"><strong>{{ $p->amount }} - {{ $basic->currency }}</strong></td>
                                    <td><span class="aaaa">{{ $p->withdrawMethod->title }}</span></td>
                                    <td width="13%">{{ $p->details }}</td>
                                    <td>
                                        @if($p->message == null)
                                            <i>Null</i>
                                        @else
                                            {{ $p->message }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->made_date == null)
                                            <span class="label label-success"><i class="fa fa-times"></i> Not Seen Yet.</span>
                                        @else
                                            {{ \Carbon\Carbon::parse($p->made_date)->format('d F Y h:i:s A') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->status == 0)
                                            <span class="label label-secondary"><i
                                                        class="fa fa-spinner"></i> Pending</span>
                                        @elseif($p->status == 1)
                                            <span class="label label-success"><i class="fa fa-check"
                                                                                 aria-hidden="true"></i> Completed</span>
                                        @else
                                            <span class="label label-danger"><i class="fa fa-exclamation-triangle"
                                                                                aria-hidden="true"></i> Refunded</span>
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

@endsection
@section('scripts')
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