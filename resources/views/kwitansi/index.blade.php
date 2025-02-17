<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="fa fa-list text-primary"></i>
            </span>
            <h3 class="card-label">History Payment</h3>
        </div>

        <div class="card-toolbar">
            <!--begin::Dropdown-->

            <!--end::Dropdown-->
            <!--begin::Button-->

            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">

        <form id="search-frm">

            <div class="mb-1 row">

                <div class="col-lg-8 col-xs-8 row">

                </div>

                <div class="col-lg-4 col-xs-4 row">
                    <div class="col-lg-8 col-xs-8">
                        <div class="input-icon">
                            <input type="search" id="f_search" class="form-control" placeholder="Search..." />
                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-4 ml-0">
                        <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table id="list_tbl_receipt" class="table display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Receipt.No</th>
                        <th>Payment Method</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <!--JAVASCRIPT -->
    @section('javascript')
    <script type="text/javascript">
        var list_tbl_receipt;

        function initData() {
            list_tbl_receipt = $("#list_tbl_receipt").DataTable({
                // responsive: true,
                // scrollX: true,
                // bAutoWidth: true,
                // Pagination settings
                dom: `<'row'<'col-sm-12'tr>>
  	<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10
                    // language: {
                    //   lengthMenu: "Display _MENU_",
                    // },
                    ,
                searchClasses: false,
                sortClasses: false,
                processing: true,
                serverSide: true,
                ajax: {
                    type: "GET",
                    url: "{{route('receipt.vload')}}",
                    data: function(d) {
                        d.search = $("#f_search").val();
                        d.pre_alert_id = $("#pre_alert_id").val();
                        d._token = "{{ csrf_token() }}";
                    },
                },
                initComplete: function(settings, json) {
                    var info = json.info;
                    //setfunction();
                },
                columns: [{
                    data: "receipt_id",
                    name: "receipt_id"
                }, {
                    data: "receipt_no",
                    name: "receipt_no",
                    render: function(data, type, row) {
                        return row.receipt_no;
                    }
                }, {
                        data: "receipt_status",
                        name: "receipt_status",
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<span class="badge badge-pill badge-info">Success</span>';
                            } else {
                                return '<span class="badge badge-pill badge-warning text-white">Failed</span>';
                            }
                        }
                    } ],
                columnDefs: [
{
                        targets: 0
                        , title: "Actions"
                        , className: "text-center"
                        , orderable: false
                        , render: function(data, type, full, meta) {
                            var linkedit = "{{route('prealert.vedit',':id')}}";
                            linkedit = linkedit.replace(":id", data);

                            var linkdelete = "{{route('prealert.vdestroy',':id')}}";
                            linkdelete = linkdelete.replace(":id", data);
                            var link = "";
                            link += "<div class ='dropdown dropdown-inline'>";
                            link += "<a href='javascript:;' class='btn btn-icon btn-light btn-hover-primary btn-md' data-toggle='dropdown'><i class='fa fa-list'></i></a>";
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
                ],
            });
        }



        function setfunction() {
            $(".delete_link").click(function(e) {
                e.preventDefault();
                var linkdelete = $(this).attr("href");
                var id = $(this).attr("data-id");
                alert(id);
                //var id   = linkdelete.attr('href').replace(/^.*?id=/,''); 
                Swal.fire({
                    title: "Are you sure?",
                    text: "You wont be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: linkdelete,
                            type: 'post',
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                if (data['success']) {
                                    list_tbl.ajax.reload(function(json) {
                                        setfunction();
                                    });

                                    Swal.fire(
                                        "Deleted!", "Your file has been deleted.", "success"
                                    )
                                }
                            },
                            error: function(e) {
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

            list_tbl_receipt.ajax.reload(function(json) {
                setfunction();
            });
        });
    </script>
    @endsection