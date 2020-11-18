
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
                <h2 class="content-header-title float-left mb-0">{{__('contact.breadcrumb_1')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{__('contact.breadcrumb_2')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{__('contact.breadcrumb_4')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('contact.breadcrumb_1')}}
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
                                        <form  method="POST" >
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="longitude">{{__('contact.form_1')}}</label>
                                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude" value="{{getSetting('longitude')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="latitude">{{__('contact.form_2')}}</label>
                                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="" value="{{getSetting('latitude')}}" >
                                                </div>
                                                <div class="col-md-12 col-12 mb-12" style="margin: 20px 0;">
                                                        <label for="label-textarea">{{__('contact.form_3')}}</label>

                                                    <textarea class="form-control" id="label-textarea" rows="3" name="description" placeholder="Description">{{getSetting('contact_description')}}</textarea>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{__('contact.btn')}}</button>
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
