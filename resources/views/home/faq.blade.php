@extends('layouts.front')
@section('content')
    <section class="faq_area p_100">
        <div class="container">
            <div class="main_title">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="row question_inner">
                <div class="col-lg-12 pl-30 md-pl-15">
                    <div class="accordion left_side" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingone">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">
                                    <i>+</i>
                                    <i>-</i>
                                    How can I invest with {{$general->title}} ?
                                </button>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingone" data-parent="#accordionExample">
                                <div class="card-body">
                                    To make a investment you must first become a member of {{$general->title}}. Once you are signed up, you can make your first deposit. All deposits must be made through the Members Area. You can login using the member email and password.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingtwo">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    How do I open my {{$general->title}} Account?</button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    It's quite easy and convenient. Follow this <a href="{{route('register')}}">link</a>, fill in the registration form and then press "Secure Sign Up".</div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingthree">

                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    Which e-currencies do you accept? </button>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    We accept Bitcoin, Ethereum and Bitcoin Cash</div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingfour">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    How long does it take for my funds to be added to my wallet? </button>
                            </div>
                            <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Your account will be updated as fast, as your payment is confirmed..
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-header" id="headingfive">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    When will the Wallet Funding should be activated?
                                </button>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Bitcoin and Ethereum are credited immediately after 3 Network confirmations.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingsix">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    May I have several deposits at the same time?</button>
                            </div>
                            <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Yes, sure you may have as many deposits as you want.</div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingseven">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    Do you have any limits for an investment amount?</button>
                            </div>
                            <div id="collapse7" class="collapse" aria-labelledby="headingseven" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Yes, The limits are according to the plan selected.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingeight">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    How can I withdraw funds?
                                </button>
                            </div>
                            <div id="collapse8" class="collapse" aria-labelledby="headingeight" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Login to your account using your email and password and check the Withdraw section.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingnine">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    How fast will my withdrawal be processed?
                                </button>
                            </div>
                            <div id="collapse9" class="collapse" aria-labelledby="headingnine" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Withdrawal is automatic, the site pays automatically directly to your wallet once contract or duration terminates or ends.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingten">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    Are there risks involved?
                                </button>
                            </div>
                            <div id="collapse10" class="collapse" aria-labelledby="headingten" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Yes. There are definitely risks involved in every form of capital management.
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header" id="headingeleven">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    What are the expected ROI?</button>
                            </div>
                            <div id="collapse11" class="collapse" aria-labelledby="headingeleven" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Expected ROIs on fully managed portfolios range from 15% monthly to 50% monthly.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingtwelve">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse12" aria-expanded="false">
                                    <i>+</i>
                                    <i>-</i>
                                    How can I change my e-mail address or password?
                                </button>
                            </div>
                            <div id="collapse12" class="collapse" aria-labelledby="headingtwelve" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                    <div class="faq-body">Log into your {{$general->title}} account and click on the "Account Information". You can change your e-mail address and password there.</div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading13">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        What if I can't log into my account because I forgot my password?
                                    </button>
                                </div>
                                <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Click forgot password link, type your e-mail and you'll receive your account information.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading14">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        How do you calculate the interest on my account?
                                    </button>
                                </div>
                                <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Depending on each plan. Interest on your {{$general->title}} account is acquired Daily, Weekly, Bi-Weekly, Monthly and Yearly and credited to your available balance at the end of each day.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading15">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        Can I do a direct deposit from my account balance? </button>
                                </div>
                                <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Yes, all deposits can only be made directly from your wallet.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading16">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse16" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        Can I make an additional deposit to {{$general->title}} account has been opened?
                                    </button>
                                </div>
                                <div id="collapse16" class="collapse" aria-labelledby="heading16" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Yes, you can but all transactions are handled separately.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading17">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse17" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        Do you have a referral program?
                                    </button>
                                </div>
                                <div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Yes and Our company offers Referral Commission.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading18">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse18" aria-expanded="false">
                                        <i>+</i>
                                        <i>-</i>
                                        Should I have an active deposit to participate in the Referral program?</button>
                                </div>
                                <div id="collapse18" class="collapse" aria-labelledby="heading18" data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        No,it is not necessary.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection