@extends('backends.pages.main')
@section('main-body')
<style>
    th:nth-child(-n+4), td:nth-child(-n+4)
    {
        position:sticky;
        background-color: white;
        z-index: 2;
    }

    table{
        border: none;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid black !important;
    }

</style>

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <form action="{{route('deposit.report.month-wise')}}" method="post">
        @csrf
        <div class="card-header table-card-header">

                <div class="col-md-12" style="margin-bottom: 25px">
                    <h5 class="text-inverse">MONTH WISE SAVINGS DEPOSIT REPORT</h5>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 form-group @error('datefilter') has-error @enderror">
                            <label class="col-form-label"> Select Date Range </label>
                            <input readonly autocomplete="off" type="text" class="form-control" name="datefilter" placeholder="Select Month" value="{{$daterange}}" required>
                            <span class="messages popover-valid">
                                @error('datefilter')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="col-form-label"> Customer </label>
                            <select style="width: 100%" name="customer_id" class="form-control select2-select col-sm-12"  data-placeholder="Select Customer">
                                <option value=""></option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->encryptId}}" @if($customerId == $customer->id) selected @endif> {{$customer->name}} :: {{$customer->customer_uid}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="col-form-label"> Scheme </label>
                            <select name="savings_scheme_id" class="form-control select2-select" data-placeholder="Select Savings Scheme">
                                <option value=""></option>
                                @foreach ($savingsSchemes as $savingsScheme)
                                    <option value="{{$savingsScheme->encryptId}}" @if($savingsSchemeId == $savingsScheme->id) selected @endif> {{$savingsScheme->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="col-form-label"> Account No </label>
                            <select style="width: 100%" name="account_id" class="form-control select2-select col-sm-12" data-placeholder="Select Account">
                                <option value=""></option>
                                @foreach ($accounts as $account)
                                    <option value="{{$account->encryptId}}" @if($accountId == $account->id) selected @endif> {{$account->account_no}} </option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class=" col-md-3 form-group row">
                        <label class="col-form-label"> </label>
                        <input type="submit" class="btn btn-primary m-b-0" name="month-wise-report" value="Submit">
                    </div>
                </div>
            <hr>
        </div>
    </form>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            {{-- @include('backends.pages.savings.deposit.reports.month_wise_report_table',[
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'accounts' => $accounts
                ]
            ) --}}
            @include('backends.pages.savings.deposit.reports.month_wise_report_table')
            {{-- https://www.youtube.com/watch?v=n3WjgZiPZdM --}}
            {{-- https://www.youtube.com/watch?v=ujUA3OL9As0 --}}
        </div>
    </div>
</div>
@endsection
