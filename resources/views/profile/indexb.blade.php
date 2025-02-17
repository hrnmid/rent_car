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

<!--start::Content-->
@section('content')
<div id="kt_content" class="content d-flex flex-column flex-column-fluid">
    <div id="kt_subheader" class="subheader py-2 py-lg-4 subheader-solid transparent border-top">
        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <h5 class="text-dark font-weight-bold my-2 mr-5"> User Profile </h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="/" class="subheader-breadcrumbs-home router-link-active"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                    <li class="breadcrumb-item"><span class="text-muted"> Change Password </span></li>
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
                                    <a id="tab-2" data-tab="2" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Account Info </a>
                                    <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block active" style="cursor: pointer;"> Change Password </a>
                                    <a id="tab-4" data-tab="4" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Verification </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-lg-9">
                    <form id="kt_password_change_form" method="POST" class="form fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate">
                        {{ csrf_field() }}
                        <div class="tabs hide-tabs" id="__BVID__901">
                            <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                    <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                    <div class="card card-custom">
                                        <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                                <span class="text-muted font-weight-bold font-size-sm mt-1">Ubah kata sandi akun Anda</span>
                                            </div>
                                            {{-- <div class="card-toolbar">
                                                <button type="submit" class="btn btn-success mr-2"> Save Changes </button>
                                                <button type="reset" class="btn btn-secondary"> Cancel </button>
                                            </div> --}}
                                        </div>
                                        <div class="card-body">
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
                                                    Pastikan kata sandi yang Anda pilih cukup kuat. Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk meningkatkan keamanan akun Anda.
                                                </div>
                                                <div class="alert-close">
                                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Kata sandi Lama</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group">
                                                        <input type="password" value="" placeholder="Kata sandi Lama" name="old_password" class="form-control form-control-lg form-control-solid">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-eye toggle-password" style="cursor: pointer;"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    {{-- <a href="#" class="col-xl-3 text-sm font-weight-bold">Forgot password?</a> --}}
                                                    {{-- <div class="fv-plugins-message-container"></div> --}}
                                                </div>
                                            </div>
                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Kata sandi Baru</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group">
                                                        <input type="password" value="" placeholder="Kata sandi Baru" name="new_password" class="form-control form-control-lg form-control-solid">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-eye toggle-password" style="cursor: pointer;"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Konfirmasi Kata sandi</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group">
                                                        <input type="password" value="" placeholder="Konfirmasi Kata sandi" name="verify_password" class="form-control form-control-lg form-control-solid">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-eye toggle-password" style="cursor: pointer;"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="fv-plugins-message-container"></div>
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

    <!-- Modal untuk pemberitahuan -->
    <div class="modal fade" id="passwordErrorModal" tabindex="-1" role="dialog" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordErrorModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Kata sandi lama salah. Silakan coba lagi.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="datasucces" tabindex="-1" role="dialog" aria-labelledby="datasuccesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datasuccesLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Kata sandi berhasil diubah.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="emptyFieldsModal" tabindex="-1" role="dialog" aria-labelledby="emptyFieldsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emptyFieldsModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Silakan isi semua kolom pada formulir di bawah ini.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('javascript')
<script>
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

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form field values
        var oldPassword = document.querySelector('input[name="old_password"]').value.trim();
        var newPassword = document.querySelector('input[name="new_password"]').value.trim();
        var verifyPassword = document.querySelector('input[name="verify_password"]').value.trim();

        // Check if any field is empty
        if (oldPassword === "" || newPassword === "" || verifyPassword === "") {
            // Show error modal for empty fields
            $('#emptyFieldsModal').modal('show');
            return; // Prevent form submission
        }

        // Create FormData object
        var formData = new FormData(this);

        $.ajax({
            url: '/profile/vupdatepass',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#datasucces').modal('show');
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    $('#passwordErrorModal').modal('show');
                } else {
                    showAlert('error', 'An error occurred while updating the password.');
                }
            }
        });
    });

    // Function to show alert
    function showAlert(type, message) {
        var alertClass = (type === 'success') ? 'alert-success' : 'alert-danger';
        var alert = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
            '<strong>' + message + '</strong>' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>';
        $('#alerts-container').html(alert);
    }

    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function() {
            let input = this.closest('.input-group').querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
</script>
@endsection