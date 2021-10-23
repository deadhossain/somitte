@extends('backends.pages.main')
@section('main-body')
{{-- @include('backends.partials.messages') --}}
<!-- Tooltip Validation card start -->
<div class="card">
    <div class="card-header">
        <h5>Register New User</h5>
    </div>
    <div class="card-block">
        <form id="second" action="{{route('user.store')}}" method="post" novalidate="">
            @csrf
            <div class="form-group row @error('name') has-error @enderror">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="name" placeholder="Enter Username" value="{{ old('name') }}">
                    <span class="messages popover-valid">
                        @error('name')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('email') has-error @enderror">
                <label class="col-sm-2 col-form-label">Email-id</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="email" placeholder="Enter email id" value="{{ old('email') }}">
                    <span class="messages popover-valid">
                        @error('email')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('password') has-error @enderror">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="password" class="form-control" name="password" placeholder="Password input">
                    <span class="messages popover-valid">
                        @error('password')
                            <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                        @enderror
                    </span>
                </div>
            </div>

            <div class="form-group row @error('confirm_password') has-error @enderror">
                <label class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input autocomplete="off" type="password" class="form-control" name="confirm_password" placeholder="Password input">
                    <span class="messages popover-valid">
                        @error('confirm_password')
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
