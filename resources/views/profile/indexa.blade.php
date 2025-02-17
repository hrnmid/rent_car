@extends('layout.main')

@section('subheader')
    <!--begin::Dashboard-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <h5 class="text-dark font-weight-bold my-2 mr-5">Dashboard</h5>
                    </div>
                    <div class="d-flex align-items-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div id="kt_content" class="content d-flex flex-column flex-column-fluid">
    <div id="kt_subheader" class="subheader py-2 py-lg-4 subheader-solid transparent border-top">
        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h5 class="text-dark font-weight-bold my-2 mr-5"> User Profile </h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="/" class="subheader-breadcrumbs-home router-link-active"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                    <li class="breadcrumb-item"><span class="text-muted"> Account Information </span></li>
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
                                            <a id="tab-0" data-tab="0" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Overview </a>
                                            <a id="tab-1" data-tab="1" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Personal Info </a>
                                            <a id="tab-2" data-tab="2" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block active" style="cursor: pointer;"> Account Info </a>
                                            <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Change Password </a>
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
                                        <h3 class="card-label font-weight-bolder text-dark"> Account Information </h3>
                                        <span class="text-muted font-weight-bold font-size-sm mt-1">Berikut status akun Anda</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="row justify-content-center">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h5 class="font-weight-bold mb-6">Account</h5>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center align-items-center">
                                            <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Status Akun</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="checkbox-inline">
                                                    <label class="checkbox">
                                                        <input type="checkbox" {{ Auth::user()->email ? 'checked' : '' }} disabled="disabled">
                                                        <span></span> Email
                                                    </label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" {{ Auth::user()->phone ? 'checked' : '' }} disabled="disabled">
                                                        <span></span> Phone
                                                    </label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" {{ Auth::user()->address ? 'checked' : '' }} disabled="disabled">
                                                        <span></span> Address
                                                    </label>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row justify-content-center">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h5 class="font-weight-bold mb-6">Security</h5>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Deactivate</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <button id="deactivateButton" type="button" class="btn btn-light-danger font-weight-bold btn-sm"> Non-aktifkan akunmu ? </button>
                                            </div>
                                        </div>
                                    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Tindakan ini memerlukan langkah lebih lanjut atau persetujuan dari admin. Silakan hubungi admin untuk bantuan.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    tabButtons.forEach(function(button) {
        button.addEventListener("click", handleTabClick);
    });
    
     document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("deactivateButton").addEventListener("click", function() {
            $('#confirmationModal').modal('show');
        });
    });
</script>

@endsection
