@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Edit Deposit</h5>
    </div>
    <div class="card-block">
        <form action="{{route('deposit.update',$deposit->encryptId)}}" method="post" novalidate="">
            @csrf
            @method('patch')
            <div class="form-group row @error('customer_id') has-error @enderror">
                <label class="col-sm-2 col-form-label"> Customer * </label>
                <div class="col-sm-10">
                    {{-- <input autocomplete="off" type="hidden" class="form-control" name="customer_id" value="{{ $account->activeCustomer->encryptId }}"> --}}
                    <input autocomplete="off" type="text" class="form-control" name="customer_name" value="{{ $deposit->savingsAccount->activeCustomer->name }}" readonly>
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
                    <input autocomplete="off" type="text" class="form-control" name="scheme_name" value="{{ $deposit->savingsAccount->activeSavingsScheme->name }}" readonly>
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
                    <input autocomplete="off" type="text" class="form-control" name="account_no" value="{{ $deposit->savingsAccount->account_no }}" readonly>
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
                    <input autocomplete="off" type="text" class="form-control autonumber" name="deposit_amount" placeholder="Enter Deposit Amount" value="{{ old('deposit_amount')?:$deposit->deposit_amount }}">
                    <span class="messages popover-valid">
                        @error('deposit_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row  @error('late_fee') has-error @enderror">
                <label class="col-sm-2 col-form-label"> Late Fee </label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber" name="late_fee" placeholder="Enter Late Fee" value="{{old('late_fee')?:$deposit->late_fee }}">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deposit Schedule Month</label>
                <div class="col-sm-10">
                    <input readonly autocomplete="off" type="text" class="form-control month-datepicker @error('schedule_date') form-control-danger @enderror" name="schedule_date" placeholder="Enter Schedule date" value="{{ old('schedule_date')?:showDateFormat($deposit->schedule_date,'F-Y')}}">
                    <span class="messages popover-valid">
                        @error('schedule_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control single-datepicker @error('deposit_date') form-control-danger @enderror" name="deposit_date" placeholder="Enter Deposit date" value="{{old('deposit_date')?:showDateFormat($deposit->deposit_date)}}">
                    <span class="messages popover-valid">
                        @error('deposit_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <textarea rows="5" name="remarks" class="form-control @error('remarks') form-control-danger @enderror" placeholder="Enter Remarks">{{ old('remarks')?:$deposit->remarks }}</textarea>
                    <span class="messages popover-valid">
                        @error('remarks')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Active Status </label>
                <div class="col-sm-10">
                    <select name="active_fg" class="form-control">
                        <option value="1" @if($deposit->active_fg==1 && old('active_fg')==1) selected @endif>ACTIVE</option>
                        <option value="0" @if($deposit->active_fg==0 && old('active_fg')==0) selected @endif>INACTIVE</option>
                    </select>
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

