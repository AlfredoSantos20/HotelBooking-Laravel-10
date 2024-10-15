
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
            <!-- Booking Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#17A2B8;">
                    <h6 class="m-0 font-weight-bold text-white">Booking's List</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bookings" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center text-dark"><strong>ID</strong></th>
                                    <th class="text-center text-dark"><strong>Room ID</strong></th>
                                    <th class="text-center text-dark"><strong>Amount</strong></th>
                                    <th class="text-center text-dark"><strong>Customer</strong></th>
                                    <th class="text-center text-dark"><strong>Room Type</strong></th>
                                    <th class="text-center text-dark"><strong>Check-in Date</strong></th>
                                    <th class="text-center text-dark"><strong>Check-out Date</strong></th>
                                    <th class="text-center text-dark"><strong>Notes</strong></th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking as $book)
                                <tr>
                                    <td class="text-center text-dark">{{ $book['id'] }}</td>
                                    <td class="text-center text-dark">{{ $book['room']['id'] }} </td>
                                    <td class="text-center text-dark">{{ $book['amount'] }} </td>
                                    <td class="text-center text-dark">
                                        @if(empty($book['customer']['Fname']))
                                            No Customer Data.
                                        @else
                                            {{ $book['customer']['Fname'] }} {{ $book['customer']['Lname'] }}
                                        @endif
                                    </td>
                                    <td class="text-center text-dark">{{ $book['room_id'] }}</td>
                                    <td class="text-center text-dark">{{ date('F j, Y, g:i a', strtotime($book['checkin_date'])) }}</td>
                                    <td class="text-center text-dark">{{ date('F j, Y, g:i a', strtotime($book['checkout_date'])) }}</td>
                                    <td class="text-center text-dark">
                                        @if(trim($book['note']) === "")
                                        No note.
                                    @else
                                        {{ $book['note'] }}
                                    @endif</td>


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


