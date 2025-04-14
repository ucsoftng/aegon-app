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
                            <th>Amount</th>
                            <th>Deposit ID</th>
                            <th>Plan Name</th>
                            <th>Compound</th>
                            <th>Made Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0;@endphp
                        @foreach($repeat as $p)
                            @php $i++;@endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $p->balance }} - {{ $basic->currency }}</td>
                                <td>{{ $p->deposit->deposit_number }}</td>
                                <td><span class="aaaa">{{ $p->deposit->plan->name }}</span></td>
                                <td>
                                    <strong><span class="aaaa">{{ $p->deposit->compound->name }}</span></strong>
                                </td>
                                <td><strong>{{ \Carbon\Carbon::parse($p->made_time) }}</strong></td>
                                <td>
                                    <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Complete</span>
                                    <a href="{{route('delete-profit',$p->id)}}" class="btn btn-danger btn-sm">Remove Profit</a>
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