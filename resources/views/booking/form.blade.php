@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Transaksi</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            @if (isset($post))
            &nbsp;Add
            @else
            &nbsp;Edit
            @endif
            <!--end::Separator-->
        </div>
    </div>
</div>

<!--end::Dashboard-->
@endsection

@section('content')
{{ Form::model($post, ['route' => ['booking.vstore'], 'method' => 'post', 'id' => 'transaksi-form', 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            Formulir Penyewaan
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        @if ($errors->any())

        <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
            <div class="alert-icon">
                <i class='fa fa-warning'></i>
            </div>
            <div class="alert-text ">
                <ul class='fv-plugins-message-container'>
                    @foreach ($errors->all() as $error)
                    <li class='fv-help-block'>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif
        <div class="card-body">
            {!! Form::hidden('id', old('id', isset($post) ? $post->id : ''), ['class' => 'form-control'. ( $errors->has('id') ? ' is-invalid' : '' )]) !!}
            {!! Form::hidden('customer_id', auth()->user()->id, ['class' => 'form-control']) !!}

            <div class="card-title">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i> Informasi Pelanggan</h3>
            </div>
            {{-- <hr style="border-top: 1px solid #000;"> --}}
            <hr>

            <div class="form-group row mt-4">
                <div class="col-md-6">
                    {!! Form::label('customer_name', 'Name Customer', ['class' => 'form-control-label']) !!}
                    {!! Form::text('customer_name', auth()->user()->name,
                    ['class' => "form-control". ( $errors->has('customer_name') ? ' is-invalid' : '' ), 'placeholder' => 'Name Customer']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_name" data-validator="error" class="fv-help-block">
                            @error('customer_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('customer_ktp', 'Nomor Induk Kependudukan', ['class' => 'form-control-label']) !!}
                    {!! Form::text('customer_ktp', old('customer_ktp', isset($post) ? $post->customer_ktp : ''),
                    ['class' => "form-control". ( $errors->has('customer_ktp') ? ' is-invalid' : '' ), 'placeholder' => 'Nomor Induk Kependudukan']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_ktp" data-validator="error" class="fv-help-block">
                            @error('customer_ktp') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('customer_phone', 'Phone', ['class' => 'form-control-label']) !!}
                    {!! Form::text('customer_phone', auth()->user()->phone,
                    ['class' => 'form-control'. ( $errors->has('customer_phone') ? ' is-invalid' : '' ), 'placeholder' => 'Phone Number']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_phone" data-validator="error" class="fv-help-block">
                            @error('customer_phone') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('customer_email', 'Email', ['class' => 'form-control-label']) !!}
                    {!! Form::text('customer_email', auth()->user()->email,
                    ['class' => 'form-control'. ( $errors->has('customer_email') ? ' is-invalid' : '' ), 'placeholder' => 'name@domain.com']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_email" data-validator="error" class="fv-help-block">
                            @error('customer_email') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('customer_address', 'Address', ['class' => 'form-control-label']) !!}
                    {!! Form::textarea('customer_address', auth()->user()->address, [
                    'class' => 'form-control'. ( $errors->has('customer_address') ? ' is-invalid' : '' ),
                    'rows' => 1,
                    'cols' => 40,
                    'placeholder' => 'Address',
                    ]) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_address" data-validator="error" class="fv-help-block">
                            @error('customer_address') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('customer_kecamatan', 'Kecamatan', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('customer_kecamatan', \App\Models\Kecamatan::where('is_active', 1)->pluck('name', 'id'),
                        auth()->user()->kecamatan,
                        [
                            'id' => 'kecamatan',
                            'class' => 'form-control'. ( $errors->has('customer_kecamatan') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Kecamatan'
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_kecamatan" data-validator="error" class="fv-help-block">
                            @error('customer_kecamatan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('customer_kelurahan', 'Kelurahan', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('customer_kelurahan', \App\Models\Kelurahan::where('is_active', 1)->pluck('name', 'id'),
                        auth()->user()->kelurahan,
                        [
                            'id' => 'kelurahan',
                            'class' => 'form-control'. ( $errors->has('customer_kelurahan') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Kelurahan'
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_kelurahan" data-validator="error" class="fv-help-block">
                            @error('customer_kelurahan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('customer_kodepos', 'Postal Code', ['class' => 'form-control-label']) !!}
                    {!! Form::text('customer_kodepos', auth()->user()->postal_code, [
                    'class' => 'form-control'. ( $errors->has('customer_kodepos') ? ' is-invalid' : '' ), 'placeholder' => 'Postal Code'
                    ]) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="customer_kodepos" data-validator="error" class="fv-help-block">
                            @error('customer_kodepos') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="card-title mt-10">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i> Informasi Mobil</h3>
            </div>
            <hr>
            <div class="col-md-4 offset-md-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="font-weight-bold font-size-lg text-right mt-2">Choose Mobil</label>
                    {{-- <a href="{{ route('mobil.vcreate') }}" class="btn btn-light btn-sm btnadduser">
                    <i class="flaticon2-plus"></i> Add Mobil
                    </a> --}}
                </div>
                {!! Form::select('mobil_id', \App\Models\Mobil::where('is_active', 1)->where('status', 1)->pluck('name', 'id'), null, [
                'id' => 'mobil_id',
                'class' => 'form-control',
                'placeholder' => 'Select Mobil'
                ]) !!}
            </div>

            <div class="form-group row mt-4">
                <div class="col-md-6">
                    {!! Form::label('mobil_name', 'Name Mobil', ['class' => 'form-control-label']) !!}
                    {!! Form::text('mobil_name', old('mobil_name', isset($post) ? $post->mobil_name : ''),
                    ['class' => "form-control". ( $errors->has('mobil_name') ? ' is-invalid' : '' ), 'placeholder' => 'Name', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_name" data-validator="error" class="fv-help-block">
                            @error('mobil_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('mobil_merek', 'Merek Mobil', ['class' => 'form-control-label']) !!}
                    {!! Form::text('mobil_merek', old('mobil_merek', isset($post) ? $post->mobil_merek : ''),
                    ['class' => "form-control". ( $errors->has('mobil_merek') ? ' is-invalid' : '' ), 'placeholder' => 'Merek Mobil', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_merek" data-validator="error" class="fv-help-block">
                            @error('mobil_merek') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('mobil_type', 'Type', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('mobil_type', \App\Models\Mobiltype::where('is_active', 1)->pluck('name', 'id'),
                        old('mobil_type', isset($post) ? $post->mobil_type : null),
                        [
                            'id' => 'type',
                            'class' => 'form-control'. ( $errors->has('mobil_type') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Type', 'readonly' => 'readonly' 
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_type" data-validator="error" class="fv-help-block">
                            @error('mobil_type') {{ $message }} @enderror
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    {!! Form::label('mobil_warna', 'Warna', ['class' => 'form-control-label']) !!}
                    {!! Form::text('mobil_warna', old('mobil_warna', isset($post) ? $post->mobil_warna : ''),
                    ['class' => 'form-control'. ( $errors->has('mobil_warna') ? ' is-invalid' : '' ), 'placeholder' => 'Warna Mobil', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_warna" data-validator="error" class="fv-help-block">
                            @error('mobil_warna') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('mobil_noplat', 'Nomor Plat', ['class' => 'form-control-label']) !!}
                    {!! Form::text('mobil_noplat', old('mobil_noplat', isset($post) ? $post->mobil_noplat : ''),
                    ['class' => 'form-control'. ( $errors->has('mobil_noplat') ? ' is-invalid' : '' ), 'placeholder' => 'Nomor Plat', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_noplat" data-validator="error" class="fv-help-block">
                            @error('mobil_noplat') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('sewa_harian', 'Harga Sewa Harian', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        {!! Form::text('sewa_harian', old('sewa_harian', isset($post) ? $post->sewa_harian : ''),
                        ['class' => 'form-control'. ( $errors->has('sewa_harian') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa','readonly' => 'readonly']) !!}
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="sewa_harian" data-validator="error" class="fv-help-block">
                            @error('sewa_harian') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('sewa_mingguan', 'Harga Sewa Mingguan', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        {!! Form::text('sewa_mingguan', old('sewa_mingguan', isset($post) ? $post->sewa_mingguan : ''),
                        ['class' => 'form-control'. ( $errors->has('sewa_mingguan') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa','readonly' => 'readonly']) !!}
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="sewa_mingguan" data-validator="error" class="fv-help-block">
                            @error('sewa_mingguan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('sewa_bulanan', 'Harga Sewa Bulanan', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        {!! Form::text('sewa_bulanan', old('sewa_bulanan', isset($post) ? $post->sewa_bulanan : ''),
                        ['class' => 'form-control'. ( $errors->has('sewa_bulanan') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa','readonly' => 'readonly']) !!}
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="sewa_bulanan" data-validator="error" class="fv-help-block">
                            @error('sewa_bulanan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-title mt-10">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i> Informasi Penyewaan</h3>
            </div>
            <hr>
            <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('booking_date', 'Tanggal Pemesanan', ['class' => 'form-control-label']) !!}
                    {!! Form::date('booking_date', old('booking_date', isset($post) ? $post->booking_date : ''),
                    ['class' => "form-control". ( $errors->has('booking_date') ? ' is-invalid' : '' ), 'id' => 'booking_date']) !!}
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
                    ['class' => "form-control". ( $errors->has('jenis_sewa') ? ' is-invalid' : '' ), 'id' => 'jenis_sewa', 'placeholder' => 'Pilih Jenis Sewa']) !!}
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
                        ['class' => "form-control". ( $errors->has('lama_sewa') ? ' is-invalid' : '' ), 'placeholder' => 'Waktu Sewa']) !!}
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
                    ['class' => "form-control" . ($errors->has('guarantee') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Jenis Jaminan']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="guarantee" data-validator="error" class="fv-help-block">
                            @error('guarantee') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    {!! Form::label('payment_mode', 'Motode Pembayaran', ['class' => 'form-control-label']) !!}
                    {!! Form::select('payment_mode', ['1' => 'Cash', '2' => 'Transfer Bank'], old('payment_mode', isset($post) ? $post->payment_mode : ''),
                    ['class' => "form-control" . ($errors->has('payment_mode') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Motode Pembayaran']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="payment_mode" data-validator="error" class="fv-help-block">
                            @error('payment_mode') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    {!! Form::label('booking_destination', 'Tujuan Sewa', ['class' => 'form-control-label']) !!}
                    {!! Form::text('booking_destination', old('booking_destination', isset($post) ? $post->booking_destination : ''),
                    ['class' => "form-control". ( $errors->has('booking_destination') ? ' is-invalid' : '' ), 'placeholder' => 'Tujuan Sewa']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="booking_destination" data-validator="error" class="fv-help-block">
                            @error('booking_destination') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="card-title mt-10">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i> Informasi Faktur</h3>
            </div>
            <hr>
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
                    {!! Form::date('invoice_date', old('invoice_date', isset($post) ? $post->invoice_date : date('Y-m-d')),
                    ['class' => "form-control" . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'id' => 'invoice_date', 'readonly' => 'readonly']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="invoice_date" data-validator="error" class="fv-help-block">
                            @error('invoice_date') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('invoice_due', 'Jatuh Tempo Invoice', ['class' => 'form-control-label']) !!}
                    {!! Form::date('invoice_due', old('invoice_due', isset($post) ? $post->invoice_due : date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d'))))),
                    ['class' => "form-control" . ($errors->has('invoice_due') ? ' is-invalid' : ''), 'id' => 'invoice_due', 'readonly' => 'readonly']) !!}
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
        </div>


        <div class="modal-footer">
            @if(Request::ajax())
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
            @endif

            {{ Form::button('Simpan', ['class' => 'btn btn-primary font-weight-bold', 'type' => 'submit']) }}
        </div>
    </div>
</div>
{{ Form::close() }}

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {});
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


    $('#mobil_id').on('change', function() {
        var mobilId = $(this).val();
        if (mobilId) {
            $.ajax({
                url: '/mobilss/' + mobilId, // Adjust the URL as needed
                type: 'GET',
                success: function(data) {
                    if (data) {
                        $('#mobil_name').val(data.mobil_name);
                        $('#mobil_merek').val(data.mobil_merek);
                        $('#type').val(data.type).trigger('change');
                        $('#mobil_warna').val(data.mobil_warna);
                        $('#mobil_noplat').val(data.mobil_noplat);
                        $('#sewa_harian').val(data.sewa_harian);
                        $('#sewa_mingguan').val(data.sewa_mingguan);
                        $('#sewa_bulanan').val(data.sewa_bulanan);
                    }
                },
                error: function() {
                    alert('Failed to fetch mobil data');
                }
            });
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
                    // If the submission is successful
                    // Show success notification
                    Swal.fire({
                        icon: "success",
                        title: "Successful",
                        text: data['msg']
                    }).then((result) => {
                        // Redirect the user to the desired page
                        window.location.href = 'mytransaksi/vdetailcus/' + data['data']['id'];
                    });



                    // if ($('#created_by').length > 0){
                    //     $('#modal-form-address').modal('hide');
                    //     console.log(data['data']['id']);
                    //     var customername = data['data']['first_name']+" "+data['data']['last_name'];
                    //     var customerid = data['data']['id'];
                    //     $("#created_by").select2("trigger", "select", {data: { id: customerid, text: customername }});
                    // }else{
                    //     $('#modal-form').modal('hide');
                    //     list_tbl.ajax.reload(function(json) {
                    //        setfunction();
                    //     });
                    // }



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

    $("#kecamatan").select2({
        allowClear: true,
        ajax: {
            url: "{{ route('load.kecamatan') }}",
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalcount
                    }
                };
            },
        },
        templateResult: tm_global,
        templateSelection: tm_global,
    });

    $("#kelurahan").select2({
        allowClear: true,
        ajax: {
            url: "{{ route('load.kelurahan') }}",
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page,
                    kecamatan: $("#kecamatan").val() // Pass selected kecamatan ID
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalcount
                    }
                };
            },
        },
        templateResult: tm_global,
        templateSelection: tm_global,
    });

    // Check if kecamatan is selected before showing kelurahan options
    $('#kelurahan').on('select2:opening', function(e) {
        if (!$("#kecamatan").val()) {
            e.preventDefault(); // Prevent the dropdown from opening
            alert('Silahkan pilih kecamatan terlebih dahulu'); // Show alert
        }
    });

    // Update kelurahan dropdown when kecamatan changes
    $('#kecamatan').on('change', function() {
        $('#kelurahan').val(null).trigger('change');
    });

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
    document.getElementById('lama_sewa').addEventListener('input', function() {
        updateUnitWaktuSewa();
    });

    // Tambahkan event listener ke jenis_sewa untuk memanggil fungsi saat nilai berubah
    document.getElementById('jenis_sewa').addEventListener('change', function() {
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

        switch (jenisSewa) {
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
        switch (jenisSewa) {
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

    // // Mengisi tanggal invoice dengan tanggal hari ini
    document.getElementById('invoice_date').valueAsDate = new Date();

    // Mengisi tanggal invoice_due dengan 1 hari setelahnya
    var invoiceDue = new Date();
    invoiceDue.setDate(invoiceDue.getDate() + 1);
    document.getElementById('invoice_due').valueAsDate = invoiceDue;
</script>
@endsection