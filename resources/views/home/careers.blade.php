@extends('layouts.front')
@section('content')
    <style>

        ol.organizational-chart,
        ol.organizational-chart ol,
        ol.organizational-chart li,
        ol.organizational-chart li > div {
            position: relative;
        }

        ol.organizational-chart,
        ol.organizational-chart ol {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ol.organizational-chart {
            text-align: center;
        }

        ol.organizational-chart ol {
            padding-top: 1em;
        }

        ol.organizational-chart ol:before,
        ol.organizational-chart ol:after,
        ol.organizational-chart li:before,
        ol.organizational-chart li:after,
        ol.organizational-chart > li > div:before,
        ol.organizational-chart > li > div:after {
            background-color: #b7a6aa;
            content: '';
            position: absolute;
        }

        ol.organizational-chart ol > li {
            padding: 1em 0 0 1em;
        }

        ol.organizational-chart > li ol:before {
            height: 1em;
            left: 50%;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart > li ol:after {
            height: 3px;
            left: 3px;
            top: 1em;
            width: 50%;
        }

        ol.organizational-chart > li ol > li:not(:last-of-type):before {
            height: 3px;
            left: 0;
            top: 2em;
            width: 1em;
        }

        ol.organizational-chart > li ol > li:not(:last-of-type):after {
            height: 100%;
            left: 0;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart > li ol > li:last-of-type:before {
            height: 3px;
            left: 0;
            top: 2em;
            width: 1em;
        }

        ol.organizational-chart > li ol > li:last-of-type:after {
            height: 2em;
            left: 0;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart li > div {
            background-color: #fff;
            border-radius: 3px;
            min-height: 2em;
            padding: 0.5em;
        }

        /*** PRIMARY ***/
        ol.organizational-chart > li > div {
            background-color: #a2ed56;
            margin-right: 1em;
        }

        ol.organizational-chart > li > div:before {
            bottom: 2em;
            height: 3px;
            right: -1em;
            width: 1em;
        }

        ol.organizational-chart > li > div:first-of-type:after {
            bottom: 0;
            height: 2em;
            right: -1em;
            width: 3px;
        }

        ol.organizational-chart > li > div + div {
            margin-top: 1em;
        }

        ol.organizational-chart > li > div + div:after {
            height: calc(100% + 1em);
            right: -1em;
            top: -1em;
            width: 3px;
        }

        /*** SECONDARY ***/
        ol.organizational-chart > li > ol:before {
            left: inherit;
            right: 0;
        }

        ol.organizational-chart > li > ol:after {
            left: 0;
            width: 100%;
        }

        ol.organizational-chart > li > ol > li > div {
            background-color: #83e4e2;
        }

        /*** TERTIARY ***/
        ol.organizational-chart > li > ol > li > ol > li > div {
            background-color: #fd6470;
        }

        /*** QUATERNARY ***/
        ol.organizational-chart > li > ol > li > ol > li > ol > li > div {
            background-color: #fca858;
        }

        /*** QUINARY ***/
        ol.organizational-chart > li > ol > li > ol > li > ol > li > ol > li > div {
            background-color: #fddc32;
        }

        /*** MEDIA QUERIES ***/
        @media only screen and ( min-width: 64em ) {

            ol.organizational-chart {
                margin-left: -1em;
                margin-right: -1em;
            }

            /* PRIMARY */
            ol.organizational-chart > li > div {
                display: inline-block;
                float: none;
                margin: 0 1em 1em 1em;
                vertical-align: bottom;
            }

            ol.organizational-chart > li > div:only-of-type {
                margin-bottom: 0;
                width: calc((100% / 1) - 2em - 4px);
            }

            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(2),
            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(2) ~ div {
                width: calc((100% / 2) - 2em - 4px);
            }

            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(3),
            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(3) ~ div {
                width: calc((100% / 3) - 2em - 4px);
            }

            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(4),
            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(4) ~ div {
                width: calc((100% / 4) - 2em - 4px);
            }

            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(5),
            ol.organizational-chart > li > div:first-of-type:nth-last-of-type(5) ~ div {
                width: calc((100% / 5) - 2em - 4px);
            }

            ol.organizational-chart > li > div:before,
            ol.organizational-chart > li > div:after {
                bottom: -1em!important;
                top: inherit!important;
            }

            ol.organizational-chart > li > div:before {
                height: 1em!important;
                left: 50%!important;
                width: 3px!important;
            }

            ol.organizational-chart > li > div:only-of-type:after {
                display: none;
            }

            ol.organizational-chart > li > div:first-of-type:not(:only-of-type):after,
            ol.organizational-chart > li > div:last-of-type:not(:only-of-type):after {
                bottom: -1em;
                height: 3px;
                width: calc(50% + 1em + 3px);
            }

            ol.organizational-chart > li > div:first-of-type:not(:only-of-type):after {
                left: calc(50% + 3px);
            }

            ol.organizational-chart > li > div:last-of-type:not(:only-of-type):after {
                left: calc(-1em - 3px);
            }

            ol.organizational-chart > li > div + div:not(:last-of-type):after {
                height: 3px;
                left: -2em;
                width: calc(100% + 4em);
            }

            /* SECONDARY */
            ol.organizational-chart > li > ol {
                display: flex;
                flex-wrap: nowrap;
            }

            ol.organizational-chart > li > ol:before,
            ol.organizational-chart > li > ol > li:before {
                height: 1em!important;
                left: 50%!important;
                top: 0!important;
                width: 3px!important;
            }

            ol.organizational-chart > li > ol:after {
                display: none;
            }

            ol.organizational-chart > li > ol > li {
                flex-grow: 1;
                padding-left: 1em;
                padding-right: 1em;
                padding-top: 1em;
            }

            ol.organizational-chart > li > ol > li:only-of-type {
                padding-top: 0;
            }

            ol.organizational-chart > li > ol > li:only-of-type:before,
            ol.organizational-chart > li > ol > li:only-of-type:after {
                display: none;
            }

            ol.organizational-chart > li > ol > li:first-of-type:not(:only-of-type):after,
            ol.organizational-chart > li > ol > li:last-of-type:not(:only-of-type):after {
                height: 3px;
                top: 0;
                width: 50%;
            }

            ol.organizational-chart > li > ol > li:first-of-type:not(:only-of-type):after {
                left: 50%;
            }

            ol.organizational-chart > li > ol > li:last-of-type:not(:only-of-type):after {
                left: 0;
            }

            ol.organizational-chart > li > ol > li + li:not(:last-of-type):after {
                height: 3px;
                left: 0;
                top: 0;
                width: 100%;
            }

        }
    </style>
    <div class="wrapper">
        <div class="container">
            <ol class="organizational-chart">
                <li>
                    <div>
                        <h3>ALI, Zeeshan</h3>
                        <p>Director</p>
                    </div>
                    <div>
                        <h3>DANIEL, C Harry</h3>
                        <p>Director</p>
                    </div>
                    <div>
                        <h3>MICHELLE, C Riordan</h3>
                        <p>Secretary</p>
                    </div>
                    <ol>
                        <li>
                            <div>
                                <h4>Patrick Barrett</h4>
                                <p>Financial Advisers</p>
                            </div>
                            <ol>
                                <li>
                                    <div>
                                        <h5>Scarlet Wallis </h5>
                                        <p>Insurers</p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h6>Erna C Bonham </h6>
                                        <p>Chief Accountant</p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h5>Kian Bryan </h5>
                                        <p>Investment managers </p>
                                    </div>
                                    <ol>
                                        <li>
                                            <div>
                                                <h6>Samuel Brennan </h6>
                                                <p>Superannuation </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h6>Wayne S Godfrey </h6>
                                                <p>Financial Adviser </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h6>Jacob Farrel </h6>
                                                <p>Financial Services Enforcement </p>
                                            </div>
                                            <ol>
                                                <li>
                                                    <div>
                                                        <h6>Ivan Baresi </h6>
                                                        <p>Wealth Management Enforcement </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <h6>Alfio Siciliani </h6>
                                                        <p>Corporations & Corporate Governance </p>
                                                    </div>
                                                    <ol>
                                                        <li>
                                                            <div>
                                                                <h6>Vyacheslav Vagin</h6>
                                                                <p>Enforcement WA & Criminal Intelligence Unit </p>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </li>
                                                <li>
                                                    <div>
                                                        <h6>Ruthie Williams </h6>
                                                        <p>Secretary </p>
                                                    </div>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <div>
                                <h4>Kate Marshall </h4>
                                <p>Markets Enforcement </p>
                            </div>
                            <ol>
                                <li>
                                    <div>
                                        <h5>Lennon Mackenzie</h5>
                                        <p>Corporations</p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h5>Mary Mclntosh</h5>
                                        <p>Corporations</p>
                                    </div>
                                    <ol>
                                        <li>
                                            <div>
                                                <h6>Cassidy Kennedy </h6>
                                                <p>Corporations</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h6>Clare Hunter</h6>
                                                <p>Corporations</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h6>Steven Black</h6>
                                                <p>Corporations</p>
                                            </div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <div>
                                <h2>Leo Thomson </h2>
                                <p>Chief Accountant </p>
                            </div>
                            <ol>
                                <li>
                                    <div>
                                        <h5>Jaxon Clark </h5>
                                        <p>Market Infrastructure</p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h5>Alan Walker  </h5>
                                        <p>Chief Supervisory Officer </p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h5>Vanessa Cameron </h5>
                                        <p>Close and Continuous monitoring Governance</p>
                                    </div>
                                    <ol>
                                        <li>
                                            <div>
                                                <h6>Scott Turner </h6>
                                                <p>Market Supervision </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h6>Tyler Hughes</h6>
                                                <p>Registered Liquidators, financial Reporting & Audit </p>
                                            </div>
                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    <div>
                                        <h5>Liam watt</h5>
                                        <p>Credit and Banking </p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h5>Mathew Findlay </h5>
                                        <p>Corporations </p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h6>Mary J Archie </h6>
                                        <p>Corporations</p>
                                    </div>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </li>
            </ol>

        </div>
    </div>
@endsection