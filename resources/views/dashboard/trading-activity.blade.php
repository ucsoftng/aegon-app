@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-left">
                        {{$page_title}}
                    </h4>
                    <div class="text-right">
                       <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Activity</button> 
                       <button class="btn btn-success" data-toggle="modal" data-target="#myModal2">Edit Activity Detail</button> 
                       <a class="btn btn-success" href="{{route('delete-all-trad-input')}}">Delete All Input</a> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Member Code</th>
                                <th>Initial Deposit</th>
                                <th>Trader Commission</th>
                                <th>Available To Deal</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($trading as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$p->member_code}}</td>
                                    <td>{{ $p->initial_deposit }}</td>
                                    <td>{{ $p->commission }}</td>
                                    <td>{{ $p->available }}</td>
                                    
                                    <td>
                                        <a href="{{ route('delete-trading-activity',$p->id) }}" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- ROW-->
    </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Manage Trading Activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('trading-activity') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Member code</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control " id="member_code" name="member_code" placeholder="member_code" value="" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Initial Deposit</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control " id="initial_deposit" name="initial_deposit" placeholder="Initial Deposit" value="" required>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Trader Commission</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control " id="commission" name="commission" placeholder="Trader Commission" value="" required>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Available To Deal</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control " id="available" name="available" placeholder="Available To Deal" value="" required>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Save Activity</button>
                        <!--<input type="hidden" id="task_id" name="task_id" value="0">-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> Trading Activity Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('trading-activity-detail') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Balance</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control " id="balance" name="balance" placeholder="Balance" value="{{$trad->balance}}" required>
                                <input type="hidden" id="id" name="id"  value="{{$trad->id}}" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTask" class="col-sm-6 control-label">Date</label>
                            <div class="col-md-12">
                                <input type="datetime-local" class="form-control " id="date" name="date" placeholder="Date" value="{{$trad->date}}" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Save Detail</button>
                        <!--<input type="hidden" id="task_id" name="task_id" value="0">-->
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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

