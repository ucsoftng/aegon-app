@extends('layouts.mobile-user')
@section('content')
    <link rel="stylesheet" href="{{asset('mobile/styles/clock.css')}}">
    <form id="playGame">
        @csrf
        <div class="card card-style">
            <div class="content">
                <div class="row">
                    <h5>Choose a period</h5>
                    <hr>
                    @foreach($times as $t)
                        <div class="col-6">
                            <div class="form-check form-check-custom">
                                <input class="form-check-input" type="radio" value="{{$t->time}} {{$t->unit}}"
                                       name="period" id="c{{$t->id}}" required>
                                <label class="form-check-label" for="c{{$t->id}}">{{$t->time}} {{$t->unit}}</label>
                                <i class="is-checked color-green-dark bi bi-check-circle"></i>
                                <i class="is-unchecked color-highlight bi bi-circle"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="tFeedback"></div>
            </div>
        </div>
        <div class="card card-style">
            <div class="content">
                <div style="text-align: center;">
                    <h5>{{$basic->currency}}<span id="cryptoPrice"></span></h5>
                </div>
{{--                <div id="container"></div>--}}
                <div id="graph"></div>
            </div>
        </div>
        <div class="card card-style">
            <div class="content">
                <div class="form-custom form-label form-icon mb-3">
                    <i class="bi bi-cash-stack font-14"></i>
                    <input type="number" class="form-control rounded-xs" id="c1" placeholder="Amount" name="amount"
                           required/>
                    <label for="c1" class="color-theme">Amount</label>
                    <div id="feedback"></div>
                    <span>(required)</span>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100 highlowButton"
                                type="submit" value="1" name="highlow">High <i class="bi bi-arrow-up font-13"></i>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-full gradient-red shadow-bg shadow-bg-s mt-4 rounded-xs text-uppercase font-700 w-100 highlowButton"
                                type="submit" value="2" name="highlow">Low <i class="bi bi-arrow-down font-13"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="trade-user-price"></div>
    <div class="card card-style clock" style="display: block !important;"></div>
@endsection
@section('scripts')
    <script src="{{asset('mobile/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('mobile/scripts/clock.min.js')}}"></script>
    <script src="{{asset('mobile/scripts/plotly-latest.min.js')}}"></script>
    <script>
        "use strict";
        var arrayLength = 15;
        var newArray = [];
        var xArray = [];
        var timezone;
        var gtime;
        var coinSymbol = "{{$wallet->short}}";

        for (var i = 0; i < arrayLength; i++) {
            var y;
            var x;
            newArray[i] = y
            xArray[i] = x
        }
        var baseColor = "#2E86DE"
        var trace1 = {
            x: xArray,
            y: newArray,
            showlegend: true,
            line: {color: baseColor},
            visible: true,
            xaxis: 'x1',
            yaxis: 'y1',
        };
        var data = [trace1];
        var layout = {
            xaxis: {
                tickfont: {
                    size: 14,
                    color: '#fff'
                },
                ticklen: 8,
                tickwidth: 2,
                tickcolor: '#8f2331'
            },
            yaxis: {
                tickfont: {
                    size: 14,
                    color: '#fff'
                },
                ticklen: 8,
                tickwidth: 2,
                tickcolor: '#8f2331'
            },
            paper_bgcolor: '#141c24',
            plot_bgcolor: '#141c24',
            showlegend: false,
        };
        Plotly.plot('graph', {
            data: data,
            layout: layout
        });
        var inter = setInterval(function () {
            var dateTime = new Date();
            timezone = dateTime.getTimezoneOffset() / 60;
            gtime = dateTime.getHours() + ':' + dateTime.getMinutes() + ':' + dateTime.getSeconds();
            var time = dateTime.getHours() + ':' + dateTime.getMinutes() + ':' + dateTime.getSeconds();
            $.get("/crypto-prices/{{$wallet->short}}", function (data) {
                $('#cryptoPrice').text(data);
                var y = data;
                var x = time;
                newArray = newArray.concat(y)
                newArray.splice(0, 1)
                xArray = xArray.concat(x)
                xArray.splice(0, 1)
            });

            var data_update = {
                x: [xArray],
                y: [newArray]
            };
            Plotly.update('graph', data_update)
        }, 10000);

        $(document).ready(function () {
            var gameLogId;
            var playTime;
            var playTimeUnit;
            var second;
            var highlowType;
            var coinId = {{$user_wallet->id}};
            const highLowArray = [1, 2];
            const userBalance = {{$user_wallet->amount_in_usd}};

            $(".highlowButton").on('click', function () {
                highlowType = $(this).val();
            })

            $("#playGame").on('submit', function (event) {
                event.preventDefault();
                var amount = $('input[name="amount"]').val();
                var pTime = document.querySelector('input[name="period"]:checked').value;
                const plTime = pTime.split(" ");
                playTime = plTime[0];
                playTimeUnit = plTime[1];
                var timeCount = secondCount();

                if (!highLowArray.includes(parseInt(highlowType)))
                {
                    alert('Invalid Game Type');
                } else if (userBalance < amount)
                {
                    document.getElementById("feedback").innerHTML= '<p style="color: red;">Your Trading Balance Not Enough! Please topup balance</p>';
                } else if (isNaN(amount) || amount <= 0) {
                    document.getElementById("feedback").innerHTML= '<p style="color: red;">Please Insert Valid Amount</p>';
                    // notify('error', 'Please Insert Valid Amount')
                } else if (isNaN(timeCount) || timeCount <= 0) {
                    document.getElementById("tFeedback").innerHTML= '<p style="color: red;">Please Select Valid Time</p>';
                    // notify('error', 'Please Select Valid Time')
                }
                else
                {
                    $('input[name="amount"]').val("");
                    $.ajax({
                        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),},
                        url: "/place-trade",
                        method: "POST",
                        data: {
                            amount: amount,
                            coinId: coinId,
                            highlowType: highlowType,
                            duration: playTime,
                            unit: playTimeUnit
                        },
                        success: function (response)
                        {
                            if (response.status == 200)
                            {
                                gameLogId = response.data.tradeLogId;
                                console.log(gameLogId);
                                countDown(timeCount, gameLogId)

                                if (highlowType == 1)
                                {
                                    document.getElementById("trade-user-price").innerHTML =
                                        '<div class="alert bg-green-light shadow-bg shadow-bg-m alert-dismissible rounded-s fade show mb-0" role="alert">' +
                                        '<i class="bi bi-check-circle-fill pe-2"></i>' +
                                        'You Traded High! ' +
                                        '<button type="button" class="btn-close opacity-10" data-bs-dismiss="alert" aria-label="Close"></button> ' +
                                        '</div>';
                                } else {

                                    document.getElementById("trade-user-price").innerHTML =
                                        '<div class="alert bg-red-light shadow-bg shadow-bg-m alert-dismissible rounded-s fade show mb-0" role="alert">' +
                                        '<i class="bi bi-check-circle-fill pe-2"></i>' +
                                        'You Traded Low! ' +
                                        '<button type="button" class="btn-close opacity-10" data-bs-dismiss="alert" aria-label="Close"></button> ' +
                                        '</div>';
                                }

                            } else if (response.status == 401) {
                                alert(response.message);
                            } else {
                                $.each(response, function (i, val) {
                                    alert(val)
                                });
                            }
                        }
                    });
                }
            });

            function secondCount() {
                if (playTimeUnit == 'seconds') {
                    second = playTime;
                    return second;
                } else if (playTimeUnit == 'minutes') {
                    second = playTime * 60;
                    console.log(playTime);
                    return second;
                } else if (playTimeUnit == 'hours') {
                    second = playTime * 60 * 60;
                    return second;
                }
            }

            function countDown(timeCount, gameLogId) {
                var clock = $('.clock').FlipClock({
                    defaultClockFace: 'HourlyCounter',
                    autoStart: false,
                    callbacks: {
                        stop: function () {
                            gameResult(gameLogId)
                        }
                    }
                });
                clock.setTime(timeCount - 1);
                clock.setCountdown(true);
                clock.start();
            }

            function gameResult(gameLogId) {
                $.ajax({
                    headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),},
                    url: "{{route('trade-result')}}",
                    method: "POST",
                    data: {tradeLogId: gameLogId},
                    success: function (response) {
                        if (response.data == 1) {
                            document.getElementById("trade-user-price").innerHTML =
                                '<div class="alert bg-green-light shadow-bg shadow-bg-m alert-dismissible rounded-s fade show mb-0" role="alert">' +
                                '<i class="bi bi-check-circle-fill pe-2"></i>' +
                                'Yay! You Won! ' +
                                '<button type="button" class="btn-close opacity-10" data-bs-dismiss="alert" aria-label="Close"></button> ' +
                                '</div>';
                            // notify('success', 'Trade Win');
                        } else if (response.data == 2) {
                            document.getElementById("trade-user-price").innerHTML =
                                '<div class="alert bg-red-light shadow-bg shadow-bg-m alert-dismissible rounded-s fade show mb-0" role="alert">' +
                                '<i class="bi bi-check-circle-fill pe-2"></i>' +
                                'OOPS! You Lost! ' +
                                '<button type="button" class="btn-close opacity-10" data-bs-dismiss="alert" aria-label="Close"></button> ' +
                                '</div>';
                            // notify('error', 'Trade Lose');
                        } else if (response.data == 3)
                        {
                            document.getElementById("trade-user-price").innerHTML =
                                '<div class="alert bg-gradient-primary shadow-bg shadow-bg-m alert-dismissible rounded-s fade show mb-0" role="alert">' +
                                '<i class="bi bi-check-circle-fill pe-2"></i>' +
                                'Awww! Its a Tie! Try Again ' +
                                '<button type="button" class="btn-close opacity-10" data-bs-dismiss="alert" aria-label="Close"></button> ' +
                                '</div>';
                            // notify('error', 'Trade Draw');
                        } else {
                            $.each(response, function (i, val) {
                                alert(val)
                            });
                        }
                        setTimeout(function () {
                            location.reload();
                        }, 5000);
                    }
                });
            }

        });
    </script>
@endsection