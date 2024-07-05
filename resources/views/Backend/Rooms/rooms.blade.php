
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Room Management</strong></h1>

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
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- room Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#17A2B8;">
                    <h6 class="m-0 font-weight-bold text-white">Room's List</h6>

                    <a href="{{url('rooms-management/add-edit-rooms')}}" style="max-width: 150px; float: right; display: inline-block;" type="button" class="btn btn-block btn-outline-light btn-sm">+ Add Room</a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="room" width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>Image</strong></th>
                                    <th class="text-center text-dark"><strong>RoomType</strong></th>
                                    <th class="text-center text-dark"><strong>Occupancy</strong></th>
                                    <th class="text-center text-dark"><strong>Status</strong></th>
                                    <th class="text-center text-dark"><strong>Active/Inactive</strong></th>
                                    <th class="text-center text-dark"><strong>Edit/Delete</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                <tr>
                                    <td class="text-center text-dark">{{ $room['id'] }} </td>
                                    <td class="text-center ">
                                        @if(!empty($room['image']))
                                            <a target="_blank" href="{{ url('Frontend/images/rooms/'.$room['image']) }}" class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;">
                                                <img style="width: 80px; height: 80px; transition: transform 0.2s ease-in-out;" src="{{ asset('Frontend/images/rooms/'.$room['image']) }}">
                                            </a>
                                        @else
                                            <img style="width: 80px; height: 80px; cursor: pointer; transition: transform 0.2s ease-in-out;" src="{{ url('Frontend/images/rooms/no-image.jpg') }}" class="zoomable-image">
                                        @endif
                                    </td>
                                    <td class="text-center text-dark">@if(empty($room['room_type']['title']))
                                        No Room Type Assigned.
                                        @else
                                        {{$room['room_type']['title']}}
                                        @endif
                                    </td>
                                    <td class="text-center text-dark">@if($room['occupancy'] == "Available")
                                        <label class="badge badge-success">Available</label>
                                        @else
                                        <label class="badge badge-danger">Occupied</label>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <label id="status-label-{{ $room['id'] }}" class="badge {{ $room['status'] == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $room['status'] == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center text-dark">

                                        <a title="Update Room Status" class="updateroomStatus" id="room-{{ $room['id'] }}" room_id="{{ $room['id'] }}" href="javascript:void(0)">
                                            <i style="font-size: 25px;" class="fa-solid fa-circle-check {{ $room['status'] == 1 ? 'text-success' : 'text-danger' }}" status="{{ $room['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">   <a href="{{ url ('rooms-management/add-edit-rooms/'.$room['id']) }}"><i title="Edit room?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="confirmDelete" module="room" moduleid="{{ $room['id'] }}"><i title="Delete Room?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('Backend.layout.footer')
    </div>
</div>
@endsection


