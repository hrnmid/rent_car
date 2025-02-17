@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Mobil
            </h5>
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
{{ Form::model($post, ['route' => ['mobil.vstore'], 'method' => 'post', 'id' => 'mobil-form', 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            @if (!isset($post))
            Add
            @else
            Edit
            @endif Mobil
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
            <div class="form-group row">
                <div class="col-md-6">
                    {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}
                    {!! Form::text('name', old('name', isset($post) ? $post->name : ''),
                    ['class' => "form-control". ( $errors->has('name') ? ' is-invalid' : '' ), 'placeholder' => 'Name']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="name" data-validator="error" class="fv-help-block">
                            @error('name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('merek', 'Merek', ['class' => 'form-control-label']) !!}
                    {!! Form::text('merek', old('merek', isset($post) ? $post->merek : ''),
                    ['class' => "form-control". ( $errors->has('merek') ? ' is-invalid' : '' ), 'placeholder' => 'Merek Mobil']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="merek" data-validator="error" class="fv-help-block">
                            @error('merek') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('type', 'Type', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('type', \App\Models\Mobiltype::where('is_active', 1)->pluck('name', 'id'),
                        old('type', isset($post) ? $post->type : null),
                        [
                            'id' => 'type',
                            'class' => 'form-control'. ( $errors->has('type') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Type'
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="type" data-validator="error" class="fv-help-block">
                            @error('type') {{ $message }} @enderror
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    {!! Form::label('warna', 'Warna', ['class' => 'form-control-label']) !!}
                    {!! Form::text('warna', old('warna', isset($post) ? $post->warna : ''),
                    ['class' => 'form-control'. ( $errors->has('warna') ? ' is-invalid' : '' ), 'placeholder' => 'Warna Mobil']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="warna" data-validator="error" class="fv-help-block">
                            @error('warna') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('no_plat', 'Nomor Plat', ['class' => 'form-control-label']) !!}
                    {!! Form::text('no_plat', old('no_plat', isset($post) ? $post->no_plat : ''),
                    ['class' => 'form-control'. ( $errors->has('no_plat') ? ' is-invalid' : '' ), 'placeholder' => 'Nomor Plat Mobil']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="no_plat" data-validator="error" class="fv-help-block">
                            @error('no_plat') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {!! Form::label('tahun_produksi', 'Tahun Produksi', ['class' => 'form-control-label']) !!}
                    {!! Form::text('tahun_produksi', old('tahun_produksi', isset($post) ? $post->tahun_produksi : ''),
                    ['class' => 'form-control'. ( $errors->has('tahun_produksi') ? ' is-invalid' : '' ), 'placeholder' => 'Tahun Produksi']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="tahun_produksi" data-validator="error" class="fv-help-block">
                            @error('tahun_produksi') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('status', 'Status Mobil', ['class' => 'form-control-label']) !!}
                    {!! Form::select('status', 
                        [1 => 'Tersedia', 2 => 'Tidak Tersedia', 3 => 'Perawatan'], 
                        old('status', isset($post) ? $post->status : ''), 
                        ['class' => 'form-control'. ( $errors->has('status') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Status']
                    ) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="status" data-validator="error" class="fv-help-block">
                            @error('status') {{ $message }} @enderror
                        </div>
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
                            ['class' => 'form-control'. ( $errors->has('sewa_harian') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa']) !!}
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
                            ['class' => 'form-control'. ( $errors->has('sewa_mingguan') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa']) !!}
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
                            ['class' => 'form-control'. ( $errors->has('sewa_bulanan') ? ' is-invalid' : '' ), 'placeholder' => 'Harga Sewa']) !!}
                    </div>
                    <div class="fv-plugins-message-container">
                        <div data-field="sewa_bulanan" data-validator="error" class="fv-help-block">
                            @error('sewa_bulanan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <!-- Preview Container -->
                    <label>Preview Image</label>
                    <div id="preview" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                        <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;" />
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('mobil_path', 'Upload File Mobil', ['class' => 'form-control-label']) !!}
                    {!! Form::file('mobil_path', ['class' => 'form-control' . ($errors->has('mobil_path') ? ' is-invalid' : ''), 'placeholder' => 'Upload File Mobil']) !!}

                    <div class="fv-plugins-message-container">
                        <div data-field="mobil_path" data-validator="error" class="fv-help-block">
                            @error('mobil_path') {{ $message }} @enderror
                        </div>
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
    var form = $('#mobil-form');
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
                    $('#modal-form').modal('hide');
                    list_tbl.ajax.reload(function(json) {
                        setfunction();
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning",
                        text: data['msg']
                    });
                    var $input = $('#mobil-form input, #mobil-form textarea');
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
                    icon: "error",
                    title: "Failed",
                    text: "Something went wrong, please call your Administrator!"
                });
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#preview-image').show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview-image').hide();
        }
    }

    // Function to check if there is an existing image and display it in the preview
    function displayExistingImage() {
        var existingImagePath = "{{ isset($post) ? asset($post->mobil_path) : '' }}";
        if (existingImagePath) {
            $('#preview-image').attr('src', existingImagePath);
            $('#preview-image').show();
        }
    }

    // Call the function to display the existing image if present
    displayExistingImage();
    
    // Trigger the readURL function when any file input changes
    $("input[type='file']").change(function() {
        readURL(this);
    });

</script>
@endsection
