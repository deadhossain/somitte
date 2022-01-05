@extends('backends.pages.main')
@section('main-body')
<style>
    .card .card-header {
        background-color: transparent;
        border-bottom: none;
        padding: 10px 20px;
    }
</style>
<div class="row">
    @php
        $totalSavingsDeposits = $customer->totalActiveSavingsDeposits;
        $totalSavingsLateFees = $customer->totalActiveSavingsDepositsLateFee;
        $totalRemainingSavingsBalance = $totalSavingsDeposits;


        $totalLoanAmount = $customer->totalLoanAmount;
        $totalLoanDeposits = $customer->totalActiveLoanDeposits;
        $totalLoanLateFees = $customer->totalActiveLoanDepositsLateFee+0;
        $totalRemainingBalance = $totalLoanAmount - $totalLoanDeposits;
    @endphp
    <div class="col-lg-6 col-xl-3 col-md-6">
        <div class="card rounded-card user-card">
            <div class="card-block">
                <div class="img-hover">
                    <img class="img-fluid img-radius" src="{{$customer->image_path}}" alt="customer-default-pic" style="height: 170px">
                </div>
                <div class="user-content">
                    <h4 class="">{{$customer->name}}</h4>
                    <p class="m-b-0 text-muted">{{$customer->customer_uid}}</p>
                    <p class="m-b-0 text-muted">{{$customer->phone}}</p>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-9 col-md-6">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">${{$totalSavingsDeposits}}</h4>
                                <h6 class="text-white m-b-0">Total Savings Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Savings Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">{{count($customer->savingsAccounts)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$0</h4>
                                <h6 class="text-white m-b-0">With Draw</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Late Fee</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">{{$totalSavingsLateFees}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">${{$totalRemainingSavingsBalance}}</h4>
                                <h6 class="text-white m-b-0">Balance</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Active Savings Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">{{$totalLoanAmount}}</h4>
                                <h6 class="text-white m-b-0">Loan Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Total Late Fee</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">{{$totalLoanLateFees}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">{{$totalLoanDeposits}}</h4>
                                <h6 class="text-white m-b-0">Paid Loan Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Total Paid Loan Late Fee</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">{{0}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">{{$totalRemainingBalance}}</h4>
                                <h6 class="text-white m-b-0">Remaining Loan </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Loan Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">{{count($customer->loanAccounts)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="row">
    <div class="col-lg-12">
        <!-- tab header start -->
        <div class="tab-header card">
            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#savings-account" role="tab">Savings Account</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#loan-account" role="tab">Loan Account</a>
                    <div class="slide"></div>
                </li>
            </ul>
        </div>
        <!-- tab header end -->
        <!-- tab content start -->
        <div class="tab-content">
            <!-- tab pane contact start -->
            <div class="tab-pane active" id="savings-account" role="tabpanel">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- user contact card left side start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">All Savings Accounts</h5>
                            </div>
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach ($customer->savingsAccounts as $savingsAccount)
                                        @php $id = $savingsAccount->id; @endphp
                                        <div class="panel panel-primary accordion-panel" style="border-color: #01a9ac;margin-bottom:15px;">
                                            <div class="accordion-heading" role="tab" id="heading{{$id}}" style="margin: -1px;" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$id}}" aria-expanded="true" aria-controls="collapse{{$savingsAccount->id}}">
                                                <h5 class="card-title accordion-title" >
                                                    <div class="accordion-msg">
                                                        <a style="color: white;font-size: inherit;">
                                                            {{$savingsAccount->account_no}}
                                                        </a>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse{{$id}}" class="panel-body panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$id}}" style="margin-top: 25px;">
                                                <div class="accordion-content accordion-desc">
                                                    <div class="row">
                                                        <div class="dt-responsive table-responsive col-md-5">
                                                            <table id="simpletable" class="table table-xs table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL</th>
                                                                        <th>Name</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $sl = 0; @endphp
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total Savings Amount </td>
                                                                        <td>{{$savingsAccount->totalSavingsDeposits}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Profit </td>
                                                                        <td> {{$savingsAccount->profit}}% </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total Late Fee </td>
                                                                        <td> {{$savingsAccount->totalSavingsDepositsLateFee}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total WithDraw Amount </td>
                                                                        <td> 0 </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Remaining Saving amount </td>
                                                                        <td> {{$savingsAccount->totalSavingsDeposits}} </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="data_table_main table-responsive dt-responsive col-md-7">
                                                            <table class="table basic-datatable table-xs table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL</th>
                                                                        <th>SChedule Date</th>
                                                                        <th>Deposit Date</th>
                                                                        <th>Deposit Amount</th>
                                                                        <th>Late Fee</th>
                                                                        {{-- <th>Status</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $sl = 0; @endphp
                                                                    @foreach ($savingsAccount->activeSavingsDeposits as $savingsDeposits)
                                                                        <tr>
                                                                            <td> {{++$sl}} </td>
                                                                            <td> {{showDateFormat($savingsDeposits->schedule_date)}} </td>
                                                                            <td> {{showDateFormat($savingsDeposits->deposit_date)}} </td>
                                                                            <td> {{$savingsDeposits->deposit_amount}} </td>
                                                                            <td> {{$savingsDeposits->late_fee}} </td>
                                                                            {{-- <td> {!! $user->status !!} </td> --}}
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- user contact card left side end -->
                    </div>
                </div>
            </div>
            <!-- tab pane contact end -->
            <div class="tab-pane" id="loan-account" role="tabpanel">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- user contact card left side start -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">All Loan Accounts</h5>
                            </div>
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach ($customer->loanAccounts as $loanAccount)
                                        @php $id = $loanAccount->id; @endphp
                                        <div class="panel panel-primary accordion-panel" style="border-color: #01a9ac;margin-bottom:15px;">
                                            <div class="accordion-heading" role="tab" id="heading{{$id}}" style="margin: -1px;" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$id}}" aria-expanded="true" aria-controls="collapse{{$loanAccount->id}}">
                                                <h5 class="card-title accordion-title" >
                                                    <div class="accordion-msg">
                                                        <a style="color: white;font-size: inherit;">
                                                            {{$loanAccount->account_no}}
                                                        </a>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse{{$id}}" class="panel-body panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$id}}" style="margin-top: 25px;">
                                                <div class="accordion-content accordion-desc">
                                                    <div class="row">
                                                        <div class="dt-responsive table-responsive col-md-5">
                                                            <table class="table table-xs table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL</th>
                                                                        <th>Name</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $sl = 0;
                                                                        $totalPayableAmount = $loanAccount->total_payable_amount;
                                                                        $totalPaidLoanAmount = $loanAccount->totalLoanDeposits;
                                                                        $totalRemainingLoanAmount = $totalPayableAmount - $totalPaidLoanAmount;
                                                                    @endphp
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Loan Amount </td>
                                                                        <td>{{$loanAccount->loan_amount}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Rate </td>
                                                                        <td> {{$loanAccount->rate}}% </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total Payable Amount </td>
                                                                        <td> {{$totalPayableAmount}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total Late Fee </td>
                                                                        <td> {{$loanAccount->totalLoanDepositsLateFee}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Total Paid Loan Amount  </td>
                                                                        <td> {{$totalPaidLoanAmount}} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> {{++$sl}} </td>
                                                                        <td> Remaining Loan amount </td>
                                                                        <td> {{$totalRemainingLoanAmount}} </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="data_table_main table-responsive dt-responsive col-md-7">
                                                            <table class="table basic-datatable table-xs table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL</th>
                                                                        <th>SChedule Date</th>
                                                                        <th>Deposit Date</th>
                                                                        <th>Deposit Amount</th>
                                                                        <th>Late Fee</th>
                                                                        {{-- <th>Status</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $sl = 0; @endphp
                                                                    @foreach ($loanAccount->activeLoanDeposits as $loanDeposits)
                                                                        <tr>
                                                                            <td> {{++$sl}} </td>
                                                                            <td> {{showDateFormat($loanDeposits->schedule_date)}} </td>
                                                                            <td> {{showDateFormat($loanDeposits->deposit_date)}} </td>
                                                                            <td> {{$loanDeposits->deposit_amount}} </td>
                                                                            <td> {{$loanDeposits->late_fee}} </td>
                                                                            {{-- <td> {!! $user->status !!} </td> --}}
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- user contact card left side end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- tab content end -->
    </div>
</div>
@include('backends.partials.datatablescript')
<script type="text/javascript">
    $(document).ready(function(){
        // adjustWidth();
        $('.basic-datatable').each(function(){
            normalDatatable($(this));
        });
    });
</script>

@endsection
