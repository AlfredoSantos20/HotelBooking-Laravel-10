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

    $regions = Region::get(['name','region_id'])->toArray();

    $employees = Employee::where('status',1)->get()->toArray();
    return view('Backend.users.employee')->with(compact('employees', 'regions'));
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

    public function storeEmployee(Request $request,$id=null){
        $regions = Region::get(['name','region_id'])->toArray();
        $provinces = Province::get(['name','province_id'])->toArray();
        $cities = City::get(['name','city_id'])->toArray();
        //dd($provinces);


        if($id==""){
            $title = "Add Employee";
            $employee = new Employee;
        }else{
            $title = "Edit Employee";
            $Employee = Employee::find($id);
            $message = "Employee updated successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();


            //echo "<pre>"; print_r($data); die;

            $rules = [
                'Fname' => 'required|unique:Employees',
                'birthday'=> 'required',

        ];
        $customeMessages = [

            'Fname.required' => 'Employee FirstName is Required!',
            'birthday.required' => 'Employee Birthday is Required!',
            'Fname.regex' => 'Valid Employee Name is Required!',

        ];
        $this->validate($request,$rules,$customeMessages);

            $Employee->Fname= $data['Fname'];
            $Employee->Lname= $data['Lname'];
            $Employee->birthday= $data['birthday'];
            $Employee->age= $data['age'];
            $Employee->region_id = $data['region'];
            $Employee->province_id = $data['province'];
            $Employee->city_id = $data['city'];
            $Employee->barangay_id = $data['barangay'];
            $Employee->address = $data['address'];
            $Employee->position = $data['position'];
            $Employee->status= 1;
            $Employee->save();




        return redirect('Backend/employee')->with('success_message',$message);
        }

        return view('Backend.users.add_edit_Employee')->with(compact('title','employee','regions','provinces','cities'));
    }

    // END EMPLOYEE MANAGEMENT


    //Logout
    public function logout(){
        Auth::guard('midware')->logout();
        return redirect('hotel-de-luna/login');
    }

}
