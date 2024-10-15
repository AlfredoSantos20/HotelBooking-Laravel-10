@extends('Frontend.layout.layout')
@section('content')
{{-- Header Section --}}
@if(isset($header[0]['image']))
<section class="site-hero overlay" title="{{ $header[0]['title'] }}" style="background-image: url('{{ asset('Frontend/images/banners/'.$header[0]['image']) }}');" alt="{{ $header[0]['alt'] }}" data-stellar-background-ratio="0.5">
@endif
    <div class="container">
      <div class="row site-hero-inner justify-content-center align-items-center">
        <div class="col-md-10 text-center" data-aos="fade-up">
          <h1 class="heading mb-3">Room Gallery</h1>
          <ul class="custom-breadcrumbs mb-4">
            <li><a href="{{ url('/')}} ">Home</a></li>
            <li>&bullet;</li>
            <li>Rooms</li>
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
  <!-- END section -->

  <section class="section pb-4">
    <div class="container">

      <div class="row check-availabilty" id="next">
        <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

            <form id="availabilityForm" action="/checkAvailableRoom" method="POST">
                @csrf <!-- I Include CSRF token for security -->
                <div class="row">
                    <!-- Room Type Selection -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label class="text-black font-weight-bold" for="room_type_id">Room Type:</label>
                        <select title="Select Room Type" name="room_type_id" class="form-control" required>
                            <option value="">Select Type</option>
                            @foreach(collect($room)->unique('room_type.id') as $rm)
                            <option value="{{ $rm['room_type']['id'] }}">
                                {{ $rm['room_type']['title'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Check-in Date -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                        <input type="date" name="checkin_date" class="form-control" required id="checkin_dates">
                    </div>

                    <!-- Check-out Date -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                        <input type="date" name="checkout_date" class="form-control" required id="checkout_dates">
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-6 col-lg-3 align-self-end">
                        <button type="submit" class="btn btn-primary btn-block text-white">Check Availability</button>
                    </div>
                </div>
            </form>
        </div>


      </div>
    </div>
  </section>


  {{-- <section class="section">
    <div class="container">

      <div class="row">

        <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
          <a href="#" class="room">
            <figure class="img-wrap">
              <img src="{{url('Frontend/images/img_1.jpg') }}" alt="Free website template" class="img-fluid mb-3">
            </figure>
            <div class="p-3 text-center room-info">
              <h2>Single Room</h2>
              <span class="text-uppercase letter-spacing-1">90$ / per night</span>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
          <a href="#" class="room">
            <figure class="img-wrap">
              <img src="{{url('Frontend/images/img_2.jpg') }}" alt="Free website template" class="img-fluid mb-3">
            </figure>
            <div class="p-3 text-center room-info">
              <h2>Family Room</h2>
              <span class="text-uppercase letter-spacing-1">120$ / per night</span>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
          <a href="#" class="room">
            <figure class="img-wrap">
              <img src="{{url('Frontend/images/img_3.jpg') }}" alt="Free website template" class="img-fluid mb-3">
            </figure>
            <div class="p-3 text-center room-info">
              <h2>Presidential Room</h2>
              <span class="text-uppercase letter-spacing-1">250$ / per night</span>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section> --}}


{{-- Normal Rooms --}}
<section class="section">
    <div class="container">
        <div class="row">
            @foreach($roomTypes as $roomType)
                @if ($roomType->rooms->isNotEmpty())
                    <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                        <a href="javascript:;" class="room">
                            <figure class="img-wrap">
                                <img src="{{ asset('Frontend/images/rooms/' . $roomType->rooms->first()->image) }}" alt="{{ $roomType->title }} image" class="img-fluid mb-3">
                            </figure>
                            <div class="p-3 text-center room-info ">
                                <h2 >{{ $roomType->title }}</h2>
                                <span class="text-uppercase letter-spacing-1 text-dark">
                                    {{ '₱ ' . number_format($roomType->price, 0, '.', ',') }} | per night
                                </span>

                                <br> <span class="text-uppercase letter-spacing-1 text-dark"> <i class="fa-solid fa-people-group"></i> {{ $roomType->adults }} Adults | {{ $roomType->children }} Childrens </span>
                                <br> <span class="text-uppercase letter-spacing-1 text-dark">  <i class="fa-solid fa-wifi text-dark"></i> wifi  <i class="fa-solid fa-circle-check text-success"></i> Included  </span>
                                <br> <span class="text-uppercase letter-spacing-1 text-dark "> <i style ="font-size:20px;" class="text-dark fa-solid fa-ban-smoking"></i> no smoking policy</span>
                                <br>  <a type="button" href="{{url('booking')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >Book now</a>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>


<style>
    .roomtype-title {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

  {{-- Popular Rooms --}}
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
                <h2 class="heading" data-aos="fade">Popular Rooms</h2>
                <p data-aos="fade">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
        </div>

        @php
            // Keep track of displayed room types to avoid duplicates
            $displayedRoomTypes = [];
            $rankings = ['1st', '2nd', '3rd'];
        @endphp

        @foreach($mostBookedRooms as $index => $roomType)
            <div class="site-block-half d-block d-lg-flex bg-white" data-aos="fade" data-aos-delay="{{ 100 * ($index + 1) }}">
                <a href="#" class="image d-block bg-image-2 {{ $index % 2 === 0 ? '' : 'order-2' }}" style="background-image: url('{{ url('Frontend/images/rooms/' . $roomType->rooms->first()->image) }}');"></a>
                <div class="text {{ $index % 2 === 0 ? '' : 'order-1' }}">
                    <span class="d-block mb-4">
                        <span class="display-4 text-primary">{{ '₱ ' . number_format($roomType->price, 0, '.', ',') }}</span>
                        <span class="text-uppercase letter-spacing-2">/ per night</span>
                    </span>
                    <h2 class="mb-4 roomtype-title">
                        {{ $rankings[$index] ?? '' }} - {{ $roomType->title }} ({{ $roomType->bookings_count }} bookings)
                    </h2>
                    <p>{{ $roomType->description }}</p>
                    <p><a href="{{ url('booking/' . $roomType->rooms->first()->id) }}" class="btn btn-primary text-white">Book Now</a></p>
                </div>
            </div>

            @php
                // Add this room type to the displayed list
                $displayedRoomTypes[] = $roomType->id;
            @endphp
        @endforeach
    </div>
</section>


{{-- Discounted Rooms --}}
<section class="section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
                <h2 class="heading" data-aos="fade">Discounted Rooms</h2>
                <p data-aos="fade">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
        </div>
        <div class="row">
            @foreach($DiscountedRooms as $discount)
                @if ($discount->rooms->isNotEmpty())
                    <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                        <a href="javascript:;" class="room">
                            <figure class="img-wrap">
                                <img src="{{ asset('Frontend/images/rooms/' . $discount->rooms->first()->image) }}" alt="{{ $discount->title }} image" class="img-fluid mb-3">
                            </figure>
                            <div class="p-3 text-center room-info ">
                                <h2 >{{ $discount->title }}</h2>
                                <span class="text-uppercase letter-spacing-1 text-dark">
                                    Original Price: {{$discount->price}}
                                </span><br>
                                <span class="text-uppercase letter-spacing-1 text-dark">
                                    <span>

                                        Discounted Price:
                                        <span style="text-decoration: line-through; color: red;">
                                        ₱ {{ $discount->discountedPrice() }}
                                        </span>

                                </td>
                                    </span><br>

                                </span>

                                <br> <span class="text-uppercase letter-spacing-1 text-dark"> <i class="fa-solid fa-people-group"></i> {{ $discount->adults }} Adults | {{ $discount->children }} Childrens </span>
                                <br> <span class="text-uppercase letter-spacing-1 text-dark">  <i class="fa-solid fa-wifi text-dark"></i> wifi  <i class="fa-solid fa-circle-check text-success"></i> Included  </span>
                                <br> <span class="text-uppercase letter-spacing-1 text-dark "> <i style ="font-size:20px;" class="text-dark fa-solid fa-ban-smoking"></i> no smoking policy</span>
                                <br>  <a type="button" href="{{url('booking')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >Book now</a>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>



  @include('Frontend.shared.customer_ratings')
  @include('Frontend.shared.booknow')
  @include('Frontend.layout.footer')
@endsection
