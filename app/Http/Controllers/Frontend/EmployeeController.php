<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounts;
use Auth;
use Validator;

class EmployeeController extends Controller
{

    // public function empSignin(Request $request)
    // {

    // // Attempt to authenticate the employee
    // if (Auth::guard('midware')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //     // Redirect to backend dashboard upon successful signin
    //     return response()->json(['success' => true, 'redirect_url' => url('hotel-de-luna/dashboard')]);
    // } else {
    //     return response()->json(['success' => false, 'message' => 'Invalid email or password.']);
    // }
    // }


 public function empSignin(Request $request)
    {

   // Validate the request
   $request->validate([
    'email' => 'required|email',
    ]);

        // Check if the employee exists by email
        $employee = Accounts::where('email', $request->email)->first();

        if ($employee) {
            // Email exists; you can redirect or return a success response
            return response()->json(['success' => true, 'redirect_url' => url('hotel-de-luna/login')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid email.']);
        }
    }



}

