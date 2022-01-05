<table class="table savings-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%;">
    <thead>
        <tr>
            <th rowspan="2">SL</th>
            <th rowspan="2">Customer Name</th>
            <th rowspan="2">Customer ID</th>
            <th rowspan="2">Savings Scheme</th>
            <th rowspan="2">Account No</th>
            <th rowspan="2">Start Date</th>
            <th rowspan="2">End Date</th>
            @php $tempStartTime = $startTime @endphp
            @while($tempStartTime <= $endTime)
                <th colspan="2"> @php echo date('F-Y',$tempStartTime) @endphp</th>
                @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp
            @endwhile
            <th rowspan="2">Total Deposit</th>
            <th rowspan="2">Total Late Fee</th>
            <th rowspan="2">Total Amount</th>
        </tr>
        <tr>
            @php $tempStartTime = $startTime @endphp
            @while($tempStartTime <= $endTime)
                <th>D</th>
                <th>L</th>
                @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp
            @endwhile

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
                <td>{{showdateformat($account->start_date,'M-Y')}}</td>
                <td>{{showdateformat($account->end_date,'M-Y')?:"Continue"}}</td>
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
                            <td> {{$depositAmount}}</td>
                            <td> {{$lateFee}} </td>
                        @endif
                    @endforeach
                    @if($paid == false)
                        @if((strtotime($account->start_date) <= $tempStartTime) && (empty($account->end_date) || strtotime($account->end_date) >= $tempStartTime))
                            <td> 0 </td>
                            <td> 0 </td>
                        @else
                            <td> N/A </td>
                            <td> N/A </td>
                        @endif
                    @endif
                    @php $tempStartTime = strtotime("+1 month", $tempStartTime); @endphp
                @endwhile
                <td>{{$totalDeposit}}</td>
                <td>{{$totalLateFee}}</td>
                <td>{{$totalDeposit+$totalLateFee}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
