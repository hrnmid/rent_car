<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LAKITAN RENTAL | @yield('title')</title>
    <link rel="shortcut icon" href="images/mobil.png" />

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" /> -->
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />


    <!--
    <script src="assets/js/jquery-3.7.1.min.js"></script> -->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize aside-minimize-hoverable">
    <!--begin::Main-->
    <!--begin::Header Mobile-->

    
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
       <!--begin::Logo-->
        <a href="/">
            <img alt="Logo" width="100" src="{{ asset('images/logo.png') }}" />
        </a>
        <!--end::Logo-->

        <!--end::Logo-->
        <!--begin::Toolbar-->
        @include('layout.headermobile')
        <!--end::Toolbar-->
    </div>
    <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    
        

                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                    @include('layout.headermobile')

                </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <a href="/" class="brand-logo">
                        <img alt="Logo" width="140" src="{{ asset('images/logocon.png') }}" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside Menu-->
                @include('layout.left')
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('layout.header')
                <!--end::Header-->
                <!--begin::Content-->
                @include('layout.content')
                <!--end::Content-->
                <!--begin::Footer-->
                <div id="kt_footer" class="footer bg-white py-4 d-flex flex-lg-column"><div class="d-flex align-items-center justify-content-between container-fluid"><div class="text-dark"><span class="text-muted font-weight-bold mr-2"> 2024 &nbsp;© </span><a href="/booking" target="_blank" class="text-dark-75 text-hover-primary">LAKITAN RENTAL</a></div></div></div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    @include('layout.quickuser')
    <!-- end::User Panel-->
    <!--begin::Quick Cart-->

    <!--end::Quick Cart-->
    <!--begin::Quick Panel-->

    <!--end::Quick Panel-->
    <!--begin::Chat Panel-->

    <!--end::Chat Panel-->
    <!--begin::Scrolltop-->

    <!--end::Scrolltop-->
    <!--begin::Sticky Toolbar-->

    <!--end::Sticky Toolbar-->
    <!--begin::Demo Panel-->

    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";

    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            breakpoints: {
                sm: 576
                , md: 768
                , lg: 992
                , xl: 1200
                , xxl: 1400
            }
            , colors: {
                theme: {
                    base: {
                        white: "#ffffff"
                        , primary: "#3699FF"
                        , secondary: "#E5EAEE"
                        , success: "#1BC5BD"
                        , info: "#8950FC"
                        , warning: "#FFA800"
                        , danger: "#F64E60"
                        , light: "#E4E6EF"
                        , dark: "#181C32"
                    , }
                    , light: {
                        white: "#ffffff"
                        , primary: "#E1F0FF"
                        , secondary: "#EBEDF3"
                        , success: "#C9F7F5"
                        , info: "#EEE5FF"
                        , warning: "#FFF4DE"
                        , danger: "#FFE2E5"
                        , light: "#F3F6F9"
                        , dark: "#D6D6E0"
                    , }
                    , inverse: {
                        white: "#ffffff"
                        , primary: "#ffffff"
                        , secondary: "#3F4254"
                        , success: "#ffffff"
                        , info: "#ffffff"
                        , warning: "#ffffff"
                        , danger: "#ffffff"
                        , light: "#464E5F"
                        , dark: "#ffffff"
                    , }
                , }
                , gray: {
                    "gray-100": "#F3F6F9"
                    , "gray-200": "#EBEDF3"
                    , "gray-300": "#E4E6EF"
                    , "gray-400": "#D1D3E0"
                    , "gray-500": "#B5B5C3"
                    , "gray-600": "#7E8299"
                    , "gray-700": "#5E6278"
                    , "gray-800": "#3F4254"
                    , "gray-900": "#181C32"
                , }
            , }
            , "font-family": "Poppins"
        , };

    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <!-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    @yield('javascript')
    <!--end::Page Scripts-->
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                , }
            , });
        });
        $(document).ready(function() {

            var current = location.pathname;
            if (current == "/") {
                return;
            }
            $('.menu-nav li').each(function() {
                var $this = $(this);
                //  console.log($this.attr('href').indexOf(current));
                // if the current path is like this link, make it active
                $menu = $this.find('a[class="menu-link"]');
                // console.log(current + "-------" + $menu.attr('href'));

                //if ($menu.attr('href').indexOf(current) !== -1) {
                if ($menu.attr('href') == current) {
                    $this.addClass('menu-item-active');
                }
            })
        });
        @section('javascript')

        @endsection

    </script>
</body>

</html>
