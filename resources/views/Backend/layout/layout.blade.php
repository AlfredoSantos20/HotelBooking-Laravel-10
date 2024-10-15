<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hotel De Luna</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('Backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="{{ url('Backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ url('Backend/css/sb-admin-2.css') }}" rel="stylesheet">

        <!-- THIS IS FOR THE BROWSER'S ICON-->
        <link rel="shortcut icon" href="{{ url('Backend/img/mylogo.png') }} " />


    <!-- DATA TABLES -->
    <link rel="stylesheet" href="{{ url('Backend/css/bootstrap.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('Backend/css/dataTables.bootstrap4.min.css') }}"> --}}
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('Backend.layout.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('Backend.layout.header')



                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield ('content')


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ url('hotel-de-luna/logout')}}">Logout</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<!-- jQuery (required for SweetAlert) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('Backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('Backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('Backend/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ url('Backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <!-- Calling Custom js-->
    <script src="{{ url('Backend/js/custom.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ url('Backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('Backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('Backend/vendor/chart.js/Chart.js') }}"></script>
    <script src="{{ url('Backend/vendor/chart.js/Chart.min.js') }}"></script>
    <!-- Load Chart.js library first -->

        <!-- DataTables plugins -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('Backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('Backend/js/demo/chart-pie-demo.js') }}"></script>


</body>

</html>
