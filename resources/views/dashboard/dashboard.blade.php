@extends('layouts.admin')
@section('content')
    <h3>Admin Balance Statistics</h3>
    <div class="row counter">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter">{{ $basic->currency }}<span class="counter-count"> {{ $current_balance }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">CURRENT BALANCE</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-wallet"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter">{{ $basic->currency }}<span class="counter-count"> {{ $total_deposit }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Deposit</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-currency-btc"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">50% Complete</span></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter">{{ $basic->currency }}<span class="counter-count">{{ $total_withdraw_bal }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Withdrawn</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder-remove"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">50% Complete</span></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
    </div>

    <h3>User Statistics</h3>
    <div class="row counter">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter"><span class="counter-count"> {{ $total_user }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">Total User</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success-gradient w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count"> {{ $total_active }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Active</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account-plus"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count">{{ $total_unverify }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Unverify</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account-minus"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count">{{ $total_block }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Block</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account-alert"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-light-danger w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <h3>Invest Plan Statistics</h3>
    <div class="row counter">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter"><span class="counter-count"> {{ $total_plan }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">Total Plan</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count"> {{ $active_plan }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Active Plan</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder-plus"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success-gradient w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count">{{ $deactive_plan }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Inactive Plan</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder-remove"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <h3>Transaction Method</h3>
    <div class="row counter">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count"> {{ $active_fund }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Active Payment Method</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-currency-btc"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count">{{ $active_withdraw }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Active Withdrawal Method</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder-remove"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter"><span class="counter-count"> {{ $total_withdraw }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">Total Withdrawal Method</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <h3>Withdraw Method</h3>
    <div class="row counter">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count"> {{ $withdraw_total }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Total Withdrawal</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-currency-btc"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center">
                            <h2 class="counter"><span class="counter-count">{{ $withdraw_pending }}</span></h2>
                            <h6 class="text-muted mb-0 text-uppercase">Pending Withdrawal</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-folder-remove"></i></div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger w-70-p h-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter"><span class="counter-count"> {{ $withdraw_refund }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">Refunded Withdrawal</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pa-10 no-block">
                        <div class="align-slef-center ">
                            <h2 class="counter"><span class="counter-count"> {{ $withdraw_success }}</span></h2>


                            <h6 class="text-muted mb-0 text-uppercase text-green-100">Successful Withdrawal</h6>
                        </div>
                        <div class="align-self-center display-6 ml-auto"> <i class="mdi mdi-account"></i> </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-dark w-70-p h-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

@endsection
@section('scripts')

@endsection