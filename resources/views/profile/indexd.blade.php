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
                    <li class="breadcrumb-item"><span class="text-muted"> Profile Vertification </span></li>
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
                                    <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Change Password </a>
                                    <a id="tab-4" data-tab="4" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block active" style="cursor: pointer;"> Profile Verification </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-lg-9">
                <form id="verif_file" method="POST" class="form fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="tabs hide-tabs" id="__BVID__901">
                            <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                <div class="tab-content" id="__BVID__901__BV_tab_container_">
                                    <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                                    <div class="card card-custom">
                                        <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">Profile Vertification</h3>
                                                <span class="text-muted font-weight-bold font-size-sm mt-1">Upload Your Doucument</span>
                                            </div>
                                            
                                        </div>
                                        <div class="card-body">
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
                                                        Pastikan Anda melakukan Verifikasi KYC sebelum menyewa mobil untuk keamanan akun dan memastikan syarat penggunaan layanan terpenuhi. Setelah verifikasi berhasil, Anda dapat menikmati semua fitur dan layanan kami. Terima kasih.
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
                                                      Maaf, dokumen verifikasi yang Anda unggah tidak memenuhi persyaratan. Silakan unggah ulang untuk proses verifikasi.
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

                                            @if (Auth::user()->kwc_required == 1)
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 col-md-8 col-sm-12">
                                                        <div class="text-center">
                                                            <div>
                                                                <h4 class="card-text">Tipe Dokumen : {{ Auth::user()->identity_type }}</h4>
                                                                <img src="{{ Auth::user()->verif_path }}" class="card-img-top img-fluid" style="max-height: 300px; max-width: 100%;" alt="KYC Verification Document">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <h4 class="font-weight-bold mb-6">Upload KYC Documents</h4>
                                                        <p>Anda diharuskan mengunggah salah satu dari 2 dokumen di bawah ini untuk verifikasi akun Anda.
                                                            <ul class="ml-6">
                                                                <li>Kartu Tanda Penduduk (KTP)</li>
                                                                <li>Surat Izin Mengemudi (SIM)</li>
                                                            </ul>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Select Document Type</label>
                                                            <select class="form-control" name="identity_type">
                                                                <option value="KTP" selected="selected">Kartu Tanda Penduduk (KTP)</option>
                                                                <option value="SIM">Surat Izin Mengemudi (SIM)</option>
                                                                {{-- <option value="Others">Others</option> --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">KYC Documents KTP / SIM (JPG, PNG, and JPEG)</label>
                                                            <input type="file" accept=".jpg, .png, .gif, .pdf" name="verif_file" class="form-control form-control-file" id="__BVID__119">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if (Auth::user()->kwc_required != 1)
                                            <div class="card-footer text-right">
                                                <button type="submit" id="saveChangesBtn" class="btn btn-success mr-2">Simpan Perubahan</button>
                                                <button type="reset" class="btn btn-secondary">Batalkan</button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
</div>
@endsection
<!-- Modal untuk pemberitahuan -->
<style>
#passwordErrorModal,
#datasucces {
    display: none;
}
    
</style>
<!-- Alert data -->
<div class="modal fade" id="passwordErrorModal" tabindex="-1" role="dialog" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordErrorModalLabel">PERINGATAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              Dokumen KYC Diperlukan. Silakan coba lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="datasucces" tabindex="-1" role="dialog" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordErrorModalLabel">SUKSES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               Pengiriman Dokumen Berhasil
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End alert data -->

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
    
   // Function to show the success modal
function showDataSuccessModal() {
    $('#datasucces').modal('show');
}

// Function to show the password error modal
function showPasswordErrorModal() {
    $('#passwordErrorModal').modal('show');
}

// Event listener for form submission
$('form#verif_file').submit(function (event) {
    event.preventDefault();

    // Get the file input
    var fileInput = $('input[name="verif_file"]')[0];

    // Check if a file is chosen
    if (!fileInput.files.length) {
        showPasswordErrorModal();
        return;
    }

    // Create a FormData object to send the file
    var formData = new FormData($(this)[0]);

    // Make the AJAX request to the Laravel controller
    $.ajax({
        url: '/profile/vuploadverification',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response.message);
            showDataSuccessModal();
            // You may want to perform additional actions upon success
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.error(xhr.responseText);
        }
    });
});

// Event listener untuk menutup modal
$('#datasucces').on('hidden.bs.modal', function (e) {
    // Refresh halaman saat modal ditutup
    location.reload();
});


</script>


@endsection
