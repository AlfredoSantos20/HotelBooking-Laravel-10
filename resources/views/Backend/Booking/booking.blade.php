
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
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="booking" width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>Customer Name</strong></th>
                                    <th class="text-center text-dark"><strong>Room ID</strong></th>
                                    <th class="text-center text-dark"><strong>Checkin Date</strong></th>
                                    <th class="text-center text-dark"><strong>Checkout Date</strong></th>
                                    <th class="text-center text-dark"><strong>Note</strong></th>
                                    <th class="text-center text-dark"><strong>Payment</strong></th>
                                    <th class="text-center text-dark"><strong>Delete</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking as $book)
                                <tr>
                                    <td class="text-center text-dark">{{ $book['id'] }} </td>
                                    <td class="text-center text-dark">@if(empty($book['customer']['Fname']  ))
                                        No Customer Data.
                                        @else
                                        {{$book['customer']['Fname'] }}  {{$book['customer']['Lname'] }}
                                        @endif
                                    </td>
                                    <td class="text-center text-dark">{{ $book['room_id'] }} </td>
                                    <td class="text-center text-dark">{{date('F j, Y, g:i a', strtotime($book['checkin_date'])); }} </td>
                                    <td class="text-center text-dark">{{date('F j, Y, g:i a', strtotime($book['checkout_date'])); }} </td>
                                    <td class="text-center text-dark">{{ $book['note'] }} </td>
                                    {{-- <td class="text-center text-dark">   <a href="{{ url ('books-management/add-edit-books/'.$book['id']) }}"><i title="Edit book?" style="color:rgb(0, 128, 128); font-size:20px;" class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="javascript:void(0)" class="bookDelete" module="book" moduleid="{{ $book['id'] }}"><i title="Delete book?" style="color:red; font-size:20px;" class="fa-solid fa-trash"></i></a> </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('Backend.layout.footer')
</div>

@endsection


