@extends('layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div id="kt_subheader" class="subheader py-2 py-lg-4 subheader-solid transparent border-top">
    <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap container-fluid">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Customer's Profile</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                <li class="breadcrumb-item">
                    <a href="/" class="subheader-breadcrumbs-home router-link-active">
                        <i class="flaticon2-shelter text-muted icon-1x"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><span class="text-muted">Customer's Profile</span></li>
            </ul>
        </div>
        <div class="d-flex align-items-center"></div>
    </div>
</div>

<!--end::Dashboard-->
@endsection
<!--start::Content-->
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="row col-12">
                    <div class="card gutter-b">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                @if($user->profile_path)
                                    <img src="{{ asset($user->profile_path) }}" alt="Profile Image" width="45" height="40" class="rounded-circle mr-2">
                                @else
                                    <i class="fa fa-user" style="font-size: 40px; width: 50px; height: 40px;"></i>
                                @endif
                                <h3 class="card-label mb-0">{{ $user->first_name . ' ' . $user->last_name }} ({{ $user->unique_id }})</h3>
                                @if($user->kwc_required == 1)
                                    <span class="badge bagde-sm badge-success ml-auto">VERIFIED</span>
                                @else
                                    <span class="badge bagde-sm badge-warning ml-auto">UNVERIFIED</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body body-fluid">
                            <div class="row">
                                <div class="col-6"><span><b>Email</b></span></div>
                                <div class="col-6">{{ $user->email }}</div>
                                <div class="col-6"><span><b>Nomor akun</b></span></div>
                                <div class="col-6">{{ $user->unique_id }}</div>
                                <div class="col-6"><span><b>Alamat</b></span></div>
                                <div class="col-6">{{ $user->address }}</div>
                                <div class="col-6"><span><b>Nomor Telepon</b></span></div>
                                <div class="col-6">{{ $user->phone }}</div>
                                <div class="col-6"><span><b>Tanggal akun dibuat</b></span></div>
                                <div class="col-6">{{ $user->created_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="row col-12">
                    <div class="card card-custom gutter-b w-100">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Verifikasi Dokumen KYC </h3>
                            </div>
                            <div class="card-toolbar">
                                 <button type="button" class="btn btn-outline-primary mr-3" onclick="window.location.href='/verifykwc/{{ $user->id }}'">Verify Account</button>
                                 <button type="button" class="btn btn-outline-danger mr-3" onclick="window.location.href='/verifykwcno/{{ $user->id }}'">Decline Verification</button>
                                {{-- <button type="button" class="btn btn-outline-primary">Attach Document</button> --}}
                            </div>
                        </div>
                        <div class="card-body body-fluid">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Type</th>
                                            {{-- <th>Action</th> --}}
                                            {{-- <th>Reason</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>@if(!empty($user->verif_path))
                                                <a href="{{ url($user->verif_path) }}" target="_blank" class="btn btn-success btn-sm" style="font-size: 12px; padding: 2px 5px;">View</a>
                                                @endif
                                            </th>
                                            <th>{{ $user->identity_type }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="fa fa-list text-primary"></i>
                            </span>
                            <h3 class="card-label">Total Shipments</h3>
                        </div>

                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_tbl" class="table table-separate table-head-custom table-checkable dataTable no-footer" style="width:100%;min-height:50px">
                                <thead>
                                    <tr>
                                        <th>Tracking.No</th>
                                        <th>Origin to Destination</th>
                                        <th>Shipment Type</th>
                                        <th>Shipping Mode</th>
                                        <th>Payment Status</th>
                                        <th>Booking Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($preAlerts as $preAlert)
                                    <tr>
                                        <td><a href="/prealert/vdetail/{{ $preAlert->id }}">{{ $preAlert->tracking_no }}</td>
                                        <td>{{ $preAlert->sender_city }} to {{ $preAlert->receiver_city }}</td>
                                        <td>{{ $preAlert->shipment_type_name }}</td>
                                        <td>{{ $preAlert->shipping_mode_name }}</td>
                                        <td>@if($preAlert->payment_status == 1)
                                                <span class="badge badge-pill badge-info">Paid</span>
                                            @else
                                                <span class="badge badge-pill badge-warning text-white">Unpaid</span>
                                            @endif
                                        </td>
                                        <td>{{ $preAlert->booking_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="fa fa-list text-primary"></i>
                            </span>
                            <h3 class="card-label">Riwayat Transaksi</h3>
                        </div>

                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_tbl" class="table table-separate table-head-custom table-checkable dataTable no-footer" style="width:100%;min-height:50px">
                                <thead>
                                    <tr>
                                        <th>Transaksi No</th>
                                        <th>Merek</th>
                                        <th>Merek</th>
                                        <th>Total Harga</th>
                                        <th>Payment Status</th>
                                        <th>Booking Date</th>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tranSaksi as $transaksi)
                                    <tr>
                                        <td><a href="/transaksi/vdetail/{{ $transaksi->id }}">{{ $transaksi->transaksi_no }}</td>
                                        <td>{{ $transaksi->mobil_merek }}</td>
                                        <td>{{ $transaksi->mobil_type_name }}</td>
                                        <td>{{ $transaksi->total_biaya }}</td>
                                        <td><span class="badge badge-{{ $transaksi->statusbayar == 'Paid' ? 'success' : 'warning' }}">{{ $transaksi->statusbayar }}</span></td>
                                        <td>{{ $transaksi->booking_date }}</td>
                                        <td>{{ $transaksi->invoice_no }}</td>
                                        <td>{{ $transaksi->invoice_date }}</td>
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
    <!--JAVASCRIPT -->
    @section('javascript')
    
    @endsection
