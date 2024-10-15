

@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong></strong></h1>

    </div>

    @if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> {{ Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        @if (session('status'))
        <div class="alert alert-info text-center">
            {{ session('status') }}
        </div>
    @endif
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Employee Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center" style=" background-color:#17A2B8;">
                    <a style="float:left; color:white;" title="Back to rooms?" href="{{ url('rooms-management/rooms')}}"><i class="fa-solid fa-arrow-left"></i> </a>

                    <h6 class="m-0 font-weight-bold text-white">Settings</h6>
                </div>


                    <div class="card-body text-center">
                        <div class="form-group">
                            <label for="maintenance">Maintenance:</label>


                            @if (session('maintenance_mode'))
                            <a href="{{ route('toggle.maintenance') }}" class="btn btn-danger">Turn Off Maintenance Mode</a>
                            @else
                            <a href="{{ route('toggle.maintenance') }}" class="btn btn-success">Turn On Maintenance Mode</a>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
