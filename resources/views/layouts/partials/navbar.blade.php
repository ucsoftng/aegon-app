<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin mt-3">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
                    <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
{{--        <form class="search-form">--}}
{{--            <div class="input-group">--}}
{{--                <div class="input-group-prepend">--}}
{{--                    <div class="input-group-text">--}}
{{--                        <i data-feather="search"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">--}}
{{--            </div>--}}
{{--        </form>--}}
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" alt="" >
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{ Auth::user()->name }}</p>
                            <p class="email text-muted mb-3">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ route('user-details') }}" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{ route('user-edit') }}" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{ route('fund-history') }}" class="nav-link">
                                    <i data-feather="dollar-sign"></i> My Balance: $ {{Auth::user()->amount}} </a></li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{route('support-all')}}" class="nav-link">
                                    <i data-feather="mail"></i> Inbox : @php $sc = \App\Support::whereuser_id(Auth::user()->id)->count() @endphp {{$sc}} Messages </a></li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{ route('user-password') }}" class="nav-link">
                                    <i data-feather="settings"></i> Account Setting</a></li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
