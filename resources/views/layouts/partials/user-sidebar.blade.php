<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('user-dashboard')}}" class="sidebar-brand">
            <img src="{{ asset('assets/images') }}/{{ $general->logo }}" alt="" style="width: 100%">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('user-dashboard')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">User</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">User Data</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user-edit') }}" class="nav-link">Edit Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-details') }}" class="nav-link">View Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-kyc') }}" class="nav-link">KYC Verification</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('programs') }}" class="nav-link">
                    <i class="link-icon" data-feather="folder"></i>
                    <span class="link-title">Plans</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user-activity') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">User Activities</span>
                </a>
            </li>
            <li class="nav-item nav-category">Transactions</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Wallet</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('wallets') }}" class="nav-link">All Wallets</a></li>
                        <li class="nav-item" >
                            <a href="{{ route('add-fund') }}" class="nav-link">Deposit Funds</a></li>
                        <li class="nav-item">
                            <a href="{{ route('fund-history') }}" class="nav-link">Deposit History</a></li>
                        <li class="nav-item">
                            <a href="{{ route('swap-coins') }}" class="nav-link">Swap Coin</a></li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('add-fund') }}" class="nav-link">Deposit in Wallet</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('fund-history') }}" class="nav-link">Deposit History</a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Invest</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('deposit-new') }}" class="nav-link">New Invest</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('deposit-history') }}" class="nav-link">Investment History</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('repeat-history') }}" class="nav-link">Profit</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Withdraw</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('withdraw-new') }}" class="nav-link">New Withdraw Request</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('withdraw-history') }}" class="nav-link">Withdraw History</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Referral</li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Referral</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reference-user') }}" class="nav-link">Downliners</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reference-history') }}" class="nav-link">Bonus History</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transfer-reference') }}" class="nav-link">Transfer Referral Bonus</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Support</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#support" role="button" aria-expanded="false" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Support</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="support">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('support-open')}}" class="nav-link">Create Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('support-all')}}" class="nav-link">All Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('announcements')}}" class="nav-link">Announcements</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Account</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user-password') }}" class="nav-link">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
