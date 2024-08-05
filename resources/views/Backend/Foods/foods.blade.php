
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Food's Management</strong></h1>

    </div>
    @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error:</strong> {{ Session::get('error_message')}}
              <button food="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
              </div>
              @endif

            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success:</strong> {{ Session::get('success_message')}}
            <button food="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
               @endforeach
             <button food="button" class="close" data-dismiss="alert" aria-label="Close">
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
                    <h6 class="m-0 font-weight-bold text-white">Foods's List</h6>

                    <a href="{{url('foods-management/add-edit-foods')}}" style="max-width: 150px; float: right; display: inline-block;" food="button" title="Add Foods" class="btn btn-block btn-outline-light btn-sm">+ Add Foods</a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="foods" class="table table-bordered table-hover"  width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>Name</strong></th>
                                    <th class="text-center text-dark"><strong>Type</strong></th>
                                    <th class="text-center text-dark"><strong>Price</strong></th>
                                    <th class="text-center text-dark"><strong>Description</strong></th>
                                    <th class="text-center text-dark"><strong>Status</strong></th>
                                    <th class="text-center text-dark"><strong>Active/Inactive</strong></th>
                                    <th class="text-center text-dark"><strong>Edit/Delete</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foods as $food)
                                <tr>
                                    <td class="text-center text-dark">{{ $food['id'] }} </td>
                                    <td class="text-center text-dark">{{ $food['name'] }} </td>
                                    <td class="text-center text-dark">{{ $food['food_type'] }} </td>
                                    <td class="text-center text-dark">{{ $food['price'] }} </td>
                                    <td class="text-center text-dark">{{ $food['description'] }} </td>
                                    <td class="text-center">
                                        <label id="status-label-{{ $food['id'] }}" class="badge {{ $food['status'] == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $food['status'] == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center text-dark">

                                        <a title="Update food Status" class="updateFoodStatus" id="food-{{ $food['id'] }}" food_id="{{ $food['id'] }}" href="javascript:void(0)">
                                            <i style="font-size: 25px;" class="fa-solid fa-circle-check {{ $food['status'] == 1 ? 'text-success' : 'text-danger' }}" status="{{ $food['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">   <a href="{{ url ('foods-management/add-edit-foods/'.$food['id']) }}"><i title="Edit food?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="deleteFood" module="food" moduleid="{{ $food['id'] }}"><i title="Delete food?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            @include('Backend.layout.footer')
        </div>

    </div>
</div>
@endsection


