@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Update Lookup</h5>
    </div>
    <div class="card-block">
        <form id="second" action="{{route('lookup_detail.update', ['lookup_detail' => $lookupDetail->id])}}" method="post" novalidate="">
            {{-- <form id="second" action="{{route('lookup_detail.update', ['lookup_detail' => Crypt::encrypt($lookupDetail->id)])}}" method="post" novalidate=""> --}}
            @csrf
            @method('patch')
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Lookup Name" value="{{ old('name')?:$lookupDetail->name }}">
                    <span class="messages popover-valid">
                        @error('name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Value</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('value') form-control-danger @enderror" name="value" placeholder="Enter Lookup value" value="{{ old('value')?:$lookupDetail->value }}">
                    <span class="messages popover-valid">
                        @error('value')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('remarks') form-control-danger @enderror" name="remarks" placeholder="Enter Lookup Remarks" value="{{ old('remarks')?:$lookupDetail->remarks }}">
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
                        <option value="1" @if($lookupDetail->active_fg==1 && old('active_fg')==1) selected @endif>ACTIVE</option>
                        <option value="0" @if($lookupDetail->active_fg==0 && old('active_fg')==0) selected @endif>INACTIVE</option>
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
