
@extends('Backend.layout.layout')
@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><strong>Employee Management</strong></h1>

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
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <!-- Employee Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color:#4e73df;">
                    <h6 class="m-0 font-weight-bold text-white">Employee's List</h6>

                        <a style="max-width: 150px; float: right; display: inline-block;" href="{{ route('add-employee')}}" class="btn btn-block btn btn-outline-light btn-sm"> + Add Employee</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="employee" width="100%" cellspacing="0">
                            <thead >
                                <tr>
                                    <th class="text-center text-dark"><strong>Profile Image</strong></th>
                                    <th class="text-center text-dark"><strong>Name</strong></th>
                                    <th class="text-center text-dark"><strong>Position</strong></th>
                                    <th class="text-center text-dark"><strong>Age</strong></th>
                                    <th class="text-center text-dark"><strong>Address</strong></th>
                                    <th class="text-center text-dark"><strong>Phone Number</strong></th>
                                    <th class="text-center text-dark"><strong>Salary</strong></th>
                                    <th class="text-center text-dark"><strong>Status</strong></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td class="text-center text-dark">
                                        @if(!empty($employee['profile_pic']))

                                        @else
                                        <img style="width: 80px; height: 80px;" src="{{ asset('Backend/img/small/no-image.jpg') }}">
                                       @endif
                                    </td>
                                    <td class="text-center text-dark">{{ $employee['Fname'] }} {{ $employee['Lname'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['position'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['age'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['address'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['phone_num'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['salary'] }}</td>
                                    <td class="text-center text-dark">{{ $employee['status'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('Backend.layout.footer')
    </div>

@endsection
