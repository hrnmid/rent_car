@extends(Request::ajax() ? 'layout.ajax' : 'layout.main')
@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                User
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
{{ Form::model($post, ['route' => ['user.vstore'], 'method' => 'post', 'id' => 'user-form']) }}
<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">
            @if (isset($post))
            Add
            @else
            Edit
            @endif User
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
            {!! Form::hidden('id', old('id', isset($post) ? $post->id : ''), ['class' => 'form-control'. ( $errors->has('id') ? ' is-invalid' : '' )]) !!}
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('first_name', 'Name', ['class' => 'form-control-label']) !!}
                    {!! Form::text('first_name', old('first_name', isset($post) ? $post->first_name : ''),
                    ['class' => "form-control". ( $errors->has('first_name') ? ' is-invalid' : '' ), 'placeholder' => 'Name']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="first_name" data-validator="error" class="fv-help-block">
                            @error('first_name') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('email', 'Email', ['class' => 'form-control-label']) !!}
                    {!! Form::text('email', old('email', isset($post) ? $post->email : ''),
                    ['class' => 'form-control'. ( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'Email']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="email" data-validator="error" class="fv-help-block">
                            @error('email') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('password', 'Password', ['class' => 'form-control-label']) !!}
                    <div class="input-group">
                        {!! Form::password('password', ['class' => 'form-control'. ( $errors->has('password') ? ' is-invalid' : '' ), 'placeholder' => 'Password', 'id' => 'password']) !!}
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
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
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('branch_id', 'Branch', ['class' => 'form-control-label']) !!}
                    {{ Form::select('branch_id',
                        \App\Models\Branch::where('is_active', 1)->pluck('name', 'id')->prepend('Choose Branch', ''),
                        old('branch_id', isset($post) ? $post->branch_id : ''),
                        [
                            'id' => 'branch_id',
                            'class' => 'form-control'. ( $errors->has('branch_id') ? ' is-invalid' : '' ),
                        ],
                    ) }}
                    <div class="fv-plugins-message-container">
                        <div data-field="branch_id" data-validator="error" class="fv-help-block">
                            @error('branch_id') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label">Role</label>
                <div class="col-md-8">
                    {!! Form::select('role', ['' => '- Select Role -', '1' => 'Branch Manager', '2' => 'Staff'], old('role', isset($post) ? $post->role : ''), ['class' => 'form-control'. ($errors->has('role') ? ' is-invalid' : ''), 'id' => 'role']) !!}
                    <div class="fv-plugins-message-container">
                        <div data-field="role" data-validator="error" class="fv-help-block">
                            @error('role') {{ $message }} @enderror</div>
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
    var form = $('#user-form');
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
                    });
                    var $input = $('#user-form input, #user-form textarea');
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
    
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fa fa-eye" aria-hidden="true"></i>' : '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    });
    
</script>
@endsection
