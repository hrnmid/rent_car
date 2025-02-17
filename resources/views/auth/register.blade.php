@extends(Request::ajax() ? 'layout.ajax' : 'layout.main2')

@section('content')
{{ Form::model($post, ['route' => ['register.vstore'], 'method' => 'post', 'id' => 'register-form']) }}
   
    <div class="modal-body">
        <div class="row mt-6">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-label">Buat Akun Anda </div>
                        </div>
                    </div>
                    <div class="card-body">
                       {!! Form::hidden('id', old('id', isset($post) ? $post->id : ''), ['class' => 'form-control'. ( $errors->has('id') ? ' is-invalid' : '' )]) !!}

                        <div class="form-group row">
                            <div class="col-md-6">
                                {!! Form::label('first_name', 'Nama depan', ['class' => 'form-control-label']) !!}
                                {!! Form::text('first_name', old('first_name', isset($post) ? $post->first_name : ''),
                                ['class' => "form-control". ( $errors->has('first_name') ? ' is-invalid' : '' ), 'placeholder' => 'Nama depan']) !!}
                                <div class="fv-plugins-message-container">
                                    <div data-field="first_name" data-validator="error" class="fv-help-block">
                                        @error('first_name') {{ $message }} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('last_name', 'Nama belakang', ['class' => 'form-control-label']) !!}
                                {!! Form::text('last_name', old('last_name', isset($post) ? $post->last_name : ''),
                                ['class' => "form-control". ( $errors->has('last_name') ? ' is-invalid' : '' ), 'placeholder' => 'Nama belakang']) !!}
                                <div class="fv-plugins-message-container">
                                    <div data-field="last_name" data-validator="error" class="fv-help-block">
                                        @error('last_name') {{ $message }} @enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                {!! Form::label('phone', 'Nomor Hp', ['class' => 'form-control-label']) !!}
                                {!! Form::text('phone', old('phone', isset($post) ? $post->phone : ''),
                                ['class' => 'form-control'. ( $errors->has('phone') ? ' is-invalid' : '' ), 'placeholder' => 'Nomor Telepon']) !!}
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
                            <div class="col-md-6">
                                {!! Form::label('password', 'Kata sandi', ['class' => 'form-control-label']) !!}
                                <div class="input-group">
                                    {!! Form::password('password', ['class' => 'form-control'. ( $errors->has('password') ? ' is-invalid' : '' ), 'id' => 'password-input', 'placeholder' => 'Kata sandi']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fv-plugins-message-container">
                                    <div data-field="password" data-validator="error" class="fv-help-block">
                                        @error('password') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('password_confirmation', 'Konfirmasi sandi', ['class' => 'form-control-label']) !!}
                                <div class="input-group">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control'. ( $errors->has('password_confirmation') ? ' is-invalid' : '' ), 'id' => 'password-confirmation-input', 'placeholder' => 'Konfirmasi sandi']) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-confirm-password">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fv-plugins-message-container">
                                    <div data-field="password_confirmation" data-validator="error" class="fv-help-block">
                                        @error('password_confirmation') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                {!! Form::label('address', 'Alamat', ['class' => 'form-control-label']) !!}
                                {!! Form::textarea('address', old('address', isset($post) ? $post->address : ''), [
                                'class' => 'form-control'. ( $errors->has('address') ? ' is-invalid' : '' ),
                                'rows' => 2,
                                'cols' => 40,
                                'placeholder' => 'Alamat',
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
                                {!! Form::label('postal_code', 'Kode Pos', ['class' => 'form-control-label']) !!}
                                {!! Form::text('postal_code', old('postal_code', isset($post) ? $post->postal_code : ''), [
                                'class' => 'form-control'. ( $errors->has('postal_code') ? ' is-invalid' : '' ), 'placeholder' => 'Kode Pos'
                                ]) !!}
                                <div class="fv-plugins-message-container">
                                    <div data-field="postal_code" data-validator="error" class="fv-help-block">
                                        @error('postal_code') {{ $message }} @enderror</div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            @if(Request::ajax())
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            @endif
                            <a href="/" class="btn btn-light font-weight-bold">Cancel</a>
                            {{ Form::button('Create Account', ['class' => 'btn btn-primary font-weight-bold', 'type' => 'submit']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        @if(Request::ajax())
        var form = $('#register-form');
        form.on('submit', function(e) {
            e.preventDefault();

            // Validate password and confirm password match
            var password = $('#password-input').val();
            var confirmPassword = $('#password-confirmation-input').val();
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: "error",
                    title: "Failed",
                    text: "Passwords do not match!",
                });
                return;
            }

            var formData = form.serialize();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data['success']) {
                        Swal.fire({
                            icon: "success",
                            title: "Successful",
                            text: data['msg']
                        });

                        // Redirect to the login page
                        window.location.href = "{{ route('login') }}";
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed",
                            text: data['msg'],
                        });

                        var $input = $('#register-form input, #register-form textarea');
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

        // Toggle password visibility
        $('#toggle-password').click(function() {
            var passwordInput = $('#password-input');
            var icon = $(this).find('i');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggle-confirm-password').click(function() {
            var passwordInput = $('#password-confirmation-input');
            var icon = $(this).find('i');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endsection
