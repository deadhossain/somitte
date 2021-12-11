
@extends('backends.pages.main')
@section('main-body')
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Edit Loan Account</h5>
    </div>
    <div class="card-block">
        <form action="{{route('loan_account.update',$loanAccount->encryptId)}}" method="post" novalidate="">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-4 form-group @error('account_no') has-error @enderror">
                    <label class="col-form-label">Account No *</label>
                    <input autocomplete="off" type="text" class="form-control" name="account_no" placeholder="Enter Account No" value="{{ old('account_no')?:$loanAccount->account_no }}">
                    <span class="messages popover-valid-inline">
                        @error('account_no')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-4 form-group @error('customer_id') has-error @enderror">
                    <label class="col-form-label"> Customer * </label>
                    <select name="customer_id" class="form-control select2-select" data-placeholder="Select Customer" required>
                        <option value=""> Select Customer </option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->encryptId}}" @if($customer->id==$loanAccount->customer_id) selected @endif> {{$customer->name}} :: {{$customer->customer_uid}} </option>
                        @endforeach
                    </select>
                    <span class="messages popover-valid-inline">
                        @error('customer_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-4 form-group @error('nominee_id') has-error @enderror">
                    <label class="col-form-label"> Nominee * </label>
                    <select name="nominee_id" class="form-control select2-select" data-placeholder="Select Nominee" required>
                        <option value=""> Select Nominee </option>
                        @foreach ($customers as $nominee)
                            <option value="{{$nominee->encryptId}}" @if($nominee->id==$loanAccount->customer_id) selected @endif> {{$nominee->name}} :: {{$nominee->customer_uid}} </option>
                        @endforeach
                    </select>
                    <span class="messages popover-valid-inline">
                        @error('nominee_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4 form-group @error('loan_scheme_id') has-error @enderror">
                    <label class="col-form-label"> Loan Scheme (Rate - Installment)* </label>
                    <select name="loan_scheme_id" class="form-control select2-select" data-placeholder="Select Loan Scheme" required>
                        <option value="">Select Loan Scheme</option>
                        @foreach ($loanSchemes as  $loanScheme)
                            <option late_fee="{{ $loanScheme->late_fee}}" min="{{ $loanScheme->min_amount}}" max="{{ $loanScheme->max_amount}}" rate="{{ $loanScheme->rate}}" max-installment="{{ $loanScheme->max_installment}}" value="{{ $loanScheme->encryptId}}" @if($loanAccount->loan_scheme_id ==  $loanScheme->id) selected @endif>
                                {{ $loanScheme->name }} ({{$loanScheme->rate}}%-{{$loanScheme->max_installment}})
                            </option>
                        @endforeach
                    </select>
                    <span class="messages popover-valid-inline">
                        @error('loan_scheme_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>


                <div class="col-md-2 form-group @error('rate') has-error @enderror">
                    <label class="col-form-label">Rate (%)</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="rate" placeholder="Enter Rate" value="{{ old('rate')?:$loanAccount->loanScheme->rate }}">
                    <span class="messages popover-valid-inline">
                        @error('rate')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>


                <div class="col-md-2 form-group @error('min_amount') has-error @enderror">
                    <label class="col-form-label">Min Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="min_amount" placeholder="Enter Min Amount" value="{{ old('min_amount')?:$loanAccount->loanScheme->min_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('min_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('max_amount') has-error @enderror">
                    <label class="col-form-label">Max Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="max_amount" placeholder="Enter Max Amount" value="{{ old('min_amount')?:$loanAccount->loanScheme->max_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('max_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('max_installment') has-error @enderror">
                    <label class="col-form-label">Max Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="max_installment" placeholder="Enter Max Installment" value="{{ old('max_installment')?:$loanAccount->loanScheme->max_installment }}">
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
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="loan_amount" placeholder="Enter Loan Amount" value="{{ old('loan_amount')?:$loanAccount->loan_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('loan_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('profit') has-error @enderror">
                    <label class="col-form-label">Profit</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="profit" placeholder="Enter Rate" value="{{ old('profit')?:$loanAccount->total_payable_amount-$loanAccount->loan_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('profit')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group  @error('total_payable_amount') has-error @enderror">
                    <label class="col-form-label">Total Payable Amount</label>
                    <input readonly autocomplete="off" type="text" class="form-control decimalNumber" name="total_payable_amount" placeholder="Enter Payable Amount" value="{{ old('total_payable_amount')?:$loanAccount->total_payable_amount }}">
                    <span class="messages popover-valid-inline">
                        @error('total_payable_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group @error('total_installment_no') has-error @enderror">
                    <label class="col-form-label">Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control wholeNumber" name="total_installment_no" placeholder="Enter Total Installment" default-value="{{ old('total_installment_no') }}" value="{{ old('total_installment_no')?:$loanAccount->total_installment_no }}">
                    <span class="messages popover-valid-inline">
                        @error('total_installment_no')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-2 form-group  @error('per_installment') has-error @enderror">
                    <label class="col-form-label">Per Installment</label>
                    <input readonly autocomplete="off" type="text" class="form-control wholeNumber" name="per_installment" placeholder="Per Installment" value="{{ old('per_installment')?:$loanAccount->total_payable_amount/$loanAccount->total_installment_no }}">
                    <span class="messages popover-valid-inline">
                        @error('per_installment')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group @error('loan_date') has-error @enderror">
                    <label class="col-form-label">Loan Date</label>
                    <input autocomplete="off" type="text" class="form-control today-datepicker" name="loan_date" placeholder="Enter Loan date" value="{{ old('loan_date')?:showDateFormat($loanAccount->loan_date)}}">
                    <span class="messages popover-valid-inline">
                        @error('loan_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group @error('late_fee') has-error @enderror">
                    <label class="col-form-label">Late Fee</label>
                    <input autocomplete="off" type="text" class="form-control wholeNumber" name="late_fee" placeholder="Enter Late Fee" value="{{ old('late_fee')?:$loanAccount->late_fee }}">
                    <span class="messages popover-valid-inline">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group @error('start_installment_date') has-error @enderror">
                    <label class="col-form-label">Start Installment Date</label>
                    <input autocomplete="off" type="text" class="form-control single-datepicker" name="start_installment_date" placeholder="Enter Scheme Start date" value="{{ old('start_installment_date')?:showDateFormat($loanAccount->start_installment_date) }}">
                    <span class="messages popover-valid-inline">
                        @error('start_installment_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>

                <div class="col-md-3 form-group @error('end_installment_date') has-error @enderror">
                    <label class="col-form-label">End Installment Date</label>
                    <input autocomplete="off" type="text" class="form-control single-datepicker" name="end_installment_date" placeholder="Enter Scheme End date" value="{{ old('end_installment_date')?:showDateFormat($loanAccount->end_installment_date) }}">
                    <span class="messages popover-valid-inline">
                        @error('end_installment_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group @error('account_status') has-error @enderror">
                    <label class="col-form-label"> Account Status </label>
                    <select name="account_status" class="form-control">
                        <option value="1" @if($loanAccount->account_status==1 && old('account_status')==1) selected @endif>Running</option>
                        <option value="0" @if($loanAccount->account_status==0 && old('account_status')==0) selected @endif>Completed</option>
                    </select>
                </div>

                <div class="col-md-3 form-group @error('active_fg') has-error @enderror">
                    <label class="col-form-label"> Active Status </label>
                    <select name="active_fg" class="form-control">
                        <option value="1" @if($loanAccount->active_fg==1 && old('active_fg')==1) selected @endif>ACTIVE</option>
                        <option value="0" @if($loanAccount->active_fg==0 && old('active_fg')==0) selected @endif>INACTIVE</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 form-group row @error('remarks') has-error @enderror" style="padding-right: 0px">
                <label class="ol-form-label">Remarks</label>
                <textarea rows="5" name="remarks" class="form-control" placeholder="Enter Remarks">{{old('remarks')?:$loanAccount->remarks}}</textarea>
                <span class="messages popover-valid-inline">
                    @error('remarks')
                        <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                    @enderror
                </span>
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
    $(document).ready(function () {

        $(document).on('change','select[name="loan_scheme_id"]',function (params) {
            var schemeId = $(this).val();
            var form = $(this).closest('form');
            elementLoanAmount = form.find('input[name="loan_amount"]');
            elementPayableAmount = form.find('input[name="total_payable_amount"]');
            elementTotalInstallment = form.find('input[name="total_installment_no"]');
            elementPerInstallment = form.find('input[name="per_installment"]');
            elementMinLoanAmount = form.find('input[name="min_amount"]');
            elementMaxLoanAmount = form.find('input[name="max_amount"]');
            elementMaxInstallment = form.find('input[name="max_installment"]');
            elementRate = form.find('input[name="rate"]');
            elementLateFee = form.find('input[name="late_fee"]');
            elementProfit = form.find('input[name="profit"]');
            elementLoanAmount.val("");
            elementPayableAmount.val("");
            elementTotalInstallment.val("");
            elementTotalInstallment.attr('default-value',"");
            elementPerInstallment.val("");
            if(schemeId){
                var element = $(this).find('option:selected');
                var minAmount = element.attr('min');
                var maxAmount = element.attr('max');
                var maxInstallment = element.attr('max-installment');
                elementMinLoanAmount.val(minAmount);
                elementMaxLoanAmount.val(maxAmount);
                elementMaxInstallment.val(maxInstallment);
                elementTotalInstallment.val(maxInstallment);
                elementTotalInstallment.attr('default-value',maxInstallment);
                elementRate.val(element.attr('rate'));
                elementLateFee.val(element.attr('late_fee'));
                elementLoanAmount.attr('min',minAmount);
                elementLoanAmount.attr('max',maxAmount);
                elementLoanAmount.attr("readonly", false);
                elementPayableAmount.attr("readonly", false);
                elementTotalInstallment.attr("readonly", false);
            }else{
                elementLoanAmount.attr("readonly", true);
                elementPayableAmount.attr("readonly", true);
                elementTotalInstallment.attr("readonly", true);
                elementMinLoanAmount.val("");
                elementMaxLoanAmount.val("");
                elementMaxInstallment.val("");
                elementRate.val("");
                elementLateFee.val("");
                elementProfit.val("");
            }
        });

        $('select[name="loan_scheme_id"]').trigger("change");
    })


    $(document).ready(function() {
        var timer = null;
        $(document).on('keydown','input[name="loan_amount"]',function (e) {
            var keyCode = (e.keyCode ? e.keyCode : e.which);
            if (keyCode === 13 || keyCode == undefined ){
                e.preventDefault();
                var time = 0;
            }else{
                var time = 1400;
            }
            clearTimeout(timer);
            var self = $(this);
            timer = setTimeout(function() { calculateLoan(self) }, time);

        })
    });



    function calculateLoan(element) {
        var form = element.closest('form');
        elementLoanAmount = form.find('input[name="loan_amount"]');
        elementTotalPayableAmount = form.find('input[name="total_payable_amount"]');
        elementTotalInstallment = form.find('input[name="total_installment_no"]');
        elementPerInstallment = form.find('input[name="per_installment"]');
        elementProfit = form.find('input[name="profit"]');
        var minAmount = parseInt(form.find('input[name="min_amount"]').val());
        var maxAmount = parseInt(form.find('input[name="max_amount"]').val());
        var rate = parseInt(form.find('input[name="rate"]').val());
        var loanAmount = parseInt(elementLoanAmount.val());
        var totalInstallment = parseInt(elementTotalInstallment.val());
        if(loanAmount>maxAmount || loanAmount<minAmount){
            alert("loan amount out of range");
            elementLoanAmount.val("");
            elementTotalPayableAmount.val("");
            elementPerInstallment.val("");
            elementProfit.val("");
        }else{
            var profit = (rate/100)*loanAmount;
            var totalAmount = loanAmount+profit;
            elementProfit.val(profit);
            elementTotalPayableAmount.val(totalAmount);
            elementPerInstallment.val(Math.ceil(totalAmount/totalInstallment));
        }
    }


    $(document).ready(function() {
        var timer = null;
        $(document).on('keydown','input[name="total_installment_no"],input[name="total_payable_amount"]',function (e) {
            var keyCode = (e.keyCode ? e.keyCode : e.which);
            if (keyCode === 13 || keyCode == undefined ){
                e.preventDefault();
                var time = 0;
            }else{
                var time = 1400;
            }
            clearTimeout(timer);
            var self = $(this);
            timer = setTimeout(function() { calculatePerInstallment(self) }, time);

        })
    });

    function calculatePerInstallment(element) {
        var form = element.closest('form');
        elementTotalPayableAmount = form.find('input[name="total_payable_amount"]');
        elementTotalInstallment = form.find('input[name="total_installment_no"]');
        elementMaxInstallment = form.find('input[name="max_installment"]');
        elementPerInstallment = form.find('input[name="per_installment"]');
        var totalInstallment = parseInt(elementTotalInstallment.val());
        var defaulTotalInstallment = parseInt(elementTotalInstallment.attr('default-value'));
        var maxInstallment = parseInt(elementMaxInstallment.val());
        var totalPayableAmount = parseInt(elementTotalPayableAmount.val());
        if(totalInstallment<=0 || totalInstallment>maxInstallment){
            alert("Installment must be greater than 0 and less equal to "+maxInstallment);
            elementTotalInstallment.val(defaulTotalInstallment);
        }else{
            elementTotalInstallment.attr('default-value',totalInstallment);
            elementPerInstallment.val(Math.ceil(totalPayableAmount/totalInstallment));
        }
    }
</script>

@endsection
