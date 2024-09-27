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
              <h1 class="heading mb-3">Booking Form</h1>
              <ul class="custom-breadcrumbs mb-4">
                <li><a href="{{ url('/')}} ">Home</a></li>
                <li>&bullet;</li>
                <li>Booking</li>
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

    <section class="section contact-section" id="next">
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

            <form id="bookingForm" action="{{ route('saveBooking') }}" method="post" class="bg-white p-md-5 p-4 mb-5 border" invalidate>@csrf

                <div class="form-group">
                    <strong style="color:red;"><label for="caution">Please read the following:</label></strong>
                    <ul>
                        <li>You cannot checkout for the current day.</li>
                        <li>You can only book for a maximum of one week.</li>


                    </ul>
                </div>

                <div class="form-group">
                    <label class="text-black font-weight-bold" for="name">Room Type:</label>
                    <select title="Select Room Type" name="room_type_id" class="form-control" required>
                        <option value="">Select Type</option>
                        @foreach(collect($room)->unique('room_type.id') as $rm)
                        <option value="{{ $rm['room_type']['id'] }}"
                            @if(old('room_type') == $rm['room_type']['id'])
                                selected
                            @elseif(isset($room->room_type) && $room->room_type == $rm['room_type']['id'])
                                selected
                            @endif>
                            {{ $rm['room_type']['title'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                 <div class="form-group">
                    <div class="text-center">
                        <button type="button" id="selectDatesBtn" class="btn btn-success">Select In Dates</button>
                        <button type="button" id="selectDaysBtn" class="btn btn-success">Select In Days</button>
                    </div>
                </div>

                <div id="dateSelection" class="row">
                    <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                        <input type="date" name="checkin_date" class="form-control" id="checkin_dates">
                    </div>


                    <div class="col-md-6 form-group">
                        <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                        <input type="date" name="checkout_date" class="form-control" id="checkout_dates">
                    </div>
                </div>

                <div id="daySelection" class="form-group" style="display:none;">
                    <label for="day" class="font-weight-bold text-black">Select Days</label>
                    <select style="color:black;" name="day" id="day" class="form-control" >
                        <option value="">Select</option>
                        @for($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}">{{ $i }} Day{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="adults" class="font-weight-bold text-black">Adults</label>
                        <div class="field-icon-wrap">
                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                            <select style="color:black;" name="total_adults" id="total_adults" class="form-control" required>
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="children" class="font-weight-bold text-black">Children</label>
                        <div class="field-icon-wrap">
                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                            <select style="color:black;" name="total_children" id="total_children" class="form-control" required>
                                <option value="">Select</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 form-group">
                        <label class="text-black font-weight-bold" for="message">Notes</label>
                        <textarea name="note" id="message" class="form-control" cols="30" rows="8" placeholder="Add Notes Here..."></textarea>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 form-group text-center">
                        <input type="submit" value="Book Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                    </div>
                </div>
            </form>





          </div>
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
                <div class="col-md-10 ml-auto contact-info">
                    <p><span class="d-block">Address:</span> <span class="text-black">Licab Nueva Ecija, Philippines</span></p>
                      <!-- Map Container -->
            <div id="map" style="height: 200px; width: 100%; margin-top: 10px; margin-bottom: 10px;"></div>
                    <p><span class="d-block">Phone:</span> <span class="text-black"> (+63) 123 456 789</span></p>
                    <p><span class="d-block">Email:</span> <span class="text-black"> hoteldeluna@gmail.com</span></p>
                </div>
            </div>
        </div>

        </div>
      </div>
    </section>

    @include('Frontend.shared.customer_ratings')

 <script>
    let map;
    let marker;

    function initMap() {
      const location = { lat: 15.5449, lng: 120.7689 };

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: location,
        });

        marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Hotel de Luna",
        });
    }
</script>
    @include('Frontend.shared.booknow')
    @include('Frontend.layout.footer')

    @include('Frontend.layout.footer')

@endsection
