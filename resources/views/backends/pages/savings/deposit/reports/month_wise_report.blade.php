@extends('backends.pages.main')
@section('main-body')

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
            <table data-source="{{route('deposit.data')}}" class="table savings-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer Name</th>
                        <th>Customer ID</th>
                        <th>Savings Scheme</th>
                        <th>Account No</th>
                        @php $tempStartTime = $startTime @endphp
                        @while($tempStartTime <= $endTime)
                            <th> @php echo date('F-Y',$tempStartTime) @endphp</th>
                            @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp

                        @endwhile
                        <th>Total Deposit</th>
                        <th>Total Late Fee</th>
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
                            <td>{{$account->customer->name}}</td>
                            <td>{{$account->customer->customer_uid}}</td>
                            <td>{{$account->savingsScheme->name}}</td>
                            <td>{{$account->account_no}}</td>
                            @php $tempStartTime = $startTime @endphp
                            @while($tempStartTime <= $endTime)
                                @php $paid = false @endphp
                                @foreach ($account->activeSavingsDeposits as $deposit)
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
                                @if($paid == false) <td> 0 </td> @endif
                                @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp
                            @endwhile
                            <td>{{$totalDeposit}}</td>
                            <td>{{$totalLateFee}}</td>
                            <td>{{$totalDeposit+$totalLateFee}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- @include('backends.partials.datatablescript') --}}
<script type="text/javascript">
    var columns = [
        {
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {data: 'customer.name', name: 'customer.name'},
        {data: 'savings_scheme.name', name: 'savings_scheme.name'},
        {data: 'account_no', name: 'account_no'},
        {data: 'savings_scheme.amount', name: 'savings_scheme.amount'},
        {data: 'savings_scheme.late_fee', name: 'savings_scheme.late_fee'},
        {data: 'paymentStatus', name: 'paymentStatus'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        // loadDatatableWithColumns($('.savings-deposit-datatable'),columns);
    });

</script>

@endsection
