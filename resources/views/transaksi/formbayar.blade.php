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
{{ Form::model($post, ['route' => ['transaksi.vstorebayar'], 'method' => 'post', 'id' => 'transaksi-form', 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            Upload Bukti Bayar
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
            
            <div class="card-title">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i>  Detail Pemesanan</h3>
            </div>
            <hr>
            <div class="form-group row mt-4">
                <div class="col-md-3">
                    {!! Form::label('booking_date', 'Tanggal Pemesanan', ['class' => 'form-control-label']) !!}
                    {!! Form::date('booking_date', old('booking_date', isset($post) ? $post->booking_date : ''),
                    ['class' => "form-control". ( $errors->has('booking_date') ? ' is-invalid' : '' ), 'id' => 'booking_date' ,'readonly' => 'readonly']) !!}
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

            <div class="card-title mt-10">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i>  Detail Invoice</h3>
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
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center mt-5">
                        <div class="card text-left border-secondary" style="min-height: 150px;"> 
                            <div class="card-body">
                                <div class="card-text">
                                    <p><b>Silakan melakukan pembayaran ke rekening di bawah ini:</b></p>
                                    <ul style="list-style: none; padding-left: 0;">
                                        <li style="display: flex; align-items: center;">
                                            <i class="fa fa-university" style="font-size:48px; color:#007bff;"></i>
                                            <div style="margin-left: 20px;">
                                                <span><b>BANK MANDIRI</b></span>
                                                <br/>
                                                <span>No Rekening : 111111111111111</span>
                                                <br/>
                                                <span>a/n  <b>LAKITAN RENTAL MOBIL</b></span>
                                            </div>
                                        </li>
                                        <li style="margin-top: 20px; display: flex; align-items: center;">
                                            <i class="fa fa-university" style="font-size:48px; color:#007bff;"></i>
                                            <div style="margin-left: 20px;">
                                                <span><b>BANK BCA</b></span>
                                                <br/>
                                                <span>No Rekening : 111111111111111</span>
                                                <br/>
                                                <span>a/n  <b>LAKITAN RENTAL MOBIL</b></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card-title mt-10">
                <h3 class="card-label"><i class="fa fa-paper-plane"></i>  Upload Bukti Bayar</h3>
            </div>
            <hr>
            <div class="form-group row">
                @if(empty($post->payment_jenis) || empty($post->bukti_path))
                    <div class="col-md-4">
                        {!! Form::label('payment_jenis', 'Jenis Pembayaran', ['class' => 'form-control-label']) !!}
                        {!! Form::select('payment_jenis', ['1' => 'Uang Muka', '2' => 'Bayar Lunas'], '', // Mengganti isset($post) ? $post->payment_jenis : '' dengan ''
                            ['class' => "form-control" . ($errors->has('payment_jenis') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Jenis Pembayaran']) !!}
                        <div class="fv-plugins-message-container">
                            <div data-field="payment_jenis" data-validator="error" class="fv-help-block">
                                @error('payment_jenis') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Preview Container -->
                        <label>Preview Bukti Bayar</label>
                        <div id="preview" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                            <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('bukti_path', 'Upload Bukti Bayar', ['class' => 'form-control-label']) !!}
                        {!! Form::file('bukti_path', ['class' => 'form-control' . ($errors->has('bukti_path') ? ' is-invalid' : ''), 'placeholder' => 'Upload Bukti Bayar']) !!}

                        <div class="fv-plugins-message-container">
                            <div data-field="bukti_path" data-validator="error" class="fv-help-block">
                                @error('bukti_path') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                        {!! Form::label('payment_jenis', 'Jenis Pembayaran', ['class' => 'form-control-label']) !!}
                        {!! Form::select('payment_jenis', ['1' => 'Uang Muka', '2' => 'Bayar Lunas'], '', // Mengganti isset($post) ? $post->payment_jenis : '' dengan ''
                            ['class' => "form-control" . ($errors->has('payment_jenis') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Jenis Pembayaran']) !!}
                        <div class="fv-plugins-message-container">
                            <div data-field="payment_jenis" data-validator="error" class="fv-help-block">
                                @error('payment_jenis') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Preview Container -->
                        <label>Preview Bukti Bayar</label>
                        <div id="preview" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                            <img id="preview-image" src="{{ $post->bukti_path }}" alt="Preview" style="max-width: 100%; max-height: 200px;" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Preview Container -->
                        <label>Preview Bukti Bayar 2</label>
                        <div id="preview2" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                            <img id="preview-image2" src="{{ $post->bukti_path2 }}" alt="Preview" style="max-width: 100%; max-height: 200px;" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('bukti_path2', 'Upload Bukti Bayar 2', ['class' => 'form-control-label']) !!}
                        {!! Form::file('bukti_path2', ['class' => 'form-control' . ($errors->has('bukti_path2') ? ' is-invalid' : ''), 'placeholder' => 'Upload Bukti Bayar 2']) !!}

                        <div class="fv-plugins-message-container">
                            <div data-field="bukti_path2" data-validator="error" class="fv-help-block">
                                @error('bukti_path2') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                @endif
            </div>
   
        </div>


        <div class="modal-footer">
            @if(Request::ajax())
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            @endif

            {{ Form::button('Save', ['class' => 'btn btn-primary font-weight-bold', 'type' => 'submit']) }}
        </div>
    </div>
</div>
{{ Form::close() }}

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {});
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
                // Mengarahkan kembali ke halaman yang sama
                window.location.href = window.location.href;
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

    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(previewId).attr('src', e.target.result);
                $(previewId).show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $(previewId).hide();
        }
    }

    // Function to check if there is an existing image and display it in the preview
    function displayExistingImage(existingImagePath, previewId) {
        if (existingImagePath) {
            $(previewId).attr('src', existingImagePath);
            $(previewId).show();
        }
    }

    // Call the function to display the existing image if present for bukti_path
    displayExistingImage("{{ isset($post) ? asset($post->bukti_path) : '' }}", "#preview-image");

    // Call the function to display the existing image if present for bukti_path2
    displayExistingImage("{{ isset($post) ? asset($post->bukti_path2) : '' }}", "#preview-image2");

    // Trigger the readURL function when any file input changes
    $("input[name='bukti_path']").change(function() {
        readURL(this, "#preview-image");
    });

    // Trigger the readURL function when any file input changes for bukti_path2
    $("input[name='bukti_path2']").change(function() {
        readURL(this, "#preview-image2");
    });

</script>
@endsection