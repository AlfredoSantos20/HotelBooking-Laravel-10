<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\Account;
use Auth;
use Validator;



class EmployeeController extends Controller
{

    public function empSignin(Request $request)
    {

    // Attempt to authenticate the employee
    if (Auth::guard('midware')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // Redirect to backend dashboard upon successful signin
        return response()->json(['success' => true, 'redirect_url' => url('hotel-de-luna/dashboard')]);
    } else {
        return response()->json(['success' => false, 'message' => 'Invalid email or password.']);
    }
    }
}

