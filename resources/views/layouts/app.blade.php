<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Lanmic|Gate Pass')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />

    <!--begin::Third Party Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />

    <!--begin::Bootstrap Datepicker CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css">

    <!--begin::Select2 CSS-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!--begin::AdminLTE CSS-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />

    <!--begin::ApexCharts CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />

    <!--begin::JSVectorMap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous" />

    <!--begin::Page Specific Styles-->
    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')

        <main class="app-main">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <!-- ============================================== -->
    <!-- ALL SCRIPTS MUST BE HERE, BEFORE </body>       -->
    <!-- ============================================== -->

    <!-- jQuery (ONLY ONCE!) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- OverlayScrollbars -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

    <!-- JSVectorMap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" crossorigin="anonymous"></script>

    <!-- AdminLTE JS -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

    <!-- Global Scripts -->
    <script>
        // OverlayScrollbars Configuration
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize OverlayScrollbars
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }

            // Initialize Sortable if element exists
            const sortableElement = document.querySelector('.connectedSortable');
            if (sortableElement && typeof Sortable !== 'undefined') {
                new Sortable(sortableElement, {
                    group: 'shared',
                    handle: '.card-header',
                });

                const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
                cardHeaders.forEach((cardHeader) => {
                    cardHeader.style.cursor = 'move';
                });
            }

            // Initialize Select2
            if (typeof $.fn.select2 !== 'undefined') {
                $('.selectize').select2({
                    tags: true
                });
            }
        });

        // Format Amount Function
        function formatAmount(input) {
            let value = input.value.replace(/,/g, "");
            if (value === "" || isNaN(value)) {
                input.value = "";
                return;
            }
            input.value = parseFloat(value).toLocaleString("en-US", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Set Current Time Function
        function setCurrentTime(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                const now = new Date();
                const timeString = now.toTimeString().slice(0, 5);
                element.value = timeString;
            }
        }
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')

</body>
</html>
