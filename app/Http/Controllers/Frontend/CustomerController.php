<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Auth;
use Validator;

class CustomerController extends Controller
{

        public function signIn(Request $request)
    {
        $email = $request->input('email');
        $key = 'login-attempts:' . $email;

        if ($request->ajax()) {
            $data = $request->all();

            // Check for rate limiting
            if (RateLimiter::tooManyAttempts($key, 5)) {
                return response()->json(['type' => 'error', 'message' => 'Too many login attempts. Please try again later.']);
            }

            $validator = Validator::make($request->all(), [

                'g-recaptcha-response' => 'required',
            ], [
                'g-recaptcha-response.required' => 'reCaptcha is required!',
            ]);

            if ($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // Clear the rate limiter on successful login
                    RateLimiter::clear($key);

                    $redirectTo = url('/');

                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                } else {
                    // Increment the rate limiter attempts
                    RateLimiter::hit($key);

                    return response()->json(['type' => 'incorrect', 'message' => 'Incorrect Email or Password!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        }
    }
    public function signUp(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'Fname' => 'required|string',
            'Lname' => 'required|string',
            'address' => 'required|string',
            'phone_num' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
        ]);

        // Create new User instance
        $saveCustomer = new User;
        $saveCustomer->Fname = $validatedData['Fname'];
        $saveCustomer->Lname = $validatedData['Lname'];
        $saveCustomer->address = $validatedData['address'];
        $saveCustomer->phone_num = $validatedData['phone_num'];
        $saveCustomer->email = $validatedData['email'];

        // Hash the password before saving it
        $saveCustomer->password = bcrypt($validatedData['password']);

        // Save the user to the database
        $saveCustomer->save();

        // Return success response
        return response()->json([
            'message' => 'Account Created Successfully!',
            'status' => 'createdAccount',
        ], 201);
    }

    public function Logout(){
        Auth::logout();

        return redirect('/');
    }

}
