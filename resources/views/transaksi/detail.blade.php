@extends('layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Details-->
    <div class="d-flex align-items-center flex-wrap mr-2">
      <!--begin::Title-->
      <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Detail Transaksi #{{$post->transaksi_no}}
      <!--begin::Separator-->
      {{-- <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div> --}}
      <!--end::Separator-->
    </div>
  </div>
</div>

<!--end::Dashboard-->
@endsection
<!--start::Content-->
@section('content')
{{-- <input type='hidden' id='id' value="{{$post->id}}"> --}}
@if (auth()->check() && auth()->user()->role == 1)
    <!-- User memiliki role 1, tidak menampilkan alert -->
@else
    @if ($post->payment_status == 0)
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
                Silakan klik "Print Invoice" untuk melakukan pembayaran dengan metode transfer bank. Untuk metode tunai, silakan datang langsung ke lokasi rental.
            </div>
            <div class="alert-close">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    @elseif ($post->payment_status == 1)
        <div role="alert" class="alert alert-custom alert-light-warning fade show mb-10">
            <div class="alert-icon">
                <span class="svg-icon svg-icon-3x svg-icon-warning">
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
                Anda telah membayar uang muka penyewaan. Silakan tunjukkan kuitansi pembayaran ke admin di lokasi untuk melanjutkan proses.
        </div>
            <div class="alert-close">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    @elseif ($post->payment_status == 3)
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
                Anda telah membayar lunas penyewaan. Silakan tunjukkan kuitansi pembayaran ke admin di lokasi untuk melanjutkan proses.
            </div>
            <div class="alert-close">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
    @else
        <!-- Handle other cases if needed -->
    @endif
@endif

<div class="card card-custom gutter-b card-sticky" id="kt_page_sticky_card">
    <div class="card-header" style="">
        <div class="card-title">
            <h3 class="card-label">
                Transaksi # {{$post->transaksi_no}} - 
                @if($post->payment_status == 0)
                    <span class='badge badge-pill badge-danger'>Menunggu Pembayaran</span>
                @elseif($post->payment_status == 1)
                    <span class='badge badge-pill badge-warning'>Telah Membayar Uang Muka</span>
                @elseif($post->payment_status == 2)
                    <span class='badge badge-pill badge-info'>Sedang kami proses</span>
                @elseif($post->payment_status == 3)
                    <span class='badge badge-pill badge-success'>Transaksi berhasil</span>
                @else
                    <span class='badge badge-pill badge-warning'>Status tidak valid</span>
                @endif
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="btn-toolbar">
                <div class="btn-group mr-2">
                    <a href="/invoices_rental/{{$post->id}}" target="_blank" class="btn btn-primary font-weight-bolder">
                        <i class="fa fa-print icon-xs"></i>
                        Print Invoice
                    </a>
                </div>
                {{-- @if(($post->payment_status != 3 && $post->payment_status != 2) || (!$post->bukti_path && !$post->bukti_path2))
                <div class="btn-group">
                    <button class="btnbayar btn btn-success font-weight-bolder">
                        <i class="fa fa-money-bill icon-xs"></i>
                        Bayar Sekarang
                    </button>
                </div>
                @endif --}}
                @if($post->payment_status != 2 && $post->payment_status != 3)
                    <div class="btn-group">
                        <button class="btnbayar btn btn-warning font-weight-bolder">
                            <i class="fa fa-money-bill icon-xs"></i>
                            Bayar Sekarang
                        </button>
                    </div>
                @endif
            </div>
        </div>


    </div>
    <div class="card-body body-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card text-left border-secondary" style="min-height: 190px;"> 
                <div class="card-body"> <h3 class="header_style_2">Detail Pelanggan</h3>
                    <div class="card-text">
                        <span class="text-dark-100 font-weight-bold" style="font-size: 16px;">Nama : {{$post->customer_name}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">NIK : {{$post->customer_ktp}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Nomor HP : {{$post->customer_phone}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Email : {{$post->customer_email}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Alamat : {{$post->customer_address}},</span>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">{{\App\Models\Kecamatan::find($post->customer_kecamatan)->name}}, {{\App\Models\Kelurahan::find($post->customer_kelurahan)->name}}, {{$post->customer_kodepos}}</span><br/>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card text-left border-secondary" style="min-height: 190px;"> 
                    <div class="card-body d-flex justify-content-center align-items-center"> 
                        {{-- <h3 class="header_style_2">Document</h3> --}}
                        <div>
                            @if(Auth::check() && (Auth::user()->id == $post->customer_id || Auth::user()->role == 1))
                                <img src="{{ asset(\App\Models\User::find($post->customer_id)->verif_path) }}" alt="Document" style="max-width:100%; max-height:100%;">
                            @else
                                <p>Anda tidak memiliki izin untuk melihat dokumen ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    {{-- <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Car Details</h3>
        </div>
    </div> --}}
    <div class="card-body body-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card text-left border-secondary" style="min-height: 190px;"> 
                <div class="card-body"> <h3 class="header_style_2">Detail Mobil</h3>
                    <div class="card-text">
                        <span class="text-dark-100 font-weight-bold" style="font-size: 16px;">Nama Mobil : {{$post->mobil_name}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Merek : {{$post->mobil_merek}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Type : {{\App\Models\Mobiltype::find($post->mobil_type)->name}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Warna : {{$post->mobil_warna}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Nomor Plat : {{$post->mobil_noplat}}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Harga Sewa Harian : Rp {{ number_format(\App\Models\Mobil::find($post->mobil_id)->sewa_harian, 2, ',', '.') }}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Harga Sewa Mingguan : Rp {{ number_format(\App\Models\Mobil::find($post->mobil_id)->sewa_mingguan, 2, ',', '.') }}</span><br/>
                        <span class="text-dark-100 font-weight-normal" style="font-size: 15px;">Harga Sewa Bulanan : Rp {{ number_format(\App\Models\Mobil::find($post->mobil_id)->sewa_bulanan, 2, ',', '.') }}</span>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card text-left border-secondary" style="min-height: 190px;"> 
                    <div class="card-body d-flex justify-content-center align-items-center"> 
                        {{-- <h3 class="header_style_2">Document</h3> --}}
                        <div>
                            <img src="{{ asset(\App\Models\Mobil::find($post->mobil_id)->mobil_path) }}" alt="Document" style="max-width:100%; max-height:100%;">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Detail Pemesanan Anda</h3>
        </div>
    </div>
    <div class="card-body body-fluid">
        <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('booking_date', 'Tanggal Pemesanan', ['class' => 'form-control-label']) !!}
                    {!! Form::date('booking_date', old('booking_date', isset($post) ? $post->booking_date : ''),
                    ['class' => "form-control". ( $errors->has('booking_date') ? ' is-invalid' : '' ), 'id' => 'booking_date', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="booking_date" data-validator="error" class="fv-help-block">
                            @error('booking_date') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('jenis_sewa', 'Jenis Sewa', ['class' => 'form-control-label']) !!}
                    {!! Form::select('jenis_sewa', [
                        1 => 'Sewa Harian',
                        2 => 'Sewa Mingguan',
                        3 => 'Sewa Bulanan'
                    ], old('jenis_sewa', isset($post) ? $post->jenis_sewa : ''),
                    ['class' => "form-control". ( $errors->has('jenis_sewa') ? ' is-invalid' : '' ), 'id' => 'jenis_sewa', 'placeholder' => 'Pilih Jenis Sewa', 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="jenis_sewa" data-validator="error" class="fv-help-block">
                            @error('jenis_sewa') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('lama_sewa', 'Waktu Sewa', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('lama_sewa', old('lama_sewa', isset($post) ? $post->lama_sewa : ''),
                        ['class' => "form-control". ( $errors->has('lama_sewa') ? ' is-invalid' : '' ), 'placeholder' => 'Waktu Sewa', 'readonly' => 'readonly']) !!}
                        <div class="input-group-append">
                            <span class="input-group-text" id="waktu_sewa_unit"></span>
                        </div>
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="lama_sewa" data-validator="error" class="fv-help-block">
                            @error('lama_sewa') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('booking_end', 'Tanggal Selesai', ['class' => 'form-control-label']) !!}
                    {!! Form::date('booking_end', old('booking_end', isset($post) ? $post->booking_end : ''),
                    ['class' => "form-control". ( $errors->has('booking_end') ? ' is-invalid' : '' ), 'id' => 'booking_end', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="booking_end" data-validator="error" class="fv-help-block">
                            @error('booking_end') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    {!! Form::label('guarantee', 'Jenis Jaminan', ['class' => 'form-control-label']) !!}
                    {!! Form::select('guarantee', ['1' => 'KTP', '2' => 'Dokumen Lainnya'], old('guarantee', isset($post) ? $post->guarantee : ''),
                        ['class' => "form-control" . ($errors->has('guarantee') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Jenis Jaminan', 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="guarantee" data-validator="error" class="fv-help-block">
                            @error('guarantee') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    {!! Form::label('payment_mode', 'Motode Pembayaran', ['class' => 'form-control-label']) !!}
                    {!! Form::select('payment_mode', ['1' => 'Cash', '2' => 'Transfer Bank'], old('payment_mode', isset($post) ? $post->payment_mode : ''),
                        ['class' => "form-control" . ($errors->has('payment_mode') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Motode Pembayaran', 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="payment_mode" data-validator="error" class="fv-help-block">
                            @error('payment_mode') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    {!! Form::label('booking_destination', 'Tujuan Sewa', ['class' => 'form-control-label']) !!}
                    {!! Form::text('booking_destination', old('booking_destination', isset($post) ? $post->booking_destination : ''),
                    ['class' => "form-control". ( $errors->has('booking_destination') ? ' is-invalid' : '' ), 'placeholder' => 'Tujuan Sewa', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="booking_destination" data-validator="error" class="fv-help-block">
                            @error('booking_destination') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Detail Invoice</h3>
        </div>
    </div>
    <div class="card-body body-fluid">
        <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('invoice_no', 'Invoice No', ['class' => 'font-weight-bold']) !!}
                        {!! Form::text('invoice_no', old('invoice_no', isset($post) ? $post->invoice_no : ''),
                        ['readOnly' =>true,'class' => "form-control". ( $errors->has('invoice_no') ? ' is-invalid' : '' ), 'placeholder' => 'Auto']) !!}
                        <div class="fv-plugins-message-container">
                            <div data-field="sender_phone" data-validator="error" class="fv-help-block">
                                @error('invoice_no') {{ $message }} @enderror</div>
                        </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('invoice_date', 'Tanggal Invoice', ['class' => 'form-control-label']) !!}
                    {!! Form::date('invoice_date', old('invoice_date', isset($post) ? $post->invoice_date : ''),
                        ['class' => "form-control". ( $errors->has('invoice_date') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="invoice_date" data-validator="error" class="fv-help-block">
                            @error('invoice_date') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('invoice_due', 'Jatuh Tempo Invoice', ['class' => 'form-control-label']) !!}
                    {!! Form::date('invoice_due', old('invoice_due', isset($post) ? $post->invoice_due : ''),
                        ['class' => "form-control". ( $errors->has('invoice_due') ? ' is-invalid' : '' ), 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="invoice_due" data-validator="error" class="fv-help-block">
                            @error('invoice_due') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('total_biaya', 'Total Harga Sewa', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        {!! Form::text('total_biaya', old('total_biaya', isset($post) ? $post->total_biaya : ''),
                            ['class' => 'form-control'. ( $errors->has('total_biaya') ? ' is-invalid' : '' ), 'placeholder' => 'Total Harga Sewa', 'readonly' => 'readonly']) !!}
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="total_biaya" data-validator="error" class="fv-help-block">
                            @error('total_biaya') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                
        </div>
            <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('payment_jenis', 'Jenis Pembayaran', ['class' => 'form-control-label']) !!}
                    {!! Form::select('payment_jenis', ['1' => 'Uang Muka', '2' => 'Bayar Lunas'], old('payment_jenis', isset($post) ? $post->payment_jenis : ''),
                        ['class' => "form-control" . ($errors->has('payment_jenis') ? ' is-invalid' : ''), 'placeholder' => 'Menunggu Pembayaran', 'disabled' => 'disabled']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="payment_jenis" data-validator="error" class="fv-help-block">
                            @error('payment_jenis') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                @if($post->bukti_path)
                <div class="col-md-3">
                    {!! Form::label('bukti_bayar', 'Bukti Bayar', ['class' => 'font-weight-bold']) !!}
                    <div class="input-group">
                        <a href="{{ asset($post->bukti_path) }}" class="btn btn-outline-secondary btn-block" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Lihat Bukti Bayar
                        </a>
                    </div>
                </div>
                @endif

                @if($post->bukti_path2)
                <div class="col-md-3">
                    {!! Form::label('bukti_bayar', 'Bukti Bayar 2', ['class' => 'font-weight-bold']) !!}
                    <div class="input-group">
                        <a href="{{ asset($post->bukti_path2) }}" class="btn btn-outline-secondary btn-block" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Lihat Bukti Bayar
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{-- <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('bukti_bayar', 'Upload Bukti Bayar', ['class' => 'font-weight-bold']) !!}
                    <div class="input-group">
                        <button class="btnbayar btn btn-success font-weight-bolder">
                            <i class="fa fa-money-bill icon-xs"></i>
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div> --}}



    </div>
</div>
<div class="card card-custom gutter-b ">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Informasi Pembayaran Anda</h3>
            @if($post->payment_status == 0)
                    <span class='badge badge-pill badge-danger'>Menunggu Pembayaran</span>
                @elseif($post->payment_status == 1)
                    <span class='badge badge-pill badge-warning'>Menunggu Pelunasan</span>
                @elseif($post->payment_status == 2)
                    <span class='badge badge-pill badge-info'>Sedang kami proses</span>
                @elseif($post->payment_status == 3)
                    <span class='badge badge-pill badge-success'>Transaksi berhasil</span>
                @else
                    <span class='badge badge-pill badge-warning'>Status tidak valid</span>
                @endif

        </div>
        <div class="card-toolbar">
           
        @if (Auth::user()->role != 6)
            <div class="btn-toolbar">
                <div class="btn-group mr-2">
                    <button class="btn btn-secondary font-weight-bolder" onclick="location.reload();">
                        <i class="fa fa-sync"></i>
                        Refresh
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btnaddpayment btn btn-primary font-weight-bolder">
                        <i class="fa fa-plus"></i>
                        Tambahkan Kuitansi
                    </button>
                </div>
            </div>
        @endif

        </div>
    </div>
      
          
    <div class="card-body">
        <div class="table-responsive">
            <table id="list_tbl" class="table display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nomor Kuitansi</th>
                        <th>Tanggal Kuitansi</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                        <th>Dibuat pada</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Rp. 0,00</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

    </div>
  </div>
</div>
@endsection
<!--JAVASCRIPT -->
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        
        var transaksi_id = {{ $post->id }};
        var list_tbl = $("#list_tbl").DataTable({
            scrollX: true,
            autoWidth: false,
            scrollCollapse: true,
            dom: `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('kwitansi.vload') }}",
                type: "GET",
                data: function(d) {
                     d.transaksi_id = transaksi_id; // Pass the transaksi_id parameter
                    d.search = $("#f_search").val();
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [{
                    data: "receipt_id"
                    , name: "receipt_id"
                }, {
                    data: "receipt_no"
                    , name: "receipt_no"
                }, {
                    data: "receipt_date"
                    , name: "receipt_date"
                }, {
                    data: "receipt_method",
                    name: "receipt_method",
                    render: function(data, type, row) {
                        // Ubah nilai menjadi "Tunai" jika nilainya adalah 1
                        if (data === 1) {
                            return "Tunai";
                        }
                        // Ubah nilai menjadi "Transfer bank" jika nilainya adalah 2
                        else if (data === 2) {
                            return "Transfer bank";
                        }
                        // Jika nilai tidak sama dengan 1 atau 2, kembalikan nilai asli
                        else {
                            return data;
                        }
                    }
                }, {
                    data: "total_biaya"
                    , name: "total_biaya"
                    , render: function(data, type, row) {
                        // Ubah nilai data ke format mata uang "Rp. 50.000"
                        var formattedAmount = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                        return formattedAmount;
                    }
                }, {
                    data: "receipt_status", 
                    name: "receipt_status",
                    render: function(data, type, row) {
                        if (data === 1) {
                            return "Uang Muka";
                        }
                        else if (data === 3) {
                            return "Lunas";
                        }
                        else {
                            return data;
                        }
                    }
                }, {
                    data: "created_at"
                    , name: "created_at"
                }],
            columnDefs: [
                {
                    targets: 0,
                    title: "Actions",
                    className: "text",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var linkprint = "{{route('kwitansi.vprint', ':id')}}".replace(':id', data);
                        var linkdelete = "{{route('kwitansi.vdestroy', ':id')}}".replace(':id', data);
                        var link = "<div class ='dropdown dropdown-inline'>";
                        link += "<a href='javascript:;' class='btn btn-icon btn-light btn-hover-primary btn-md' data-toggle='dropdown'><i class='la la-cog'></i></a>";
                        link += "<div class = 'dropdown-menu dropdown-menu-sm dropdown-menu-right'>";
                        link += "<ul class='nav nav-hoverable flex-column'>";
                        link += "<li class='nav-item'><a class='print_link nav-link' href='" + linkprint + "' data-id='" + data + "' target='_blank'><i class='nav-icon la la-print'></i><span class='nav-text'>Cetak Kuitansi</span></a></li>";
                        // link += "<li class='nav-item'><a class='delete_link nav-link' href='" + linkdelete + "' data-id='" + data + "'><i class='nav-icon la la-remove'></i><span class='nav-text'>Delete</span></a></li>";
                        @if(Auth::user()->role == 1)
                            link += "<li class='nav-item'><a class='delete_link nav-link' href='" + linkdelete + "' data-id='" + data + "'><i class='nav-icon la la-remove'></i><span class='nav-text'>Hapus</span></a></li>";
                        @endif

                        link += "</ul></div></div>";
                        return link;
                    }
                }
            ],
            drawCallback: function(settings) {
            var api = this.api();
            var total = api.column(4, {page: 'current'}).data().reduce(function(a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0);
            // Ubah nilai total ke format mata uang "Rp. 50.000"
            var formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
            $(api.column(4).footer()).html(formattedTotal);
            },
            initComplete: function(settings, json) {
                setfunction();
            }
        });
        function setfunction() {
            $(".delete_link").click(function(e) {
                e.preventDefault();
                var linkdelete = $(this).attr("href");
                var id = $(this).attr("data-id");
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengembalikan ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: linkdelete,
                            type: 'post',
                            data: { id: id },
                            success: function(data) {
                                if (data.success) {
                                    list_tbl.ajax.reload();
                                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                                }
                            },
                            error: function() {
                                Swal.fire("Error!", "Something went wrong.", "danger");
                            }
                        });
                    }
                });
            });

            $(".edit_link").click(function(e) {
                e.preventDefault();
                $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
            });
        }
    });
        
        
    

    // $(document).ready(function() {});
    $('#customer_id').select2({
        placeholder: 'Select Customer',
        ajax: {
            url: '/search-customers',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    @if(Request::ajax())
    var form = $('#transaksi-form');
    form.on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                if (data['success']) {
                    Swal.fire({
                        icon: "success",
                        title: "Successful",
                        text: data['msg']
                    });
                    
                    
                    
                    if ($('#created_by').length > 0){
                        $('#modal-form-address').modal('hide');
                        console.log(data['data']['id']);
                        var customername = data['data']['first_name']+" "+data['data']['last_name'];
                        var customerid = data['data']['id'];
                        $("#created_by").select2("trigger", "select", {data: { id: customerid, text: customername }});
                    }else{
                        $('#modal-form').modal('hide');
                        list_tbl.ajax.reload(function(json) {
                           setfunction();
                        });
                    }
                   


                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Failed",
                        text: data['msg'],
                    });


                    var $input = $('#transaksi-form input, #transaksi-form textarea');
                    $input.each(function() {
                        $input.removeClass('is-invalid');
                        $input.addClass('is-valid');
                    });

                    var $error_text = $("div[data-validator='error']");
                    $error_text.each(function() {
                        $error_text.text("");
                    });

                    $.each(data['errors'], function(key, val) {
                        $("#" + key + "").addClass("is-invalid");
                        $("div[data-field='" + key + "']").text(val);

                    });
                }
            },
            error: function(e) {
                Swal.fire({
                    icon: "danger",
                    title: "Failed",
                    text: e,
                });
            }
        });
    });
    @endif
    var tm_global = function(item) {
        if (!item.id) {
            return item.text;
        }
        if (item.loading) {
            return param.text;
        }
        var span = document.createElement('span');
        var template = '';
        template += item.text;
        span.innerHTML = template;
        return $(span);
    }

    function updateUnitWaktuSewa() {
        var jenisSewa = document.getElementById('jenis_sewa').value;
        var spanText = '';

        switch (jenisSewa) {
            case '1':
                spanText = 'Hari';
                break;
            case '2':
                spanText = 'Minggu';
                break;
            case '3':
                spanText = 'Bulan';
                break;
            default:
                spanText = '';
        }

        document.getElementById('waktu_sewa_unit').textContent = spanText;
    }

    // Panggil fungsi saat halaman dimuat untuk memastikan unit waktu sewa sesuai dengan jenis sewa yang dipilih
    updateUnitWaktuSewa();

    // Tambahkan event listener ke lama_sewa untuk memanggil fungsi saat nilai berubah
    document.getElementById('lama_sewa').addEventListener('input', function () {
        updateUnitWaktuSewa();
    });

    // Tambahkan event listener ke jenis_sewa untuk memanggil fungsi saat nilai berubah
    document.getElementById('jenis_sewa').addEventListener('change', function () {
        updateUnitWaktuSewa();
    });

        document.getElementById('lama_sewa').addEventListener('input', function() {
            updateBookingEnd();
        });

        function updateBookingEnd() {
            var bookingDate = new Date(document.getElementById('booking_date').value);
            var jenisSewa = parseInt(document.getElementById('jenis_sewa').value);
            var lamaSewa = parseInt(document.getElementById('lama_sewa').value);
            var bookingEnd = new Date(bookingDate);

            switch(jenisSewa) {
                case 1: // Harian
                    bookingEnd.setDate(bookingEnd.getDate() + lamaSewa);
                    break;
                case 2: // Mingguan
                    bookingEnd.setDate(bookingEnd.getDate() + (lamaSewa * 7));
                    break;
                case 3: // Bulanan
                    bookingEnd.setMonth(bookingEnd.getMonth() + lamaSewa);
                    break;
                default:
                    break;
            }

            var formattedBookingEnd = bookingEnd.toISOString().split('T')[0];
            document.getElementById('booking_end').value = formattedBookingEnd;
        }
    
    // UNTUK TOTAL_BIAYA
    function updateTotalBiaya() {
        var jenisSewa = parseInt(document.getElementById('jenis_sewa').value);
        var lamaSewa = parseInt(document.getElementById('lama_sewa').value);
        var hargaSewa = 0;

        // Mendapatkan harga sewa berdasarkan jenis sewa yang dipilih
        switch(jenisSewa) {
            case 1: // Harian
                hargaSewa = parseFloat(document.getElementById('sewa_harian').value);
                break;
            case 2: // Mingguan
                hargaSewa = parseFloat(document.getElementById('sewa_mingguan').value);
                break;
            case 3: // Bulanan
                hargaSewa = parseFloat(document.getElementById('sewa_bulanan').value);
                break;
            default:
                break;
        }

        // Memastikan harga sewa tidak kosong sebelum melakukan perhitungan
        if (isNaN(hargaSewa) || isNaN(lamaSewa)) {
            document.getElementById('total_biaya').value = ''; // Kosongkan nilai total biaya
            return; // Hentikan eksekusi fungsi
        }

        // Menghitung total biaya
        var totalBiaya = hargaSewa * lamaSewa;

        // Menampilkan total biaya
        document.getElementById('total_biaya').value = totalBiaya.toFixed(2); // Menampilkan 2 digit desimal
    }

    // Event listener untuk perubahan jenis sewa
    document.getElementById('jenis_sewa').addEventListener('change', function() {
        updateTotalBiaya(); // Memanggil fungsi updateTotalBiaya() setiap kali jenis sewa berubah
    });

    // Event listener untuk input lama sewa
    document.getElementById('lama_sewa').addEventListener('input', function() {
        updateTotalBiaya(); // Memanggil fungsi updateTotalBiaya() setiap kali input lama sewa berubah
    });

    // Memanggil fungsi updateTotalBiaya() saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updateTotalBiaya();
    });

    //RECEIPT
    $(".btnaddpayment").click(function(e) {
        //alert("click");
        showModalAddPayment();
    });

    function showModalAddPayment(){
            var transaksiid = "{{$post->id}}";
            //alert(pre_alert_id);
            if (transaksiid == "" || transaksiid == null){
                            Swal.fire({
                                icon: "warning"
                                , title: "Warning"
                                , text: "Payment Unavailable!!"
                            });
                            return;
            }
          
           var link = "{{route('kwitansi.vcreate',':id')}}";
               link = link.replace(":id", transaksiid);

            $("#modal-form").modal("show").find(".modal-content").load(link);
            $('#modal-form').removeAttr('tabindex');
    }

    //BUKTI BAYAR
    $(".btnbayar").click(function(e) {
        //alert("click");
        showModalBayar();
    });
    function showModalBayar(){
            var transaksiid = "{{$post->id}}";
            //alert(pre_alert_id);
            if (transaksiid == "" || transaksiid == null){
                            Swal.fire({
                                icon: "warning"
                                , title: "Warning"
                                , text: "Payment Unavailable!!"
                            });
                            return;
            }
          
           var link = "{{route('transaksi.vbayar',':id')}}";
               link = link.replace(":id", transaksiid);

            $("#modal-form").modal("show").find(".modal-content").load(link);
            $('#modal-form').removeAttr('tabindex');
    }

</script>
@endsection