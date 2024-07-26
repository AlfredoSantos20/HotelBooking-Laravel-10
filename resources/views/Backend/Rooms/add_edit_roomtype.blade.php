

@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong></strong></h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Employee Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center" style=" background-color:#17A2B8;">
                    <a style="float:left; color:white;" title="Back to rooms?" href="{{ url('rooms-management/roomtype')}}"><i class="fa-solid fa-arrow-left"></i> </a>

                    <h6 class="m-0 font-weight-bold text-white">{{ $title }}</h6>
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
                    <div class="card-body">
                        <form id="roomtypeForm" class="forms-sample" @if(empty($roomType['id'])) action="{{ url('rooms-management/add-edit-roomtype') }}" @else action="{{ url('rooms-management/add-edit-roomtype/'.$roomType['id']) }}" @endif method="POST" enctype="multipart/form-data">@csrf
                            @csrf

                            <div class="form-group">
                                <label for="price">Room Type:</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter RoomType Title" value="{{ $roomType['title'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Room Price:</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter RoomType Price" value="{{ $roomType['price'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter RoomType Description"  name="description" value="{{ $roomType['description'] ?? '' }}" required>
                            </div>

                            <div style="justify-content:center;" class="modal-footer">
                                <button type="submit" style="background-color:#17A2B8;" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
