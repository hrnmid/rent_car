<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    {{-- <title>Login | LAKITAN RENTAL</title> --}}
    <title>Login | RENTCARS</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="images/mobil.png" />
    <link rel="canonical" href="#" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->

    <style type="text/css">
        body {
            height: 100%;
            overflow: hidden;
        }

        .login-tracking {
            display: none;
        }

        .login-content {
            overflow: hidden;
        }

        .login-container {
            display: flex;
            width: 100%;
            height: 100vh;
            flex-direction: row;
        }

        .login-aside, .login-content {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-aside {
            background-color: #F3F6F9;
        }

        .aside-img {
            width: 80%;
            height: 80%;
            background-image: url('images/logocon.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        @media only screen and (max-width: 767px) {
            body {
                overflow: auto;
            }

            .login-container {
                flex-direction: column;
                height: auto;
            }

            .login-aside, .login-content {
                width: 100%;
                height: auto;
            }

            .aside-img {
                height: 50vh;
                margin-top: 0;
            }
        }
    </style>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login-container" id="kt_login">
            <div class="login-aside">
                <div class="aside-img"></div>
            </div>
            <div class="login-content p-7 mx-auto">
                <div class="d-flex flex-column-fluid flex-center">
                    <div class="login-form login-signin">
                        <form action="{{ route('authenticate') }}" method="post">
                            @csrf
                            <div class="pb-4 pt-lg-0 pt-5">
                                {{-- <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Selamat datang di Lakitan Rental</h3> --}}
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Selamat datang di RENTCARS</h3>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('email') is-invalid @enderror form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email" autocomplete="off" style="border: 1px solid #ccc;">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group position-relative">
                                <input type="password" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" id="password" placeholder="Password" name="password" style="border: 1px solid #ccc;">
                                <span class="position-absolute eye-toggle" style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </span>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="pb-lg-0 pb-5 text-center">
                                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-5 py-3 my-3">Masuk</button>
                            </div>
                        </form>

                        <!-- Separator Line -->
                        <div class="d-flex align-items-center justify-content-center my-4">
                            <hr class="w-100">
                            <span class="mx-2">atau</span>
                            <hr class="w-100">
                        </div>

                        <!-- Create New Account Button -->
                        <div class="d-flex align-items-center justify-content-center pb-5">
                            <a href="{{ route('register') }}" class="btn btn-success font-weight-bolder font-size-h6 px-5 py-3">Buat akun baru</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Selecting the necessary elements
            var loginForm = document.querySelector('.login-signin');
            var forgotForm = document.querySelector('.login-forgot');
            var TrackingForm = document.querySelector('.login-tracking');
            var TrackingLink = document.getElementById('kt_tracking');
            var forgotLink = document.getElementById('kt_login_forgot');
            var submitTrackingBtn = document.getElementById('kt_tracking_submit');
            var cancelForgotBtn = document.getElementById('kt_login_forgot_cancel');
            var cancelTrackingBtn = document.getElementById('kt_tracking_cancel');

            // Function to show the forgot password form
            function showForgotForm() {
                loginForm.style.display = 'none';
                TrackingForm.style.display = 'none';
                forgotForm.style.display = 'block';
            }

            // Function to show the login form
            function showLoginForm() {
                loginForm.style.display = 'block';
                TrackingForm.style.display = 'none';
                forgotForm.style.display = 'none';
            }
            // Function to show the Tracking form
            function showTrackingForm() {
                loginForm.style.display = 'none';
                TrackingForm.style.display = 'block';
                forgotForm.style.display = 'none';
            }
            

            // Event listener for the "Forgot Password?" link
            submitTrackingBtn.addEventListener('click', function (e) {
                submitTracking();
            });
            // Event listener for the "Forgot Password?" link
            forgotLink.addEventListener('click', function (e) {
                e.preventDefault();
                showForgotForm();
            });

            TrackingLink.addEventListener('click', function (e) {
                e.preventDefault();
                showTrackingForm();
            });



            // Event listener for the "Cancel" button in the forgot password form
            cancelForgotBtn.addEventListener('click', function (e) {
                e.preventDefault();
                showLoginForm();
            });
            cancelTrackingBtn.addEventListener('click', function (e) {
                e.preventDefault();
                showLoginForm();
            });
        });

        // FITUR MATA PASSWORD
         document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil parameter query string
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');

            // Jika parameter success bernilai 1, tampilkan pesan sukses
            if (success === '1') {
                alert('Pendaftaran berhasil! Akun Anda sudah aktif.');
            }
        });
    </script>

</body>

</html>