
@extends('admin.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">

    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/data-list-view.css">
@endpush
@section('content')






<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{__('article.breadcrumb_1')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{__('article.breadcrumb_2')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{__('article.breadcrumb_3')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('article.breadcrumb_1')}}
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
    <!-- Data list view starts -->
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">
                <div class="btn-group dropdown actions-dropodown">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>{{__('article.act_1')}}</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>{{__('article.act_2')}}</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-file"></i>{{__('article.act_3')}}</a>
                        <a class="dropdown-item" href="#"><i class="feather icon-save"></i>{{__('article.act_4')}}</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>{{__('article.th_1')}}</th>
                        <th>{{__('article.th_2')}}</th>
                        <th>{{__('article.th_3')}}</th>
                        <th>{{__('article.th_4')}}</th>
                        <th>{{__('article.th_5')}}</th>
                        <th>{{__('article.th_6')}}</th>
                        <th>{{__('article.th_7')}}</th>
                        <th>{{__('article.th_8')}}</th>
                        <th>{{__('article.th_9')}}</th>
                        <th>{{__('article.th_10')}}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- dataTable ends -->

        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <form id="edit" action="{{aurl('add/article')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                <div id="add-new-data" class="add-new-data" >

                    <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                        <div>
                            <h4 class="text-uppercase">{{__('article.form_h')}}</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>



                        <div class="data-items pb-3">
                            <div class="data-fields px-2 mt-3">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <div class="row">

                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">{{__('article.form_1')}}</label>
                                        <input type="text" class="form-control" name="libelle" id="data-name">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-category"> {{__('article.form_2')}} </label>
                                        <select name="categorie" class="form-control" id="data-category">
                                                @foreach ($categories as $categorie)
                                                    <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-category"> {{__('article.form_3')}} </label>
                                        <select name="marque" class="form-control" id="data-marque">
                                                @foreach ($marques as $marque)
                                                    <option value="{{$marque->id}}">{{$marque->libelle}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-status">{{__('article.form_4')}}</label>
                                        <select name="status" class="form-control" id="data-status">
                                            <option value="0">{{__('article.opt_1')}}</option>
                                            <option value="3">{{__('article.opt_2')}}</option>
                                            <option value="1">{{__('article.opt_3')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">{{__('article.form_5')}}</label>
                                        <input type="number" name="prix" class="form-control" id="data-price">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">{{__('article.form_6')}}</label>
                                        <input type="number" name="qty" class="form-control" id="data-qty">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">{{__('article.form_7')}}</label>
                                        <input type="number" name="taux_tva" class="form-control" id="data-tva">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">{{__('article.form_8')}}</label>
                                        <textarea name="description" id="data-description" class="form-control" cols="30" rows="10"></textarea>

                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-price">{{__('article.form_9')}}</label>
                                        <input multiple type="file" name="images[]" accept="image/*" class="form-control" id="data-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <input class="btn btn-primary" name="btnsub"  onclick="document.getElementById('edit').submit()" type="submit" value="{{__('article.form_4')}}">

                            </div>
                            <div class="cancel-data-btn">
                                <button class="btn btn-outline-danger" type="reset">{{__('article.btn_3')}}</button>
                            </div>
                        </div>




                </div>
            </form>
        </div>
        <!-- add new sidebar ends -->


    </section>
    <!-- Data list view end -->

</div>









@endsection




@push('scripts')



    <!-- BEGIN: Page Vendor JS-->
    <script src="{{url('')}}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->



    <!-- BEGIN: Page JS-->
    <script src="{{url('')}}/app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->
    @if ( $errors->any() )
        <script>
            $( document ).ready(function() {
            document.getElementsByClassName('btnAjout')[0].click();
            });
        </script>
    @endif

    <script>

          // init thumb view datatable
  var dataThumbView = $(".data-thumb-view").DataTable({
    responsive: true,
    ajax: "{{aurl('article/list/dataTables')}}",
    columns: [

        {data: 'photo', name: 'photo' , className: "product-img"},
        {data:'libelle', name: 'libelle' , className: "product-name"},
        {data: 'categorie.nom', name: 'categorie.nom' , className: "product-category"},
        {data: 'marque.libelle', name: 'categorie.libelle' , className: "product-category"},
        {data: 'description', name: 'description' },
        {data: 'statusDetails', name: 'statusDetails' },
        {data: 'prix', name: 'prix' , className: "product-price"},
        {data: 'qty', name: 'qty' , className: "product-price"},
        {data: 'taux_tva', name: 'taux_tva' , className: "product-price"},
        {data: 'action', name: 'action' , className: "product-action"}
    ],
    columnDefs: [

    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
    buttons: [
      {
        text: "<i class='feather icon-plus'></i> {{__('article.btn_1')}}",
        action: function() {
          $(this).removeClass("btn-secondary")
          editForm = document.getElementById('edit');
          editForm.action = "{{aurl('add/article')}}";
          editForm.description.value = "";
          editForm.prix.value = "";
          editForm.categorie.value = "";
          editForm.libelle.value = "";
          editForm.btnsub.value = "{{__('article.btn_2')}}";
          editForm.status.value = "";
          editForm.marque.value = "";
          editForm.qty.value = "";
          editForm.taux_tva.value = "";
          $("#add-new-data").addClass("show")

          $(".overlay-bg").addClass("show")
        },
        className: "btn-outline-primary btnAjout"
      }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  })




  function openUpdate (data)  {
    editForm = document.getElementById('edit');


    editForm.action = "{{aurl('edit/article')}}/"+data.id;
    editForm.description.value = data.description;
    editForm.prix.value = data.prix;
    editForm.categorie.value = data.id_categorie;
    editForm.libelle.value = data.libelle;
    editForm.status.value = data.status;
    editForm.marque.value = data.id_marque;
    editForm.qty.value = data.qty;
    editForm.taux_tva.value = data.taux_tva;
    editForm.btnsub.value = "Edit Article";
    $("#add-new-data").addClass("show")
    $(".overlay-bg").addClass("show")

  }
    </script>
@endpush
