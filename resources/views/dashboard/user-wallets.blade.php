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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page_title}}</h4>
                    <table class="table table-bordered table-striped bold">
                        <thead>
                        <tr>
                            <th><b>Wallet</b></th>
                            <th><b>Amount USD</b></th>
                            <th><b>Amount Crypto</b></th>
                            <th><b>Action</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallets as $w)
                        <tr>
                            <form method="post" action="{{route('update-user-wallet')}}">
                                @csrf
                                <td>{{$w->wallets->name}}</td>
                                <input type="hidden" name="id" value="{{$w->id}}">
                                <td><input type="text" name="usd" value="{{$w->amount_in_usd}}"></td>
                                <td><input type="text" name="crypto" value="{{$w->amount_in_crypto}}"></td>
                                <td><button type="submit" class="btn btn-sm btn-primary">Update</button> </td>
                            </form>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection