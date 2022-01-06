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
    <form action="{{route('loan_deposit.report.month-wise')}}" method="post">
        @csrf
        <div class="card-header table-card-header">

                <div class="col-md-12" style="margin-bottom: 25px">
                    <h5 class="text-inverse">MONTH WISE LOAN DEPOSIT REPORT</h5>
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
                            <select name="loan_scheme_id" class="form-control select2-select" data-placeholder="Select Loan Scheme">
                                <option value=""></option>
                                @foreach ($loanSchemes as $loanScheme)
                                    <option value="{{$loanScheme->encryptId}}" @if($loanSchemeId == $loanScheme->id) selected @endif> {{$loanScheme->name}} </option>
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
                        <input style="margin-right:10px " type="submit" class="btn btn-primary m-b-0" name="month-wise-report" value="Submit">
                        <input type="submit" class="btn btn-primary m-b-0" name="month-wise-report" value="Excel">
                    </div>
                </div>
            <hr>
        </div>
    </form>
    <div class="card-block">

        <div class="dt-responsive table-responsive">
            <table data-source="{{route('deposit.data')}}" class="table loan-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer Information</th>
                        <th>Loan Scheme</th>
                        <th>Account Information</th>
                        @php $tempStartTime = $startTime @endphp
                        @while($tempStartTime <= $endTime)
                            <th> @php echo date('F-Y',$tempStartTime) @endphp</th>
                            @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp

                        @endwhile
                        <th>Deposit Details</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl = 1 @endphp
                    @foreach ($accounts as $account)
                        @php
                            $totalDeposit = 0; $totalLateFee = 0; $totalAmount = 0
                        @endphp
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>
                                <ul class="list list-unstyled">
                                    <li>ID #: &nbsp;{{$account->customer->customer_uid}}</li>
                                    <li>{{$account->customer->name}}</li>
                                </ul>
                            </td>
                            <td>{{$account->loanScheme->name}}</td>
                            <td>
                                <ul class="list list-unstyled">
                                    <li>Account #: &nbsp;{{$account->account_no}}</li>
                                    <li>Start Date #: &nbsp;{{showdateformat($account->start_installment_date,'M-Y')}}</li>
                                    <li>End Date #: &nbsp;{{showdateformat($account->end_installment_date,'M-Y')}}</li>
                                </ul>
                            </td>
                            @php $tempStartTime = $startTime @endphp
                            @while($tempStartTime <= $endTime)
                                @php $paid = false @endphp
                                @foreach ($account->activeLoanDeposits as $deposit)
                                    @if($deposit->scheduleDateTime == $tempStartTime)
                                        @php
                                            $paid = true;
                                            $depositAmount = $deposit->deposit_amount;
                                            $lateFee = $deposit->late_fee;
                                            $totalDeposit += $depositAmount;
                                            $totalLateFee += $lateFee;
                                        @endphp
                                        <td>
                                            <ul class="list list-unstyled">
                                                <li>Deposit #: &nbsp;{{$depositAmount}}</li>
                                                <li style="color: red">Late Fee #: &nbsp;{{$lateFee}}</li>
                                            </ul>
                                        </td>
                                    @endif
                                @endforeach
                                @if($paid == false)
                                    @if((strtotime($account->start_installment_date) <= $tempStartTime) && (empty($account->end_installment_date) || strtotime($account->end_installment_date) >= $tempStartTime))
                                        <td> 0 </td>
                                    @else
                                        <td> N/A </td>
                                    @endif
                                @endif
                                @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp
                            @endwhile
                            <td>
                                <ul class="list list-unstyled">
                                    <li>Total Deposit #: &nbsp;{{$totalDeposit}}</li>
                                    <li style="color: red">Total Late Fee #: &nbsp;{{$totalLateFee}}</li>
                                </ul>
                            </td>
                            <td>{{$totalDeposit+$totalLateFee}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        let colWidth = 0;
        for (let index = 1; index <= 4; index++) {
            $('th:nth-child('+index+')').css('left',colWidth);
            $('td:nth-child('+index+')').css('left',colWidth);
            colWidth += $('th:nth-child('+(index)+')').outerWidth();
        }
    });

</script>

@endsection
