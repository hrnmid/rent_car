@extends('layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
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

@if(Auth::user()->kwc_required == 0)
    <div role="alert" class="alert alert-custom alert-light-danger fade show mb-10">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-3x svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                    </g>
                </svg>
            </span>
        </div>
        <div class="alert-text font-weight-bold">
            Pastikan Anda melakukan Verifikasi KYC sebelum menyewa mobil untuk keamanan akun dan memastikan syarat penggunaan layanan terpenuhi. Setelah verifikasi berhasil, Anda dapat menikmati semua fitur dan layanan kami. Terima kasih. Untuk melakukan verifikasi, kunjungi halaman berikut ini: <a href="/profiled">DISINI</a>.
        </div>
        <div class="alert-close">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@elseif(Auth::user()->kwc_required == 1)
    <div role="alert" class="alert alert-custom alert-light-success fade show mb-10">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-3x svg-icon-success">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                        <path d="M10.3,15.6 C10.1,15.8 9.8,15.9 9.5,15.9 C9.2,15.9 8.9,15.8 8.7,15.6 L6.4,13.3 C5.9,12.9 5.9,12.2 6.4,11.8 C6.9,11.4 7.6,11.4 8,11.9 L9.5,13.4 L14.3,8.6 C14.7,8.2 15.4,8.2 15.8,8.7 C16.2,9.2 16.2,9.9 15.7,10.3 L10.3,15.6 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M10.3,15.6 C10.1,15.8 9.8,15.9 9.5,15.9 C9.2,15.9 8.9,15.8 8.7,15.6 L6.4,13.3 C5.9,12.9 5.9,12.2 6.4,11.8 C6.9,11.4 7.6,11.4 8,11.9 L9.5,13.4 L14.3,8.6 C14.7,8.2 15.4,8.2 15.8,8.7 C16.2,9.2 16.2,9.9 15.7,10.3 L10.3,15.6 Z" fill="#000000"></path>
                    </g>
                </svg>
            </span>
        </div>
        <div class="alert-text font-weight-bold">
            Akun anda telah di verifikasi oleh admin .
        </div>
        <div class="alert-close">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@elseif(Auth::user()->kwc_required == 2)
    <div role="alert" class="alert alert-custom alert-light-info fade show mb-10">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-3x svg-icon-info">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                        <path d="M12,16 L12,12 L13,12 L13,16 L12,16 Z M12,10 L12,8 L12,8 L12,10 Z" fill="#000000"></path>
                        <path d="M12,6 L12,6 L12,6 L12,6 L12,6 Z" fill="#000000"></path>
                    </g>
                </svg>
            </span>
        </div>
        <div class="alert-text font-weight-bold">
            Mohon menunggu verifikasi dari admin.
        </div>
        <div class="alert-close">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@elseif(Auth::user()->kwc_required == 3)
    <div role="alert" class="alert alert-custom alert-light-danger fade show mb-10">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-3x svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                    </g>
                </svg>
            </span>
        </div>
        <div class="alert-text font-weight-bold">
          Maaf, dokumen verifikasi yang Anda unggah tidak memenuhi persyaratan. Silakan unggah ulang untuk proses verifikasi. Kunjungi halaman berikut ini: <a href="/profiled">DISINI</a>.
        </div>
        <div class="alert-close">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
@endif

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            @auth
                @if(Auth::user()->profile_path)
                    <img src="{{ asset(Auth::user()->profile_path) }}" alt="Circle image" width="45" height="45" class="rounded-circle mr-5">
                @else
                    <!-- Icon User Default menggunakan Font Awesome -->
                    <i class="fas fa-user-circle fa-2x mr-4"></i>
                @endif
                <p class="card-label font-weight-normal">
                    {{ auth()->user()->name }} (<span class="font-weight-bold">{{ auth()->user()->unique_id }}</span>)
                </p>
            @endauth
        </div>
        <div class="card-toolbar d-flex justify-content-between align-items-center">
            <div>
                <a href="/booking" class="mr-4">
                    <label class="cursor-pointer" style="font-size: 1.3em;"><i class="flaticon2-add-1"></i> Sewa Mobil</label>
                </a>
                <a href="/mytransaksi" class="">
                    <label class="cursor-pointer" style="font-size: 1.3em;"><i class="flaticon2-mail"></i> Transaksi Saya</label>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="fa fa-list text-primary"></i>
            </span>
            <h3 class="card-label">Transaksi Terbaru</h3>
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
                        {{-- <th>ID</th> --}}
                        <th>Transaksi No</th>
                        <th>Merek</th>
                        <th>Type Mobil</th>
                        <th>Total Harga</th>
                        <th>Customer Name</th>
                        <th>Payment Status</th>
                        <th>Booking Date</th>
                        <th>Payment Mode</th>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
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

    <!-- Modal-->
    <div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

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
                //     data: "id"
                //     , name: "id"
                // }, {
                    data: "transaksi_no"
                    , name: "transaksi_no",
                    render: function(data, type, row) {
                        var linkshow = "{{route('mytransaksi.vdetailcus',':id')}}";
                        linkshow = linkshow.replace(":id", row.id);

                        return '<a href="' + linkshow + '">' + data + '</a>';
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
                }],
             });
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

    </script>
    @endsection
