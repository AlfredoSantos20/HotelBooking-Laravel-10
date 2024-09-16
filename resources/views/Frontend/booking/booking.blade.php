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

            <form id="bookingForm" action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">@csrf
                <div class="form-group">
                    <label class="text-black font-weight-bold" for="name">Room Type:</label>
                    <select title="Select Room Type" name="room_type_id" class="form-control" required>
                        <option value="" >Select Type</option>
                        @foreach($room as $rm)
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

              {{-- <div class="row">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" >Price</label>
                  <input style="color:black;" type="text" class="form-control " readonly>
                </div>
            </div> --}}

              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                  <input type="date" name="checkin_date" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                  <input type="date" name="checkout_date" class="form-control" required>
                </div>
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
                  <textarea name="note" id="message" class="form-control " cols="30" rows="8" placeholder="Add Notes Here..."></textarea>
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
                <p><span class="d-block">Address:</span> <span class="text-black">Nueva Ecija, Philippines</span></p>
                <p><span class="d-block">Phone:</span> <span class="text-black"> (+63) 123 456 789</span></p>
                <p><span class="d-block">Email:</span> <span class="text-black"> hoteldeluna@gmail.com</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section testimonial-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">People Says</h2>
          </div>
        </div>
        <div class="row">
          <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="{{ url('Frontend/images/person_1.jpg')}}" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; Jean Smith</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="{{ url('Frontend/images/person_2.jpg')}}" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>
                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="{{ url('Frontend/images/person_3.jpg')}}" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>


            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="{{ url('Frontend/images/person_1.jpg')}}" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; Jean Smith</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="{{ url('Frontend/images/person_2.jpg') }}" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>
                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

          </div>
            <!-- END slider -->
        </div>

      </div>
    </section>

    <section class="section bg-image overlay" style="background-image: url('{{ url('Frontend/images/hero_4.jpg') }}');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">The Best Place To Stay. Reserve Now!</h2>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
              <a href="reservation.html" class="btn btn-outline-white-primary py-3 text-white px-5">Reserve Now</a>
            </div>
          </div>
        </div>
      </section>

      @include('Frontend.layout.footer')

@endsection
