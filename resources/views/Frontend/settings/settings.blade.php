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
              <h1 class="heading mb-3">Settings</h1>
              <ul class="custom-breadcrumbs mb-4">
                <li><a href="{{ url('/')}} ">Home</a></li>
                <li>&bullet;</li>
                <li>Settings</li>
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
            <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

                <form id="customerSetting" action="{{ route('customerSetting', ['id' => Auth::user()->id]) }}" method="post" class="bg-white p-md-5 p-4 mb-5 border mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-center">
                        <h1>Personal Details</h1>
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

                    <div class="form-group">
                        <label class="text-black font-weight-bold" for="fname">Email</label>
                        <input type="text" id="Fname" class="form-control" value="{{Auth::user()->email}}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-black font-weight-bold" for="fname">First Name</label>
                            <input type="text" id="Fname" class="form-control" value="{{Auth::user()->Fname}}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-black font-weight-bold" for="lname">Last Name</label>
                            <input type="text" id="Lname" class="form-control" value="{{Auth::user()->Lname}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-black font-weight-bold" for="num">Phone Number</label>
                            <input type="text" name="phone_num" id="user-employee_pnum" value="{{ Auth::user()->phone_num }}" class="form-control" placeholder="09XXXXXXXXX" pattern="^09\d{9}$" title="Please enter a valid mobile number starting with 09, followed by 9 digits." required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-black font-weight-bold" for="address">Current Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-weight-bold" for="image">Profile Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        <div style="margin-top:20px;">
                            @if (!empty(Auth::user()->image))
                                <img width="25%" src="{{ url('Frontend/images/customerImages/' . Auth::user()->image) }}" alt="alt">
                            @else
                                <img title="NO IMAGE YET" width="25%" src="{{ url('Frontend/images/customerImages/no-user-image.png') }}" alt="alt">
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 form-group text-center">
                            <input type="submit" value="Save" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                        </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </section>


    @include('Frontend.shared.customer_ratings')


    @include('Frontend.shared.booknow')
    @include('Frontend.layout.footer')



@endsection
