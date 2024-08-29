
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Booking Management</strong></h1>

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
            <!-- book Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#17A2B8;">
                    <h6 class="m-0 font-weight-bold text-white">Booking's List</h6>

                    <a href="{{url('booking-management/add-edit-booking')}}" style="max-width: 150px; float: right; display: inline-block;" type="button" class="btn btn-block btn-outline-light btn-sm">+ Add Booking</a>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="book" width="100%" cellspacing="0">
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
                                @foreach($booking as $book)
                                <tr>
                                    <td class="text-center text-dark">{{ $book['id'] }} </td>
                                    <td class="text-center ">
                                        @if(!empty($book['image']))
                                            <a target="_blank" href="{{ url('Frontend/images/books/'.$book['image']) }}" class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;">
                                                <img style="width: 80px; height: 80px; transition: transform 0.2s ease-in-out;" src="{{ asset('Frontend/images/books/'.$book['image']) }}">
                                            </a>
                                        @else
                                            <img style="width: 80px; height: 80px; cursor: pointer; transition: transform 0.2s ease-in-out;" src="{{ url('Frontend/images/books/no-image.jpg') }}" class="zoomable-image">
                                        @endif
                                    </td>

                                    <td class="text-center text-dark">{{ $book['title'] }} </td>
                                    <td class="text-center text-dark">{{ $book['type'] }} </td>
                                    <td class="text-center text-dark">{{ $book['link'] }}</td>
                                    <td class="text-center text-dark">{{ $book['alt'] }}</td>
                                    <td class="text-center">
                                        <label id="status-label-{{ $book['id'] }}" class="badge {{ $book['status'] == 1 ? 'badge-success' : 'badge-danger' }}">
                                            {{ $book['status'] == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </td>
                                    <td class="text-center text-dark">

                                        <a title="Update book Status" class="updatebookStatus" id="book-{{ $book['id'] }}" book_id="{{ $book['id'] }}" href="javascript:void(0)">
                                            <i style="font-size: 25px;" class="fa-solid fa-circle-check {{ $book['status'] == 1 ? 'text-success' : 'text-danger' }}" status="{{ $book['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                        </a>
                                    </td>
                                    <td class="text-center text-dark">   <a href="{{ url ('books-management/add-edit-books/'.$book['id']) }}"><i title="Edit book?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="bookDelete" module="book" moduleid="{{ $book['id'] }}"><i title="Delete book?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td>
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


