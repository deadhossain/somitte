@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->

<!-- Select 2 css -->
{{-- <link rel="stylesheet" href="{{asset('bower_components\select2\css\select2.min.css')}}"> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<!-- Form wizard with validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Form Wizard With Validation</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>

    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                <div id="wizard">
                    <section>
                        <form class="wizard-form" id="example-advanced-form" action="#">
                            <h3> Registration </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input autocomplete="off" type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Customer Name" value="{{ old('name') }}">
                                        <span class="messages popover-valid">
                                            @error('name')
                                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Gender </label>
                                    <div class="col-sm-10">
                                        <select class="form-control gender-select" aria-placeholder="Select Gender">
                                            <option value="">Select Gender</option>
                                            @foreach ($genders as $gender)
                                                <option value="{{$gender->id}}"> {{$gender->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NID No</label>
                                    <div class="col-sm-10">
                                        <input autocomplete="off" type="text" class="form-control @error('nid_no') form-control-danger @enderror" name="nid_no" placeholder="Enter NID No" value="{{ old('nid_no') }}">
                                        <span class="messages popover-valid">
                                            @error('nid_no')
                                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input autocomplete="off" type="text" class="form-control autonumber @error('phone') form-control-danger @enderror" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                                        <span class="messages popover-valid">
                                            @error('phone')
                                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input autocomplete="off" type="text" class="form-control today-datepicker @error('start_date') form-control-danger @enderror" name="start_date" placeholder="Enter Customer Start date" value="{{ old('start_date') }}">
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
                                        <input autocomplete="off" type="text" class="form-control single-datepicker @error('end_date') form-control-danger @enderror" name="end_date" placeholder="Enter Customer End date" value="{{ old('end_date') }}">
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
                                        <input autocomplete="off" type="text" class="form-control @error('address') form-control-danger @enderror" name="address" placeholder="Enter Adress" value="{{ old('address') }}">
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
                                        <textarea rows="5" name="remakrs" class="form-control @error('remarks') form-control-danger @enderror" placeholder="Enter Remarks">{{old('remarks')}}</textarea>
                                        <span class="messages popover-valid">
                                            @error('remarks')
                                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </fieldset>
                            <h3> General information </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="name-2" class="block">First name *</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="name-2" name="name" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="surname-2" class="block">Last name *</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="surname-2" name="surname" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="phone-2" class="block">Phone #</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="phone-2" name="phone" type="number" class="form-control required phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="date" class="block">Date Of Birth</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="date" name="Date Of Birth" type="text" class="form-control required date-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">Select Country</div>
                                    <div class="col-md-8 col-lg-10">
                                        <select class="form-control required">
                                            <option>Select State</option>
                                            <option>Gujarat</option>
                                            <option>Kerala</option>
                                            <option>Manipur</option>
                                            <option>Tripura</option>
                                            <option>Sikkim</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <h3> Education </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="University-2" class="block">University</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="University-2" name="University" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="Country-2" class="block">Country</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="Country-2" name="Country" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="Degreelevel-2" class="block">Degree level #</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="Degreelevel-2" name="Degree level" type="text" class="form-control required phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="datejoin" class="block">Date Join</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="datejoin" name="Date Of Birth" type="text" class="form-control required">
                                    </div>
                                </div>
                            </fieldset>
                            <h3> Work experience </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="Company-2" class="block">Company:</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="Company-2" name="Company:" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="CountryW-2" class="block">Country</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="CountryW-2" name="Country" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-lg-2">
                                        <label for="Position-2" class="block">Position</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <input id="Position-2" name="Position" type="text" class="form-control required">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Form wizard with validation card end -->
<!-- Form Basic Wizard card start -->


<div class="card">
    <div class="card-header">
        <h5>Create New Customer</h5>
    </div>
    <div class="card-block">
        <form action="{{route('customer.store')}}" method="post" novalidate="">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Customer Name" value="{{ old('name') }}">
                    <span class="messages popover-valid">
                        @error('name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>



            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber @error('amount') form-control-danger @enderror" name="amount" placeholder="Enter Customer Amount" value="{{ old('amount') }}">
                    <span class="messages popover-valid">
                        @error('amount')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Profit</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber @error('profit') form-control-danger @enderror" name="profit" placeholder="Enter Profit" value="{{ old('profit') }}">
                    <span class="messages popover-valid">
                        @error('profit')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Late Fee</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control autonumber @error('late_fee') form-control-danger @enderror" name="late_fee" placeholder="Enter Late Fee" value="{{ old('late_fee') }}">
                    <span class="messages popover-valid">
                        @error('late_fee')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control today-datepicker @error('start_date') form-control-danger @enderror" name="start_date" placeholder="Enter Customer Start date" value="{{ old('start_date') }}">
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
                    <input autocomplete="off" type="text" class="form-control single-datepicker @error('end_date') form-control-danger @enderror" name="end_date" placeholder="Enter Customer End date" value="{{ old('end_date') }}">
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
                    <textarea rows="5" name="remakrs" class="form-control @error('remarks') form-control-danger @enderror" placeholder="Enter Remarks">{{old('remarks')}}</textarea>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script type="text/javascript" src="{{asset('bower_components\select2\js\select2.full.min.js')}}"></script> --}}

@endsection
