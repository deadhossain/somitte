@if ($errors->count()>0)
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger border-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled"></i>
                    </button>
                    <strong>Error!</strong> {{$error}}
                </div>
            @endforeach
        </div>
    </div>
@endif
@if (session('message'))
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="alert alert-success border-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <strong>Success!</strong> {{ session('message') }}
            </div>
        </div>
    </div>
@endif
{{-- @if (\Session::has('error-dev') && !empty(session('user')) && session('user')->id==1)
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="alert alert-danger border-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <strong>Error!</strong> {!! \Session::get('error-dev') !!}
            </div>
        </div>
    </div>
@endif

@if (\Session::has('error'))
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="alert alert-danger border-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <strong>Error!</strong> {!! \Session::get('error') !!}
            </div>
        </div>
    </div>
@endif

@if (\Session::has('message'))
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="alert alert-success border-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                {!! \Session::get('message') !!}
            </div>
        </div>
    </div>
@endif --}}
