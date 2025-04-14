@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <form method="POST" action="{{route('update-payment-wallets')}}" enctype="multipart/form-data"
                          class="form-group">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name: </label>
                                    <input class="form-control" type="text" name="name" value="{{$wallet->name}}" required>
                                    <input type="hidden" name="id" value="{{$wallet->id}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Short (Acronym): </label>
                                    <input class="form-control" type="text" name="short" value="{{$wallet->short}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Rate: </label>
                                    <input class="form-control" type="text" name="rate" value="{{$wallet->rate}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fixed: </label>
                                    <input class="form-control" type="text" name="fix" value="{{$wallet->fix}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Percent: </label>
                                    <input class="form-control" type="text" name="percent" value="{{$wallet->percent}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>API: </label>
                                    <input class="form-control" type="text" name="api" value="{{$wallet->api}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>XPUB: </label>
                                    <input class="form-control" type="text" name="xpub" value="{{$wallet->xpub}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Network: </label>
                                    <input class="form-control" type="text" name="network" value="{{$wallet->network}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tag: </label>
                                    <input class="form-control" type="text" name="tag" value="{{$wallet->tag}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Wallet 1: </label>
                                    <input class="form-control" type="text" name="wallet_1" value="{{$wallet->wallet_1}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Image: </label>
                                    <div class="col-md-3">
                                        <img src="{{ asset('assets/images') }}/{{ $wallet->image }}"
                                             alt="Display Image" style="width: 100%;">
                                    </div>
                                    <input class="form-control" type="file" name="image">
                                </div>
                                {{--                        <div class="form-group col-md-6">--}}
                                {{--                            <label>Wallet 2: </label>--}}
                                {{--                            <input class="form-control" type="text" name="wallet_2">--}}
                                {{--                        </div>--}}
                            </div>
                            <div class="row">
                                {{--                        <div class="form-group col-md-6">--}}
                                {{--                            <label>Wallet 3: </label>--}}
                                {{--                            <input class="form-control" type="text" name="wallet_3">--}}
                                {{--                        </div>--}}
                                {{--                        <div class="form-group col-md-6">--}}
                                {{--                            <label>Image: </label>--}}
                                {{--                            <input class="form-control" type="file" name="image" required>--}}
                                {{--                        </div>--}}
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-12"><strong
                                                style="text-transform: uppercase;">STATUS</strong></label>
                                    <div class="col-md-12 bt-switch">
                                        <input {{ $wallet->status == 1 ? 'checked' : '' }} data-on-color="success"
                                               data-off-color="danger" data-width="20%" type="checkbox"
                                               name="status">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update Wallet
                            </button>
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
                    url: '{{ url('/wallet-details') }}',
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
    <script src="{{ asset('adminz/assetz/vendors/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
    <script type="text/javascript">
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function () {
            var bt = function () {
                $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function () {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function () {
                    bt()
                }
            }
        }();
        $(function () {
            radioswitch.init()
        });
    </script>

@endsection