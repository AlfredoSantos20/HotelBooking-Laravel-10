
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
                <div class="card-header py-3" style="background-color:#4e73df;">
                    <h6 class="m-0 font-weight-bold text-white">{{ $title }}</h6>
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
                                <input type="text" class="form-control" id="employee_name" placeholder="Enter Firstname" name="Fname"  pattern="[A-Za-z]+" title="Please enter letters only" required="">
                            </div>

                            <div class="form-group">
                                <label for="middlename">Middlename (optional)</label>
                                <input type="text" class="form-control" id="employee_mname" placeholder="Enter Middlename" name="Mname" pattern="[A-Za-z]+" title="Please enter letters only">
                            </div>


                            <div class="form-group">
                                <label for="lastname">Lastname
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_lname" placeholder="Enter Lastname" name="Lname"  pattern="[A-Za-z]+" title="Please enter letters only" required="">
                            </div>

                            <div class="form-group">
                                <label for="type">Suffix</label>
                                <select class="form-control" id="employee_suffix" name="Suffix" style="color:#000;">
                                <option value="">Select</option>
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
                                <input type="date" class="form-control" id="employee_birthday" name="birthday"  required="">
                            </div>


                            <div class="form-group">
                                <label for="employee_age">Age</label>
                                <input style="" type="text" class="form-control" id="employee_age" name="age" readonly>
                            </div>

                            <div class="form-group">
                                <label for="type">Sex</label>
                                <select class="form-control" id="employee_sex" name="sex" style="color:#000;" required="">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
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
                                <label for="region">Region
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="region" name="region"  required="">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $data)
                                    <option value="{{ $data['region_id'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="province">Province
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="province" name="province"  required=""></select>
                            </div>

                            <div class="form-group">
                                <label for="city">City
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="city" name="city"   required=""></select>
                            </div>

                            <div class="form-group">
                                <label for="barangay">Barangay
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="barangay" name="barangay"   required=""></select>
                            </div>

                            <div class="form-group">
                                <label for="barangay">Current Address
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <input type="text" class="form-control" id="employee_address" placeholder="Enter Current Address" name="address"  required="">
                            </div>



                            <div class="form-group">
                                <label for="type">Choose Position
                                    <span style="color:red; " class="astk">*</span>
                                </label>
                                <select class="form-control" id="employee_position" name="position" style="color:#000;" required="">
                                <option value="">Select</option>
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
                            @if(!empty($Employee['profile_pic']))
                            <a target="_blank" href="{{ url('Backend/img/small/'.$Employee['profile_pic'])  }}">View Image</a>
                            @endif
                            </div>


                        </div>
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
