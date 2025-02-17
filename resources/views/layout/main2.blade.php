<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LAKITAN RENTAL</title>
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
    
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
   

    {{-- <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed"> --}}
        <!--begin::Logo-->
        <a href="/">
            {{-- <img alt="Logo" width="100" src="assets/media/logos/logo.png" /> --}}
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        {{-- @include('layout.headermobile') --}}
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <div class="navbar-header">
                    <a href="/login" class="navbar-brand logo-w">
                        <img src="images/logo.png" width="120" alt="" class="logo-w">
                    </a>
                </div>
                <div class="navbar-top">
                </div>
            </div>
        </nav>
        <!--begin::Page-->
        {{-- <div class="d-flex flex-row flex-column-fluid page"> --}}
            <!--begin::Aside-->
           
            <!--end::Aside-->
            <!--begin::Wrapper-->
                <!--begin::Header-->
                <!--end::Header-->
                <!--begin::Content-->
                @include('layout.content')
                <!--end::Content-->
                <!--begin::Footer-->
                <div id="kt_footer" class="footer bg-white py-4 d-flex flex-lg-column">
                    <div class="d-flex align-items-center justify-content-between container-fluid">
                        <div class="text-dark">
                            <span class="text-muted font-weight-bold mr-2"> 2024 &nbsp;© </span>
                            <a href="#" target="_blank" class="text-dark-75 text-hover-primary">LAKITAN RENTAL</a>
                        </div>
                    </div>
                </div>
                <!--end::Footer-->
            {{-- </div> --}}
            <!--end::Wrapper-->
        {{-- </div> --}}
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
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
