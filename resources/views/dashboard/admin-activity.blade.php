@extends('layouts.admin')
@section('style')
@endsection
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
                                <th>Balance Type</th>
                                <th>Balance</th>
                                <th>Charge</th>
                                <th>Balance Details</th>
                                <th>Past Balance</th>
                                <th>Present Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0;@endphp
                            @foreach($activity as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td width="18%">{{ \Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A') }}</td>
                                    <td width="11%">
                                        @if($p->balance_type == 1)
                                            <span class="label label-info"><i class="fa fa-plus"></i> Add Fund</span>
                                        @elseif($p->balance_type == 2)
                                            <span class="label label-success"><i class="fa fa-cloud-download"></i> Deposit</span>
                                        @elseif($p->balance_type == 3)
                                            <span class="label label-success"><i
                                                        class="fa fa-recycle"></i> Rebeat</span>
                                        @elseif($p->balance_type == 4)
                                            <span class="label label-success"><i
                                                        class="fa fa-reply-all"></i> Withdraw</span>
                                        @elseif($p->balance_type == 5)
                                            <span class="label label-success"><i class="fa fa-user-circle-o"></i> Referral</span>
                                        @elseif($p->balance_type == 7)
                                            <span class="label label-danger"><i class="fa fa-bolt"></i> Refund</span>
                                        @elseif($p->balance_type == 6)
                                            <span class="label label-danger"><i
                                                        class="fa fa-check"></i> Completed</span>
                                        @elseif($p->balance_type == 8)
                                            <span class="label label-success"><i class="fa fa-plus"></i> Bank</span>
                                        @endif
                                    </td>
                                    <td width="10%">{{ $p->balance }} - {{ $basic->currency }}</td>
                                    <td width="9%">
                                        @if($p->charge == null)
                                            <i>Null</i>
                                        @else
                                            {{ $p->charge }} - {{ $basic->currency }}
                                        @endif
                                    </td>
                                    <td>{{ $p->details }}</td>
                                    <td width="12%">{{ round($p->old_balance,3) }} - {{ $basic->currency }}</td>
                                    <td width="12%">{{ round($p->new_balance,3) }} - {{ $basic->currency }}</td>
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