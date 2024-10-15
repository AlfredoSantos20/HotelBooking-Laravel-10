<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hotel De Luna </title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('Backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('Backend/css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message')}}
                        </div>
                        @endif
                        <form action="{{ url('hotel-de-luna/login') }}" method="post">@csrf
                            <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-user"
                                    aria-describedby="emailHelp"
                                    placeholder="Enter Email Address" @if(isset($_COOKIE["email"])) value="{{ $_COOKIE["email"] }}" @endif required>
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" id="emp-password" class="form-control form-control-user"
                                    placeholder="Password" @if(isset($_COOKIE["password"])) value="{{ $_COOKIE["password"] }}" @endif required>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small ">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" @if(isset($_COOKIE["email"])) checked @endif>
                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>

                            <div class="form-group">

                                <button id="AdminLogin" type="submit" style="background-color:#17A2B8; color:white;" class="btn btn-user btn-block">
                                    Login
                                </button>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('Backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('Backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('Backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('Backend/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
