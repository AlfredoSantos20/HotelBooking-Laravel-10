@extends('Frontend.layout.layout')
@section('content')
  <body>

    @include('Frontend.layout.header')
    <!-- END head -->

    @if(isset($header[0]['image']))
    <section class="site-hero overlay" title="{{ $header[0]['title'] }}" style="background-image: url('{{ asset('Frontend/images/banners/'.$header[0]['image']) }}');" alt="{{ $header[0]['alt'] }}" data-stellar-background-ratio="0.5">
    @endif
        <div class="container">
          <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
              <h1 class="heading mb-3">My Booked</h1>
              <ul class="custom-breadcrumbs mb-4">
                <li><a href="{{ url('/')}} ">Home</a></li>
                <li>&bullet;</li>
                <li>List</li>
              </ul>
            </div>
          </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
          <div class="mouse-icon">
            <span class="mouse-wheel"></span>
          </div>
        </a>
      </section>


      <section class="section contact-section" id="next">
        <div class="container">
          <div class="row justify-content-center"> <!-- Centering the row -->
            <div class="col-md-12 grid-margin stretch-card" data-aos="fade-up" data-aos-delay="100">

            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#17A2B8;">

                    <a title="Download Transactions?" href="javascript:;"><i style="font-size:30px; float:left; color:red;" class="fa-solid fa-file-pdf"></i></a>
                      <h4 class="m-0 font-weight-bold  text-center text-white">My Booking's List</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="bookinglist" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center text-dark"><strong>Room ID</strong></th>
                                    <th class="text-center text-dark"><strong>Type</strong></th>
                                    <th class="text-center text-dark"><strong>Amount</strong></th>
                                    <th class="text-center text-dark"><strong>Checkin Date</strong></th>
                                    <th class="text-center text-dark"><strong>Checkout Date</strong></th>
                                    <th class="text-center text-dark"><strong>Adults</strong></th>
                                    <th class="text-center text-dark"><strong>Children</strong></th>
                                    <th class="text-center text-dark"><strong>Note</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingList as $list)
                                <tr>
                                    <td class="text-center text-dark">{{ $list['room_id'] }} </td>
                                    <td class="text-center text-dark">{{ $list['room']['room_type']['title'] }} </td>
                                    <td class="text-center text-dark">{{ $list['amount'] }} </td>
                                    <td class="text-center text-dark">{{ date('F j, Y, g:i a', strtotime($list['checkin_date'])) }} </td>
                                    <td class="text-center text-dark">{{ date('F j, Y, g:i a', strtotime($list['checkout_date'])) }} </td>
                                    <td class="text-center text-dark">{{ $list['total_adults'] }}</td>
                                    <td class="text-center text-dark">{{ $list['total_children'] }}</td>
                                    <td class="text-center text-dark">
                                        @if(trim($list['note']) === "")
                                        No note.
                                    @else
                                        {{ $list['note'] }}
                                    @endif</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

              </div>
          </div>
        </div>
      </section>


    @include('Frontend.shared.customer_ratings')


    @include('Frontend.shared.booknow')
    @include('Frontend.layout.footer')



@endsection
