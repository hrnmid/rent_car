@extends('layout.main')

@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">My Profile</h5>
                </div>
                <div class="d-flex align-items-center"></div>
            </div>
        </div>
    </div>
</div>
<!--end::Dashboard-->
@endsection

<!--start::Content-->
@section('content')
<div id="kt_content" class="content d-flex flex-column flex-column-fluid">
    <div id="kt_subheader" class="subheader py-2 py-lg-4 subheader-solid transparent border-top">
        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h5 class="text-dark font-weight-bold my-2 mr-5"> User Profile </h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="/" class="subheader-breadcrumbs-home router-link-active"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                    <li class="breadcrumb-item"><span class="text-muted"> Profile Overview </span></li>
                </ul>
            </div>
            <div class="d-flex align-items-center"></div>
        </div>
    </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    <div id="kt_profile_aside" class="col-md-3 col-lg-3 col-sm-12 w-xl-350px">
                        <div class="card card-custom">
                            <div class="card-body pt-15">
                                <div class="text-center mb-10">
                                    <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                        <div class="symbol-label" style="background-image: url('{{ Auth::user()->profile_path }}');"></div>
                                        <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                    </div>
                                    <h4 class="font-weight-bold my-2">{{ Auth::user()->name}}</h4>
                                    <div class="text-muted mb-2"></div>
                                    <span class="label label-light-{{ Auth::user()->kwc_required == 1 ? 'success' : (Auth::user()->kwc_required == 2 ? 'warning' : 'danger') }} label-inline font-weight-bold label-lg">
                                        {{ Auth::user()->kwc_required == 1 ? 'Verified' : (Auth::user()->kwc_required == 2 ? 'Pending' : 'Not Verified') }}
                                    </span>

                                </div>

                                <div role="tablist" class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                    <div class="nav-item mb-2">
                                        <a id="tab-0" data-tab="0" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block active" style="cursor: pointer;"> Profile Overview </a>
                                        <a id="tab-1" data-tab="1" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Personal Info </a>
                                        <a id="tab-2" data-tab="2" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Account Info </a>
                                        <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block " style="cursor: pointer;"> Change Password </a>
                                        <a id="tab-4" data-tab="4" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Verification </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9 col-sm-12 col-lg-9">
                        <div class="tabs hide-tabs" id="__BVID__901">
                            <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                <div class="card card-custom">
                                    <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark"> Profile Overview </h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">Berikut Riwayat aktivitas login akun anda</span>
                                        </div>
                                    </div>

                                    <div class="text-center"> <!-- Tambahkan div untuk rata tengah -->
                                        <table id="list_tbl" class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Login Time</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

<!-- JAVASCRIPT -->
@section('javascript')
<script type="text/javascript">
    var list_tbl;

    function initData() {
        list_tbl = $("#list_tbl").DataTable({
            responsive: true,
            bAutoWidth: true,
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            searchClasses: false,
            sortClasses: false,
            processing: true,
            serverSide: true,
            paging: false, // Menonaktifkan navigasi halaman
            info: false, // Menonaktifkan informasi jumlah entri
            ajax: {
                type: "GET",
                url: "profile/vload",
                data: function (d) {
                    d.search = $("#f_search").val();
                    d._token = "{{ csrf_token() }}";
                }
            },
            initComplete: function (settings, json) {
                var info = json.info;
                setfunction();
            },
            columns: [{
                data: "created_at",
                name: "created_at"
            }, {
                data: "user_id",
                name: "user_id"
            }],
            order: [
                [0, 'desc']
            ]
        });
    }

    function setfunction() {
        $(".delete_link").click(function (e) {
            e.preventDefault();
            var linkdelete = $(this).attr("href");
            var id = $(this).attr("data-id");
            // alert(id);
            //var id   = linkdelete.attr('href').replace(/^.*?id=/,''); 
            Swal.fire({
                title: "Are you sure?"
                , text: "You wont be able to revert this!"
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: linkdelete
                        , type: 'post'
                        , data: {
                            id: id
                        }
                        , success: function (data) {
                            console.log(data);
                            if (data['success']) {
                                list_tbl.ajax.reload(function (json) {
                                    setfunction();
                                });

                                Swal.fire(
                                    "Deleted!"
                                    , "Your file has been deleted."
                                    , "success"
                                )
                            }
                        }
                        , error: function (e) {
                            Swal.fire(
                                "Error!"
                                , "Something went wrong."
                                , "danger"
                            )
                        }
                    });

                }
            });
        });

        $(".edit_link").click(function (e) {
            e.preventDefault();
            $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
        });

        $(".add_link").click(function (e) {
            e.preventDefault();
            $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
        });
    }

    $(document).ready(function () {
        initData();
    });

    $("#search-frm").on("submit", function (e) {
        e.preventDefault();

        list_tbl.ajax.reload(function (json) {
            setfunction();
        });
    });

    // Fungsi untuk menangani klik pada tombol
    function handleTabClick(event) {
        // Mendapatkan ID tombol yang diklik
        var tabId = event.target.getAttribute("id");
        // Mendapatkan angka dari ID tombol (mis. "tab-1" menjadi 1)
        var tabNumber = parseInt(tabId.split("-")[1]);
        // Mendapatkan nama tab berdasarkan angka (mis. "tab-1" menjadi "Personal Info")
        var tabName = "tab-" + tabNumber;

        // Menyimpan lokasi URL yang sesuai dengan nama tab (mis. "/personalinfo")
        var tabUrlMap = {
            "tab-0": "/profile",
            "tab-1": "/profilec",
            "tab-2": "/profilea",
            "tab-3": "/profileb",
            "tab-4": "/profiled"
        };

        // Mendapatkan URL sesuai dengan nama tab
        var tabUrl = tabUrlMap[tabName];

        // Mengarahkan pengguna ke URL yang sesuai
        window.location.href = tabUrl;
    }

    // Mendapatkan semua tombol tab
    var tabButtons = document.querySelectorAll("[data-tab]");

    // Menambahkan event click listener ke setiap tombol tab
    tabButtons.forEach(function (button) {
        button.addEventListener("click", handleTabClick);
    });
</script>
@endsection
