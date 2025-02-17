

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div id="kt_profile_aside" class="col-md-3 col-lg-3 col-sm-12 w-xl-350px">
                    <div class="card card-custom">
                        <div class="card-body pt-15">
                            <div class="text-center mb-10">
                                <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                <div class="symbol-label" style="background-image: url('{{ Auth::user()->photo_path ?? asset('path_to_default_photo.jpg') }}');"></div>
                                    <i class="symbol-badge symbol-badge-bottom bg-success">aaa</i>
                                </div>
                                <h4 class="font-weight-bold my-2">{{ Auth::user()->name}}</h4>
                                <div class="text-muted mb-2"></div>
                                <span class="label label-light-{{ Auth::user()->is_verified ? 'success' : 'danger' }} label-inline font-weight-bold label-lg">
                             {{ Auth::user()->is_verified ? 'Verified' : 'Not Verified' }}</span>
                            </div>
                            <div role="tablist" class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                <div class="nav-item mb-2">
                                    <a id="tab-0" data-tab="0" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Overview </a>
                                    <a id="tab-1" data-tab="1" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Personal Info </a>
                                    <a id="tab-2" data-tab="2" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Account Info </a>
                                    <a id="tab-3" data-tab="3" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Change Password </a>
                                    <a id="tab-4" data-tab="4" data-toggle="tab" role="tab" class="btn btn-hover-light-primary font-weight-bold py-3 px-6 mb-2 text-center btn-block" style="cursor: pointer;"> Profile Verification </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-12 col-lg-9">
                    <div class="tabs hide-tabs" id="__BVID__901">
                        <div>
                            <ul role="tablist" class="nav nav-tabs" id="__BVID__901__BV_tab_controls_">
                                <li role="presentation" class="nav-item"><a role="tab" tabindex="-1" aria-selected="false" aria-setsize="5" aria-posinset="1"  href="/profile" target="_self" class="nav-link" id="__BVID__902___BV_tab_button__" aria-controls="__BVID__902">Profile Overview</a></li>
                                <li role="presentation" class="nav-item"><a role="tab" tabindex="-1" aria-selected="false" aria-setsize="5" aria-posinset="2" href="/profview" target="_self" class="nav-link" id="__BVID__905___BV_tab_button__" aria-controls="__BVID__905">Personal Info</a></li>
                                <li role="presentation" class="nav-item"><a role="tab" tabindex="-1" aria-selected="true" aria-setsize="5" aria-posinset="3" href="/accountinfo" target="_self" class="nav-link" id="__BVID__908___BV_tab_button__" aria-controls="__BVID__908">Account Info</a></li>
                                <li role="presentation" class="nav-item"><a role="tab" tabindex="-1" aria-selected="false" aria-setsize="5" aria-posinset="4" href="/changepass" target="_self" class="nav-link" id="__BVID__911___BV_tab_button__" aria-controls="__BVID__911">Change Password</a></li>
                                <li role="presentation" class="nav-item"><a role="tab" tabindex="-1" aria-selected="false" aria-setsize="5" aria-posinset="5" href="/profilverif" target="_self" class="nav-link" id="__BVID__914___BV_tab_button__" aria-controls="__BVID__914">Profile Verification</a></li>
                            </ul>
                        </div>
                        <div class="tab-content" id="__BVID__901__BV_tab_container_">
                            <!-- ... Konten tab Profile Overview, Personal Info, Account Info, Change Password, Profile Verification ... -->
                          

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
    // Mendapatkan nama tab berdasarkan angka (mis. "tab-1" menjadi "tab_1")
    var tabName = "tab_" + tabNumber;

    // Menyimpan lokasi URL yang sesuai dengan nama tab (mis. "/personalinfo")
    var tabUrlMap = {
        "tab_0": "/profile",
        "tab_1": "/profview",
        "tab_2": "/accountinfo",
        "tab_3": "/changepass",
        "tab_4": "/profilverif"
    };

    // Menghapus kelas "active" dari semua tombol navigasi
    var navTabs = document.querySelectorAll(".nav-tabs .nav-item");
    navTabs.forEach(function(navTab) {
        navTab.classList.remove("active");
    });

    // Menambahkan kelas "active" ke tombol navigasi yang sesuai dengan tombol yang diklik
    var activeNavTab = document.querySelector('[href="' + tabUrlMap[tabName] + '"]');
    activeNavTab.closest(".nav-item").classList.add("active");

    // Menghapus kelas "active" dari semua tombol tab
    tabButtons.forEach(function(button) {
        button.classList.remove("active");
        button.classList.remove("btn-block");
    });

    // Menambahkan kelas "active" ke tombol yang diklik
    event.target.classList.add("active");
    event.target.classList.add("btn-block");

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

</script>

@endsection
