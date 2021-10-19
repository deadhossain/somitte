@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Update Customer</h5>
    </div>
    <div class="card-block">
        <form action="{{route('customer.update',$customer->id)}}" method="post" novalidate="" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Customer Name" value="{{ old('name')?:$customer->name }}">
                            <span class="messages popover-valid">
                                @error('name')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Gender * </label>
                        <div class="col-sm-10">
                            <select name="gender_id" class="form-control gender-select @error('gender_id') form-control-danger @enderror" aria-placeholder="Select Gender" required>
                                <option value="">Select Gender</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}" @if($gender->id===$customer->gender_id) selected @endif> {{$gender->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NID No *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control @error('nid_no') form-control-danger @enderror" name="nid_no" placeholder="Enter NID No" value="{{ old('nid_no')?:$customer->nid_no }}">
                            <span class="messages popover-valid">
                                @error('nid_no')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control numeric @error('phone') form-control-danger @enderror" name="phone" placeholder="Enter Phone Number" value="{{ old('phone')?:$customer->phone }}">
                            <span class="messages popover-valid">
                                @error('phone')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Date *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control today-datepicker @error('start_date') form-control-danger @enderror" name="start_date" placeholder="Enter Customer Start date" value="{{ old('start_date')?:showDateFormat($customer->start_date) }}">
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
                            <input autocomplete="off" type="text" class="form-control single-datepicker @error('end_date') form-control-danger @enderror" name="end_date" placeholder="Enter Customer End date" value="{{ old('end_date')?:showDateFormat($customer->end_date) }}">
                            <span class="messages popover-valid">
                                @error('end_date')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control @error('address') form-control-danger @enderror" name="address" placeholder="Enter Adress" value="{{ old('address')?:$customer->address }}">
                            <span class="messages popover-valid">
                                @error('address')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="remarks" class="form-control @error('remarks') form-control-danger @enderror" placeholder="Enter Remarks">{{old('remarks')?:$customer->remarks}}</textarea>
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
                                <option value="1" @if($customer->active_fg==1 && old('active_fg')==1) selected @endif>ACTIVE</option>
                                <option value="0" @if($customer->active_fg==0 && old('active_fg')==0) selected @endif>INACTIVE</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label">Picture</label>
                        <img style="width: 280px;height: 300px;margin: auto;" src="{{$customer->image_path}}" alt="customer-default-pic" class="img-thumbnail image-preview">
                        <input style="width: 280px;margin: auto;" type="file" class="form-control image @error('image') form-control-danger @enderror" name="image">
                        <span class="messages popover-valid">
                            @error('image')
                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">NID</label>
                        <input type="file" name="nid_attachment" class="form-control @error('nid_attachment') form-control-danger @enderror">
                        <span class="messages popover-valid">
                            @error('nid_attachment')
                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<!-- Tooltip Validation card end -->
@endsection

