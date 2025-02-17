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
                    <li class="breadcrumb-item"><span class="text-muted"> Personal Information </span></li>
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
                                    <a id="tab-1" data-tab="1" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block active" style="cursor: pointer;"> Personal Info </a>
                                    <a id="tab-2" data-tab="2" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Account Info </a>
                                    <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Change Password </a>
                                    <a id="tab-4" data-tab="4" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Verification </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-lg-9">
                    <form id="kt_info" method="POST" class="form fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="tabs hide-tabs" id="__BVID__901">
                            <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                    <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                    <div class="card card-custom">
                                        <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                                                <span class="text-muted font-weight-bold font-size-sm mt-1">Perbarui informasi pribadi Anda</span>
                                            </div>
                                            
                                        </div>
                                                                    
                                                                        
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                <h5 class="font-weight-bold mt-2 mb-6">Profile Info</h5>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Avatar</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div id="kt_profile_avatar" class="image-input image-input-outline">
                                                        <div class="image-input-wrapper" style="background-image: url('{{ Auth::user()->profile_path ?? asset('path/to/placeholder-image.jpg') }}');"></div>
                                                        <label data-action="change" data-toggle="tooltip" title="Change avatar" class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="profile_path" accept=".png, .jpg, .jpeg .pdf" onchange="loadPreview(this)">
                                                            <input type="hidden" name="profile_path">
                                                        </label>
                                                        <span data-action="remove" data-toggle="tooltip" title="Remove avatar" class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" onclick="removeProfilePath()">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>

                                                    </div>
                                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">First Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="text" name='name' class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Last Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="text" name='last_name' class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->last_name }}">
                                                </div>
                                            </div>
                        
                                            <div class="row justify-content-center">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h5 class="font-weight-bold mt-2 mb-6">Contact Info</h5>
                                                </div>
                                            </div>
                        
                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Contact Phone</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="la la-phone"></i></span>
                                                        </div>
                                                        <input type="text"  name='phone' class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->phone }}">

                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Email</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="la la-envelope"></i></span>
                                                        </div>
                                                        <input type="text"  name='email' class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->email }}">

                                                    </div>
                                                    <span class="form-text text-muted">Kami tidak akan pernah membagikan email Anda kepada orang lain.</span>
                                                </div>
                                            </div>
                        
                                            <div class="form-group row justify-content-center">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Address</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="la la-map-marker-alt"></i></span>
                                                        </div>
                                                        <input type="text"  name='address' class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->address }}">

                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-footer text-right">
                                             <button type="submit" id="saveChangesBtn" class="btn btn-success mr-2">Simpan Perubahan</button>
                                             <button type="reset" class="btn btn-secondary">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal-->
    <div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
    
@endsection
<!-- Modal untuk pemberitahuan -->
<style>
#dataerror,
#datasucces {
    display: none;
}
    
</style>
<div class="modal fade" id="dataerror" tabindex="-1" role="dialog" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordErrorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data cannot be input.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="datasucces" tabindex="-1" role="dialog" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordErrorModalLabel">Succes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               Data Succesfully Changed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="avatarRemovedModal" tabindex="-1" role="dialog" aria-labelledby="avatarRemovedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatarRemovedModalLabel">Avatar Removed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your avatar has been successfully removed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- JAVASCRIPT -->
@section('javascript')
<!-- Modal untuk pemberitahuan -->


<script>
    // Fungsi untuk menangani klik pada tombol
    function handleTabClick(event) {
            var tabId = event.target.getAttribute("id");
            var tabNumber = parseInt(tabId.split("-")[1]);
            var tabName = "tab-" + tabNumber;
            var tabUrlMap = {
                "tab-0": "/profile",
                "tab-1": "/profilec",
                "tab-2": "/profilea",
                "tab-3": "/profileb",
                "tab-4": "/profiled"
            };
            var tabUrl = tabUrlMap[tabName];
            window.location.href = tabUrl;
        }

        var tabButtons = document.querySelectorAll("[data-tab]");
        tabButtons.forEach(function(button) {
            button.addEventListener("click", handleTabClick);
        });
        function loadPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#kt_profile_avatar .image-input-wrapper').css('background-image', 'url(' + e.target.result + ')');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/profile/vupdatePersonalInfo',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response.message);
                showDataSuccessModal(); // Tampilkan modal jika sukses
                $('#datasucces').modal('show'); // Tampilkan modal untuk data yang berhasil terganti
                
            },
            error: function (error) {
                // Handle errors, e.g., show an error modal
                console.error(error.responseJSON.message);
                showDataErrorModal();
                showAlert('error', error.responseJSON.message);
            }
        });
    });
    function showDataSuccessModal() {
        $('#datasucces').modal('show'); // Tampilkan modal untuk data yang berhasil terganti
    }
    $('#datasucces').on('hidden.bs.modal', function () {
            // Me-refresh halaman saat modal ditutup
            window.location.reload();
        });
     function removeProfilePath() {
        $.ajax({
            url: '/remove-avatar', // Ganti dengan URL yang sesuai
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // Handle success
                $('#avatarRemovedModal').modal('show'); // Membuka modal
                // Jika ingin melakukan tindakan lain, seperti memperbarui tampilan, Anda bisa menambahkan kode di sini
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                alert('Failed to remove avatar. Please try again.');
            }
        });
    }
    $('#avatarRemovedModal').on('hidden.bs.modal', function () {
        // Me-refresh halaman saat modal ditutup
        window.location.reload();
    });
</script>


@endsection
