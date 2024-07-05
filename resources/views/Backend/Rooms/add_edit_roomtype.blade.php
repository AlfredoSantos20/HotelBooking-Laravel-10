

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
                    <a style="float:left; color:white;" title="Back to rooms?" href="{{ url('rooms-management/rooms')}}"><i class="fa-solid fa-arrow-left"></i> </a>
                    <a href="{{url('rooms-management/add-edit-roomtype')}}" style="max-width: 150px; float: right; display: inline-block;" type="button" class="btn btn-block btn-outline-light btn-sm">+ Add RoomType</a>
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
                        <form id="roomForm" class="forms-sample" @if(empty($room['id'])) action="{{ url('rooms-management/add-edit-rooms') }}" @else action="{{ url('rooms-management/add-edit-rooms/'.$room['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                            @csrf

                            <div class="form-group">
                                <label for="type">Room Type:</label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="SingleRoom" @if(isset($room['title']) && $room['title'] == 'SingleRoom') selected @endif>Single Room</option>
                                    <option value="FamilyRoom" @if(isset($room['title']) && $room['title'] == 'FamilyRoom') selected @endif>Family Room</option>
                                    <option value="PresidentialRoom" @if(isset($room['title']) && $room['title'] == 'PresidentialRoom') selected @endif>Presidential Room</option>

                                </select>
                            </div>



                            @endif
                            <div class="form-group">
                                <label for="price">Room Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $room['price'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $room['description'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="alt">room Alternate Text:</label>
                                <input type="text" class="form-control" id="alt" name="alt" value="{{ $room['alt'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image">room Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @if (!empty($room['image']))
                                    <a target="_blank" href="{{ url('Frontend/images/rooms/' . $room['image']) }}">View Image</a>
                                @else
                                    <a target="_blank" href="{{ url('Frontend/images/rooms/no-image.jpg') }}">View Image</a>
                                @endif
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
