@extends('layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Transaksi</h5>
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
            <h3 class="card-label">List Transaksi</h3>
        </div>

        <div class="card-toolbar">
            <!--begin::Dropdown-->
            
            <!--end::Dropdown-->
            <!--begin::Button-->
            {{-- <a href="{{ route('transaksi.vcreate') }}" class="add_link btn btn-primary font-weight-bolder">
                <i class="fa fa-plus"></i>
                New Record
            </a> --}}
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
                        <th>Transaksi No</th>
                        <th>Merek</th>
                        <th>Type Mobil</th>
                        <th>Total Harga</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor Telepon Pelanggan</th>
                        <th>Email Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Mode Pembayaran</th>
                        <th>Nomor Invoice</th>
                        <th>Tanggal Invoice</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
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
                    , url: "mytransaksi/vloadcus"
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
                    data: "transaksi_no",
                    name: "transaksi_no",
                    render: function(data, type, row) {
                        var linkshow = "{{ route('mytransaksi.vdetailcus', ':id') }}";
                        linkshow = linkshow.replace(":id", row.id);

                        return '<strong>' + data + '</strong> <a href="' + linkshow + '" class="btn btn-outline-primary btn-sm py-0 px-1">Lihat Detail</a>';
                    }
                }, {
                    data: "mobil_merek"
                    , name: "mobil_merek"
                }, {
                    data: "mobil_type"
                    , name: "mobil_type"
                }, {
                    data: "total_biaya"
                    , name: "total_biaya"
                }, {
                    data: "customer_name"
                    , name: "customer_name"
                }, {
                    data: "customer_phone"
                    , name: "customer_phone"
                }, {
                    data: "customer_email"
                    , name: "customer_email"
                }, {
                    data: "customer_address"
                    , name: "customer_address"
                }, {
                    data: "payment_status",
                    name: "payment_status",
                    render: function(data, type, row) {
                        var badgeClass = "";
                        var statusText = "";
                        
                        // Tentukan kelas dan teks badge berdasarkan nilai payment_status
                        switch (data) {
                            case 0:
                                badgeClass = "badge-danger";
                                statusText = "Menunggu Pembayaran";
                                break;
                            case 1:
                                badgeClass = "badge-warning";
                                statusText = "Menunggu Pelunasan";
                                break;
                            case 2:
                                badgeClass = "badge-info";
                                statusText = "Menunggu Konfirmasi";
                                break;
                            case 3:
                                badgeClass = "badge-success";
                                statusText = "Transaksi berhasil";
                                break;
                            default:
                                badgeClass = "badge-secondary";
                                statusText = "Status tidak valid";
                        }
                        
                        // Kembalikan HTML untuk badge dengan kelas dan teks yang sesuai
                        return "<span class='badge badge-pill " + badgeClass + "'>" + statusText + "</span>";
                    }
                }, {
                    data: "booking_date"
                    , name: "booking_date"
                }, {
                    data: "payment_mode"
                    , name: "payment_mode"
                }, {
                    data: "invoice_no"
                    , name: "invoice_no"
                }, {
                    data: "invoice_date"
                    , name: "invoice_date"
                }]
                , columnDefs: [{
                        targets: 0
                        , title: "Actions"
                        , className: "text-center"
                        , orderable: false
                        , render: function(data, type, full, meta) {
                            // var linkedit = "{{route('transaksi.vedit',':id')}}";
                            // linkedit = linkedit.replace(":id", data);

                            // var linkdelete = "{{route('transaksi.vdestroy',':id')}}";
                            // linkdelete = linkdelete.replace(":id", data);

                            var linkprint = "{{route('invoices.rental',':id')}}";
                            linkprint = linkprint.replace(":id", data);

                            var linkpay = "{{route('transaksi.vbayar',':id')}}";
                            linkpay = linkpay.replace(":id", data);
                            var link = "";
                            link += "<div class ='dropdown dropdown-inline'>";
                            link += "<a href='javascript:;' class='btn btn-icon btn-light btn-hover-primary btn-md' data-toggle='dropdown'><i class='la la-cog'></i></a>";
                            link += "<div class = 'dropdown-menu dropdown-menu-sm dropdown-menu-right'>";
                            link += "<ul class='nav nav-hoverable flex-column'>";
                            // link += "<li class='nav-item'><a class='edit_link nav-link' href='" + linkedit + "' data-id='" + data + "'><i class='nav-icon la la-edit'></i><span class='nav-text'>Edit</span></a></li>";
                            // link += "<li class='nav-item'><a class='delete_link nav-link' href='" + linkdelete + "' data-id='" + data + "'><i class='nav-icon la la-remove'></i><span class='nav-text'>Delete</span></a></li>";
                            link += "<li class='nav-item'><a class='print_link nav-link' href='" + linkprint + "' data-id='" + data + "'><i class='nav-icon la la-print'></i><span class='nav-text'>Print Invoice</span></a></li>";
                            
                            // Check statusbayar, if Unpaid then show pay_link
                            if (full.payment_status !== 2) {
                                link += "<li class='nav-item'><a class='pay_link nav-link' href='" + linkpay + "' data-id='" + data + "'><i class='nav-icon la la-credit-card'></i><span class='nav-text'>Bayar Sekarang</span></a></li>";
                            }

                            
                            // link += "<li class='nav-item'><a class='pay_link nav-link' href='" + linkpay + "' data-id='" + data + "'><i class='nav-icon la la-credit-card'></i><span class='nav-text'>Bayar Sekarang</span></a></li>";
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
            $(".pay_link").click(function(e) {
                e.preventDefault();
                $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
            });
            
            $(".print_link").click(function(e) {
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
