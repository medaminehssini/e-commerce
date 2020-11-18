
@extends('admin.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/plugins/file-uploaders/dropzone.css">
@endpush
@section('content')


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{__('params.breadcrumb_1')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{__('params.breadcrumb_2')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{__('params.breadcrumb_3')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('params.breadcrumb_1')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="content-body">


                <!-- Tooltip validations start -->
                <section class="tooltip-validations" >
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <style>
                                            .col-12 {
                                                margin-bottom: 20px;
                                            }
                                            .col-12 label {
                                                text-transform: uppercase;
                                                padding: 5px 0;
                                            }
                                        </style>
                                        <form  method="POST" >
                                            @csrf
                                            <div class="form-row">


                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="Name">{{__('params.form_1')}}</label>
                                                    <input type="text" class="form-control" id="Name" name="name" placeholder="{{__('params.form_1')}}" value="{{getSetting('name')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="phone">{{__('params.form_2')}} </label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="{{__('params.form_2')}}" value="{{getSetting('phone')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="mail">{{__('params.form_3')}}</label>
                                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="{{__('params.form_3')}}" value="{{getSetting('mail')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="currency">{{__('params.form_4')}}</label>
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="{{__('params.form_4')}}" value="{{getSetting('currency')}}" >
                                                </div>
                                                <div class="col-md-12 col-12 mb-12">
                                                    <label for="adresse">{{__('params.form_5')}}  </label>
                                                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="{{__('params.form_5')}}" value="{{getSetting('adresse')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="facebook">{{__('params.form_6')}}</label>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="{{__('params.form_6')}}" value="{{getSetting('facebook')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="twitter">{{__('params.form_7')}}</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="{{__('params.form_7')}}" value="{{getSetting('twitter')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="googleplus">{{__('params.form_8')}}</label>
                                                    <input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="{{__('params.form_8')}}" value="{{getSetting('googleplus')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="instagrame">{{__('params.form_9')}}</label>
                                                    <input type="text" class="form-control" id="instagrame" name="instagrame" placeholder="{{__('params.form_9')}}" value="{{getSetting('instagrame')}}" >
                                                </div>
                                                <div class="col-md-12 col-12 mb-12">
                                                    <label for="youtube">{{__('params.form_10')}}</label>
                                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="{{__('params.form_10')}}" value="{{getSetting('youtube')}}" >
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{__('params.btn')}}</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Tooltip validations end -->
</div>



@endsection




@push('scripts')




@endpush
