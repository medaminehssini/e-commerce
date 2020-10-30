
@extends('admin.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/tables/ag-grid/ag-grid.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/tables/ag-grid/ag-theme-material.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/app-user.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/aggrid.css">
    <!-- END: Page CSS-->
@endpush
@section('content')






<div class="content-header row">
</div>
<div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
        <!-- users filter start -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Filters</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                        <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="users-list-filter">
                        <form>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-role">Role</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-role">
                                            <option value="">All</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="employe">Employer</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-status">Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-status">
                                            <option value="">All</option>
                                            <option value="Active">Active</option>
                                            <option value="Blocked">Blocked</option>
                                            <option value="notconfirmed">not confirmed</option>
                                            <option value="Deactivated">Deactivated</option>
                                        </select>
                                    </fieldset>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- users filter end -->
        <!-- Ag Grid users list section start -->
        <div id="basic-examples">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                                    <div class="dropdown sort-dropdown mb-1 mb-sm-0">

                                    </div>
                                    <div class="ag-btns d-flex flex-wrap">
                                        <input type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" style="width: 100% !important" id="filter-text-box" placeholder="Search...." />

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="myGrid" class="aggrid ag-theme-material"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ag Grid users list section end -->
    </section>
    <!-- users list ends -->

</div>









@endsection




@push('scripts')




    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('' ) }}/app-assets/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js"></script>
    <!-- END: Page Vendor JS-->


    <script>
        $(document).ready(function () {

            var isRtl;
            if ( $('html').attr('data-textdirection') == 'rtl' ) {
            isRtl = true;
            } else {
            isRtl = false;
            }

            //  Rendering badge in status column
            var customBadgeHTML = function (params) {
            var color = "";
            if (params.value == "Active") {
                color = "success"
                return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
            } else if (params.value == "Blocked") {
                color = "danger";
                return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
            } else if (params.value == "Deactivated") {
                color = "warning";
                return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
            }
            else if (params.value == "notconfirmed") {
                color = "warning";
                return "<div class='badge badge-pill badge-light-" + color + "' >Not Confirmed</div>"
            }
            }

            //  Rendering bullet in verified column
            var customBulletHTML = function (params) {
            var color = "";
            if (params.value == true) {
                color = "success"
                return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
            } else if (params.value == false) {
                color = "secondary";
                return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
            }
            }

            // Renering Icons in Actions column
            var customIconsHTML = function (params) {
            var usersIcons = document.createElement("span");
            var editIconHTML = "<a href='app-user-edit.html'><i class= 'users-edit-icon feather icon-edit-1 mr-50'></i></a>"
            var deleteIconHTML = document.createElement('i');
            var attr = document.createAttribute("class")
            attr.value = "users-delete-icon feather icon-trash-2"
            deleteIconHTML.setAttributeNode(attr);
            // selected row delete functionality
            deleteIconHTML.addEventListener("click", function () {
                deleteArr = [
                params.data
                ];
                // var selectedData = gridOptions.api.getSelectedRows();

                $.ajax( "{{aurl('delete/user/')}}/"+params.data.id+"?role="+ params.data.role )
                .done(function() {
                    gridOptions.api.updateRowData({
                    remove: deleteArr
                    });

                })
                .fail(function() {
                    alert( "error" );
                })

            });
            usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
            usersIcons.appendChild(deleteIconHTML);
            return usersIcons
            }

            //  Rendering avatar in username column
            var customAvatarHTML = function (params) {
            return "<span class='avatar'><img src='{{url('')}}/" +  params.data.image + "' height='32' width='32'></span>" + params.value
            }

            //  Rendering avatar in username column
            var customNameHTML = function (params) {
                return params.data.first_name + " " +  params.data.last_name;
            }

            // ag-grid
            /*** COLUMN DEFINE ***/

            var columnDefs =
            [
                {
                    headerName: 'ID',
                    field: 'id',
                    width: 60,
                    filter: true,

                },
                {
                    headerName: 'Username',
                    field: 'username',
                    filter: true,
                    width: 175,
                    cellRenderer: customAvatarHTML,
                },
                {
                    headerName: 'Email',
                    field: 'email',
                    filter: true,
                    width: 225,
                },
                {
                    headerName: 'Name',
                    field: 'name',
                    filter: true,
                    width: 200,
                    cellRenderer: customNameHTML
                },
                {
                    headerName: 'Ville',
                    field: 'ville',
                    filter: true,
                    width: 100,
                },
                {
                    headerName: 'Adresse',
                    field: 'adresse',
                    filter: true,
                    width: 205,
                },
                {
                    headerName: 'Code Postale',
                    field: 'code_postale',
                    filter: true,
                    width: 100,
                },
                {
                    headerName: 'Telephone',
                    field: 'tel',
                    filter: true,
                    width: 150,
                },
                {
                    headerName: 'Role',
                    field: 'role',
                    filter: true,
                    width: 100,
                },
                {
                    headerName: 'Status',
                    field: 'status',
                    filter: true,
                    width: 150,
                    cellRenderer: customBadgeHTML,
                    cellStyle: {
                    "text-align": "center"
                    }
                },

                {
                    headerName: 'Actions',
                    field: 'transactions',
                    width: 150,
                    cellRenderer: customIconsHTML,
                }
            ];

            /*** GRID OPTIONS ***/
            var gridOptions = {
            defaultColDef: {
                sortable: true
            },
            enableRtl: isRtl,
            columnDefs: columnDefs,
            rowSelection: "multiple",
            floatingFilter: true,
            filter: true,
            pagination: true,
            paginationPageSize: 20,
            pivotPanelShow: "always",
            colResizeDefault: "shift",
            animateRows: true,
            resizable: true
            };
            if (document.getElementById("myGrid")) {
            /*** DEFINED TABLE VARIABLE ***/
            var gridTable = document.getElementById("myGrid");

            /*** GET TABLE DATA FROM URL ***/
            agGrid.simpleHttpRequest({
                url: "{{aurl('user/list/dataTables')}}"
                })
                .then(function (data) {
                    console.log(data);
                gridOptions.api.setRowData(data);
                });

            /*** FILTER TABLE ***/
            function updateSearchQuery(val) {
                gridOptions.api.setQuickFilter(val);
            }

            $(".ag-grid-filter").on("keyup", function () {
                updateSearchQuery($(this).val());
            });

            /*** CHANGE DATA PER PAGE ***/
            function changePageSize(value) {
                gridOptions.api.paginationSetPageSize(Number(value));
            }

            $(".sort-dropdown .dropdown-item").on("click", function () {
                var $this = $(this);
                changePageSize($this.text());
                $(".filter-btn").text("1 - " + $this.text() + " of 50");
            });

            /*** EXPORT AS CSV BTN ***/
            $(".ag-grid-export-btn").on("click", function (params) {
                gridOptions.api.exportDataAsCsv();
            });

            //  filter data function
            var filterData = function agSetColumnFilter(column, val) {
                var filter = gridOptions.api.getFilterInstance(column)
                var modelObj = null
                if (val !== "all") {
                modelObj = {
                    type: "equals",
                    filter: val
                }
                }
                filter.setModel(modelObj)
                gridOptions.api.onFilterChanged()
            }
            //  filter inside role
            $("#users-list-role").on("change", function () {
                var usersListRole = $("#users-list-role").val();
                filterData("role", usersListRole)
            });
            //  filter inside verified
            $("#users-list-verified").on("change", function () {
                var usersListVerified = $("#users-list-verified").val();
                filterData("is_verified", usersListVerified)
            });
            //  filter inside status
            $("#users-list-status").on("change", function () {
                var usersListStatus = $("#users-list-status").val();
                filterData("status", usersListStatus)
            });
            //  filter inside department
            $("#users-list-department").on("change", function () {
                var usersListDepartment = $("#users-list-department").val();
                filterData("department", usersListDepartment)
            });
            // filter reset
            $(".users-data-filter").click(function () {
                $('#users-list-role').prop('selectedIndex', 0);
                $('#users-list-role').change();
                $('#users-list-status').prop('selectedIndex', 0);
                $('#users-list-status').change();
                $('#users-list-verified').prop('selectedIndex', 0);
                $('#users-list-verified').change();
                $('#users-list-department').prop('selectedIndex', 0);
                $('#users-list-department').change();
            });

            /*** INIT TABLE ***/
            new agGrid.Grid(gridTable, gridOptions);
            }
            // users language select
            if ($("#users-language-select2").length > 0) {
            $("#users-language-select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            }
            // users music select
            if ($("#users-music-select2").length > 0) {
            $("#users-music-select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            }
            // users movies select
            if ($("#users-movies-select2").length > 0) {
            $("#users-movies-select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            }
            // users birthdate date
            if ($(".birthdate-picker").length > 0) {
            $('.birthdate-picker').pickadate({
                format: 'mmmm, d, yyyy'
            });
            }
            // Input, Select, Textarea validations except submit button validation initialization
            if ($(".users-edit").length > 0) {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
            }
        });
    </script>


@endpush
