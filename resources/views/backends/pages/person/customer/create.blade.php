@extends('backends.pages.main')
@section('main-body')

<div class="card">
    <div class="card-header">
        <h5>Create New Customer</h5>
    </div>
    <div class="card-block">
        <form action="{{route('customer.store')}}" method="post" novalidate="" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group row @error('name') has-error @enderror">
                        <label class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control" name="name" placeholder="Enter Customer Name" value="{{ old('name') }}">
                            <span class="messages popover-valid">
                                @error('name')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('customer_uid') has-error @enderror">
                        <label class="col-sm-2 col-form-label">Customer ID *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control" name="customer_uid" placeholder="Enter Customer ID" value="{{ old('customer_uid') }}">
                            <span class="messages popover-valid">
                                @error('customer_uid')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('gender_id') has-error @enderror">
                        <label class="col-sm-2 col-form-label"> Gender * </label>
                        <div class="col-sm-10">
                            <select name="gender_id" class="form-control select2-select" data-placeholder="Select Gender" required>
                                <option value="">Select Gender</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}"> {{$gender->name}} </option>
                                @endforeach
                            </select>
                            <span class="messages popover-valid">
                                @error('gender_id')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('nid_no') has-error @enderror">
                        <label class="col-sm-2 col-form-label">NID No *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control" name="nid_no" placeholder="Enter NID No" value="{{ old('nid_no') }}">
                            <span class="messages popover-valid">
                                @error('nid_no')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('phone') has-error @enderror">
                        <label class="col-sm-2 col-form-label">Phone *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control numeric" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                            <span class="messages popover-valid">
                                @error('phone')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('start_date') has-error @enderror">
                        <label class="col-sm-2 col-form-label">Start Date *</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control today-datepicker" name="start_date" placeholder="Enter Customer Start date" value="{{ old('start_date') }}">
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
                            <input autocomplete="off" type="text" class="form-control single-datepicker" name="end_date" placeholder="Enter Customer End date" value="{{ old('end_date') }}">
                            <span class="messages popover-valid">
                                @error('end_date')
                                    <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row @error('address') has-error @enderror">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input autocomplete="off" type="text" class="form-control" name="address" placeholder="Enter Adress" value="{{ old('address') }}">
                            <span class="messages popover-valid">
                                @error('address')
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
                </div>
                <div class="col-md-3">
                    <div class="form-group @error('image') has-error @enderror">
                        <label class="col-form-label">Picture</label>
                        <img style="width: 280px;height: 300px;margin: auto;" src="{{asset('assets/images/customer-default.png')}}" alt="customer-default-pic" class="img-thumbnail image-preview">
                        <input style="width: 280px;" type="file" class="form-control image" name="image">
                        <span class="messages popover-valid">
                            @error('image')
                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                            @enderror
                        </span>
                    </div>

                    <div class="form-group @error('nid_attachment') has-error @enderror">
                        <label class="col-form-label">NID</label>
                        <input type="file" name="nid_attachment" class="form-control">
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
