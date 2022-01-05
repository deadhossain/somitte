<table class="table savings-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%;">
    <thead>
        <tr>
            <th>SL</th>
            <th>Customer Information</th>
            <th>Savings Scheme</th>
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
                <td>{{$account->savingsScheme->name}}</td>
                <td>
                    <ul class="list list-unstyled">
                        <li>Account #: &nbsp;{{$account->account_no}}</li>
                        <li>Start Date #: &nbsp;{{showdateformat($account->start_date,'M-Y')}}</li>
                        <li>End Date #: &nbsp;{{showdateformat($account->end_date,'M-Y')}}</li>
                    </ul>
                </td>
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
                    @if($paid == false)
                        @if((strtotime($account->start_date) <= $tempStartTime) && (empty($account->end_date) || strtotime($account->end_date) >= $tempStartTime))
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
