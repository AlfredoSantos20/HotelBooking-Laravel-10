

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
                    <a style="float:left; color:white;" title="Back to foods?" href="{{ url('foods-management/foods')}}"><i class="fa-solid fa-arrow-left"></i> </a>

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
                        <form id="foodForm" class="forms-sample" @if(empty($foods['id'])) action="{{ url('foods-management/add-edit-foods') }}" @else action="{{ url('foods-management/add-edit-foods/'.$foods['id']) }}" @endif method="post">
                            @csrf

                            <div class="form-group">
                                <label for="price">Food Name</label>
                                <input type="text" class="form-control" id="price" name="name" placeholder="Enter FoodName " value="{{ $foods['name'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="food_type">Food Type:</label>
                                <select title="Select food Type" name="food_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="main" {{ old('food_type', $foods->food_type) == 'main' ? 'selected' : '' }}>Main Course</option>
                                    <option value="dessert" {{ old('food_type', $foods->food_type) == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                    <option value="drink" {{ old('food_type', $foods->food_type) == 'drink' ? 'selected' : '' }}>Drink</option>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{ $foods['price'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Enter Food Description" required>{{ $foods['description'] ?? '' }}</textarea>
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
