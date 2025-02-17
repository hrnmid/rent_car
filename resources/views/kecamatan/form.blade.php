@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Kecamatan
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
{{ Form::model($post, ['route' => ['kecamatan.vstore'], 'method' => 'post', 'id' => 'kecamatan-form']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            @if (!isset($post))
            Add
            @else
            Edit
            @endif Kecamatan
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
                <div class="col-md-6">
                    {!! Form::label('name', 'Nama Kecamatan', ['class' => 'form-control-label']) !!}
                    {!! Form::text('name', old('name', isset($post) ? $post->name : ''),
                    ['class' => "form-control". ( $errors->has('name') ? ' is-invalid' : '' ), 'placeholder' => 'Nama Kecamatan']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="name" data-validator="error" class="fv-help-block">
                            @error('name') {{ $message }} @enderror</div>
                    </div>

                </div>
                <div class="col-md-6">
                    {!! Form::label('kode', 'Kode Kecamatan', ['class' => 'form-control-label']) !!}
                    {!! Form::text('kode', old('kode', isset($post) ? $post->kode : ''),
                    ['class' => "form-control". ( $errors->has('kode') ? ' is-invalid' : '' ), 'placeholder' => 'Kode Kecamatan']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="kode" data-validator="error" class="fv-help-block">
                            @error('kode') {{ $message }} @enderror</div>
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
    var form = $('#kecamatan-form');
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


                    var $input = $('#kecamatan-form input, #kecamatan-form textarea');
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

    var tm_country = function(item) {
        if (item.loading) return "Searching...";
        if (!item.id) {
            return item.code + " " + item.text;
        }


        var span = document.createElement('span');
        var template = '';
        template += item.code + " " + item.text;
        span.innerHTML = template;
        return $(span);
    }


    $("#country_id").select2({
        allowClear: true
        , dropdownAutoWidth: true,
        //minimumInputLength: 3,
        ajax: {
            url: "{{ route('load.countryy') }}"
            , delay: 250
            , data: function(params) {
                return {
                    q: params.term
                    , page: params.page
                }
            }
            , processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: (data.items)
                    , pagination: {
                        more: (params.page * 10) < data.totalcount
                    }
                };
            }
        , }
        , formatSelection: tm_country
        , formatResult: tm_country
        , templateResult: tm_country
            // , templateSelection: tm_country
        , cache: true
    });

</script>
@endsection
