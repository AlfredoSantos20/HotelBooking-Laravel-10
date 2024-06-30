

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
                    <a style="float:left; color:white;" title="Back to Banners?" href="{{ url('banners-management/banners')}}"><i class="fa-solid fa-arrow-left"></i> </a>
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
                        <form id="bannerForm" class="forms-sample" @if(empty($banner['id'])) action="{{ url('banners-management/add-edit-banners') }}" @else action="{{ url('banners-management/add-edit-banners/'.$banner['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                            @csrf

                            <div class="form-group">
                                <label for="type">Banner Type:</label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Slider" @if(isset($banner['type']) && $banner['type'] == 'Slider') selected @endif>Slider</option>
                                    <option value="header" @if(isset($banner['type']) && $banner['type'] == 'header') selected @endif>Header</option>
                                    <option value="Fix1" @if(isset($banner['type']) && $banner['type'] == 'Fix1') selected @endif>Fix1</option>
                                    <option value="Circle" @if(isset($banner['type']) && $banner['type'] == 'Circle') selected @endif>Circle</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Banner Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $banner['title'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="link">Banner Link:</label>
                                <input type="text" class="form-control" id="link" name="link" value="{{ $banner['link'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="alt">Banner Alternate Text:</label>
                                <input type="text" class="form-control" id="alt" name="alt" value="{{ $banner['alt'] ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Banner Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @if (!empty($banner['image']))
                                    <a target="_blank" href="{{ url('Frontend/images/banners/' . $banner['image']) }}">View Image</a>
                                @else
                                    <a target="_blank" href="{{ url('Frontend/images/banners/no-image.jpg') }}">View Image</a>
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
