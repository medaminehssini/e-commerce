
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
                <h2 class="content-header-title float-left mb-0">Contact et Réclamation</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Accueill</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Liste des réclamations</a>
                        </li>
                        <li class="breadcrumb-item active">Contact et Réclamation
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
                                                    <label for="Name">Site Name</label>
                                                    <input type="text" class="form-control" id="Name" name="name" placeholder="Site Name" value="{{getSetting('name')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="phone">phone </label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{getSetting('phone')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="mail">mail</label>
                                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="mail" value="{{getSetting('mail')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="currency">currency</label>
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="currency" value="{{getSetting('currency')}}" >
                                                </div>
                                                <div class="col-md-12 col-12 mb-12">
                                                    <label for="adresse">adresse  </label>
                                                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="" value="{{getSetting('adresse')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="facebook">facebook</label>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="facebook" value="{{getSetting('facebook')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="twitter">twitter</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="twitter" value="{{getSetting('twitter')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="googleplus">googleplus</label>
                                                    <input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="googleplus" value="{{getSetting('googleplus')}}" >
                                                </div>
                                                <div class="col-md-6 col-12 mb-6">
                                                    <label for="instagrame">instagrame</label>
                                                    <input type="text" class="form-control" id="instagrame" name="instagrame" placeholder="instagrame" value="{{getSetting('instagrame')}}" >
                                                </div>
                                                <div class="col-md-12 col-12 mb-12">
                                                    <label for="youtube">youtube</label>
                                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="youtube" value="{{getSetting('youtube')}}" >
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Update Setting</button>
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
