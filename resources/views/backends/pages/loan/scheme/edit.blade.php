@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Create New Scheme</h5>
    </div>
    <div class="card-block">
        <form action="{{route('loan_scheme.update',$loanScheme->encryptId)}}" method="post" novalidate="">
            @csrf
            @method('patch')
            <div class="form-group row @error('name') has-error @enderror">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="name" placeholder="Enter Scheme Name" value="{{ old('name')?:$loanScheme->name }}">
                    <span class="messages popover-valid">
                        @error('name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('min_amount') has-error @enderror">
                <label class="col-sm-2 col-form-label">Min Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="min_amount" placeholder="Enter Min Amount" value="{{ old('min_amount')?:$loanScheme->min_amount }}">
                    <span class="messages popover-valid">
                        @error('min_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('max_amount') has-error @enderror">
                <label class="col-sm-2 col-form-label">Max Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="max_amount" placeholder="Enter Max Amount" value="{{ old('max_amount')?:$loanScheme->max_amount }}">
                    <span class="messages popover-valid">
                        @error('max_amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('rate') has-error @enderror">
                <label class="col-sm-2 col-form-label">Rate (%)</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="rate" placeholder="Enter Rate" value="{{ old('rate')?:$loanScheme->rate }}">
                    <span class="messages popover-valid">
                        @error('rate')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('max_installment') has-error @enderror">
                <label class="col-sm-2 col-form-label">Max Installment</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="max_installment" placeholder="Enter Max Installment" value="{{ old('max_installment')?:$loanScheme->max_installment }}">
                    <span class="messages popover-valid">
                        @error('max_installment')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('late_fee') has-error @enderror">
                <label class="col-sm-2 col-form-label">Late Fee</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="late_fee" placeholder="Enter Late Fee" value="{{ old('late_fee')?:$loanScheme->late_fee }}">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('remarks') has-error @enderror">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <textarea rows="5" name="remarks" class="form-control" placeholder="Enter Remarks">{{ old('remarks')?:$loanScheme->remarks }}</textarea>
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
                        <option value="1" @if($loanScheme->active_fg==1 && old('active_fg')==1) selected @endif>ACTIVE</option>
                        <option value="0" @if($loanScheme->active_fg==0 && old('active_fg')==0) selected @endif>INACTIVE</option>
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

