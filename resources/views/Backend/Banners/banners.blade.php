
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Banner Management</strong></h1>

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
            <!-- banner Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#17A2B8;">
                    <h6 class="m-0 font-weight-bold text-white">Banner's List</h6>

                    <a href="{{url('banners-management/add-edit-banners')}}" style="max-width: 150px; float: right; display: inline-block;" type="button" class="btn btn-block btn-outline-light btn-sm">+ Add Banner</a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="banner" width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>Image</strong></th>
                                    <th class="text-center text-dark"><strong>Title</strong></th>
                                    <th class="text-center text-dark"><strong>Type</strong></th>
                                    <th class="text-center text-dark"><strong>Link</strong></th>
                                    <th class="text-center text-dark"><strong>Alt</strong></th>
                                    <th class="text-center text-dark"><strong>Status</strong></th>
                                    <th class="text-center text-dark"><strong>Active/Inactive</strong></th>
                                    <th class="text-center text-dark"><strong>Edit/Delete</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <td class="text-center text-dark">{{ $banner['id'] }} </td>
                                    <td class="text-center ">
                                        @if(!empty($banner['image']))
                                            <a target="_blank" href="{{ url('Frontend/images/banners/'.$banner['image']) }}" class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;">
                                                <img style="width: 80px; height: 80px; transition: transform 0.2s ease-in-out;" src="{{ asset('Frontend/images/banners/'.$banner['image']) }}">
                                            </a>
                                        @else
                                            <img style="width: 80px; height: 80px; cursor: pointer; transition: transform 0.2s ease-in-out;" src="{{ url('Frontend/images/banners/no-image.jpg') }}" class="zoomable-image">
                                        @endif
                                    </td>

                                    <td class="text-center text-dark">{{ $banner['title'] }} </td>
                                    <td class="text-center text-dark">{{ $banner['type'] }} </td>
                                    <td class="text-center text-dark">{{ $banner['link'] }}</td>
                                    <td class="text-center text-dark">{{ $banner['alt'] }}</td>
                                    <td class="text-center">
                                        <label id="status-label-{{ $banner['id'] }}" class="badge {{ $banner['status'] == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $banner['status'] == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center text-dark">

                                        <a title="Update Banner Status" class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)">
                                            <i style="font-size: 25px;" class="fa-solid fa-circle-check {{ $banner['status'] == 1 ? 'text-success' : 'text-danger' }}" status="{{ $banner['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">   <a href="{{ url ('banners-management/add-edit-banners/'.$banner['id']) }}"><i title="Edit Banner?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="confirmDelete" module="banner" moduleid="{{ $banner['id'] }}"><i title="Delete Banner?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td>
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


