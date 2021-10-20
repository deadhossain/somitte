@extends('backends.pages.main')
@section('main-body')
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Create New Account</h5>
    </div>
    <div class="card-block">
        <form action="{{route('account.store')}}" method="post" novalidate="">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Customer * </label>
                <div class="col-sm-10">
                    <select name="customer_id" class="form-control select2-select @error('customer_id') form-control-danger @enderror" aria-placeholder="Select Customer" required>
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}"> {{$customer->name}} </option>
                        @endforeach
                    </select>
                    <span class="messages popover-valid">
                        @error('customer_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Savings Scheme * </label>
                <div class="col-sm-10">
                    <select name="savings_scheme_id" class="form-control select2-select @error('savings_scheme_id') form-control-danger @enderror" aria-placeholder="Select Savings Scheme" required>
                        <option value="">Select Savings Scheme</option>
                        @foreach ($savingsSchemes as $savingsScheme)
                            <option value="{{$savingsScheme->id}}"> {{$savingsScheme->name}} </option>
                        @endforeach
                    </select>
                    <span class="messages popover-valid">
                        @error('savings_scheme_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Account No</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('account') form-control-danger @enderror" name="account" placeholder="Enter Scheme Name" value="{{ old('account') }}">
                    <span class="messages popover-valid">
                        @error('account')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">First Deposit Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber @error('first_deposit_ammount') form-control-danger @enderror" name="amount" placeholder="Enter First Deposit Amount" value="{{ old('first_deposit_ammount') }}">
                    <span class="messages popover-valid">
                        @error('first_deposit_ammount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control today-datepicker @error('start_date') form-control-danger @enderror" name="start_date" placeholder="Enter Scheme Start date" value="{{ old('start_date') }}">
                    <span class="messages popover-valid">
                        @error('start_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control single-datepicker @error('end_date') form-control-danger @enderror" name="end_date" placeholder="Enter Scheme End date" value="{{ old('end_date') }}">
                    <span class="messages popover-valid">
                        @error('end_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <textarea rows="5" name="remarks" class="form-control @error('remarks') form-control-danger @enderror" placeholder="Enter Remarks">{{old('remarks')}}</textarea>
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

@endsection
