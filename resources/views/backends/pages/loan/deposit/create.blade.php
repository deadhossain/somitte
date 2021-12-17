@extends('backends.pages.main')
@section('main-body')
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Deposit</h5>
    </div>
    <div class="card-block">
        <form action="{{route('loan_deposit.store',$account->encryptId)}}" method="post" novalidate="">
            @csrf
            <input type="hidden" readonly name="lateDays" id="late-days" value="{{$lateDays->value}}">

            <div class="row">
                <div class="col-md-4 form-group @error('customer_id') has-error @enderror">
                    <label class="col-form-label"> Customer * </label>
                    <input autocomplete="off" type="text" class="form-control" name="customer_name" value="{{ $account->customer->name }}" readonly>
                    <span class="messages popover-valid">
                        @error('customer_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-4 form-group @error('account_no') has-error @enderror">
                    <label class="col-form-label">Account No</label>
                    <input autocomplete="off" type="text" class="form-control" name="account_no" value="{{ $account->account_no }}" readonly>
                    <span class="messages popover-valid">
                        @error('account_no')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-4 form-group @error('loan_date') has-error @enderror">
                    <label class="col-form-label">Loan Month</label>
                    <input readonly autocomplete="off" type="text" class="form-control month-datepicker" name="loan_date" placeholder="Enter Schedule date" value="{{ showDateFormat($account->loan_date,'F-Y') }}">
                    <span class="messages popover-valid">
                        @error('loan_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group @error('scheme_name') has-error @enderror">
                    <label class="col-form-label"> Scheme * </label>
                    <input autocomplete="off" type="text" class="form-control" name="scheme_name" value="{{ $account->loanScheme->name }}" readonly>
                    <span class="messages popover-valid">
                        @error('scheme_name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('rate') has-error @enderror">
                    <label class="col-form-label">Rate (%)</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="rate" placeholder="Enter Rate" value="{{ $account->loanScheme->rate }}">
                    <span class="messages popover-valid-inline">
                        @error('rate')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('min_amount') has-error @enderror">
                    <label class="col-form-label">Min Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="min_amount" placeholder="Enter Min Amount" value="{{ $account->loanScheme->min_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('min_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('max_amount') has-error @enderror">
                    <label class="col-form-label">Max Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="max_amount" placeholder="Enter Max Amount" value="{{ $account->loanScheme->max_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('max_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('max_installment') has-error @enderror">
                    <label class="col-form-label">Max Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="max_installment" placeholder="Enter Max Installment" value="{{ $account->loanScheme->max_installment }}">
                    <span class="messages popover-valid-inline">
                        @error('max_installment')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group  @error('loan_amount') has-error @enderror">
                    <label class="col-form-label">Loan Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="loan_amount" placeholder="Enter Loan Amount" value="{{ $account->loan_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('loan_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('profit') has-error @enderror">
                    <label class="col-form-label">Profit</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="profit" placeholder="Enter Rate" value="{{ $account->total_payable_amount - $account->loan_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('profit')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group  @error('total_payable_amount') has-error @enderror">
                    <label class="col-form-label">Total Payable Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="total_payable_amount" placeholder="Enter Payable Amount" value="{{ $account->total_payable_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('total_payable_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('total_installment_no') has-error @enderror">
                    <label class="col-form-label">Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control wholeNumber" name="total_installment_no" placeholder="Enter Total Installment" value="{{ $account->total_installment_no }}">
                    <span class="messages popover-valid-inline">
                        @error('total_installment_no')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group  @error('per_installment') has-error @enderror">
                    <label class="col-form-label">Per Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control wholeNumber" name="per_installment" placeholder="Per Installment" value="{{ $account->per_installment }}">
                    <span class="messages popover-valid-inline">
                        @error('per_installment')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row">

                <div class="col-md-3 form-group @error('deposit_amount') has-error @enderror">
                    <label class="col-form-label">Deposit Amount</label>
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="deposit_amount" placeholder="Enter First Deposit Amount" value="{{ $account->per_installment }}">
                    <span class="messages popover-valid">
                        @error('deposit_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group @error('late_fee') has-error @enderror">
                    <label class="col-form-label"> Late Fee(<strong class="late-days">{{$days}}</strong> day(s) late)</label>

                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="late_fee" placeholder="Enter Late Fee" latefee={{$account->loanScheme->late_fee}}
                    value="@php
                        if(empty(old('late_fee'))) if($days>=$lateDays->value) echo $account->loanScheme->late_fee; else echo 0;
                        else echo old('late_fee');
                        @endphp">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>

                </div>

                <div class="col-md-3 form-group @error('schedule_date') has-error @enderror">
                    <label class="col-form-label">Deposit Schedule Month</label>
                    <input readonly autocomplete="off" type="text" class="form-control month-datepicker" name="schedule_date" placeholder="Enter Schedule date" value="{{ showDateFormat($date,'F-Y') }}">
                    <span class="messages popover-valid">
                        @error('schedule_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group @error('deposit_date') has-error @enderror">
                    <label class="col-form-label">Deposit Date</label>
                    <input autocomplete="off" type="text" class="form-control single-datepicker" name="deposit_date" placeholder="Enter Scheme End date" value="{{ date('d-m-Y') }}">
                    <span class="messages popover-valid">
                        @error('deposit_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 form-group @error('remarks') has-error @enderror">
                    <label class="col-form-label">Remarks</label>
                    <textarea rows="5" name="remarks" class="form-control" placeholder="Enter Remarks">{{old('remarks')}}</textarea>
                    <span class="messages popover-valid">
                        @error('remarks')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>


            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Tooltip Validation card end -->

<script>
    $(document).ready(function() {
        $(document).on('change','input[name="deposit_date"]',function (params) {
            let lateDays= $(this).closest('form').find('input[name="lateDays"]').val();

            let scheduleDate= $(this).closest('form').find('input[name="schedule_date"]').val();
            let lateFees=$(this).closest('form').find('input[name="late_fee"]').attr('latefee');
            // let lbllateFees=$(this).closest('form').find('input[name="late_fee"]').attr('latefee');

            var DepositDate= $(this).val();
            let differenceDays = dateDiff (scheduleDate, DepositDate);
            $(this).closest('form').find('strong.late-days').text(differenceDays);
            if(differenceDays>=lateDays) $(this).closest('form').find('input[name="late_fee"]').val(lateFees);
            else $(this).closest('form').find('input[name="late_fee"]').val(0);
        })
    })

    function dateDiff (date1, date2) {
        var start = moment(date1, "MMMM-YYYY");
        var end = moment(date2, "DD-MM-YYYY");
        return moment.duration(end.diff(start)).asDays();
    }
</script>

@endsection
