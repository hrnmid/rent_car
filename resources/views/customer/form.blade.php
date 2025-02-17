@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Customer</h5>
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
{{ Form::model($post, ['route' => ['customer.vstore'], 'method' => 'post', 'id' => 'customer-form', 'enctype' => 'multipart/form-data']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            @if (!isset($post))
            Add
            @else
            Edit
            @endif Customer
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
                    {!! Form::label('first_name', 'First Name', ['class' => 'form-control-label']) !!}
                    {!! Form::text('first_name', old('first_name', isset($post) ? $post->first_name : ''),
                    ['class' => "form-control". ( $errors->has('first_name') ? ' is-invalid' : '' ), 'placeholder' => 'First Name']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="first_name" data-validator="error" class="fv-help-block">
                            @error('first_name') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('last_name', 'Last Name', ['class' => 'form-control-label']) !!}
                    {!! Form::text('last_name', old('last_name', isset($post) ? $post->last_name : ''),
                    ['class' => "form-control". ( $errors->has('last_name') ? ' is-invalid' : '' ), 'placeholder' => 'Last Name']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="last_name" data-validator="error" class="fv-help-block">
                            @error('last_name') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {!! Form::label('phone', 'Phone', ['class' => 'form-control-label']) !!}
                    {!! Form::text('phone', old('phone', isset($post) ? $post->phone : ''),
                    ['class' => 'form-control'. ( $errors->has('phone') ? ' is-invalid' : '' ), 'placeholder' => 'Phone Number']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="phone" data-validator="error" class="fv-help-block">
                            @error('phone') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}
                    {!! Form::text('email', old('email', isset($post) ? $post->email : ''),
                    ['class' => 'form-control'. ( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'name@domain.com']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="email" data-validator="error" class="fv-help-block">
                            @error('email') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
                

            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('address', 'Address', ['class' => 'form-control-label']) !!}
                    {!! Form::textarea('address', old('address', isset($post) ? $post->address : ''), [
                    'class' => 'form-control'. ( $errors->has('address') ? ' is-invalid' : '' ),
                    'rows' => 2,
                    'cols' => 40,
                    'placeholder' => 'Address',
                    ]) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="address" data-validator="error" class="fv-help-block">
                            @error('address') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            

            <div class="form-group row">
                <div class="col-md-4">
                    {!! Form::label('kecamatan', 'Kecamatan', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('kecamatan', \App\Models\Kecamatan::where('is_active', 1)->pluck('name', 'id'),
                        old('kecamatan', isset($post) ? $post->kecamatan : null),
                        [
                            'id' => 'kecamatan',
                            'class' => 'form-control'. ( $errors->has('kecamatan') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Kecamatan'
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="kecamatan" data-validator="error" class="fv-help-block">
                            @error('kecamatan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('kelurahan', 'Kelurahan', ['class' => 'font-weight-bold']) !!}
                    {{ Form::select('kelurahan', \App\Models\Kelurahan::where('is_active', 1)->pluck('name', 'id'),
                        old('kelurahan', isset($post) ? $post->kelurahan : null),
                        [
                            'id' => 'kelurahan',
                            'class' => 'form-control'. ( $errors->has('kelurahan') ? ' is-invalid' : '' ), 'placeholder' => 'Pilih Kelurahan'
                        ],) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="kelurahan" data-validator="error" class="fv-help-block">
                            @error('kelurahan') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('postal_code', 'Postal Code', ['class' => 'form-control-label']) !!}
                    {!! Form::text('postal_code', old('postal_code', isset($post) ? $post->postal_code : ''), [
                    'class' => 'form-control'. ( $errors->has('postal_code') ? ' is-invalid' : '' ), 'placeholder' => 'Postal Code'
                    ]) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="postal_code" data-validator="error" class="fv-help-block">
                            @error('postal_code') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <!-- Preview Container -->
                    <label>Preview KYC Document</label>
                    <div id="preview" style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                        <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;" />
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('verif_path', 'Upload KYC Document', ['class' => 'form-control-label']) !!}
                    {!! Form::file('verif_path', ['class' => 'form-control' . ($errors->has('verif_path') ? ' is-invalid' : ''), 'placeholder' => 'Upload KYC Document']) !!}

                    <div class="fv-plugins-message-container">
                        <div data-field="verif_path" data-validator="error" class="fv-help-block">
                            @error('verif_path') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>    
            {{-- <div class="form-group row">
                <label for="kwc_required" class="col-md-4 col-form-label">KWC Required</label>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="form-check">
                        <input type="hidden" name="kwc_required" value="0">
                        <input type="checkbox" class="form-check-input" id="kwc_required_checkbox" name="kwc_required" value="1" @if(old('kwc_required', isset($post) ? $post->kwc_required : '') == '1') checked @endif>
                        <label class="form-check-label" for="kwc_required_checkbox">Check the box if you have verified the data</label>
                    </div>
                </div>
            </div> --}}
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
    var form = $('#customer-form');
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


                    var $input = $('#customer-form input, #customer-form textarea');
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
        var existingImagePath = "{{ isset($post) ? asset($post->verif_path) : '' }}";
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