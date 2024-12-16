<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend') }}/assets/img/favicon.ico' />
    <!-- Custom Theme Style -->
    <style>
        #loaderr {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            z-index: 99999;
            background: #0f0c27  ;
        }

        #imgl {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            z-index: 99999;
            background: #0f0c27 url("/backend/lg.png") no-repeat center center;
        }
    </style>

    @yield('css')

</head>

<body>

    <div class="loader"></div>
    <div id='loaderr'>
        <div id="imgl"></div>
    </div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Header  -->
            @include('frontend.include.header')
            <!-- Main Content -->

            <div class="main-content">
                @yield('content')
            </div>
            @include('frontend.include.footer')
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

    <script>
        $(function() {
            $("form").submit(function() {
                console.log('sss')
                $('#loaderr').show();
            });
        });
    </script>
</body>

</html>
