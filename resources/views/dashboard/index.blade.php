@extends('layout.main') @section('subheader')
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
<div>
    <div class="row">
        <div class="col-xxl-4">
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <div class="card-header border-0 bg-danger py-5">
                        <h3 class="card-title font-weight-bolder text-white">Statistik Penyewaan</h3>
                        {{-- <div class="card-toolbar">
                            <div class="dropdown">
                                <button aria-haspopup="true" aria-expanded="false" type="button" class="btn dropdown-toggle btn-primary btn-sm btn btn-transparent-white btn-sm font-weight-bolder px-5" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                    <div class="navi navi-hover min-w-md-200px">
                                        <li role="presentation" class="navi-header pb-1">
                                            <div class="b-dropdown-text">
                                                <span class="text-primary text-uppercase font-weight-bold"> Add new: </span>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-graph-1"></i></span>
                                                    <span class="navi-text"> Order </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-calendar-4"></i></span>
                                                    <span class="navi-text"> Event </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-layers-1"></i></span>
                                                    <span class="navi-text"> Report </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-calendar-4"></i></span>
                                                    <span class="navi-text"> Post </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="flaticon2-file-1"></i></span>
                                                    <span class="navi-text"> File </span>
                                                </a>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div> --}}
                        
                    </div>
                    <div class="card-body p-0 position-relative overflow-hidden">
						<div class="card-rounded-bottom bg-danger" style="height: 185px">
						<div id="kt_mixed_widget_1_chart1"></div>
                        </div>
                            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                            <?php
                                // Contoh skrip untuk mengambil data dari model Transaksi dan mengelompokkannya berdasarkan bulan

                                use App\Models\Transaksi;
                                use Carbon\Carbon;

                                // Mendapatkan rentang bulan dari Januari sampai Desember
                                $months = collect(Carbon::now()->subYear()->startOfYear()->monthsUntil(Carbon::now()->startOfYear()));

                                // Inisialisasi array untuk menyimpan data per bulan
                                $dataPerMonth = [];

                                // Loop melalui setiap bulan
                                foreach ($months as $key => $month) {
                                    // Mendapatkan nomor bulan (1-12)
                                    $monthNumber = $month->format('n');

                                    // Inisialisasi jumlah data untuk bulan ini
                                    $dataPerMonth[$monthNumber] = 0;
                                }

                                // Mengambil semua data dari tabel Transaksi
                                $tranSaksi = Transaksi::all();

                                // Loop melalui setiap entri Transaksi
                                foreach ($tranSaksi as $transaksi) {
                                    // Mendapatkan bulan dari tanggal Transaksi
                                    $monthNumber = date('n', strtotime($transaksi->created_at));

                                    // Menambahkan jumlah data ke array sesuai bulan
                                    if (isset($dataPerMonth[$monthNumber])) {
                                        $dataPerMonth[$monthNumber]++;
                                    }
                                }

                                // Membuat array untuk data dalam format yang dibutuhkan oleh grafik ApexCharts
                                $data = array_values($dataPerMonth);
                            ?>

                            <script>
                                    // Membuat variabel untuk menyimpan data yang diambil dari PHP
                                var dataFromPHP = <?php echo json_encode($data); ?>;

                                // Creating the chart with the data from PHP
                                var chart = new ApexCharts(document.querySelector("#kt_mixed_widget_1_chart1"), {
                                    series: [{
                                        name: 'Jumlah Transaksi',
                                        data: dataFromPHP // Menggunakan data dari PHP
                                    }],
                                    chart: {
                                        type: 'line',
                                        height: 200,
                                        animations: {
                                            enabled: true // Disable animations for smoother hiding
                                        },
                                        toolbar: {
                                            show: false // Hide toolbar menu
                                        },
                                        zoom: {
                                            enabled: false // Disable zoom
                                        },
                                        pan: {
                                            enabled: false // Disable pan
                                        }
                                    },
                                    stroke: {
                                        width: 3,
                                        curve: 'smooth',
                                        colors: ['#d13547'] // Warna kurva
                                    },
                                    xaxis: {
                                        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], // Labels bulan
                                        labels: {
                                            show: false // Hide x-axis labels
                                        },
                                        axisBorder: {
                                            show: false // Hide x-axis border
                                        }
                                    },
                                    yaxis: {
                                        show: false // Sembunyikan sumbu y
                                    },
                                    grid: {
                                        show: false, // Hide grid lines
                                        yaxis: {
                                            lines: {
                                                show: false // Hide y-axis grid lines
                                            }
                                        }
                                    }
                                });

                                // Rendering the chart
                                chart.render();
                            </script>
                        
                        <div class="card-spacer mt-n10">
                            <div class="row m-0">
                                <!-- Add other columns as needed -->
                                <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                                    @php
                                        $currentWeekSalesTotal = DB::table('transaksis')
                                            ->where('transaksis.is_active', 1)
                                            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
                                            ->sum('transaksis.total_biaya');
                                        
                                        $formattedCurrentWeekSalesTotal = 'Rp. ' . number_format($currentWeekSalesTotal, 2, ',', '.');
                                    @endphp

                                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                        {{ $formattedCurrentWeekSalesTotal }}
                                    </span>
                                    <a class="text-warning font-weight-bold font-size-h6">Transaksi Mingguan</a>
                                </div>


                                <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                                    @php
                                        $currentMonth = now()->format('m'); 
                                        $newUsersCount = \App\Models\User::where('is_active', 1)
                                                                        ->whereMonth('created_at', $currentMonth)
                                                                        ->count();
                                    @endphp
                                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <title>Stockholm-icons / Communication / Add-user</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                        <span class="ml-3 text-primary font-weight-bold font-size-h5">{{ $newUsersCount }}</span>
                                    </span>
                                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                                        Pengguna Baru
                                    </a>
                                </div>

                            </div>
                            <div class="row m-0">

                                <div class="col bg-light-success px-6 py-8 rounded-xl mr-7">
                                    @php
                                    $activeCarsCount = \App\Models\Mobil::where('status', 1)->count();
                                    @endphp
                                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <title>Stockholm-icons / Design / Layers</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <span class="ml-3 text-success font-weight-bold font-size-h5">{{ $activeCarsCount }}</span>
                                    </span>
                                    <a href="#" class="text-success font-weight-bold font-size-h6 mt-2">
                                        Mobil di-sewakan
                                    </a>
                                </div>
                                <div class="col bg-light-info px-6 py-8 rounded-xl">
                                    @php
                                    $inactiveCarsCount = \App\Models\Mobil::where('status', 2)->count();
                                    @endphp
                                    <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <title>Stockholm-icons / Design / Layers</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <span class="ml-3 text-info font-weight-bold font-size-h5">{{ $inactiveCarsCount }}</span>
                                    </span>
                                    <a href="#" class="text-info font-weight-bold font-size-h6 mt-2">
                                        Mobil sedang di-sewa 
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
        </div>


        <div class="col-xxl-4">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">Ringkasan Sewa</h3>
                    <div class="card-toolbar">
                        <div class="dropdown b-dropdown btn-group" id="__BVID__68">
                        </div>
                    </div>
                    {{-- <div class="card-toolbar">
                            <div class="dropdown">
                                <button aria-haspopup="menu" aria-expanded="false" type="button" class=" btn-link btn-sm custom-v-dropdown btn btn-clean btn-hover-light-primary btn-sm btn-icon dropdown-toggle-no-caret" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ki ki-bold-more-hor"></i>
                                </button>

                                <ul role="menu" tabindex="-1" class="dropdown-menu dropdown-menu-right" aria-labelledby="__BVID__68__BV_toggle_" style="">
                                    <div class="navi navi-hover min-w-md-250px">
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-group"></i>
                                                    </span>
                                                    <span class="navi-text">New Group</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-open-text-book"></i>
                                                    </span>
                                                    <span class="navi-text">Contacts</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-rocket-1"></i>
                                                    </span>
                                                    <span class="navi-text">Groups</span>
                                                    <span class="navi-link-badge">
                                                        <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Calls</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-dashboard"></i>
                                                    </span>
                                                    <span class="navi-text">Settings</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-separator my-3">
                                            <div class="b-dropdown-text"></div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-protected"></i>
                                                    </span>
                                                    <span class="navi-text">Help</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li role="presentation" class="navi-item">
                                            <div class="b-dropdown-text">
                                                <a class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Privacy</span>
                                                    <span class="navi-link-badge">
                                                        <span class="label label-light-danger label-rounded font-weight-bold"> 5 </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div> --}}
                </div>
                <div class="card-body pt-2">
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-primary">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    <svg version="1.1" viewBox="0 0 24 24" height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title>Stockholm-icons / Communication / Write</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g id="Stockholm-icons-/-Communication-/-Write" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                            </path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                        </div>

                        <div class="d-flex flex-column font-weight-bold">
                            @php
                                $today = now()->format('Y-m-d');
                                $todaySalesTotal = DB::table('transaksis')
                                    ->where('transaksis.is_active', 1)
                                    ->whereDate('transaksis.created_at', $today)
                                    ->sum('transaksis.total_biaya');
                                    $formattedCurrenttodaySalesTotal = 'Rp. ' . number_format($todaySalesTotal, 2, ',', '.');
                            @endphp
                            <a class="text-dark text-hover-primary mb-1 font-size-lg"> Transaksi Hari ini
                            </a><span class="text-muted"> dengan Total 
                                {{ $formattedCurrenttodaySalesTotal }}
                            </span></div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-warning">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-warning">
                                    <svg version="1.1" viewBox="0 0 24 24" height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title>Stockholm-icons / Communication / Write</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g id="Stockholm-icons-/-Communication-/-Write" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" id="Path-11" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                            </path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                        </div>

                            <div class="d-flex flex-column font-weight-bold">
                                @php
                                    $currentMonth = now()->format('m');

                                    $thisMonthSalesTotal = DB::table('transaksis')
                                        ->where('transaksis.is_active', 1)
                                        ->whereMonth('transaksis.created_at', $currentMonth)
                                        ->sum('transaksis.total_biaya');
                                    $formattedCurrentthisMonthSalesTotal = 'Rp. ' . number_format($thisMonthSalesTotal, 2, ',', '.');
                                @endphp
                                <a class="text-dark text-hover-primary mb-1 font-size-lg"> Transaksi Bulan ini
                                </a><span class="text-muted"> dengan Total 
                                    {{ $formattedCurrentthisMonthSalesTotal }}
                                 </span>
                            </div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-success">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Communication / Group-chat</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>

                        <div class="d-flex flex-column font-weight-bold">
                            @php
                            $today = now()->format('Y-m-d'); 
                            $totalTodayTransaksi = \App\Models\Transaksi::whereDate('created_at', $today) 
                                                                        ->count();
                            @endphp
                            <a class="text-dark text-hover-primary mb-1 font-size-lg"> Penyewaan Hari ini </a>
                            <span class="text-muted"> Jumlah Penyewaan
                                {{ $totalTodayTransaksi }}
                             </span>
                        </div>

                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 symbol-light-info mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-info">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Communication / Group-chat</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>

                            <div class="d-flex flex-column font-weight-bold">
                                @php
                                $currentMonth = now()->format('m'); 
                                $totalMonthTransaksi = \App\Models\Transaksi::whereMonth('created_at', $currentMonth) 
                                                                        ->count();
                                @endphp
                                <a class="text-dark text-hover-primary mb-1 font-size-lg"> Penyewaan Bulan ini </a>
                                <span class="text-muted"> Jumlah Penyewaan
                                    {{ $totalMonthTransaksi }}
                                </span>
                            </div>

                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 symbol-light-info mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-info">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Communication / Group-chat</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>
                        <div class="d-flex flex-column font-weight-bold"><a
                                @php
                                $totalTransaksi = \App\Models\Transaksi::count();
                                @endphp
                            class="text-dark text-hover-primary mb-1 font-size-lg"> Total Penyewaan
                            </a><span class="text-muted"> Jumlah Penyewaan
                                {{ $totalTransaksi }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-danger"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-danger"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons /
                                            General / Attachment2</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-General-/-Attachment2"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z"
                                                id="Combined-Shape" fill="#000000" opacity="0.3"
                                                transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641) ">
                                            </path>
                                            <path
                                                d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z"
                                                id="Combined-Shape-Copy" fill="#000000"
                                                transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359) ">
                                            </path>
                                            <path
                                                d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z"
                                                id="Combined-Shape" fill="#000000" opacity="0.3"
                                                transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146) ">
                                            </path>
                                            <path
                                                d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z"
                                                id="Combined-Shape-Copy-2" fill="#000000" opacity="0.3"
                                                transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961) ">
                                            </path>
                                        </g>
                                    </svg></span></span></div>
                            <div class="d-flex flex-column font-weight-bold"><a
                                @php
                                $totalMobil = \App\Models\Mobil::count();
                                @endphp
                                class="text-dark text-hover-primary mb-1 font-size-lg"> Total Mobil
                                </a><span class="text-muted"> {{ $totalMobil }} mobil
                                 </span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-primary">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Home / Library</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>


                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h4">Penyewaan Bulan</span>
                            <span class="text-primary font-weight-bold"><?php echo date('F'); ?></span>
                        </div>

                    </div>
                    <div class="card-rounded-bottom" style="min-height: 150px; height: 150px;">
                        <div id="kt_mixed_widget_1_chart2"></div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                <?php
                use Carbon\Carbon as CarbonDate;
                use App\Models\Transaksi as TransactionModel;

                $currentMonth = CarbonDate::now()->startOfMonth();
                $weeks = [];
                for ($i = 0; $i < 4; $i++) {
                    $weeks[] = [
                        'start' => $currentMonth->copy()->startOfWeek(),
                        'end' => $currentMonth->copy()->endOfWeek(),
                    ];
                    $currentMonth->addWeek();
                }

                $dataPerWeek = [];

                foreach ($weeks as $key => $week) {
                    $dataPerWeek[$key] = 0;
                    $transactions = TransactionModel::whereBetween('created_at', [$week['start'], $week['end']])->get();
                    $dataPerWeek[$key] = count($transactions);
                }

                $data = array_values($dataPerWeek);
                ?>

                <script>
                    var dataFromPHP = <?php echo json_encode($data); ?>;

                    var chart = new ApexCharts(document.querySelector("#kt_mixed_widget_1_chart2"), {
                        series: [{
                            name: 'Jumlah Transaksi',
                            data: dataFromPHP
                        }],
                        chart: {
                            type: 'area',
                            height: 150,
                            animations: {
                                enabled: true
                            },
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                            pan: {
                                enabled: false
                            }
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth',
                            colors: ['#1E90FF']
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'light',
                                type: "vertical",
                                shadeIntensity: 0.25,
                                gradientToColors: ['#1E90FF'],
                                inverseColors: false,
                                opacityFrom: 0.7,
                                opacityTo: 0.3,
                                stops: [0, 90, 100]
                            }
                        },
                        xaxis: {
                            categories: ['Minggu ke 1', 'Minggu ke 2', 'Minggu ke 3', 'Minggu ke 4'],
                            labels: {
                                show: false
                            },
                            axisBorder: {
                                show: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        grid: {
                            show: false,
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            }
                        },
                        markers: {
                            size: 0 // Remove the markers
                        },
                        dataLabels: {
                            enabled: false // Disable data labels
                        }
                    });

                    chart.render();
                </script>
            </div>
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Home / Library</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>


                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h4">Penyewaan Bulan Sebelumnya</span>
                            <span class="text-success font-weight-bold"><?php echo date('F', strtotime('last month')); ?></span>
                        </div>

                    </div>
                    <div class="card-rounded-bottom" style="min-height: 150px; height: 150px;">
                        <div id="kt_mixed_widget_2_chart2"></div>
                    </div>
                </div>
                <?php
                    use Carbon\Carbon as CarbonLibrary;
                    use App\Models\Transaksi as TransaksiModel; // Mengubah alias model Transaksi

                    $currentMonth = CarbonLibrary::now()->startOfMonth();
                    $previousMonth = CarbonLibrary::now()->subMonth()->startOfMonth();

                    $currentWeeks = [];
                    $previousWeeks = [];

                    // Membuat array minggu untuk bulan ini
                    for ($i = 0; $i < 4; $i++) {
                        $currentWeeks[] = [
                            'start' => $currentMonth->copy()->startOfWeek(),
                            'end' => $currentMonth->copy()->endOfWeek(),
                        ];
                        $currentMonth->addWeek();
                    }

                    // Membuat array minggu untuk bulan sebelumnya
                    $previousMonth = CarbonLibrary::now()->subMonth()->startOfMonth();
                    for ($i = 0; $i < 4; $i++) {
                        $previousWeeks[] = [
                            'start' => $previousMonth->copy()->startOfWeek(),
                            'end' => $previousMonth->copy()->endOfWeek(),
                        ];
                        $previousMonth->addWeek();
                    }

                    $dataCurrentMonth = [];
                    $dataPreviousMonth = [];

                    // Mengumpulkan data transaksi untuk bulan ini
                    foreach ($currentWeeks as $key => $week) {
                        $dataCurrentMonth[$key] = 0;
                        $transactions = TransaksiModel::whereBetween('created_at', [$week['start'], $week['end']])->get(); // Menggunakan alias baru
                        $dataCurrentMonth[$key] = count($transactions);
                    }

                    // Mengumpulkan data transaksi untuk bulan sebelumnya
                    foreach ($previousWeeks as $key => $week) {
                        $dataPreviousMonth[$key] = 0;
                        $transactions = TransaksiModel::whereBetween('created_at', [$week['start'], $week['end']])->get(); // Menggunakan alias baru
                        $dataPreviousMonth[$key] = count($transactions);
                    }

                    $dataCurrent = array_values($dataCurrentMonth);
                    $dataPrevious = array_values($dataPreviousMonth);
                    ?>

                <script>
                    var dataFromPHP2 = <?php echo json_encode($dataPrevious); ?>;

                    var chart2 = new ApexCharts(document.querySelector("#kt_mixed_widget_2_chart2"), {
                        series: [{
                            name: 'Jumlah Transaksi',
                            data: dataFromPHP2
                        }],
                        chart: {
                            type: 'area',
                            height: 150,
                            animations: {
                                enabled: true
                            },
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                            pan: {
                                enabled: false
                            }
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth',
                            colors: ['#34BFA3']
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'light',
                                type: "vertical",
                                shadeIntensity: 0.25,
                                gradientToColors: ['#34BFA3'],
                                inverseColors: false,
                                opacityFrom: 0.7,
                                opacityTo: 0.3,
                                stops: [0, 90, 100]
                            }
                        },
                        xaxis: {
                            categories: ['Minggu ke 1', 'Minggu ke 2', 'Minggu ke 3', 'Minggu ke 4'],
                            labels: {
                                show: false
                            },
                            axisBorder: {
                                show: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        grid: {
                            show: false,
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            }
                        },
                        markers: {
                            size: 0 // Remove the markers
                        },
                        dataLabels: {
                            enabled: false // Disable data labels
                        }
                    });

                    chart2.render();
                </script>
            </div>
        </div>
        <div class="col-xxl-12 order-1 order-xxl-2">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column"><span
                            class="card-label font-weight-bolder text-dark">Transaksi Terbaru</span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center table-head-bg table-borderless">
                                <thead>
                                    <tr class="text-left">
                                        <th class="pl-7" style="min-width: 250px;"><span class="text-dark-75">Customer</span></th>
                                        <th style="min-width: 100px;">Nomor Transaksi</th>
                                        <th style="min-width: 100px;">Jenis Sewa</th>
                                        <th style="min-width: 100px;">Total Harga</th>
                                        <th style="min-width: 100px;">Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $transaksis = DB::table('transaksis AS A')
                                        ->leftJoin(DB::raw('(SELECT transaksi_id, SUM(COALESCE(total_biaya,0)) AS total FROM kwitansis GROUP BY transaksi_id) AS J'), 'J.transaksi_id', '=', 'A.id')
                                        ->select('A.*', DB::raw('CASE WHEN (A.total_biaya - COALESCE(J.total, 0)) = 0 THEN "Paid" ELSE "Unpaid" END AS statusbayar'))
                                        ->where('A.is_active', 1)
                                        ->orderBy('A.created_at', 'desc')
                                        ->take(5)
                                        ->get();
                                    @endphp
                                    @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <td class="pl-7">
                                                <span class="text-dark-75">{{ $transaksi->customer_name }}</span>
                                            </td>
                                            <td>
                                                <a href="/transaksi/vdetail/{{ $transaksi->id }}">{{ $transaksi->transaksi_no }}</a>
                                            </td>

                                            <td>
                                                @if($transaksi->jenis_sewa == 1)
                                                    Harian
                                                @elseif($transaksi->jenis_sewa == 2)
                                                    Mingguan
                                                @elseif($transaksi->jenis_sewa == 3)
                                                    Bulanan
                                                @else
                                                    Tidak Diketahui
                                                @endif
                                            </td>
                                            <td>{{ 'Rp ' . number_format($transaksi->total_biaya, 2, ',', '.') }}</td>
                                            <td>
                                                @if($transaksi->statusbayar == 'Paid')
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <span class="badge badge-warning">Unpaid</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
