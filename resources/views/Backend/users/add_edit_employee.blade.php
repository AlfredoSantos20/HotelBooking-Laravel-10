
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong></strong></h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Employee Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center " style="background-color:#17A2B8;">
                    <a style="float:left; color:white;" title="Back to Employee?" href="{{ url('users-management/employee')}}"><i class="fa-solid fa-arrow-left"></i> </a>

                    <h6 class="m-0 font-weight-bold text-white ">{{ $title }}</h6>

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

                    <div class="card-body">
                        <form id="employeeForm" class="forms-sample" @if(empty($Employee['id'])) action="{{ url('users-management/add-edit-employee') }}" @else action="{{ url('users-management/add-edit-employee/'.$Employee['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf

                            <div class="form-group">
                                <label for="firstname">Firstname
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_name" placeholder="Enter Firstname" name="Fname"  value="{{ $Employee['Fname'] ?? '' }}" pattern="[A-Za-z]+" title="Please enter letters only" required="">
                            </div>

                            <div class="form-group">
                                <label for="middlename">Middlename (optional)</label>
                                <input type="text" class="form-control" id="employee_mname" placeholder="Enter Middlename" name="Mname" value="{{ $Employee['Mname'] ?? '' }}" pattern="[A-Za-z]+" title="Please enter letters only">
                            </div>


                            <div class="form-group">
                                <label for="lastname">Lastname
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_lname" placeholder="Enter Lastname" name="Lname"  value="{{ $Employee['Lname'] ?? '' }}" pattern="[A-Za-z]+" title="Please enter letters only" required="">
                            </div>

                            <div class="form-group">
                                <label for="type">Suffix</label>
                                <select class="form-control" id="employee_suffix"   name="Suffix" style="color:#000;">
                                <option   @if(!empty($Employee['Suffix'])) selected="" @endif value="{{ $Employee['Suffix'] }}">  @if(empty($Employee['Suffix']))Select  @else {{ $Employee['Suffix'] }} @endif</option>
                                <option value="Jr">Jr. (Junior)</option>
                                <option value="Sr">Sr. (Senior)</option>
                                <option value="II">II (The Second)</option>
                                <option value="III">III (The Third)</option>
                                <option value="IV">IV (The Fourth)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_birthday">Birthday
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="date" class="form-control" id="employee_birthday" name="birthday" value="{{ $Employee['birthday'] ?? '' }}" required="">
                            </div>


                            <div class="form-group">
                                <label for="employee_age">Age</label>
                                <input style="" type="text" class="form-control" id="employee_age" value="{{ $Employee['age'] ?? '' }}" name="age" readonly>
                            </div>

                            <div class="form-group">
                                <label for="type">Sex</label>
                                <select class="form-control" id="employee_sex" name="sex" style="color:#000;" required="">
                                <option @if(!empty($Employee['sex'])) selected="" @endif value="{{ $Employee['sex'] }}">  @if(empty($Employee['sex']))Select  @else {{ $Employee['sex'] }} @endif</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_pnum">Phone Number
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" id="user-employee_pnum" name="phone_num" class="form-control" value="{{ $Employee['phone_num'] ?? '' }}" placeholder="09XXXXXXXXX"
                                       pattern="^09\d{9}$"
                                       title="Please enter a valid mobile number starting with 09, followed by 9 digits.">
                            </div>



                            <div class="form-group">
                                <label for="employee_age">Email
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_email" value="{{ $Employee['email'] ?? '' }}"  placeholder="Enter Email" name="email" required="">
                            </div>


                            <div class="form-group">
                                <label for="region">Region
                                    <span style="color:red;" class="astk">*</span>
                                </label>
                                <select class="form-control" id="region" name="region" required="">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $data)
                                    <option value="{{ $data['region_id'] }}" {{ $data['region_id'] == $Employee->region_id ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="province">Province
                                    <span style="color:red;" class="astk">*</span>
                                </label>
                                <select class="form-control" id="province" name="province" required="">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $data)
                                    <option value="{{ $data['province_id'] }}" {{ $data['province_id'] == $Employee->province_id ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city">City
                                    <span style="color:red;" class="astk">*</span>
                                </label>
                                <select class="form-control" id="city" name="city" required="">
                                    <option value="">Select City</option>
                                    @foreach($cities as $data)
                                    <option value="{{ $data['city_id'] }}" {{ $data['city_id'] == $Employee->city_id ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="barangay">Barangay
                                    <span style="color:red;" class="astk">*</span>
                                </label>
                                <select class="form-control" id="barangay" name="barangay" required="">
                                    <option value="">Select Barangay</option>
                                    @foreach($barangays as $data)
                                    <option value="{{ $data['id'] }}" {{ $data['id'] == $Employee->barangay_id ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="barangay">Current Address
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_address" placeholder="Enter Current Address" name="address"  value="{{ $Employee['address'] ?? '' }}" required="">
                            </div>



                            <div class="form-group">
                                <label for="type">Choose Position
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="employee_position" name="position" style="color:#000;" required="">
                                <option @if(!empty($Employee['position'])) selected="" @endif value="{{ $Employee['position'] }}">  @if(empty($Employee['position']))Select  @else {{ $Employee['position'] }} @endif</option>
                                <option value="Manager">Manager</option>
                                <option value="Chef">Chef</option>
                                <option value="Cleaner">Cleaner</option>
                                <option value="Staff">Staff</option>
                                <option value="Bartender">Bartender</option>
                                <option value="Server">Server</option>
                                </select>
                                </div>


                            <div class="form-group">
                            <label for="profile_pic">Profile Image
                                <span style="color:red; " class="astk">*</span>
                            </label>
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                            <div style="margin-top:20px;">
                                @if (!empty($Employee['profile_pic']))
                                <img width="25%" src="{{ url('Backend/img/small/' . $Employee['profile_pic']) }}" alt="alt">
                             @else
                                <img width="25%" src="{{ url('Backend/img/small/no-image.jpg') }}" alt="alt">
                             @endif
                            </div>
                            </div>


                        </div>
                        <div style="justify-content:center;" class="modal-footer">
                            <button type="submit" style="background-color:#17A2B8;" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
