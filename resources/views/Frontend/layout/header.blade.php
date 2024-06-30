<header class="site-header js-site-header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="{{ url('/')}}">Hotel De Luna</a></div>
        <div class="col-6 col-lg-8">


          <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
            <span></span>
            <span></span>
            <span></span>
          </div>


          <div class="site-navbar js-site-navbar">
            <nav role="navigation">
              <div class="container">
                <div class="row full-height align-items-center">
                  <div class="col-md-6 mx-auto">
                    <ul class="list-unstyled menu">
                      <li class="active"><a style="font-size:30px;" href="index.html">Home</a></li>
                      <li><a style="font-size:30px;" href="rooms.html">Rooms</a></li>
                      <li><a style="font-size:30px;" href="about.html">About</a></li>
                      <li><a style="font-size:30px;" href="events.html">Events</a></li>
                      <li><a style="font-size:30px;" href="contact.html">Contact</a></li>
                      <li><a style="font-size:30px;" href="reservation.html">Reservation</a></li>
                      <hr class="sidebar-divider" style="height:10px;">
                      <li>
                        <div>
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#signin">
                                Sign-in
                              </button>
                              <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#signup">
                                Sign-up
                              </button>
                        </div>
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


  <!--  Sign-in -->
  <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title" id="exampleModalLongTitle">Sign-in</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="employee_age">Email
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" class="form-control" id="employee_email"  placeholder="Enter Email" name="email" required="">
            </div>
            <div class="form-group">
                <label for="employee_age">Password
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="password" class="form-control" id="employee_email"  placeholder="Enter Password" name="password" required="">
            </div>
            <div class="form-group">

                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}

            </div>
        </div>


        <div style="justify-content:center;" class="modal-footer">
          <button type="submit" class="btn btn-primary text-white">Sign-in</button>
        </div>
      </div>
    </div>
</form>
  </div>

  <!--  Sign-up -->

  <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <label for="firstname">Firstname
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" class="form-control" id="employee_name" placeholder="Enter Firstname" name="Fname"  pattern="[A-Za-z]+" title="Please enter letters only" required="">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" class="form-control" id="employee_lname" placeholder="Enter Lastname" name="Lname"  pattern="[A-Za-z]+" title="Please enter letters only" required="">
            </div>

            <div class="form-group">
                <label for="barangay">Current Address
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" class="form-control" id="employee_address" placeholder="Enter Current Address" name="address"  required="">
            </div>

            <div class="form-group">
                <label for="employee_pnum">Phone Number
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" id="user-employee_pnum" name="phone_num" class="form-control" placeholder="09XXXXXXXXX"
                       pattern="^09\d{9}$"
                       title="Please enter a valid mobile number starting with 09, followed by 9 digits.">
            </div>

            <div class="form-group">
                <label for="employee_age">Email
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="text" class="form-control" id="employee_email"  placeholder="Enter Email" name="email" required="">
            </div>

            <div class="form-group">
                <label for="employee_age">Password
                    <span style="color:red; " class="astk">*</span>
                </label>
                <input type="password" class="form-control" id="employee_email"  placeholder="Enter Password" name="password" required="">
            </div>
        </div>
        <div class="form-group" style="margin-left:20px;">
            <a href="#"><u>Forgot password?</u></a>
        </div>

            <div style="justify-content:center;" class="modal-footer">
                <button type="submit" class="btn btn-primary text-white">Sign-up</button>
              </div>

      </div>
    </div>
  </div>

