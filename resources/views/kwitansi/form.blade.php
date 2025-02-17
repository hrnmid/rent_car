@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Kuitansi
            </h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200">

            </div>
            {{-- @if (isset($post))
            &nbsp;Add
            @else
            &nbsp;Edit
            @endif --}}
            <!--end::Separator-->
        </div>
    </div>
</div>

<!--end::Dashboard-->
@endsection

@section('content')
{{ Form::model($post, ['route' => ['kwitansi.vstore'], 'method' => 'post', 'id' => 'kwitansi-form']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            Tambah Kuitansi
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        @if ($errors->any())


        <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
            <div class="alert-icon">
                <i class='fa fa-warning'></i> </div>
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
            <div class="card-title">
                <h3 class="card-label">
                    INVOICE # {{$transaksi->invoice_no}}
                    -
                    <span class="text-success">{{$transaksi->customer_name}}</span> dengan total pembayaran <span class="text-warning">{{$transaksi->total_biaya}}</span>
                </h3>
            </div>
            {!! Form::hidden('receipt_id', old('receipt_id', isset($post) ? $post->receipt_id : ''), ['class' => 'form-control'. ( $errors->has('receipt_id') ? ' is-invalid' : '' )]) !!}
            {!! Form::hidden('transaksi_id', $transaksi->id) !!}
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('reeceipt_no', 'Kwitansi No', ['class' => 'font-weight-bold']) !!}
                        {!! Form::text('reeceipt_no', old('reeceipt_no', isset($post) ? $post->reeceipt_no : ''),
                        ['readOnly' =>true,'class' => "form-control". ( $errors->has('reeceipt_no') ? ' is-invalid' : '' ), 'placeholder' => 'Auto']) !!}
                        <div class="fv-plugins-message-container">
                            <div data-field="sender_phone" data-validator="error" class="fv-help-block">
                                @error('reeceipt_no') {{ $message }} @enderror</div>
                        </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('receipt_method', 'Motode Pembayaran', ['class' => 'font-weight-bold']) !!}
                    {!! Form::select('receipt_method', ['1' => 'Cash', '2' => 'Transfer Bank'], old('receipt_method', isset($post) ? $post->receipt_method : ''),
                        ['class' => "form-control" . ($errors->has('receipt_method') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Motode Pembayaran']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="receipt_method" data-validator="error" class="fv-help-block">
                            @error('receipt_method') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('receipt_date', 'Tanggal Kwitansi', ['class' => 'form-control-label']) !!}
                    {!! Form::date('receipt_date', old('receipt_date', isset($post) ? $post->receipt_date : ''),
                    ['class' => "form-control". ( $errors->has('receipt_date') ? ' is-invalid' : '' ), 'id' => 'receipt_date']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="receipt_date" data-validator="error" class="fv-help-block">
                            @error('receipt_date') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {!! Form::label('receipt_status', 'Status Pembayaran', ['class' => 'font-weight-bold']) !!}
                    {!! Form::select('receipt_status', ['1' => 'Uang Muka', '3' => 'Lunas'], old('receipt_status', isset($post) ? $post->receipt_status : ''),
                        ['class' => "form-control" . ($errors->has('receipt_status') ? ' is-invalid' : ''), 'placeholder' => 'Pilih Status Pembayaran']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="receipt_status" data-validator="error" class="fv-help-block">
                            @error('receipt_status') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('total_biaya', 'Jumlah Pembayaran', ['class' => 'font-weight-bold']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        {!! Form::text('total_biaya', $transaksi->total_biaya, ['class' => 'form-control']) !!}
                    </div>

                </div>

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
    var form = $('#kwitansi-form');
    form.on('submit', function(e) {
        e.preventDefault();
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action")
            , type: form.attr("method")
            , data: formData
            , success: function(data) {
                console.log(data);
                if (data['success']) {
                    Swal.fire({
                        icon: "success"
                        , title: "Successful"
                        , text: data['msg']
                    }).then((result) => {
                        // Mengarahkan kembali ke halaman yang sama
                        window.location.href = window.location.href;
                    });
                    $('#modal-form').modal('hide');
                    list_tbl.ajax.reload(function(json) {
                        setfunction();
                    });
                } else {
                    Swal.fire({
                        icon: "warning"
                        , title: "Warning"
                        , text: data['msg']
                    });
                    var $input = $('#kwitansi-form input, #kwitansi-form textarea');
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
            }
            , error: function(e) {
                Swal.fire({
                    icon: "error"
                    , title: "Failed"
                    , text: "Something went wrong, please call you Administrator!"
                , });
            }
        });
    });
    @endif
    var tm_global = function(item) {
        if (!item.id) {
            return item.text;
        }

        var span = document.createElement('span');
        var template = '';
        template += item.text;
        span.innerHTML = template;
        return $(span);
    }


</script>
@endsection
