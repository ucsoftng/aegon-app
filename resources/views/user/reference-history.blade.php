@extends('layouts.mobile-user')

@section('content')
    @foreach($bonus as $p)
        <div class="card card-style mb-2">
            <div class="content mx-3 mt-3">
                <div class="d-flex mt-n2 ms-3">
                <span class="align-self-center ms-auto">
                    {{ date('d-m-Y h:s A',strtotime($p->created_at)) }}
                </span>
                </div>
                <div class="d-flex">
                    <div>
                        <h6 class="mb-n1 opacity-80 color-highlight">#{{ $p->under_reference }}</h6>
                        <p>
                            {{ $p->details }}
                        </p>
                    </div>
                    <div class="align-self-center ms-auto">
                        <h5>{{ $basic->currency }}{{ $p->balance }}</h5>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('scripts')


@endsection