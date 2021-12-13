<!DOCTYPE html>
<html lang="en">

<head>
    <title>Digital Somitte</title>
    <!-- HTML5 Shim and Respond.js')}} IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">


    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- jquery file upload Frame work -->
    <link href="{{asset('assets/pages/jquery.filer/css/jquery.filer.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}" type="text/css" rel="stylesheet">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/feather/css/feather.css')}}">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{asset('bower_components/select2/css/select2.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}"> --}}
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/multiselect/css/multi-select.css')}}">
    <!--forms-wizard css-->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/jquery.steps/css/jquery.steps.css')}}">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/bootstrap-daterangepicker/css/daterangepicker.css')}}">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/datedropper/css/datedropper.min.css')}}">

    <!-- sweetalert2 Css -->
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}" />

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css')}}">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/form-error.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('bower_components/jquery/js/jquery.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components/select2/js/select2.full.min.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('assets/pages/advance-elements/select2-custom.js')}}"></script> --}}
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('backends.partials.header')

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('backends.partials.sidebar')
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        @include('backends.partials.messages')
                        {{-- @if ($errors->count()>0)
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
                        @endif --}}
                        <!-- Main-body start -->
                        @yield('main-body')
                        @include('backends.partials.style_selector')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script type="text/javascript" src="{{asset('bower_components/popper.js/js/popper.min.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>

<!-- modernizr js -->
<script type="text/javascript" src="{{asset('bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/modernizr/js/css-scrollbars.js')}}"></script>

<!-- jquery file upload js -->
<script src="{{asset('assets/pages/jquery.filer/js/jquery.filer.min.js')}}"></script>
<script src="{{asset('assets/pages/filer/custom-filer.js')}}"></script>
<script src="{{asset('assets/pages/filer/jquery.fileuploads.init.js')}}"></script>

<!-- Masking js -->
<script src="{{asset('assets/pages/form-masking/inputmask.js')}}"></script>
<script src="{{asset('assets/pages/form-masking/jquery.inputmask.js')}}"></script>
<script src="{{asset('assets/pages/form-masking/autoNumeric.js')}}"></script>
<script src="{{asset('assets/pages/form-masking/form-mask.js')}}"></script>

<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="{{asset('assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="{{asset('bower_components/bootstrap-daterangepicker/js/daterangepicker.js')}}"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{asset('bower_components/datedropper/js/datedropper.min.js')}}"></script>

<!-- Accordion js -->
<script type="text/javascript" src="{{asset('assets/pages/accordion/accordion.js')}}"></script>

<!-- data-table js -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/fixed-header/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/colreorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js')}}"></script>
<script src="{{asset('assets/pages/data-table/extensions/fixed-header/js/fixed-header-custom.js')}}"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>

<!-- Select 2 js -->

<!-- Multiselect js -->
<script type="text/javascript" src="{{asset('bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript" src="{{asset('bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.quicksearch.js')}}"></script>

<!--Forms - Wizard js-->
<script src="{{asset('bower_components/jquery.cookie/js/jquery.cookie.js')}}"></script>
<script src="{{asset('bower_components/jquery.steps/js/jquery.steps.js')}}"></script>
<script src="{{asset('bower_components/jquery-validation/js/jquery.validate.js')}}"></script>
<!-- Validation js -->
<script type="text/javascript" src="{{asset('assets/pages/form-validation/validate.js')}}"></script>

<!-- sweetalert2.min.js -->
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>

<!-- Custom js -->
<script src="{{asset('assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/pages/advance-elements/custom-picker.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('assets/js/vartical-layout.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/script.js')}}"></script>




@include('backends.partials.globalJSScript')
</body>

</html>
