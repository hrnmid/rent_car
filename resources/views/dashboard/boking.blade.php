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
                        <h3 class="card-title font-weight-bolder text-white">Sales Stat</h3>
                        <div class="card-toolbar">
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
                        </div>
                        
                    </div>
                    <div class="card-body p-0 position-relative overflow-hidden">
						<div class="card-rounded-bottom bg-danger" style="height: 185px">
						<div id="kt_mixed_widget_1_chart1"></div>
                        </div>
                            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                            <?php
                                // Contoh skrip untuk mengambil data dari model PreAlerts dan mengelompokkannya berdasarkan bulan

                                use App\Models\PreAlerts;
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

                                // Mengambil semua data dari tabel PreAlerts
                                $preAlerts = PreAlerts::all();

                                // Loop melalui setiap entri PreAlerts
                                foreach ($preAlerts as $preAlert) {
                                    // Mendapatkan bulan dari tanggal PreAlert
                                    $monthNumber = date('n', strtotime($preAlert->created_at));

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
                                        name: 'Shipment Count',
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
                                        $currentWeekSalesTotal = DB::table('shipping_charges')
                                            ->where('shipping_charges.is_active', 1)
                                            ->whereRaw('created_at >= DATE_SUB( CURDATE(), INTERVAL 7 Day ) AND created_at <= Date( CURDATE())')
                                            ->sum('shipping_charges.fee');
                                    @endphp

                                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">{{ $currentWeekSalesTotal }}</span>
                                    <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>
                                </div>

                                <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                                    {{-- @php
                                    $startDate = now()->subWeek(); //Mendapatkan tanggal awal 1 minggu yang lalu
                                    $endDate = now(); // Mendapatkan tanggal sekarang

                                    $newUsersCount = \App\Models\User::whereBetween('created_at', [$startDate,
                                    $endDate])->count();
                                    @endphp --}}

                                    @php
                                    $currentMonth = now()->format('m'); 
                                    $newUsersCount = \App\Models\User::where('is_active', 1)
                                                                        ->whereMonth('created_at', $currentMonth)
                                                                        ->count();
                                    @endphp

                                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">{{ $newUsersCount}}</span>
                                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">New Users</a>
                                </div>
                            </div>
                            <div class="row m-0">

                                <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                                    @php
                                    $currentMonth = now()->format('m'); 
                                    $preAlertsCount = \App\Models\PreAlerts::where('type', 1)
                                                                        ->where('is_active', 1) // Filter records where is_active is 1
                                                                        ->whereMonth('created_at', $currentMonth)
                                                                        ->count();
                                    @endphp

                                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">{{ $preAlertsCount}}</span>
                                    <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">You Shop, We Ship</a>
                                </div>

                                <div class="col bg-light-success px-6 py-8 rounded-xl">
                                    @php
                                    $currentMonth = now()->format('m'); 
                                    $preAlertsCount = \App\Models\PreAlerts::where('type', 2)
                                                                        ->where('is_active', 1) // Filter records where is_active is 1
                                                                        ->whereMonth('created_at', $currentMonth)
                                                                        ->count();
                                    @endphp
                                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2"> {{ $preAlertsCount}} </span>
                                    <a href="#" class="text-success font-weight-bold font-size-h6 mt-2"> We Grab, We ship </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
        </div>


        <div class="col-xxl-4">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">Account Summary</h3>
                    <div class="card-toolbar">
                        <div class="dropdown b-dropdown btn-group" id="__BVID__68">
                        </div>
                    </div>
                    <div class="card-toolbar">
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
                        </div>
                </div>
                <div class="card-body pt-2">
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-primary"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-primary"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons / Home
                                            / Library</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-Home-/-Library"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                id="Combined-Shape" fill="#000000"></path>
                                            <rect id="Rectangle-Copy-2" fill="#000000" opacity="0.3"
                                                transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                x="16.3255682" y="2.94551858" width="3" height="18" rx="1">
                                            </rect>
                                        </g>
                                    </svg></span></span></div>
                        <div class="d-flex flex-column font-weight-bold">
                            @php
                                $today = now()->format('Y-m-d');
                                $todaySalesTotal = DB::table('shipping_charges')
                                    ->where('shipping_charges.is_active', 1)
                                    ->whereDate('shipping_charges.created_at', $today)
                                    ->sum('shipping_charges.fee');
                            @endphp
                            <a class="text-dark text-hover-primary mb-1 font-size-lg"> Today's Sale
                            </a><span class="text-muted"> Payments in SGD {{ $todaySalesTotal }} </span></div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-warning"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-warning"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons /
                                            Communication / Write</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-Communication-/-Write"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                id="Path-11" fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">
                                            </path>
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3">
                                            </path>
                                        </g>
                                    </svg></span></span></div>
                            <div class="d-flex flex-column font-weight-bold">
                                @php
                                    $currentMonth = now()->format('m');

                                    $thisMonthSalesTotal = DB::table('shipping_charges')
                                        ->where('shipping_charges.is_active', 1)
                                        ->whereMonth('shipping_charges.created_at', $currentMonth)
                                        ->sum('shipping_charges.fee');
                                @endphp
                                <a class="text-dark text-hover-primary mb-1 font-size-lg"> Month's Sale
                                </a><span class="text-muted"> Payments in SGD {{ $thisMonthSalesTotal }} </span>
                            </div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-success"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-success"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons /
                                            Communication / Write</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-Communication-/-Write"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                id="Path-11" fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) ">
                                            </path>
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3">
                                            </path>
                                        </g>
                                    </svg></span></span></div>
                        <div class="d-flex flex-column font-weight-bold">
                            @php
                            $today = now()->format('Y-m-d'); 
                            $totalTodayPreAlerts = \App\Models\PreAlerts::whereDate('created_at', $today) 
                                                                        ->count();
                            @endphp
                            <a class="text-dark text-hover-primary mb-1 font-size-lg"> Today's Shipments </a>
                            <span class="text-muted"> Count {{ $totalTodayPreAlerts }} </span>
                        </div>

                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-info"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-info"><svg version="1.1" viewBox="0 0 24 24"
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
                            <div class="d-flex flex-column font-weight-bold">
                                @php
                                $currentMonth = now()->format('m'); 
                                $totalMonthPreAlerts = \App\Models\PreAlerts::whereMonth('created_at', $currentMonth) 
                                                                        ->count();
                                @endphp
                                <a class="text-dark text-hover-primary mb-1 font-size-lg"> Month's Shipments </a>
                                <span class="text-muted"> Count {{ $totalMonthPreAlerts }} </span>
                            </div>

                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 mr-5 symbol-light-info"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-lg svg-icon-info"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                $totalPreAlerts = \App\Models\PreAlerts::count();
                                @endphp
                            class="text-dark text-hover-primary mb-1 font-size-lg"> Total Shipments
                            </a><span class="text-muted"> Count {{ $totalPreAlerts }} </span>
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
                                $totalContainers = \App\Models\Container::count();
                                @endphp
                                class="text-dark text-hover-primary mb-1 font-size-lg"> Total Containers
                                </a><span class="text-muted"> Count {{ $totalContainers }} </span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-xl svg-icon-success"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons /
                                            Layout / Layout-4-blocks</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-Layout-/-Layout-4-blocks"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <rect id="Rectangle-7" fill="#000000" x="4" y="4" width="7" height="7" rx="1.5">
                                            </rect>
                                            <path
                                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg></span></span></span>
                        <div class="d-flex flex-column text-right"><span class="text-muted font-weight-bold mt-2">Monthly
                                Prealert Income</span>
                        </div>
                    </div>
                    <div class="card-rounded-bottom" style="min-height: 150px;">
                        <div id="apexchartsqpuue0tz" class="apexcharts-canvas apexchartsqpuue0tz apexcharts-theme-light"
                            style="width: 324px; height: 150px;"><svg id="SvgjsSvg2181" width="324" height="150"
                                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                transform="translate(0, 0)" style="background: transparent;">
                                <g id="SvgjsG2183" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                    <defs id="SvgjsDefs2182">
                                        <clipPath id="gridRectMaskqpuue0tz">
                                            <rect id="SvgjsRect2187" width="331" height="153" x="-3.5" y="-1.5" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskqpuue0tz"></clipPath>
                                        <clipPath id="nonForecastMaskqpuue0tz"></clipPath>
                                        <clipPath id="gridRectMarkerMaskqpuue0tz">
                                            <rect id="SvgjsRect2188" width="328" height="154" x="-2" y="-2" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                    </defs>
                                    <g id="SvgjsG2212" class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g id="SvgjsG2213" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)">
                                        </g>
                                    </g>
                                    <g id="SvgjsG2195" class="apexcharts-grid">
                                        <g id="SvgjsG2196" class="apexcharts-gridlines-horizontal" style="display: none;">
                                            <line id="SvgjsLine2200" x1="0" y1="15" x2="324" y2="15" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2201" x1="0" y1="30" x2="324" y2="30" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2202" x1="0" y1="45" x2="324" y2="45" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2203" x1="0" y1="60" x2="324" y2="60" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2204" x1="0" y1="75" x2="324" y2="75" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2205" x1="0" y1="90" x2="324" y2="90" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2206" x1="0" y1="105" x2="324" y2="105" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2207" x1="0" y1="120" x2="324" y2="120" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2208" x1="0" y1="135" x2="324" y2="135" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                        </g>
                                        <g id="SvgjsG2197" class="apexcharts-gridlines-vertical" style="display: none;">
                                        </g>
                                        <line id="SvgjsLine2211" x1="0" y1="150" x2="324" y2="150" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt">
                                        </line>
                                        <line id="SvgjsLine2210" x1="0" y1="1" x2="0" y2="150" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2189" class="apexcharts-area-series apexcharts-plot-series">
                                        <g id="SvgjsG2190" class="apexcharts-series" seriesName="NetxSales"
                                            data:longestSeries="true" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath2193"
                                                d="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z"
                                                fill="rgba(201,247,245,1)" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqpuue0tz)"
                                                pathTo="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z"
                                                pathFrom="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z">
                                            </path>
                                            <path id="SvgjsPath2194"
                                                d="M 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                fill="none" fill-opacity="1" stroke="#1bc5bd" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="3" stroke-dasharray="0"
                                                class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqpuue0tz)"
                                                pathTo="M 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                pathFrom="M 0 150C 10.309090909090909 150 19.145454545454548 -193.63636363636368 29.454545454545457 -193.63636363636368C 39.763636363636365 -193.63636363636368 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                fill-rule="evenodd"></path>
                                            <g id="SvgjsG2191" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                <g class="apexcharts-series-markers">
                                                    <circle id="SvgjsCircle2232" r="0" cx="0" cy="0"
                                                        class="apexcharts-marker wlvb74bjo no-pointer-events" stroke="#1bc5bd"
                                                        fill="#c9f7f5" fill-opacity="1" stroke-width="3" stroke-opacity="0.9"
                                                        default-marker-size="0">
                                                    </circle>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG2192" class="apexcharts-datalabels" data:realIndex="0">
                                        </g>
                                    </g>
                                    <g id="SvgjsG2198" class="apexcharts-grid-borders" style="display: none;">
                                        <line id="SvgjsLine2199" x1="0" y1="0" x2="324" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2209" x1="0" y1="150" x2="324" y2="150" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <line id="SvgjsLine2227" x1="0" y1="0" x2="324" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine2228" x1="0" y1="0" x2="324" y2="0" stroke-dasharray="0" stroke-width="0"
                                        stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                    </line>
                                    <g id="SvgjsG2229" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG2230" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG2231" class="apexcharts-point-annotations"></g>
                                </g>
                                <g id="SvgjsG2226" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)">
                                </g>
                                <g id="SvgjsG2184" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 75px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;">
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                        class="apexcharts-tooltip-marker" style="background-color: rgb(201, 247, 245);"></span>
                                    <div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-primary mr-2"><span class="symbol-label"><span
                                    class="svg-icon svg-icon-xl svg-icon-primary"><svg version="1.1" viewBox="0 0 24 24"
                                        height="24px" width="24px" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                                        <title xmlns="http://www.w3.org/2000/svg">Stockholm-icons /
                                            Shopping / Cart3</title>
                                        <desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.
                                        </desc>
                                        <defs xmlns="http://www.w3.org/2000/svg"></defs>
                                        <g xmlns="http://www.w3.org/2000/svg" id="Stockholm-icons-/-Shopping-/-Cart3"
                                            stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z"
                                                id="Path-30" fill="#000000" fill-rule="nonzero" opacity="0.3">
                                            </path>
                                            <path
                                                d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z"
                                                id="Combined-Shape" fill="#000000"></path>
                                        </g>
                                    </svg></span></span></span>
                        <div class="d-flex flex-column text-right"><span class="text-muted font-weight-bold mt-2">Monthly
                                Shipment Income</span>
                        </div>
                    </div>
                    <div class="card-rounded-bottom" style="min-height: 150px;">
                        <div id="apexchartsohd0hgwd" class="apexcharts-canvas apexchartsohd0hgwd apexcharts-theme-light"
                            style="width: 324px; height: 150px;"><svg id="SvgjsSvg2234" width="324" height="150"
                                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                transform="translate(0, 0)" style="background: transparent;">
                                <g id="SvgjsG2236" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                    <defs id="SvgjsDefs2235">
                                        <clipPath id="gridRectMaskohd0hgwd">
                                            <rect id="SvgjsRect2240" width="331" height="153" x="-3.5" y="-1.5" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskohd0hgwd"></clipPath>
                                        <clipPath id="nonForecastMaskohd0hgwd"></clipPath>
                                        <clipPath id="gridRectMarkerMaskohd0hgwd">
                                            <rect id="SvgjsRect2241" width="328" height="154" x="-2" y="-2" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                    </defs>
                                    <g id="SvgjsG2265" class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g id="SvgjsG2266" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)">
                                        </g>
                                    </g>
                                    <g id="SvgjsG2248" class="apexcharts-grid">
                                        <g id="SvgjsG2249" class="apexcharts-gridlines-horizontal" style="display: none;">
                                            <line id="SvgjsLine2253" x1="0" y1="15" x2="324" y2="15" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2254" x1="0" y1="30" x2="324" y2="30" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2255" x1="0" y1="45" x2="324" y2="45" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2256" x1="0" y1="60" x2="324" y2="60" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2257" x1="0" y1="75" x2="324" y2="75" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2258" x1="0" y1="90" x2="324" y2="90" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2259" x1="0" y1="105" x2="324" y2="105" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2260" x1="0" y1="120" x2="324" y2="120" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2261" x1="0" y1="135" x2="324" y2="135" stroke="#e0e0e0"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                        </g>
                                        <g id="SvgjsG2250" class="apexcharts-gridlines-vertical" style="display: none;">
                                        </g>
                                        <line id="SvgjsLine2264" x1="0" y1="150" x2="324" y2="150" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt">
                                        </line>
                                        <line id="SvgjsLine2263" x1="0" y1="1" x2="0" y2="150" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2242" class="apexcharts-area-series apexcharts-plot-series">
                                        <g id="SvgjsG2243" class="apexcharts-series" seriesName="NetxSales"
                                            data:longestSeries="true" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath2246"
                                                d="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z"
                                                fill="rgba(225,233,255,1)" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                class="apexcharts-area" index="0" clip-path="url(#gridRectMaskohd0hgwd)"
                                                pathTo="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z"
                                                pathFrom="M 0 150 L 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150C 324 150 324 150 324 150M 324 150z">
                                            </path>
                                            <path id="SvgjsPath2247"
                                                d="M 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                fill="none" fill-opacity="1" stroke="#6993ff" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="3" stroke-dasharray="0"
                                                class="apexcharts-area" index="0" clip-path="url(#gridRectMaskohd0hgwd)"
                                                pathTo="M 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                pathFrom="M 0 150C 10.309090909090909 150 19.145454545454548 -13759.09090909091 29.454545454545457 -13759.09090909091C 39.763636363636365 -13759.09090909091 48.60000000000001 150 58.909090909090914 150C 69.21818181818182 150 78.05454545454546 150 88.36363636363637 150C 98.67272727272729 150 107.50909090909092 150 117.81818181818183 150C 128.12727272727273 150 136.96363636363637 150 147.27272727272728 150C 157.5818181818182 150 166.41818181818184 150 176.72727272727275 150C 187.03636363636366 150 195.87272727272727 150 206.1818181818182 150C 216.4909090909091 150 225.32727272727274 150 235.63636363636365 150C 245.94545454545457 150 254.7818181818182 150 265.0909090909091 150C 275.40000000000003 150 284.23636363636365 150 294.54545454545456 150C 304.8545454545455 150 313.6909090909091 150 324 150"
                                                fill-rule="evenodd"></path>
                                            <g id="SvgjsG2244" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                <g class="apexcharts-series-markers">
                                                    <circle id="SvgjsCircle2285" r="0" cx="0" cy="0"
                                                        class="apexcharts-marker w38q0kuvi no-pointer-events" stroke="#6993ff"
                                                        fill="#e1e9ff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9"
                                                        default-marker-size="0">
                                                    </circle>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="SvgjsG2245" class="apexcharts-datalabels" data:realIndex="0">
                                        </g>
                                    </g>
                                    <g id="SvgjsG2251" class="apexcharts-grid-borders" style="display: none;">
                                        <line id="SvgjsLine2252" x1="0" y1="0" x2="324" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2262" x1="0" y1="150" x2="324" y2="150" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <line id="SvgjsLine2280" x1="0" y1="0" x2="324" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine2281" x1="0" y1="0" x2="324" y2="0" stroke-dasharray="0" stroke-width="0"
                                        stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                    </line>
                                    <g id="SvgjsG2282" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG2283" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG2284" class="apexcharts-point-annotations"></g>
                                </g>
                                <g id="SvgjsG2279" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)">
                                </g>
                                <g id="SvgjsG2237" class="apexcharts-annotations"></g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 75px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                <div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;">
                                </div>
                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                        class="apexcharts-tooltip-marker" style="background-color: rgb(225, 233, 255);"></span>
                                    <div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span>
                                        </div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12 order-1 order-xxl-2">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column"><span
                            class="card-label font-weight-bolder text-dark">Top 5 Customer Stats</span>
                    </h3>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center table-head-bg table-borderless">
                                <thead>
                                    <tr class="text-left">
                                        <th class="pl-7" style="min-width: 250px;"><span class="text-dark-75">Profile</span>
                                        </th>
                                        <th style="min-width: 100px;">Shipments</th>
                                        <th style="min-width: 100px;">Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
