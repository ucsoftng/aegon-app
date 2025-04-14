@extends('layouts.front')
@section('content')
    <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>Latest news & articles<span class="dot">.</span></h2>
            </div>

            <div class="row clearfix">
            @foreach($news as $n)
                <!--News Block-->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                         data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <a href="{{$n->url}}"><img src="{{$n->urlToImage}}" alt="" style="height: 250px;"></a>
                            </div>
                            <div class="lower-box">
                                <div class="post-meta">
                                    <ul class="clearfix">
                                        <li><span class="far fa-clock"></span> {{ \Carbon\Carbon::parse($n->publishedAt)->format('d-m-Y') }}</li>
                                        <li><span class="far fa-user-circle"></span> {{$n->author}}</li>
                                    </ul>
                                </div>
                                <h5><a href="{{$n->url}}">{{$n->title}}</a></h5>
                                {{--                            <div class="text">Lorem ipsum is simply free text used by copytyping refreshing.</div>--}}
                                <div class="link-box"><a class="theme-btn" href="{{$n->url}}"><span
                                                class="flaticon-next-1"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--News Block-->
                @endforeach
            </div>
        </div>
    </section>

@endsection

