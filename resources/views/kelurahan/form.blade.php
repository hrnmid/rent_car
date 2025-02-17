@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Kelurahan
            </h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200">

            </div>
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
{{ Form::model($post, ['route' => ['kelurahan.vstore'], 'method' => 'post', 'id' => 'kelurahan-form']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            @if (!isset($post))
            Add
            @else
            Edit
            @endif Kelurahan
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
            {!! Form::hidden('id', old('id', isset($post) ? $post->id : ''), ['class' => 'form-control'. ( $errors->has('name') ? ' is-invalid' : '' )]) !!}
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}
                    {!! Form::text('name', old('name', isset($post) ? $post->name : ''),
                    ['class' => "form-control". ( $errors->has('name') ? ' is-invalid' : '' )]) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="name" data-validator="error" class="fv-help-block">
                            @error('name') {{ $message }} @enderror</div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('kecamatan_id', 'Kecamatan', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('kecamatan_id', \App\Models\Kecamatan::where('is_active', 1)->pluck('name', 'id'),
                    old('kecamatan_id', isset($post) ? $post->kecamatan_id : ''),
                    [
                        'id' => 'kecamatan_id',
                       'class' => 'form-control'. ( $errors->has('kecamatan_id') ? ' is-invalid' : '' ),'placeholder' => 'Pilih Kecamatan'
                    ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="shipping_mode" data-validator="error" class="fv-help-block">
                            @error('kecamatan_id') {{ $message }} @enderror
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
    var form = $('#kelurahan-form');
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
                    , });


                    var $input = $('#kelurahan-form input, #kelurahan-form textarea');
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
