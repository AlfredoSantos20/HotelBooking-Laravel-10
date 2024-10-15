<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel De Luna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">


    <link rel="stylesheet" href="{{ url('Frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/css/zoom.css')}}">

    <!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- THIS IS FOR THE BROWSER'S ICON-->
    <link rel="shortcut icon" href="{{ url('Backend/img/mylogo.png') }} " />

    <link rel="stylesheet" href="{{ url('Frontend/fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ url('Frontend/fonts/fontawesome/css/font-awesome.min.css')}}">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ url('Frontend/css/style.css')}}">

    <style>
            #goUpButton {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                border: none;
                outline: none;
                background-color: #17A2B8;
                color: white;
                padding: 10px 15px;
                border-radius: 10px;
                font-size: 18px;
                cursor: pointer;
            }

            #goUpButton:hover {
                background-color: #0a515c;
            }
    </style>
  </head>
  <body>
    {{-- <div class="loader">
        <img src="{{ asset('Frontend/images/loader/loader2.gif') }}" alt="loading..."/>
    </div> --}}


        @include('Frontend.layout.header')

        <!-- Go Up Button -->
        <button id="goUpButton" title="Go to top">&#9650;</button>

        @yield('content')

    <!-- Sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYCqCYYe2DF_y2WO6GRqioYE7CVwAAQbg&callback=initMap" async defer></script>

    <script src="{{ url('Frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ url('Frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{ url('Frontend/js/popper.min.js')}}"></script>
    <script src="{{ url('Frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ url('Frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ url('Frontend/js/jquery.stellar.min.js')}}"></script>
    <script src="{{ url('Frontend/js/jquery.fancybox.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ url('Frontend/js/aos.js')}}"></script>
    <script src="{{ url('Frontend/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ url('Frontend/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{ url('Frontend/js/main.js')}}"></script>
    <script src="{{ url('Frontend/js/custom.js')}}"></script>
    <script src="{{ url('Frontend/js/employee.js')}}"></script>
    <script src="{{ url('Frontend/js/button-up.js')}}"></script>

    {{-- plugin dataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('Backend/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ url('Backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  </body>
</html>
