<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                'password' => 'required|max:30'
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
    //Logout
    public function logout(){
        Auth::guard('midware')->logout();
        return redirect('hotel-de-luna/login');
    }

}
