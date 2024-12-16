<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dahbaord</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend') }}/assets/img/favicon.ico' />
    <!-- Custom Theme Style -->


    @yield('css')

</head>

<body>

    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Header  -->
            @include('backend.include.header')
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            @include('backend.include.footer')
            <!-- Footer  -->
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('backend') }}/assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('backend') }}/assets/bundles/apexcharts/apexcharts.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend') }}/assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="{{ asset('backend') }}/assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('backend') }}/assets/js/custom.js"></script>

    @yield('js')
</body>

</html>
