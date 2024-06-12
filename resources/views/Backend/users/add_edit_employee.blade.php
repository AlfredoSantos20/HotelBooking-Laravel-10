
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Employee Management</strong></h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Employee Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#4e73df;">
                    <h6 class="m-0 font-weight-bold text-white"></h6>
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
                        <form class="forms-sample" @if(empty($employee['id'])) action="{{ url('users-management/add-edit-employee') }}" @else action="{{ url('Backend/add-edit-employee/'.$employee['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                            <input type="text" class="form-control" id="employee_name" placeholder="Enter Firstname" name="Fname" >
                            </div>

                            <div class="form-group">
                            <input type="text" class="form-control" id="employee_lname" placeholder="Enter Lastname" name="Lname" >
                            </div>

                            <div class="form-group">
                                <label for="employee_birthday">Birthday</label>
                                <input type="date" class="form-control" id="employee_birthday" name="birthday">
                            </div>

                            <div class="form-group">
                                <label for="employee_age">Age</label>
                                <input type="text" class="form-control" id="employee_age" name="age" readonly>
                            </div>

                            <div class="form-group">
                                <label for="region">Region</label>
                                <select class="form-control" id="region" name="region">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $data)
                                    <option value="{{ $data['region_id'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="province">Province</label>
                                <select class="form-control" id="province" name="province" ></select>
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="form-control" id="city" name="city"></select>
                            </div>

                            <div class="form-group">
                                <label for="barangay">Barangay</label>
                                <select class="form-control" id="barangay" name="barangay"></select>
                            </div>

                            <div class="form-group">
                                <label for="barangay">Current Address</label>
                                <input type="text" class="form-control" id="employee_address" placeholder="Enter Current Address" name="address" >
                            </div>



                            <div class="form-group">
                                <label for="type">Choose Position</label>
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
