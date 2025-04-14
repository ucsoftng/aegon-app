@extends('layouts.front')
@section('content')
    <!-- Start Contact Area -->
    <section class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="flaticon-email"></i>
                        </div>

                        <h3>Email Here</h3>
                        <p><a href="mailto:{{$general->email}}"><span>{{$general->email}}</span></a></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="flaticon-phone-call"></i>
                        </div>

                        <h3>Location Here</h3>
                        <p><a href="#" target="_blank"><b>Address:</b> {{$general->address}}, </a> <br>
                            <span><b> Branch: </b></span>5445 Atlanta Hwy, Montgomery, AL 36109, United States.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="flaticon-marker"></i>
                        </div>

                        <h3>Call Here</h3>
                        <p><a href="tel:{{$general->number}}">{{$general->number}}</a></p>
                    </div>
                </div>
            </div>

            <div class="section-title">
                <span class="sub-title">Contact Us</span>
                <h2>Drop us Message for any Query</h2>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <div class="contact-image">
                        <img src="{{asset('front/img/contact.png')}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-8 col-md-8">
                    <div class="contact-form">
                        <form method="post" action="{{route('contact')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" required data-error="Write your message" placeholder="Your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn">Send Message <span></span></button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->

@endsection

