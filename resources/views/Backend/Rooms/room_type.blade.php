
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Room-Type Management</strong></h1>

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
                    <h6 class="m-0 font-weight-bold text-white">Room's Type List</h6>

                    <a href="{{url('rooms-management/add-edit-roomtype')}}" style="max-width: 150px; float: right; display: inline-block;" type="button" title="Add RoomType" class="btn btn-block btn-outline-light btn-sm">+ Add RoomType</a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="room" width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>RoomType</strong></th>
                                    <th class="text-center text-dark"><strong>Children</strong></th>
                                    <th class="text-center text-dark"><strong>Adult</strong></th>
                                    <th class="text-center text-dark"><strong>Description</strong></th>
                                    <th class="text-center text-dark"><strong>Price</strong></th>
                                    <th class="text-center text-dark"><strong>Status</strong></th>
                                    <th class="text-center text-dark"><strong>Active/Inactive</strong></th>
                                    <th class="text-center text-dark"><strong>Edit/Delete</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomType as $type)
                                <tr>
                                    <td class="text-center text-dark">{{ $type['id'] }} </td>

                                    <td class="text-center text-dark">@if(empty($type['title']))
                                        No Room Type Assigned.
                                        @else
                                        {{$type['title']}}
                                        @endif
                                    </td>
                                    <td class="text-center text-dark">{{ $type['children'] }} </td>
                                    <td class="text-center text-dark">{{ $type['adults'] }} </td>
                                    <td class="text-center text-dark">{{ $type['description'] }} </td>
                                    <td class="text-center text-dark">{{ $type['price'] }} </td>
                                    <td class="text-center">
                                        <label id="status-label-{{ $type['id'] }}" class="badge {{ $type['status'] == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $type['status'] == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center text-dark">

                                        <a title="Update Room Status" class="updateRoomtypeStatus" id="roomtype-{{ $type['id'] }}" roomtype_id="{{ $type['id'] }}" href="javascript:void(0)">
                                            <i style="font-size: 25px;" class="fa-solid fa-circle-check {{ $type['status'] == 1 ? 'text-success' : 'text-danger' }}" status="{{ $type['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">   <a href="{{ url ('rooms-management/add-edit-roomtype/'.$type['id']) }}"><i title="Edit RoomType?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="deleteRoomType" module="roomtype" moduleid="{{ $type['id'] }}"><i title="Delete RoomType?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td>
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


