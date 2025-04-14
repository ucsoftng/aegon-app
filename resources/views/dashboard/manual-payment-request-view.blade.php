@extends('layouts.dashboard')
@section('style')
    <style>
        span.label{
            font-size: 12px; !important;
        }
        td,th{
            font-size: 14px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css//cus.css') }}">
@endsection
@section('content')


    <table class="table table-striped table-hover table-bordered datatable" id="table-4">
        <thead>
        <tr>
            <th>Date</th>
            <th>Transaction ID</th>
            <th>Method Name</th>
            <th>Total</th>
            <th>Charge</th>
            <th>Amount</th>
            <th>Success Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td width="13%">{{ \Carbon\Carbon::parse($fund->created_at)->format('d-F-y h:i:s A') }}</td>
                <td>{{ $fund->log->transaction_id }}</td>
                <td width="12%">{{ $fund->log->method->name }}</td>
                <td width="15%">{{ $basic->symbol }} {{ $fund->log->total }}</td>
                <td>{{ $basic->symbol }} {{ $fund->log->charge }}</td>
                <td>{{ $basic->symbol }} {{ $fund->log->amount }}</td>
                <td width="10%">
                    @if($fund->made_time == null)
                        <span class="label label-success"><i class="fa fa-times"></i> Not Seen Yet.</span>
                    @else
                        {{ \Carbon\Carbon::parse($fund->made_time)->format('d-F-y h:i:s A') }}
                    @endif
                </td>

                <td>
                    @if($fund->status == 0)
                        <span class="label label-secondary"><i class="fa fa-spinner"></i> Pending</span>
                    @elseif($fund->status == 1)
                        <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>
                    @else
                        <span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Refunded</span>
                    @endif
                </td>
            </tr>
        </tbody>

    </table>

    <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title">Payment Prove Preview</div>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <!-- panel body -->
        <div class="panel-body">
            <h3>Message : </h3><br>
            <p class="lead">{{ $fund->message }}</p>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    @foreach($img as $i)
                        <img style="margin-bottom: 10px;" src="{{ asset('assets/upload') }}/{{ $i->image }}" alt="" class="img-responsive">
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <button type="button" class="btn btn-danger  btn-lg btn-icon btn-block icon-left delete_button"
                            data-toggle="modal" data-target="#DelModal"
                            data-id="{{ $fund->id }}">
                        <i class="fa fa-check"></i> Confirm Payment
                    </button>
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
                    <strong>Are you sure you want to Confirm This Payment.?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-payment-confirm') }}" class="form-inline">
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

@endsection