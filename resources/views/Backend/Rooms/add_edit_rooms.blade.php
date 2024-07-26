

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
                                <label for="title">Room Type:</label>
                                <select title="Select Room Type" name="room_type" class="form-control" required>
                                    <option value="" >Select Type</option>
                                    @foreach($roomType as $type)
                                    <option value="{{ $type['id'] }}"
                                        @if(old('room_type') == $type['id'])
                                            selected
                                        @elseif(isset($room->room_type) && $room->room_type == $type['id'])
                                            selected
                                        @endif>
                                        {{ $type['title'] }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Room Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <div style="margin-top:20px;">
                                    @if (!empty($room['image']))
                                    <img width="25%" src="{{ url('Frontend/images/rooms/' . $room['image']) }}" alt="alt">
                                 @else
                                    <img width="25%" src="{{ url('Frontend/images/rooms/no-image.jpg') }}" alt="alt">
                                 @endif
                                </div>
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
