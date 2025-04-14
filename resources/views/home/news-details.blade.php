@extends('layouts.front')
@section('content')

    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="image">
                        <img src="{{ asset('assets/images') }}/{{ $news->image }}" alt="#">
                    </div>
                    <div class="blog-detail">
                        <h2 class="blog-title">{{ $news->title }}.</h2>
                        <div class="blog-meta">
                            <span class="author"><a href="javascript:void(0);"><i class="fas fa-user"></i>By Admin</a><a href="javascript:void(0);"><i class="fas fa-calendar"></i>{{ \Carbon\Carbon::parse($news->created_at)->format('d F M') }}</a></span>
                            <div class="like-comment">
                                <span class="comment"><a href="javascript:void(0);"><i class="fas fa-comments"></i>@php $gr = \App\News::findOrFail($news->id) @endphp {{ $gr->view }} Views</a></span>
                            </div>
                        </div>
                        <div class="content">
                            <p>
                                {!! strip_tags($news->description) !!}
                            </p>
                        </div>
                    </div>
                    <div class="share-social">
                        <h3 class="title">Share article:</h3>
                        <ul>
                            <li><a href="http://www.facebook.com/share.php?u={{ url()->current() }}/{{ $news->id }}/{{ \Illuminate\Support\Str::slug($news->title) }}&title={{ $news->title }}" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="http://twitter.com/home?status={{ $news->title }}+{{ url()->current() }}/{{ $news->id }}/{{ \Illuminate\Support\Str::slug($news->title) }}" class="twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{ url()->current() }}/{{ $news->id }}/{{ \Illuminate\Support\Str::slug($news->title) }}" class="google-plus"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="comments">
                        <div class="commment_area">
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1421567158073949";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
