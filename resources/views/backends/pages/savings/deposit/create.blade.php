@extends('backends.pages.main')
@section('main-body')
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Deposit</h5>
    </div>
    <div class="card-block">
        <form action="{{route('deposit.store',$account->encryptId)}}" method="post" novalidate="">
            @csrf
            <div class="form-group row @error('customer_id') has-error @enderror">
                <label class="col-sm-2 col-form-label"> Customer * </label>
                <div class="col-sm-10">
                    {{-- <input autocomplete="off" type="hidden" class="form-control" name="customer_id" value="{{ $account->activeCustomer->encryptId }}"> --}}
                    <input autocomplete="off" type="text" class="form-control" name="customer_name" value="{{ $account->activeCustomer->name }}" readonly>
                    <span class="messages popover-valid">
                        @error('customer_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('customer_id') has-error @enderror">
                <label class="col-sm-2 col-form-label"> Scheme * </label>
                <div class="col-sm-10">
                    {{-- <input autocomplete="off" type="hidden" class="form-control" name="customer_id" value="{{ $account->activeSavingsScheme->encryptId }}"> --}}
                    <input autocomplete="off" type="text" class="form-control" name="scheme_name" value="{{ $account->activeSavingsScheme->name }}" readonly>
                    <span class="messages popover-valid">
                        @error('customer_id')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('account_no') has-error @enderror">
                <label class="col-sm-2 col-form-label">Account No</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="account_no" value="{{ $account->account_no }}" readonly>
                    <span class="messages popover-valid">
                        @error('account_no')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row  @error('deposit_amount') has-error @enderror">
                <label class="col-sm-2 col-form-label">Deposit Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber" name="deposit_amount" placeholder="Enter First Deposit Amount" value="{{ $account->activeSavingsScheme->amount }}">
                    <span class="messages popover-valid">
                        @error('deposit_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row  @error('late_fee') has-error @enderror">
                <label class="col-sm-2 col-form-label"> Late Fee({{$days}} day(s) late)</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber" name="late_fee" placeholder="Enter Late Fee"
                    value="@php
                        if(empty(old('late_fee'))) if($days>=$lateDays->value) echo $account->activeSavingsScheme->late_fee; else echo 0;
                        else echo old('late_fee');
                        @endphp">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('schedule_date') has-error @enderror">
                <label class="col-sm-2 col-form-label">Deposit Schedule Month</label>
                <div class="col-sm-10">
                    <input readonly autocomplete="off" type="text" class="form-control month-datepicker" name="schedule_date" placeholder="Enter Schedule date" value="{{ showDateFormat($date,'F-Y') }}">
                    <span class="messages popover-valid">
                        @error('schedule_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('deposit_date') has-error @enderror">
                <label class="col-sm-2 col-form-label">Deposit Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control single-datepicker" name="deposit_date" placeholder="Enter Scheme End date" value="{{ date('d-m-Y') }}">
                    <span class="messages popover-valid">
                        @error('deposit_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('remarks') has-error @enderror">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
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

@endsection
