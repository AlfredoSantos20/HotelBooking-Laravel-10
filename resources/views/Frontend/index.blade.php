@extends('Frontend.layout.layout')
@section('content')

@if(isset($header[0]['image']))
<section class="site-hero overlay" title="{{ $header[0]['title'] }}" style="background-image: url('{{ asset('Frontend/images/banners/'.$header[0]['image']) }}');" alt="{{ $header[0]['alt'] }}" data-stellar-background-ratio="0.5">
@endif
    <div class="container">
      <div class="row site-hero-inner justify-content-center align-items-center">
        <div class="col-md-10 text-center" data-aos="fade-up">
          <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To</span>
          <h1 class="heading"> Hotel De Luna</h1>
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

{{-- START CHECK AVAILABLE --}}
  <section class="section bg-light pb-0" data-aos="fade-up" >
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
{{-- END CHECK AVAILABLE --}}
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-left">

          <figure class="img-absolute">
            @if(isset($circle[0]['image']))
            <a target="blank_" href=" {{ url('Frontend/images/banners/'.$circle[0]['image']) }} ">
                <img src="{{ asset('Frontend/images/banners/'.$circle[0]['image']) }}" alt="Image" class="img-fluid">
            </a>
            @else
            <a target="blank_" href="{{ url('Frontend/images/banners/no-image.jpg') }}">
                <img  src="{{ asset('Frontend/images/banners/no-image.jpg') }}"  alt="Image" class="img-fluid">
            </a>
            @endif
          </figure>

          @if(isset($fix1Banner[0]['image']))
          <a target="blank_" href="{{ url('Frontend/images/banners/'.$fix1Banner[0]['image'])}}">
          <img title="{{ $fix1Banner[0]['title'] }}" src="{{ asset('Frontend/images/banners/'.$fix1Banner[0]['image']) }}" alt="{{ $fix1Banner[0]['alt'] }}" class="img-fluid rounded">
          </a>
        @else
        <img  src="{{ asset('Frontend/images/banners/no-image.jpg') }}"  class="img-fluid rounded">
        @endif

        </div>
        <div class="col-md-12 col-lg-4 order-lg-1">
          <h2 class="heading" data-aos="fade-right">Welcome!</h2>
          <p class="mb-4" data-aos="fade-up">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          <p data-aos="fade-right"><a href="#" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
        </div>

      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
          <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4" data-aos="fade-up">

            <figure class="img-wrap">
                @if(isset($singleRoomImg[0]['image']))
                    <a class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;" target="_blank" href="{{ url('Frontend/images/rooms/'.$singleRoomImg[0]['image']) }}">
                        <img class="zoomable-img img-fluid mb-3"  title="{{ $singleRoom['title'] }}" src="{{ asset('Frontend/images/rooms/'.$singleRoomImg[0]['image']) }}" alt="alt">
                    </a>
                @else
                    <img src="{{ asset('Frontend/images/rooms/no-image.jpg') }}" class="img-fluid mb-3">
                @endif
            </figure>

            <div style ="justify-content:center;" class="p-3 text-center room-info">
              <h2>Single Room</h2>
              <span class="text-uppercase letter-spacing-1">{{$formattedSingleRoomPrice}} | per night</span>

              <br> <span class="text-uppercase letter-spacing-1">  <i class="fa-solid fa-wifi"></i> wifi  <i class="fa-solid fa-circle-check text-success"></i> Included  </span>
              <br> <span class="text-uppercase letter-spacing-1"> <i style ="font-size:20px;" class="fa-solid fa-ban-smoking"></i> no smoking policy</span>
              <br>  <a type="button" href="{{url('booking')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >Book now</a>
            </div>

        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up">

            <figure class="img-wrap ">
                @if(isset($famRoomImg[0]['image']))
                <a class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;" target="blank_" href="{{ url('Frontend/images/rooms/'.$famRoomImg[0]['image'])}}">
                  <img  class="zoomable-img img-fluid mb-3" title="{{ $famRoom['title'] }}" src="{{ asset('Frontend/images/rooms/'.$famRoomImg[0]['image']) }}" alt="alt" >
                </a>
                  @else
                  <img  src="{{ asset('Frontend/images/rooms/no-image.jpg') }}"  class="img-fluid mb-3">

                  @endif
            </figure>
            <div class="p-3 text-center room-info">
              <h2>Family Room</h2>
              <span class="text-uppercase letter-spacing-1">{{ $formattedFamRoomPrice}} | per night</span>

              <br> <span class="text-uppercase letter-spacing-1">  <i class="fa-solid fa-wifi"></i> wifi  <i class="fa-solid fa-circle-check text-success"></i> Included  </span>
              <br> <span class="text-uppercase letter-spacing-1"> <i style ="font-size:20px;" class="fa-solid fa-ban-smoking"></i> no smoking policy</span>
              <br>  <a type="button" href="{{url('booking')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >Book now</a>
            </div>

        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up">

            <figure class="img-wrap">
                @if(isset($presRoomImg[0]['image']))
                <a  class="zoomable-image" style="cursor: pointer; display: inline-block; position: relative;" target="blank_" href="{{ url('Frontend/images/rooms/'.$presRoomImg[0]['image'])}}">
                  <img class="zoomable-img img-fluid mb-3" title="{{ $presRoom['title'] }}" src="{{ asset('Frontend/images/rooms/'.$presRoomImg[0]['image']) }}" alt="alt">
                </a>
                  @else
                  <img src="{{ asset('Frontend/images/rooms/no-image.jpg') }}"  class="img-fluid mb-3">

                  @endif
            </figure>
            <div style="text-align:justify;" class="p-3 text-center room-info">
              <h2>Presidential Room</h2>
              <span class="text-uppercase letter-spacing-1">{{$formattedPresRoomPrice}} | per night </span>

              <br> <span class="text-uppercase letter-spacing-1">  <i class="fa-solid fa-wifi"></i> wifi  <i class="fa-solid fa-circle-check text-success"></i> Included  </span>
              <br> <span class="text-uppercase letter-spacing-1"> <i style ="font-size:20px;" class="fa-solid fa-ban-smoking"></i> no smoking policy</span>
              <br>  <a type="button" href="{{url('booking')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >Book now</a>
            </div>
        </div>

      </div>

    </div>
    <div data-aos="fade-up" class="row justify-content-center" style="margin-top:50px; ">

        <a type="button" title="View More Rooms" href="{{url('roomGallery')}}" class="btn btn-primary text-white py-2 px-4 font-weight-bold" >View More Rooms <i style ="font-size:30px; vertical-align: middle; margin-left: 10px;" class="fa-solid fa-circle-arrow-right"></i></a>
    </div>
  </section>


  <section class="section slider-section bg-light">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Gallery</h2>
          <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
            @foreach($sliderBanners as $banner)
            <div class="slider-item">
              <a href="{{ asset('Frontend/images/banners/'.$banner['image']) }}"  data-fancybox="images" data-caption="{{$banner['title']}}">
                <img @if(!empty($banner['link'])) href="{{ url($banner['link']) }} " @else href="javascript:;" @endif><img title="{{ $banner['title'] }}" alt="alt" src="{{ asset('Frontend/images/banners/'.$banner['image']) }}" class="img-fluid">
                </a>
            </div>
            @endforeach


          </div>
          <!-- END slider -->
        </div>

      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="section bg-image overlay" style="background-image: url('{{ url('Frontend/images/hero_3.jp') }}g');">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading text-white" data-aos="fade">Our Restaurant Menu</h2>
          <p class="text-white" data-aos="fade" data-aos-delay="100">Explore our diverse selection of delicious dishes crafted to delight your taste buds. From savory appetizers to hearty mains and indulgent desserts, each item on our menu is made with the freshest ingredients and a touch of creativity. Whether you're here for a quick bite or a leisurely meal, we have something for everyone. Enjoy your dining experience!</p>

          {{-- <p >
            <div style="justify-content:center;" class="col-md-12 " data-aos="fade" data-aos-delay="100">
                <a  style="color:white;" href="javascript:;"><u>View More</u></a>
            </div>
        </p> --}}

        </div>
      </div>
      <div class="food-menu-tabs" data-aos="fade">
        <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active letter-spacing-2" id="mains-tab" data-toggle="tab" href="#mains" role="tab" aria-controls="mains" aria-selected="true">Mains</a>
          </li>
          <li class="nav-item">
            <a class="nav-link letter-spacing-2" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Desserts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link letter-spacing-2" id="drinks-tab" data-toggle="tab" href="#drinks" role="tab" aria-controls="drinks" aria-selected="false">Drinks</a>
          </li>
        </ul>
        <div class="tab-content py-5" id="myTabContent">


          <div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">

            <div class="row">
                @foreach($formattedMainFood->chunk(5) as $chunk)
                <div class="col-md-6">
                    @foreach($chunk as $main)
                        <div class="food-menu mb-5">

                            <h3 class="text-white">{{ $main['name'] }}</h3>
                            <p class="text-white text-opacity-7">{{ $main['description'] }}</p>
                            <span class="d-block text-primary h4 mb-3">{{ $main['price'] }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($loop->iteration % 2 == 0 && !$loop->last)
                    </div>
                    <div class="row">
                @endif
            @endforeach
        </div>
          </div> <!-- .tab-pane -->

          <div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">

            <div class="row">
                @foreach($formattedDesFood->chunk(5) as $chunk)
                <div class="col-md-6">
                    @foreach($chunk as $dessert)
                        <div class="food-menu mb-5">

                            <h3 class="text-white">{{ $dessert['name'] }}</h3>
                            <p class="text-white text-opacity-7">{{ $dessert['description'] }}</p>
                            <span class="d-block text-primary h4 mb-3">{{ $dessert['price'] }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($loop->iteration % 2 == 0 && !$loop->last)
                    </div>
                    <div class="row">
                @endif
            @endforeach
        </div>
          </div> <!-- .tab-pane -->
          <div class="tab-pane fade text-left" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
            <div class="row">
                @foreach($formattedDriFood->chunk(5) as $chunk)
                <div class="col-md-6">
                    @foreach($chunk as $drink)
                        <div class="food-menu mb-5">

                            <h3 class="text-white">{{ $drink['name'] }}</h3>
                            <p class="text-white text-opacity-7">{{ $drink['description'] }}</p>
                            <span class="d-block text-primary h4 mb-3">{{ $drink['price'] }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($loop->iteration % 2 == 0 && !$loop->last)
                    </div>
                    <div class="row">
                @endif
            @endforeach
        </div>
          </div> <!-- .tab-pane -->
        </div>
      </div>
    </div>
  </section>

  <!-- END section -->
  @include('Frontend.shared.customer_ratings')


  {{-- @include('Frontend.shared.event') --}}
  @include('Frontend.shared.booknow')
{{-- <section class="section bg-image overlay" style="background-image: url('{{ url('Frontend/images/hero_4.jpg') }}');">
      <div class="container" >
        <div class="row align-items-center">
          <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
            <h2 class="text-white font-weight-bold">The Best Place To Stay. Book Now!</h2>
          </div>
          <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ url('/booking')}}" class="btn btn-outline-white-primary py-3 text-white px-5">Book Now</a>
          </div>
        </div>
      </div>
</section> --}}
    @include('Frontend.layout.footer')
@endsection
