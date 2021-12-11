@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Create New Scheme</h5>
    </div>
    <div class="card-block">
        <form action="{{route('scheme.store')}}" method="post" novalidate="">
            @csrf
            <div class="form-group row @error('name') has-error @enderror">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="name" placeholder="Enter Scheme Name" value="{{ old('name') }}">
                    <span class="messages popover-valid">
                        @error('name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('amount') has-error @enderror">
                <label class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="amount" placeholder="Enter Scheme Amount" value="{{ old('amount') }}">
                    <span class="messages popover-valid">
                        @error('amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('profit') has-error @enderror">
                <label class="col-sm-2 col-form-label">Profit(%)</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="profit" placeholder="Enter Profit" value="{{ old('profit') }}">
                    <span class="messages popover-valid">
                        @error('profit')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('late_fee') has-error @enderror">
                <label class="col-sm-2 col-form-label">Late Fee</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control decimalNumber" name="late_fee" placeholder="Enter Late Fee" value="{{ old('late_fee') }}">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('start_date') has-error @enderror">
                <label class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control today-datepicker" name="start_date" placeholder="Enter Scheme Start date" value="{{ old('start_date') }}">
                    <span class="messages popover-valid">
                        @error('start_date')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('end_date') has-error @enderror">
                <label class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control single-datepicker" name="end_date" placeholder="Enter Scheme End date" value="{{ old('end_date') }}">
                    <span class="messages popover-valid">
                        @error('end_date')
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
