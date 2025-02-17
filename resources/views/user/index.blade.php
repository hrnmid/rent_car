@extends('layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Users</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
    </div>
</div>

<!--end::Dashboard-->
@endsection
<!--start::Content-->
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="fa fa-list text-primary"></i>
            </span>
            <h3 class="card-label">List Users</h3>
        </div>

        <div class="card-toolbar">
            <!--begin::Dropdown-->
            
            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="{{ route('user.vcreate') }}" class="add_link btn btn-primary font-weight-bolder">
                <i class="fa fa-plus"></i>
                New Record
            </a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">

        <form id="search-frm">
            <div class="row">
                <div class="col-lg-9 col-xs-9 row">
                    <!-- Isi kolom 9 (atau sesuaikan kebutuhan) di sini -->
                </div>
                <div class="input-group col-lg-3 col-xs-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #fff;"><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                    <input type="search" id="f_search" class="form-control" placeholder="Search..." />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="table-responsive">
            <table id="list_tbl" class="table table-separate table-head-custom table-checkable dataTable no-footer" style="width:100%;min-height:50px">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Role</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
</div>
@endsection
    <!--JAVASCRIPT -->
    @section('javascript')
    <script type="text/javascript">
        var list_tbl;
       
        function initData() {
            list_tbl = $("#list_tbl").DataTable({
                scrollX: true
                , autoWidth: false
                , bAutoWidth: false
                , scrollCollapse: true
                    //  , scrollY: 300
                , dom: `<'row'<'col-sm-12'tr>>
  	                    <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                lengthMenu: [5, 10, 25, 50]
                , pageLength: 10
                    // language: {
                    //   lengthMenu: "Display _MENU_",
                    // },
                    //, searchClasses: false
                    //, sortClasses: false
                , processing: true
                , serverSide: true
                , ajax: {
                    type: "GET"
                    , url: "user/vloadd"
                    , data: function(d) {
                        d.search = $("#f_search").val();
                        d._token = "{{ csrf_token() }}";
                    }
                , }
                , initComplete: function(settings, json) {
                    var info = json.info;
                    setfunction();
                }
                , columns: [{
                    data: "id"
                    , name: "id"
                }, {
                    data: "first_name"
                    , name: "first_name"
                }, {
                    data: "email"
                    , name: "email"
                }, {
                    data: "branch_id"
                    , name: "branch_id"
                }, {
                    data: "role",
                    name: "role",
                    render: function (data, type, row) {
                        if (data == 1) {
                            return 'Branch Manager';
                        } else if (data == 2) {
                            return 'Staff';
                        } else {
                            return 'Unknown Role';
                        }
                    }
                }]
                , columnDefs: [{
                        targets: 0
                        , title: "Actions"
                        , className: "text"
                        , orderable: false
                        , render: function(data, type, full, meta) {
                            var linkedit = "{{route('user.vedit',':id')}}";
                            linkedit = linkedit.replace(":id", data);

                            var linkdelete = "{{route('user.vdestroy',':id')}}";
                            linkdelete = linkdelete.replace(":id", data);
                            var link = "";
                            link += "<div class ='dropdown dropdown-inline'>";
                            link += "<a href='javascript:;' class='btn btn-icon btn-light btn-hover-primary btn-md' data-toggle='dropdown'><i class='la la-cog'></i></a>";
                            link += "<div class = 'dropdown-menu dropdown-menu-sm dropdown-menu-right'>";
                            link += "<ul class='nav nav-hoverable flex-column'>";
                            link += "<li class='nav-item'><a class='edit_link nav-link' href='" + linkedit + "' data-id='" + data + "'><i class='nav-icon la la-edit'></i><span class='nav-text'>Edit</span></a></li>";
                            link += "<li class='nav-item'><a class='delete_link nav-link' href='" + linkdelete + "' data-id='" + data + "'><i class='nav-icon la la-remove'></i><span class='nav-text'>Delete</span></a></li>";
                            link += "</ul>";
                            link += "</div>";
                            link += "</div>";
                            return link;
                        }
                    }

                ]
            , });
        }



        function setfunction() {
            $(".delete_link").click(function(e) {
                e.preventDefault();
                var linkdelete = $(this).attr("href");
                var id = $(this).attr("data-id");
                //  alert(id);
                //var id   = linkdelete.attr('href').replace(/^.*?id=/,''); 
                Swal.fire({
                    title: "Are you sure?"
                    , text: "You wont be able to revert this!"
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: linkdelete
                            , type: 'post'
                            , data: {
                                id: id
                            }
                            , success: function(data) {
                                console.log(data);
                                if (data['success']) {
                                    list_tbl.ajax.reload(function(json) {
                                        setfunction();
                                    });

                                    Swal.fire(
                                        "Deleted!", "Your file has been deleted.", "success"
                                    )
                                }
                            }
                            , error: function(e) {
                                Swal.fire(
                                    "Error!", "Something went wrong.", "danger"
                                )
                            }
                        });

                    }
                });
            });

            $(".edit_link").click(function(e) {
                e.preventDefault();
                $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
            });

            $(".add_link").click(function(e) {
                e.preventDefault();
                $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
            });
        }

        $(document).ready(function() {
            initData();
        });

        $("#search-frm").on("submit", function(e) {
            e.preventDefault();

            list_tbl.ajax.reload(function(json) {
                setfunction();
            });
        });

        $( document ).ajaxComplete(function() {
            setfunction();
        }); 
    </script>
    @endsection
