<header class="site-header js-site-header">
    <style>
        .dropdown-item:hover {
            cursor: pointer;
        }
    </style>
    <div class="container-fluid">
      <div class="row align-items-center">
        <div style="font-size:20px;" class="col-6 col-lg-4 site-logo dropdown" data-aos="fade"><a type="button" data-toggle="dropdown" href="javascript:;" >
                @if(Auth::check()) My Account @else Sign-up/Sign-in @endif

            <ul class="dropdown-menu">
                @if(Auth::check())
                           {{-- gonna put account settings, logout etc here --}}
                <li><a title="My Booked" style="font-size:15px;" class="text-dark" href="#">&nbsp; <i class="fa-solid fa-door-open"></i></i></i></i> My Booked</a> ({{ $bookingCount ?? 0 }})</li>
                <li><a title="Setting" style="font-size:15px;" class="text-dark" href="#">&nbsp;  <i class="fa-solid fa-gear"></i></i> Settings</a></li>
                <li><a title="Logout" style="font-size:15px;" class="text-dark" href="{{url('logout')}}">&nbsp;  <i class="fa-solid fa-right-to-bracket"></i> Logout</a></li>
               @else
               <li><a title="Sign-in" style="font-size:15px;" class="text-dark" href="javascript:;" data-toggle="modal" data-target="#Empsignin">&nbsp;  <i class="fa-solid fa-right-to-bracket"></i> Employee</a></li>
                <li><a title="Sign-in" style="font-size:15px;" class="text-dark" href="javascript:;" data-toggle="modal" data-target="#signin">&nbsp;  <i class="fa-solid fa-right-to-bracket"></i> Customer </a></li>
                {{-- <li><a title="Sign-up" style="font-size:15px;"  class="text-dark" href="javascript:;" data-toggle="modal" data-target="#signup">&nbsp;  <i class="fa-solid fa-user-plus"></i> Sign-up</a></li> --}}
              @endif
            </ul>
          </div></a>


        <div class="col-6 col-lg-8">



          <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
            <span></span>
            <span></span>
            <span></span>
          </div>

          <style>
            .modal-body {
            max-height: 400px; /* Adjust this height as needed */
            overflow-y: auto;
                        }
          </style>


<div class="site-navbar js-site-navbar">
    <nav role="navigation">
        <div class="container">
            <div class="row full-height align-items-center">
                <div class="col-md-6 mx-auto">
                    <ul class="list-unstyled menu">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a style="font-size:30px;" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="{{ Request::is('rooms') ? 'active' : '' }}">
                            <a style="font-size:30px;" href="#">Rooms</a>
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}">
                            <a style="font-size:30px;" href="#">About</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a style="font-size:30px;" href="#">Contact</a>
                        </li>
                        <li class="{{ Request::is('booking') ? 'active' : '' }}">
                            <a style="font-size:30px;" href="{{ url('/booking') }}">Booking</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

        </div>
      </div>
    </div>
  </header>

  <!-- Sign-in Sign-up Modal -->


  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  @if(Session::has('success_message'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success:</strong> {{ Session::get('success_message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
   </div>
   @endif

   @if(Session::has('error_message'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error:</strong> {{ Session::get('error_message')}}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
     </button>
    </div>
    @endif

    @if($errors->any())
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error:</strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
     </button>
    </div>
    @endif

  <!--Customer  Sign-in -->
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form id="loginForm" action="javascript:;" method="post">@csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sign-in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="signin-error"></p>
                    <div class="form-group">
                        <label for="employee_email">Email
                            <span style="color:red;" class="astk">*</span>
                        </label>
                        <input type="text" class="form-control" id="user-email" placeholder="Enter Email" name="email" required>
                        <p id="signin-email"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_password">Password
                            <span style="color:red;" class="astk">*</span>
                        </label>
                        <input type="password" class="form-control" id="user-password" placeholder="Enter Password" name="password" required>
                        <p id="signin-password"></p>
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        <span style="color:red;" id="g-recaptcha-response-error" class="error"></span>
                    </div>
                    <p id="countdown-timer" style="display:none; color:red;">30 seconds </p> <!-- Hidden initially -->
                </div>
                <div class="form-group" style="margin-left:20px;">
                    <a href="javascript:;" class="text-center" data-toggle="modal" data-target="#forgotpassword" data-dismiss="modal"><u>Forgot password?</u></a>
                </div>
                <div style="justify-content:center;" class="modal-footer">
                    <button type="submit" id="signin-button" class="btn btn-primary text-white">Sign-in</button>
                </div>
                <a href="javascript:;" class="text-center" data-toggle="modal" data-target="#signup" data-dismiss="modal"><u>Don't have an account yet?</u></a>
            </div>
        </div>
    </form>
</div>


  <!-- Customer Sign-up -->

  <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form id="signupForm" action="javascript:;" method="post">@csrf
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title " id="exampleModalLongTitle">Sign-up</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label for="firstname">Firstname <span style="color:red;" class="astk">*</span></label>
                <input type="text" name="Fname" class="form-control" id="employee_name" placeholder="Enter Firstname" name="Fname" pattern="[A-Za-z]+" title="Please enter letters only" required="">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname <span style="color:red;" class="astk">*</span></label>
                <input type="text" name="Lname" class="form-control" id="employee_lname" placeholder="Enter Lastname" name="Lname" pattern="[A-Za-z]+" title="Please enter letters only" required="">
            </div>

            <div class="form-group">
                <label for="barangay">Current Address <span style="color:red;" class="astk">*</span></label>
                <input type="text" name="address" class="form-control" id="employee_address" placeholder="Enter Current Address" name="address" required="">
            </div>

            <div class="form-group">
                <label for="employee_pnum">Phone Number <span style="color:red;" class="astk">*</span></label>
                <input type="text" name="phone_num" id="user-employee_pnum" name="phone_num" class="form-control" placeholder="09XXXXXXXXX" pattern="^09\d{9}$" title="Please enter a valid mobile number starting with 09, followed by 9 digits.">
                <span style="color:red;" id="phone_num-error" class="error"></span>
            </div>

            <div class="form-group">
                <label for="employee_age">Email <span style="color:red;" class="astk">*</span></label>
                <input type="email" name="email" class="form-control" id="employee_email" placeholder="Enter Email" name="email" required="">
                <span style="color:red;" id="email-error" class="error"></span>
            </div>

            <div class="form-group">
                <label for="password">Password <span style="color:red;" class="astk">*</span></label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password <span style="color:red;" class="astk">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
                <small id="passwordHelp" class="form-text text-danger"></small>
            </div>

            <div class="form-group">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                <span style="color:red;" id="g-recaptcha-response-error" class="error"></span>
            </div>
        </div>

        <div style="justify-content:center;" class="modal-footer">
            <button type="submit" id="signup-btn" class="btn btn-primary text-white">Sign-up</button>
        </div>
        <a href="javascript:;" class="text-center" data-toggle="modal" data-target="#signin" data-dismiss="modal"><u>Go to Sign-in?</u></a>
      </div>
    </div>
    </form>
</div>


{{-- Employee Sign-in --}}

<div class="modal fade" id="Empsignin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form id="EmploginForm" action="javascript:;" method="post">@csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Employee Sign-in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="emp-signin-error"></p>
                    <div class="form-group">
                        <label for="employee_email">Email
                            <span style="color:red;" class="astk">*</span>
                        </label>
                        <input type="text" class="form-control" id="emp-email" placeholder="Enter Email" name="email" required>
                        <p id="emp-signin-email"></p>
                    </div>
                    <div class="form-group">
                        <label for="employee_password">Password
                            <span style="color:red;" class="astk">*</span>
                        </label>
                        <input type="password" class="form-control" id="emp-password" placeholder="Enter Password" name="password" required>
                        <p id="emp-signin-password"></p>
                    </div>
                    <div class="form-group" >
                        <input type="checkbox" id="show-password"> Show Password
                    </div>
                    <div class="form-group">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <p id="emp-countdown-timer" style="display:none; color:red;">30 seconds </p> <!-- Hidden initially -->
                </div>
                <div style="justify-content:center;" class="modal-footer">
                    <button type="submit" id="emp-signin-button" class="btn btn-primary text-white">Sign-in</button>
                </div>
            </div>
        </div>
    </form>
</div>





{{--Customer FORGOT PASSWORD --}}

<div class="modal fade" id="forgotpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLongTitle">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Send OTP Form -->
            <form id="forgotpassForm" action="javascript:;" method="post">@csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email <span style="color:red;" class="astk">*</span></label>
                        <input type="email" id='email' name="email" class="form-control" placeholder="Enter Email" required="">
                    </div>
                </div>
                <div class="modal-footer" style="justify-content:center;">
                    <button type="submit" class="btn btn-primary text-white">Send OTP</button>
                </div>
            </form>

            <!-- Verify OTP Form (Initially Hidden) -->
            <form id="otpForm" style="display:none;" action="javascript:;" method="post">@csrf
                <input name="email" id="hiddenEmail" type="hidden">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="otp">Enter OTP <span style="color:red;" class="astk">*</span></label>
                        <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required="">
                        <div id="otpTimer" style="color:red;" class="mt-2" style="display: none;">
                            <span  id="timerDisplay">60</span> seconds remaining <br> OTP has been sent please check your registered email.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-white">Verify OTP</button>
                    <button type="button" id="resendOtp" class="btn btn-secondary" style="display: none;">Resend OTP</button>
                </div>
            </form>
        </div>
    </div>
</div>



