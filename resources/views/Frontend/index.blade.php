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
  <section class="section bg-light pb-0"  >
    <div class="container">

      <div class="row check-availabilty" id="next">
        <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

          <form action="#">
            <div class="row">
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkin_date" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkout_date" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                <div class="row">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="adults" class="font-weight-bold text-black">Adults</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="adults" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4+</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="children" class="font-weight-bold text-black">Children</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="children" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4+</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 align-self-end">
                <button class="btn btn-primary btn-block text-white">Check Availabilty</button>
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
        <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">

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
        <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
          <h2 class="heading">Welcome!</h2>
          <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          <p><a href="#" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
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
                        <img class="zoomable-img img-fluid mb-3" title="{{ $singleRoom['title'] }}" src="{{ asset('Frontend/images/rooms/'.$singleRoomImg[0]['image']) }}" alt="alt">
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
            </div>

        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up">

            <figure class="img-wrap">
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
            </div>

        </div>


      </div>
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
          <p class="text-white" data-aos="fade" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
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
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$20.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Murgh Tikka Masala</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$35.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Fish Moilee</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$15.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Safed Gosht</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$10.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">French Toast Combo</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$8.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Vegie Omelet</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$22.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Chorizo &amp; Egg Omelet</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>


          </div> <!-- .tab-pane -->

          <div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
            <div class="row">
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$11.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Banana Split</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$72.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Sticky Toffee Pudding</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$26.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Pecan</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$42.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Apple Strudel</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$7.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Pancakes</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$22.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Ice Cream Sundae</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>
          </div> <!-- .tab-pane -->
          <div class="tab-pane fade text-left" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
            <div class="row">
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$32.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Spring Water</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$14.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Coke, Diet Coke, Coke Zero</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$93.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Orange Fanta</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$18.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Lemonade, Lemon Squash</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$38.35</span>
                  <h3 class="text-white"><a href="#" class="text-white">Sparkling Mineral Water</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
                <div class="food-menu mb-5">
                  <span class="d-block text-primary h4 mb-3">$69.00</span>
                  <h3 class="text-white"><a href="#" class="text-white">Lemon, Lime &amp; Bitters</a></h3>
                  <p class="text-white text-opacity-7">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
              </div>
            </div>
          </div> <!-- .tab-pane -->
        </div>
      </div>
    </div>
  </section>

  <!-- END section -->
  <section class="section testimonial-section">
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
              <img src="{{ url('Frontend/images/person_1.') }}jpg" alt="Image placeholder" class="rounded-circle mx-auto">
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
              <img src="{{ url('Frontend/images/person_3.jpg') }}" alt="Image placeholder" class="rounded-circle mx-auto">
            </div>
            <blockquote>

              <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
            </blockquote>
            <p><em>&mdash; John Doe</em></p>
          </div>


          <div class="testimonial text-center slider-item">
            <div class="author-image mb-3">
              <img src="{{ url('Frontend/images/person_1.jpg') }}" alt="Image placeholder" class="rounded-circle mx-auto">
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
              <img src="{{ url('Frontend/images/person_3.jpg') }}" alt="Image placeholder" class="rounded-circle mx-auto">
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


  {{-- <section class="section blog-post-entry bg-light">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7">
          <h2 class="heading" data-aos="fade-up">Events</h2>
          <p data-aos="fade-up">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">

          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="{{ url('Frontend/images/img_1.jpg') }}" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">Travel Hacks to Make Your Flight More Comfortable</a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
          </div>

        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="200">
          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="{{ url('Frontend/images/img_2.jpg') }}" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">5 Job Types That Aallow You To Earn As You Travel The World</a></h2>
              <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="300">
          <div class="media media-custom d-block mb-4 h-100">
            <a href="#" class="mb-4 d-block"><img src="{{ url('Frontend/images/img_3.jpg') }}" alt="Image placeholder" class="img-fluid"></a>
            <div class="media-body">
              <span class="meta-post">February 26, 2018</span>
              <h2 class="mt-0 mb-3"><a href="#">30 Great Ideas On Gifts For Travelers</a></h2>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. t is a paradisematic country, in which roasted parts of sentences.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

  <section class="section bg-image overlay" style="background-image: url('{{ url('Frontend/images/hero_4.jp') }}g');">
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
@endsection
