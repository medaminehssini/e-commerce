
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
                <h2 class="content-header-title float-left mb-0">{{__('commande.breadcrumb_1')}}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">{{__('commande.breadcrumb_2')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{__('commande.breadcrumb_3')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('commande.breadcrumb_1')}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="content-body">
    <!-- Data list view starts -->
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">

            </div>
        </div>
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>{{__('commande.th_1')}}</th>
                        <th>{{__('commande.th_2')}}</th>
                        <th>{{__('commande.th_3')}}</th>
                        <th>{{__('commande.th_4')}}</th>
                        <th>{{__('commande.th_5')}}</th>
                        <th>{{__('commande.th_6')}}</th>
                        <th>{{__('commande.th_7')}}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- dataTable ends -->




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

    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

    <script>

$(document).ready(function() {
          // init thumb view datatable
          var templates = Handlebars.compile($("#details-templates").html());

  var table = $(".data-thumb-view").DataTable({
    responsive: true,
    ajax: "{{aurl('commande/list/dataTables')}}",
    columns: [


        {data: 'id', name: 'id' , className: "product-img details-control"},
        {data:'client.username', name: 'client.username' , className: "product-name details-control"},
        {data:'total', name: 'total' , className: "product-name details-control"},
        {data:'description', name: 'description' , className: "product-name details-control"},
        {data:'coupon.code', "defaultContent": ' ' , name: 'coupon.code' , className: "product-name details-control" },

        {data:'status', name: 'status' , className: "product-name details-control"},
        {data: 'action'   , name: 'action' , className: "product-action"}
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

    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }



  })

  $('.data-thumb-view tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(templates(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

  function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{aurl('get/liste/item')}}/"+data.id,
            columns: [
                { data: 'id', name: 'id'  ,  className: "product-img"},
                { data: 'photo', name: 'photo' ,  className: "product-img"},
                { data: 'libelle', name: 'libelle' },
                { data: 'prix', name: 'prix' },
                { data: 'pivot.qty', name: 'pivot.qty' },
            ]
        })
    }

        });
    </script>


<script    id="details-templates" type="text/x-handlebars-template">
    <div style="padding-top: 10px;padding-left: 10px; ">
        <div  class="label label-info">liste des articles
        </div>
     </div>
     <table  class="table details-table" id="posts-@{{id}}">
         <thead>
         <tr>
            <th>{{__('commande.th_01')}}</th>
            <th>{{__('commande.th_02')}}</th>
            <th>{{__('commande.th_03')}}</th>
            <th>{{__('commande.th_04')}}</th>
            <th>{{__('commande.th_05')}}</th>
         </tr>
         </thead>
     </table>
 </script>


@endpush
