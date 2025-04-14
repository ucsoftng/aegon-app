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
                                <!--<th>Sl No</th>-->
                            
                                <!--<th>Balance</th>-->
                                <!--<th>Charge</th>-->
                                
                                <th>Action</th>
                                <th>Deposit</th>
                                <th>Old Balance</th>
                                <th>Amount</th>
                                <th>Wallet</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        
                                <tr>
                                
                                    <form method="post" action="{{route('tweak-fundz',['id'=>$user->id])}}">
                                        {{csrf_field()}}
                                
                                    <td>
                                        <select name="action" class="form-control">
                                            <option value="add">Add</option>
                                            <option value="subtract">Subtract</option>
                                        </select>
                                    </td>
                                    @php $deposit = \App\Deposit::whereuser_id($user->id)->get(); @endphp
                                    <td>
                                        <select name="deposit" class="form-control">
                                            @foreach($deposit as $d)
                                                <option value="{{$d->id}}">{{$d->deposit_number}} {{$d->wallets->wallets->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $user->amount }}</td>
                                    <td><input value="" name="amount" class="form-control"> </td>
                                    <td>
                                        <select name="wallet_id" class="form-control">
                                            @foreach($wallets as $d)
                                                <option value="{{$d->id}}">{{$d->wallets->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input value="" name="description" required class="form-control"> </td>
                                    <input type="hidden" value="{{$user->id}}" name="id">
                                    <input type="hidden" value="{{$user->amount}}" name="old_balance">
                                    <td><button class="btn-info btn-sm" type="submit">Update</button> </td>
                                    </form>
                                </tr>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation..!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete this.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete-news') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
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