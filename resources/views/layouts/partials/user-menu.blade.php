{{--<div class="card card-style bg-23 mb-3 rounded-m mt-3" data-card-height="150">--}}
{{--    <div class="card-top m-3">--}}
{{--        <a href="#" data-bs-dismiss="offcanvas" class="icon icon-xs bg-theme rounded-s color-theme float-end">--}}
{{--            <i class="bi bi-caret-left-fill"></i>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="card-overlay rounded-0"></div>--}}
{{--</div>--}}

<div class="bg-theme mx-3 rounded-m shadow-m mt-3 mb-3">
    <div class="d-flex px-2 pb-2 pt-2">
        <div>
            <a href="#">
                <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" width="45" class="rounded-s" alt="img">
            </a>
        </div>
        <div class="ps-2 align-self-center">
            <h5 class="ps-1 mb-0 line-height-xs pt-1">{{ Auth::user()->name }}</h5>
            <h6 class="ps-1 mb-0 font-400 opacity-40">{{ Auth::user()->email }}</h6>
        </div>
        <div class="ms-auto">
            <a href="#" data-bs-toggle="dropdown" class="icon icon-m ps-3"><i class="bi bi-three-dots-vertical font-18 color-theme"></i></a>
            <div class="dropdown-menu  bg-transparent border-0 mt-n1 ms-3">
                <div class="card card-style rounded-m shadow-xl mt-1 me-1">
                    <div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                           class="color-theme opacity-70 list-group-item py-1"><strong class="font-500 font-12">Log Out</strong><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<span class="menu-divider">NAVIGATION</span>
<div class="menu-list">
    <div class="card card-style rounded-m p-3 py-2 mb-0">
        <a href="{{route('user-dashboard')}}" id="nav-homes">
            <i class="gradient-blue shadow-bg shadow-bg-xs bi bi-house-fill"></i>
            <span>Dashboard</span><i class="bi bi-chevron-right"></i>
        </a>
        <a data-bs-toggle="collapse" href="#collapse-list-1" aria-controls="collapse-list-1">
            <i class="gradient-red shadow-bg shadow-bg-xs bi bi-wallet-fill"></i>
            <span>Wallet</span><i class="bi bi-chevron-right"></i>
        </a>
        <div id="collapse-list-1" class="collapse">
            <a href="{{route('wallets')}}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">Wallets</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
{{--            <a href="{{ route('swap-coins') }}" class="list-group-item ss">--}}
{{--                <div class="ps-1"><strong class="font-12">Swap</strong></div>--}}
{{--                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>--}}
{{--            </a>--}}
            <a href="{{ route('fund-history') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">History</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
        </div>
        <a data-bs-toggle="collapse" href="#collapse-list-2" aria-controls="collapse-list-2">
            <i class="gradient-green shadow-bg shadow-bg-xs bi bi-bar-chart-fill"></i>
            <span>Trade</span><i class="bi bi-chevron-right"></i>
        </a>
        <div id="collapse-list-2" class="collapse">
{{--            <a href="{{ route('programs') }}" class="list-group-item ss">--}}
{{--                <div class="ps-1"><strong class="font-12">Bots</strong></div>--}}
{{--                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>--}}
{{--            </a>--}}
            <a href="{{ route('trade') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">Trade</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
            <a href="{{ route('deposit-history') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">History</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
{{--            <a href="{{ route('repeat-history') }}" class="list-group-item ss">--}}
{{--                <div class="ps-1"><strong class="font-12">Profit</strong></div>--}}
{{--                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>--}}
{{--            </a>--}}
        </div>
        <a data-bs-toggle="collapse" href="#collapse-list-3" aria-controls="collapse-list-3">
            <i class="gradient-yellow shadow-bg shadow-bg-xs bi bi-folder-fill"></i>
            <span>Withdrawal</span><i class="bi bi-chevron-right"></i>
        </a>
        <div id="collapse-list-3" class="collapse">
            <a href="{{ route('withdraw-new') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">Withdraw</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
            <a href="{{ route('withdraw-history') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">History</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
        </div>
        <a data-bs-toggle="collapse" href="#collapse-list-4" aria-controls="collapse-list-4">
            <i class="gradient-magenta shadow-bg shadow-bg-xs bi bi-person-plus-fill"></i>
            <span>Referral</span><i class="bi bi-chevron-right"></i>
        </a>
        <div id="collapse-list-4" class="collapse">
            <a href="{{ route('reference-user') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">Downliners</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
            <a href="{{ route('reference-history') }}" class="list-group-item ss">
                <div class="ps-1"><strong class="font-12">History</strong></div>
                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
            </a>
{{--            <a href="{{ route('transfer-reference') }}" class="list-group-item ss">--}}
{{--                <div class="ps-1"><strong class="font-12">Transfer</strong></div>--}}
{{--                <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>--}}
{{--            </a>--}}
        </div>
    </div>
</div>
<span class="menu-divider mt-4">Messages</span>
<div class="menu-content px-3">
    <div class="card card-style rounded-m p-2 mx-0 bg-theme mb-0">
        <div class="menu-list">
            <a data-bs-toggle="collapse" href="#collapse-list-5" aria-controls="collapse-list-5">
                <i class="gradient-highlight shadow-bg shadow-bg-xs bi bi-headphones"></i>
                <span>Support</span><i class="bi bi-chevron-right"></i>
            </a>
            <div id="collapse-list-5" class="collapse">
                <a href="{{route('support-open')}}" class="list-group-item ss">
                    <div class="ps-1"><strong class="font-12">Create Ticket</strong></div>
                    <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
                </a>
                <a href="{{route('support-all')}}" class="list-group-item ss">
                    <div class="ps-1"><strong class="font-12">All Ticket</strong></div>
                    <i class="bi bi-chevron-right font-9 color-gray-dark ps-4"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<span class="menu-divider mt-4">SETTINGS</span>
<div class="menu-list">
    <div class="card card-style rounded-m p-3 py-2 mb-0">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="gradient-highlight shadow-bg shadow-bg-xs bi bi-lock-fill"></i>
            <span>Logout</span>
            <i class="bi bi-chevron-right"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" data-toggle-theme data-trigger-switch="switch-1">
            <i class="gradient-dark shadow-bg shadow-bg-xs bi bi-moon-fill font-13"></i>
            <span>Dark Mode</span>
            <div class="form-switch ios-switch switch-green switch-s me-2">
                <input type="checkbox" data-toggle-theme class="ios-input" id="switch-1">
                <label class="custom-control-label" for="switch-1"></label>
            </div>
        </a>
    </div>
</div>

