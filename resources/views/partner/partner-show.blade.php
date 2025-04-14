@extends('layouts.dashboard')
@section('content')

    <div class="col-md-12" >
        <a href="{{ route('partner-create') }}" style="margin-bottom: 20px;" class="btn btn-blue pull-right" >
            <i class="entypo-plus"></i> Add New Partner
        </a>
    </div>
    <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            var $table4 = jQuery( "#table-4" );

            $table4.DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>

    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>Sl No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0;@endphp
        @foreach($partner as $p)
            @php $i++;@endphp
            <tr>
                <td>{{ $i }}</td>
                <td width="20%">{{ $p->name }}</td>
                <td>
                    <img src="{{ asset('assets/images') }}/{{ $p->image }}" alt="">
                </td>
                <td width="10%">{{ date('d-F-Y',strtotime($p->created_at)) }}</td>
                <td width="13%">
                    <a href="{{ route('partner-edit',$p->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm delete_button"
                            data-toggle="modal" data-target="#DelModal"
                            data-id="{{ $p->id }}">
                        <i class="fa fa-trash"></i>
                    </button>

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

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
                    <form method="post" action="{{ route('partner-delete') }}" class="form-inline">
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

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/datatables.css') }}">

    <script src="{{ asset('assets/dashboard/js/datatables.js') }}"></script>

@endsection