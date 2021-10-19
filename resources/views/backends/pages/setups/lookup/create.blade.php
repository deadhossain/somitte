@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Add Lookup</h5>
    </div>
    <div class="card-block">
        <form id="second" action="{{route('lookup.store')}}" method="post" novalidate="">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Lookup Name" value="{{ old('name') }}">
                    <span class="messages popover-valid">
                        @error('name')
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
