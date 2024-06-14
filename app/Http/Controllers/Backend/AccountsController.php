<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Barangay;
use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use Yajra\Address\HasAddress;
use Auth;
use Image;
class AccountsController extends Controller
{
    public function dashboard(){
        return view('Backend.dashboard');
    }

    //Error 404
    public function error(){
        return view('Backend.error');
    }


    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $customMessages = [
                'email.required' => "Email is Required!",
                'email.email' => "Valid Email is Required!",
                'password.required' => "Password is Required!",

            ];
            $this->validate($request,$rules,$customMessages);

            if(Auth::guard('midware')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                //Remember Admin Email & Password with cookies
                if(isset($data['remember']) && !empty($data['remember'])){
                    setcookie("email",$data['email'],time()+3600);
                    setcookie("password",$data['password'],time()+3600);
                }else{
                    setcookie("email","");
                    setcookie("password","");
                }

                return redirect("hotel-de-luna/dashboard");
            }else{
                return redirect()->back()->with("error_message","Invalid Email or Password!");
            }
        }
        return view('Backend.login');
    }



//START EMPLOYEE
public function employee() {

    $employees = Employee::with(['region','province','city','barangay'])->where('status',1)->get()->toArray();
    //dd($employees);
    return view('Backend.users.employee')->with(compact('employees'));
}
    //END EMPLOYEE

    //START FETCHING PHILIPPINES FUNCTIONS
    public function fetchProvinces(Request $request) {
        $data['provinces'] = Province::where('region_id', $request->region_id)->get(['name', 'province_id'])->toArray();

        return response()->json($data);
    }
    public function fetchCities(Request $request) {
        $data['cities'] = City::where('province_id', $request->province_id)->get(['name', 'city_id'])->toArray();

        return response()->json($data);
    }

    public function fetchBrgy(Request $request) {
        $data['barangays'] = Barangay::where('city_id', $request->city_id)->get(['name', 'id'])->toArray();

        return response()->json($data);
    }

    //END FETCHING PHILIPPINES FUNCTIONS

    //Add employe to DB FUNCTION

    public function storeEmployee(Request $request, $id = null)
    {
        $regions = Region::get(['name', 'region_id'])->toArray();
        $provinces = Province::get(['name', 'province_id'])->toArray();
        $cities = City::get(['name', 'city_id'])->toArray();

        if ($id == "") {
            $title = "Add Employee";
            $Employee = new Employee; // Correctly initialize $Employee for new record
            $message = "Employee added successfully!";
        } else {
            $title = "Edit Employee";
            $Employee = Employee::find($id); // Correctly initialize $Employee for existing record
            if (!$Employee) {
                return redirect('Backend/employee')->with('error_message', 'Employee not found');
            }
            $message = "Employee updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Validation rules and custom messages
            $rules = [
                'Fname' => 'required|regex:/^[a-zA-Z\s\-\'`]+$/',
                'Lname' => 'required|regex:/^[a-zA-Z\s\-\'`]+$/',
                'birthday' => ['required','before:12 years ago'],
                'email' => 'required|email',
                'profile_pic' => 'nullable|image',
            ];

            $customMessages = [
                'Fname.required' => 'Employee FirstName is Required!',
                'Fname.regex' => 'Valid Employee FirstName is Required!',
                'Lname.required' => 'Employee LastName is Required!',
                'Lname.regex' => 'Valid Employee LastName is Required!',
                'birthday.required' => 'Employee Birthday is Required!',
                'birthday.date' => 'Employee Birthday must be a valid date!',
                'email.required' => 'A valid Email is Required!',
                'email.email' => 'A valid Email is Required!',
                'profile_pic.image' => 'The file should be an Image!',
            ];

            $this->validate($request, $rules, $customMessages);

            //SAVING TO DB
            $Employee->Fname = ucwords(strtolower($data['Fname']));
            $Employee->Mname = ucwords(strtolower($data['Mname']));
            $Employee->Lname = ucwords(strtolower($data['Lname']));
            $Employee->Suffix = $data['Suffix'];
            $Employee->birthday = $data['birthday'];
            $Employee->age = $data['age'];
            $Employee->phone_num = $data['phone_num'];
            $Employee->sex = $data['sex'];
            $Employee->region_id = $data['region'];
            $Employee->province_id = $data['province'];
            $Employee->city_id = $data['city'];
            $Employee->barangay_id = $data['barangay'];
            $Employee->address = $data['address'];
            $Employee->position = $data['position'];

            $Employee->email = $data['email'];
            $Employee->status = 1;

            // Handle file upload for profile picture
            if ($request->hasFile('profile_pic')) {
                $image_tmp = $request->file('profile_pic');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $largeImagePath = public_path('Backend/img/large/' . $imageName);
                    $mediumImagePath = public_path('Backend/img/medium/' . $imageName);
                    $smallImagePath = public_path('Backend/img/small/' . $imageName);
                    // Upload the Image
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallImagePath);
                    // Insert Image in table
                    $Employee->profile_pic = $imageName;
                }
            }

            // Save the Employee object
            $Employee->save();

            return redirect()->back()->with('success_message', $message);
        }

        return view('Backend.users.add_edit_Employee')->with(compact('title', 'Employee', 'regions', 'provinces', 'cities'));
    }
    // END EMPLOYEE MANAGEMENT


    //Logout
    public function logout(){
        Auth::guard('midware')->logout();
        return redirect('hotel-de-luna/login');
    }

}
