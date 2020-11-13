
@extends('admin.index')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ url('') }}/app-assets/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/app-assets/css/plugins/forms/validation/form-validation.css">

@endpush
@section('content')





<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{__('profile.breadcrumb_1')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{__('profile.breadcrumb_2')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{__('profile.breadcrumb_3')}}</a>
                        </li>
                        <li class="breadcrumb-item active"> {{__('profile.breadcrumb_1')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
            </div>
        </div>
    </div> --}}
</div>
<div class="content-body">
    <!-- account setting page start -->
    <section id="page-account-settings">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style-type: none">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">

            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            {{__('profile.menu_1')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            {{__('profile.menu_2')}}
                        </a>
                    </li>

                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <form method="POST" action="{{ aurl('edit/profile', []) }}" enctype="multipart/form-data">

                                    <div class="media">
                                        <a href="javascript: void(0);">
                                            @if (Auth::guard('admin')->user()->image)
                                             <img src="{{ url('') }}/{{Auth::guard('admin')->user()->image}}" class="rounded mr-75" alt="profile image" height="64" width="64">

                                            @else
                                             <img src="{{ url('') }}/app-assets/images/portrait/small/avatar-s-11.jpg" class="rounded mr-75" alt="profile image" height="64" width="64">

                                            @endif
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">{{__('profile.btn_4')}}</label>
                                                <input type="file" id="account-upload" name="image" hidden>
                                                <button class="btn btn-sm btn-outline-warning ml-50">{{__('profile.btn_5')}}</button>
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>{{__('profile.img')}}</small></p>
                                        </div>
                                    </div>
                                    <hr>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-username">{{__('profile.form_1')}}</label>
                                                        <input type="text" name="username" class="form-control" id="account-username" placeholder="Username" value="{{Auth::guard('admin')->user()->username}}" required data-validation-required-message="This username field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">{{__('profile.form_2')}}</label>
                                                        <input type="text" class="form-control" id="account-name" placeholder="Name" value="{{Auth::guard('admin')->user()->first_name}}" required name="first_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">{{__('profile.form_3')}}</label>
                                                        <input type="text" class="form-control" id="account-name" placeholder="Name"  value="{{Auth::guard('admin')->user()->last_name}}" required name="last_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-e-mail">{{__('profile.form_4')}}</label>
                                                        <input type="email" disabled class="form-control" id="account-e-mail" placeholder="Email" value="{{Auth::guard('admin')->user()->email}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <p class="mb-0">
                                                        Your email is not confirmed. Please check your inbox.
                                                    </p>
                                                    <a href="javascript: void(0);">Resend confirmation</a>
                                                </div>
                                            </div> --}}

                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{__('profile.btn_2')}}</button>
                                                <button type="reset" class="btn btn-outline-warning">{{__('profile.btn_3')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <form method="POST"  action="{{ aurl('edit/profile/password') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">{{__('profile.form_5')}}</label>
                                                        <input type="password" name="current_password" class="form-control" id="account-old-password" required placeholder="{{__('profile.ph_5')}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">{{__('profile.form_6')}}</label>
                                                        <input type="password" name="password" id="account-new-password" class="form-control" placeholder="{{__('profile.ph_6')}}" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">{{__('profile.form_7')}}</label>
                                                        <input type="password" name="confirmation_password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="{{__('profile.ph_7')}}" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{__('profile.btn_2')}}</button>
                                                <button type="reset" class="btn btn-outline-warning">{{__('profile.btn_3')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->

</div>









@endsection




@push('scripts')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ url('') }}/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="{{ url('') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ url('') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ url('') }}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{ url('') }}/app-assets/js/scripts/pages/account-setting.js"></script>
    <!-- END: Page JS-->
@endpush
